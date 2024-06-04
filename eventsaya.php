<?php
include 'function.php';
include 'navbar.php';

// $user_id = $_SESSION['user_id'];
$id = $_GET["id"];

// Query untuk mendapatkan event yang hanya milik pengguna yang sedang login
$users = query("SELECT events.*, users.* FROM events JOIN users ON events.users_id = users.id WHERE users.id = '$id'");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />

</head>

<body>
    <div class="flex flex-wrap list-none my-4 px-32 ">
        <div class="flex hover:text-[#756AB6] font-semibold">
            <a href="index.php">
                <i class="ti ti-home-filled pr-2"></i>Beranda</a>
        </div>
        <span class="mx-2">/</span>
        <li class="text-[#756AB6] font-semibold">Event Saya</li>
    </div>

    <div class="flex justify-center gap-8 py-12 grid grid-cols-3 px-28">
        <div class="rounded-xl border-2 border-[#AC87C5] flex flex-col items-center justify-center">
            <a href="daftarevent.php" class="text-center">
                <i class="text-[#AC87C5] text-4xl font-bold ti ti-circle-plus"></i>
                <p class="text-[#AC87C5] font-bold">Buat Event <br> Baru</p>
            </a>
        </div>
        <?php foreach ($users as $row) : ?>
            <?php
            $status = strtolower($row['status']); // Mengonversi status menjadi huruf kecil
            $date = date_create($row['tanggal']);
            $time = date_create($row['waktu']);
            // $eventStatus = strtolower($row['tanggal']); // Mendapatkan status tanggal (mendatang atau selesai)

            // Menentukan kelas warna berdasarkan status pengajuan
            $statusClass = '';
            if ($status === 'disetujui') {
                $statusClass = 'bg-emerald-600'; // Hijau untuk disetujui
            } elseif ($status === 'ditolak') {
                $statusClass = 'bg-rose-600'; // Merah untuk ditolak
            } elseif ($status === 'sedang diajukan') {
                $statusClass = 'bg-yellow-500'; // Kuning untuk sedang diajukan
            } else {
                $statusClass = 'bg-gray-500'; // Warna default jika status tidak dikenali
            }
            ?>
            <div class="rounded-xl  border-2 border-[#AC87C5]">
                <!-- <a href="detailevent.php?id=<?php echo $row['id']; ?>"> -->
                <img class="rounded-t-xl w-full h-52 " src="img/<?php echo $row["gambar"]; ?>">
                <div class="px-8 py-6">
                    <h4 class="truncate text-xl font-bold mb-2"><?php echo $row["judul"]; ?></h4>
                    <div class="flex justify-between mb-2 text-[#AC87C5] font-bold">
                        <div class="flex items-center gap-2">
                            <i class="ti ti-calendar text-base font-bold"></i>
                            <p class="text-sm  text-start "><?php echo date_format($date, "d M Y"); ?></p>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="ti ti-clock text-base font-bold"></i>
                            <p class="text-sm text-start "><?php echo date_format($time, "H:i"); ?> WIB </p>
                        </div>
                    </div>
                    <p class="truncate text-justify text-sm"><?php echo $row["deskripsi"]; ?></p>
                </div>
                <hr class="border-[#AC87C5] ">
                <div class="<?php echo $statusClass; ?> rounded-b-xl text-base font-bold text-center text-white px-10 py-2 "><?php echo $row["status"]; ?></div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>



    <!--footer-->
    <div class="flex items-center px-28 bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] mt-[50px] h-[200px]">
        <div class="flex-1 ">
            <p class="text-white font-bold text-4xl">EventUnila</p>
            <p class="text-gray-500 font-bold text-sm mt-4">Kumpulan Pengalaman, <br> Ayo bergabung bersama di EventUnila!</p>
            <div class="flex gap-4 text-white font-bold text-sm mt-4">
                <a href="about.php">Tentang Kami </a>
                <a href="kontak.php">Kontak</a>
                <a href="kebijakan.php">Kebijakan Pribadi</a>
            </div>
        </div>
        <div class="flex-1 ml-[400px]">
            <p class=" flex text-white font-bold text-sm">Jl. Prof. Sumantri Brojonegoro No.1 Gedong Meneng, <br>
                Bandar Lampung.</p>
            <div class="flex text-white text-2xl gap-10 mt-4">
                <a href="https://web.facebook.com/OfficialUnila/?_rdc=1&_rdr"><i class="ti ti-brand-facebook"></i></a>
                <a href="https://twitter.com/official_unila"><i class="ti ti-brand-twitter"></i></a>
                <a href="https://www.instagram.com/official_unila"><i class="ti ti-brand-instagram "></i></a>
                <a href="https://www.tiktok.com/@official_unila"><i class="ti ti-brand-tiktok"></i></a>
                <a href="https://www.youtube.com/c/OfficialUnila"><i class="ti ti-brand-youtube"></i></a>
            </div>
            <div class="text-white font-bold text-sm mt-4">
                <p>copyright EventUnila © 2024 all rights reserved</p>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>