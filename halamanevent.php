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

// Cari event berdasarkan kata kunci pencarian
// if ($searchKeyword) {
//     // Panggil fungsi pencarian
//     $events = cari3($searchKeyword);
// } else {
//     // Jika tidak ada kata kunci pencarian, tampilkan semua event
//     $query_all_events = "SELECT events.*, kategori.kategori FROM events JOIN kategori ON events.kategori_id = kategori.id";
//     $result_all_events = mysqli_query($conn, $query_all_events);
//     $events = mysqli_fetch_all($result_all_events, MYSQLI_ASSOC);
// }

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
    <div class="px-28 mt-[100px] flex justify-between">
        <h1 class="text-[#756AB6] font-bold text-3xl">Event Mendatang</h1>
        <form action="halamanevent.php" method="post" class="flex items-center">
            <select name="kategori" class="px-4 w-44 h-10 bg-white shadow-2xl rounded-xl border-2 border-[#756AB6]" onchange="this.form.submit()">
                <option class="text-black font-bold text-sm" value="">Pilih Kategori</option>
                <?php
                $kategori = getkategori();
                foreach ($kategori as $row) {
                    $selected = isset($_POST['kategori']) && $_POST['kategori'] == $row['id'] ? 'selected' : '';
                    echo "<option value='" . $row['id'] . "' $selected>" . $row['kategori'] . "</option>";
                }
                ?>
            </select>
        </form>
    </div>

    <div class="flex flex-wrap list-none my-4 px-32 ">
        <div class="flex hover:text-[#756AB6] font-semibold">
            <a href="index.php">
                <i class="ti ti-home-filled pr-2"></i>Beranda</a>
        </div>
        <span class="mx-2">/</span>
        <a href="halamanevent.php">
            <li class="text-[#756AB6] font-semibold">Event</li>
        </a>
        <!-- <span class="mx-2">/</span>
        <li class="text-[#756AB6] font-semibold"><?php echo htmlspecialchars($searchKeyword); ?></li> -->
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
        <div class="flex justify-center gap-8 grid grid-cols-3 px-28">
            <?php foreach ($events as $row) : ?>
                <?php
                $date = date_create($row['tanggal']);
                $time = date_create($row['waktu']);
                ?>
                <div class="rounded-xl border-2 border-[#AC87C5]">
                    <a href="detailevent.php?id=<?php echo $row["id"]; ?>">
                        <img class="rounded-t-xl w-full h-52" src="img/<?php echo $row["gambar"]; ?>">
                        <div class="px-8 py-6">
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


    <div class="flex justify-end mt-4 px-28">
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

    <div class="flex items-center px-28 bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] mt-[100px] h-[200px]">
        <div class="flex-1 ">
            <div class="text-white font-bold text-4xl">EventUnila</div>
            <div class="text-gray-500 font-bold text-sm mt-4">Kumpulan Pengalaman, <br> Ayo bergabung bersama di EventUnila!</div>
            <div class="flex gap-4 text-white font-bold text-sm mt-4">
                <a href="about.php">Tentang Kami </a>
                <a href="kontak.php">Kontak</a>
                <a href="kebijakan.php">Kebijakan Pribadi</a>
            </div>
        </div>
        <div class="flex-1 ml-[400px]">
            <div class=" flex text-white font-bold text-sm">Jl. Prof. Sumantri Brojonegoro No.1 Gedong Meneng, <br>
                Bandar Lampung.</div>
            <div class="flex text-white text-2xl gap-10 mt-4">
                <a href="https://web.facebook.com/OfficialUnila/?_rdc=1&_rdr"><i class="fab fa-facebook-f "></i></a>
                <a href="https://twitter.com/official_unila"><i class="fab fa-twitter "></i></a>
                <a href="https://www.instagram.com/official_unila"><i class="fab fa-instagram "></i></a>
                <a href="https://www.tiktok.com/@official_unila"><i class="fab fa-tiktok "></i></a>
                <a href="https://www.youtube.com/c/OfficialUnila"><i class="fab fa-youtube "></i></a>
            </div>
            <div class="text-white font-bold text-sm mt-4">
                <p>copyright EventUnila © 2024 all rights reserved</p>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>