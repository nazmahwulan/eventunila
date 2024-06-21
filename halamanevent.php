<?php
include 'function.php';
include 'navbar.php';

//pagination
$jumlahDataPerHalaman = 6;
$events = query("SELECT * FROM events");
$jumlahData = count($events);
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$event = query("SELECT * FROM events WHERE events.status ='disetujui' ORDER BY id LIMIT $awalData, $jumlahDataPerHalaman");

// Mendapatkan kata kunci pencarian dari URL
$searchKeyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/2eb34c602e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />

</head>

</head>

<body>
    <div class=" mx-10 lg:mx-28  mt-[50px] lg:mt-[100px] flex justify-between">
        <h1 class="text-[#756AB6] font-bold text-2xl md:text-3xl text-justify md:hidden">Event <br> Mendatang</h1>
        <h1 class="text-[#756AB6] font-bold text-2xl md:text-3xl hidden md:block">Event Mendatang</h1>
        <form action="halamanevent.php" method="post" class="my-5 md:mt-[-6px]">
            <div class="relative inline-block w-44">
                <select name="kategori" class="block appearance-none w-full px-4 pr-8 h-10 bg-white border-2 border-[#756AB6] rounded-xl leading-tight focus:outline-none focus:bg-white focus:border-purple-500" onchange="this.form.submit()">
                    <option class="text-black font-bold text-sm" value="">Pilih Kategori</option>
                    <?php
                    $kategori = getkategori();
                    foreach ($kategori as $row) {
                        $selected = isset($_POST['kategori']) && $_POST['kategori'] == $row['id'] ? 'selected' : '';
                        echo "<option value='" . $row['id'] . "' $selected>" . $row['kategori'] . "</option>";
                    }
                    ?>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                    </svg>
                </div>
            </div>
        </form>
    </div>

    <div class="flex flex-wrap list-none mx-14  my-5 lg:mx-32 ">
        <div class="flex hover:text-[#756AB6] font-semibold">
            <a href="index.php">
                <i class="ti ti-home-filled pr-2"></i>Home</a>
        </div>
        <span class="mx-2">/</span>
        <a href="halamanevent.php">
            <li class="text-[#756AB6] font-semibold">Event</li>
        </a>
    </div>

    <?php
    $kategori_id = isset($_POST['kategori']) ? $_POST['kategori'] : '';
    $events = getEvents($kategori_id, $searchKeyword);
    ?>
    <?php if ($searchKeyword && empty($events)) : ?>
        <div class="mx-auto px-28">
            <p>Data tidak ditemukan untuk kata kunci"<?php echo htmlspecialchars($searchKeyword); ?>".</p>
        </div>
    <?php else : ?>
        <div class="flex justify-center grid gap-8 my-5 mx-10 lg:mx-28 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
            <?php foreach ($events as $row) : ?>
                <?php
                $date = date_create($row['tanggal']);
                $time = date_create($row['waktu']);
                ?>
                <div class="rounded-xl border-2 border-[#AC87C5]">
                    <a href="detailevent.php?id=<?php echo $row["id"]; ?>">
                        <img class="rounded-t-xl w-full h-52" src="img/<?php echo $row["gambar"]; ?>">
                        <div class="mx-8 my-6">
                            <h4 class="truncate text-xl font-bold mb-2"><?php echo $row["judul"]; ?></h4>
                            <div class="flex justify-between mb-2 text-[#AC87C5] font-bold">
                                <div class="flex items-center gap-2">
                                    <i class="ti ti-calendar text-base"></i>
                                    <p class="text-sm text-start"><?php echo date_format($date, "d M Y"); ?></p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="ti ti-clock text-base"></i>
                                    <p class="text-sm text-start"><?php echo date_format($time, "H:i"); ?> WIB</p>
                                </div>
                            </div>
                            <p class="truncate text-justify text-sm"><?php echo $row["deskripsi"]; ?></p>
                        </div>
                        <hr class="border-[#AC87C5]">
                        <div class="text-base font-bold text-center px-10 py-2"><?php echo $row["penyelenggara"]; ?></div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>


    <div class="flex justify-end my-5 mx-10 lg:mx-28 lg:my-10">
        <?php if ($halamanAktif > 1) : ?>
            <a class="border border-[#AC87C5] rounded-xl p-2 mx-1 text-xs font-bold" href="?halaman=<?= $halamanAktif - 1; ?>">&laquo;</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
            <?php if ($i == $halamanAktif) : ?>
                <a class="border-2 border-[#AC87C5] rounded-xl p-2 mx-1 text-xs font-bold text-white bg-gradient-to-r from-[#AC87C5] to-[#E0AED0]" href="?halaman=<?= $i; ?>"><?= $i; ?> </a>
            <?php else : ?>
                <a class=" border-2 border-[#AC87C5] rounded-xl p-2 mx-1 text-xs font-bold" href="?halaman=<?= $i; ?>"><?= $i; ?> </a>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if ($halamanAktif < $jumlahHalaman) : ?>
            <a class="border-2 border-[#AC87C5] rounded-xl p-2 mx-1 text-xs font-bold" href="?halaman=<?= $halamanAktif + 1; ?>">&raquo;</a>
        <?php endif; ?>
    </div>

    <div class="bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] mt-20 md:mt-40 py-16 px-10 lg:px-28">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
            <div class="mb-6 md:mb-0">
                <p class="text-white font-bold text-2xl md:text-4xl">EventUnila</p>
                <p class="text-gray-500 font-bold text-sm mt-4">Kumpulan Pengalaman, <br> Ayo bergabung bersama di EventUnila!</p>
                <div class="flex flex-col md:flex-row gap-4 text-white font-bold text-sm mt-4">
                    <a href="about.php">Tentang Kami</a>
                    <a href="kontak.php">Kontak</a>
                    <a href="kebijakan.php">Kebijakan Pribadi</a>
                </div>
            </div>
            <div class="text-white font-bold text-sm">
                <p>Jl. Prof. Sumantri Brojonegoro No.1 Gedong Meneng, <br>Bandar Lampung.</p>
                <div class="flex gap-5 md:gap-10 text-white text-2xl mt-4">
                    <a href="https://web.facebook.com/OfficialUnila/?_rdc=1&_rdr"><i class="ti ti-brand-facebook"></i></a>
                    <a href="https://twitter.com/official_unila"><i class="ti ti-brand-twitter"></i></a>
                    <a href="https://www.instagram.com/official_unila"><i class="ti ti-brand-instagram"></i></a>
                    <a href="https://www.tiktok.com/@official_unila"><i class="ti ti-brand-tiktok"></i></a>
                    <a href="https://www.youtube.com/c/OfficialUnila"><i class="ti ti-brand-youtube"></i></a>
                </div>
                <div class="mt-6">
                    <p>&copy; 2024 EventUnila. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>