<?php
include 'function.php';

// Periksa apakah parameter ID ada dan valid
if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = intval($_GET["id"]);
    
    // Query untuk memeriksa apakah pengguna ada
    $userCheck = query("SELECT * FROM users WHERE id = '$id'");
    
    // Periksa apakah pengguna ditemukan
    if (count($userCheck) === 0) {
        // Jika pengguna tidak ditemukan, alihkan ke halaman error
        include 'error.php';
        exit;
    } else {
        // Jika pengguna ditemukan, ambil data pengguna
        $user = $userCheck[0];

        // Query data event pengguna berdasarkan ID
        $users = query("SELECT events.*, users.* 
            FROM events 
            JOIN users ON events.users_id = users.id 
            WHERE users.id = '$id' 
            ORDER BY events.created_at DESC
        ");

        // Cek apakah pengguna memiliki event
        $isValidUser = true;
    }
} else {
    // Jika parameter ID tidak valid, alihkan ke halaman error
    include 'error.php';
    exit;
}

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
    <?php if (isset($isValidUser) && $isValidUser) : ?>
        <?php
        ob_start(); // Memulai buffer output
        include 'navbar.php';

        // session_start();

        // Periksa apakah pengguna sudah login
        if (!isset($_SESSION["login"])) {
            header("Location: login.php");
            exit;
        }

        ?>
        <div class="flex flex-wrap list-none mx-14 mt-10 lg:mx-32">
            <div class="flex hover:text-[#756AB6] font-semibold">
                <a href="index.php">
                    <i class="ti ti-home-filled pr-2"></i>Beranda</a>
            </div>
            <span class="mx-2">/</span>
            <li class="text-[#756AB6] font-semibold">Event Saya</li>
        </div>
        
        <!-- <div class="h-full min-h-screen md:h-full lg:h-full lg:mb-0 flex justify-center grid gap-8 my-10 mx-10 lg:mx-28 grid-cols-1 md:grid-cols-2 lg:grid-cols-3"> -->
        <div class="md:h-full lg:mb-0 flex justify-center grid gap-8 my-10 mx-10 lg:mx-28 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
            <div class="rounded-xl border-2 border-[#AC87C5] flex flex-col items-center justify-center">
                <a href="daftarevent.php" class="text-center">
                    <i class="text-[#AC87C5] text-4xl font-bold ti ti-circle-plus"></i>
                    <p class="text-[#AC87C5] font-bold">Buat Event <br> Baru</p>
                </a>
            </div>

            <?php if (count($users) > 0): ?>
                <?php foreach ($users as $row) : ?>
                    <?php
                    $status = strtolower($row['status']); // Mengonversi status menjadi huruf kecil
                    $tanggalMulai = $row["tanggal_mulai"];
                    $tanggalAkhir = $row["tanggal_berakhir"];

                    // Format tanggal
                    $formattedTanggalMulai = date('d M Y', strtotime($tanggalMulai));
                    $formattedTanggalAkhir = date('d M Y', strtotime($tanggalAkhir));

                    // Cek jika tanggal mulai dan akhir sama
                    if ($tanggalMulai == $tanggalAkhir) {
                        $tanggalTampil = $formattedTanggalMulai;
                    } else {
                        $tanggalTampil = $formattedTanggalMulai . " - " . $formattedTanggalAkhir;
                    }

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
                    <div class="rounded-xl border-2 border-[#AC87C5]">
                    <div class="relative w-full h-52">
                        <img class="rounded-t-xl w-full h-52" src="img/<?php echo $row["gambar"]; ?>">
                        <?php if ($status === 'sedang diajukan') : ?>
                            <a href="editevent.php?id=<?php echo $row["event_id"]; ?>" class="ti ti-edit absolute top-2 right-2 bg-white border-2 border-[#AC87C5] rounded-xl w-8 h-8 text-sm text-[#AC87C5] flex items-center justify-center"></a>
                        <?php endif; ?>
                    </div>
                        <div class="mx-8 my-6">
                            <h4 class="truncate text-xl font-bold mb-2"><?php echo $row["judul"]; ?></h4>
                            <div class="flex justify-between mb-2 text-[#AC87C5] font-bold">
                                <div class="flex items-center gap-2">
                                    <i class="ti ti-calendar text-base"></i>
                                    <p class="text-sm text-start"><?php echo $tanggalTampil; ?></p>
                                </div>
                            </div>
                            <div class="truncate text-justify text-sm">
                                <?php echo strip_tags(htmlspecialchars_decode($row["deskripsi"])); ?>
                            </div>
                        </div>
                        <hr class="border-[#AC87C5]">
                        <div class="<?php echo $statusClass; ?> rounded-b-xl text-base font-bold text-center text-white px-10 py-2 "><?php echo $row["status"]; ?></div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!--footer-->
        <div class="bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] mt-40 py-16 px-10 lg:px-28">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                <div class="mb-6 md:mb-0">
                    <p class="text-white font-bold text-2xl md:text-4xl">EventUnila</p>
                    <p class="text-gray-500 font-bold text-sm mt-4">Kumpulan Pengalaman, <br> Ayo bergabung bersama di EventUnila!</p>
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
    <?php else : ?>
        <?php
        include 'error.php';
        ?>
    <?php endif; ?>
    <script src="script.js"></script>
</body>

</html>
