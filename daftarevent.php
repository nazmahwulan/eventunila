<?php
include 'navbar.php';
include 'function.php';
// session_start();

$kategori = query("SELECT *FROM kategori");

// //cek apakah tombol submit sudah ditekan apa belum
// if(isset($_POST["submit"])){

//     //cek apakah data berhasil diubah atau tidak 
//     if(pengajuan ($_POST) > 0){
//         echo "<script>
//         alert('event berhasil diajukan!');
//         document.location.href = 'index.php'
//         </script>";
//     }else {
//         echo"<script>
//         alert('event gagal  diajukan!');
//         document.location.href = 'index.php'
//         </script>";
//     }
// }

// function flash() {
//     if (isset($_SESSION['flash'])) {
//         echo "<div class='{$_SESSION['flash']['type']}'>
//                 {$_SESSION['flash']['message']}
//               </div>";
//         unset($_SESSION['flash']);
//     }
// }

// Panggil fungsi flash di tempat yang sesuai dalam HTML
// flash();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["submit"])) {
    if (pengajuan($_POST) > 0) {
        // Set flashdata untuk sukses
        $_SESSION['flash'] = [
            'message' => 'Event berhasil diajukan!',
            'type' => 'success'
        ];
    } else {
        if (!isset($_SESSION['flash'])) {
            // Set flashdata untuk error umum jika belum ada set dari fungsi pengajuan
            $_SESSION['flash'] = [
                'message' => 'Event gagal diajukan!',
                'type' => 'error'
            ];
        }
    }
    // Redirect ke halaman daftar event
    header('Location: daftarevent.php');
    exit;
}
// // Cek apakah ada flashdata
$flash = isset($_SESSION['flash']) ? $_SESSION['flash'] : null;
unset($_SESSION['flash']); // Hapus flashdata setelah ditampilkan

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

<body>

    <div class="flex flex-wrap list-none my-4 px-60 mt-20">
        <div class="flex hover:text-[#756AB6] font-semibold">
            <a href="index.php">
                <i class="ti ti-home-filled pr-2"></i>Beranda</a>
        </div>
        <span class="mx-2">/</span>
        <li class="text-[#756AB6] font-semibold">Daftar Event</li>
    </div>

    <?php if ($flash) : ?>
        <div id="flash-message" class="w-full h-12 flex items-center justify-center my-8">
            <div class="px-4 py-2 rounded-xl text-white <?php echo ($flash['type'] == 'success') ? 'bg-green-500' : ($flash['type'] == 'error' ? 'bg-red-500' : ($flash['type'] == 'warning' ? 'bg-yellow-500' : 'bg-blue-500')); ?>">
                <?php echo $flash['message']; ?>
            </div>
        </div>
    <?php endif; ?> 
    <form action="" method="post" enctype="multipart/form-data">
        <div class="flex flex-col">
            <div class="mx-auto shadow-2xl rounded-t-xl w-[900px] h-[400px] border-2 border-[#AC87C5] overflow-hidden relative flex flex-col justify-center items-center">
                <input type="file" name="gambar" id="gambar" class="hidden">
                <label for="gambar" id="upload-label" class="flex flex-col items-center justify-center w-full h-full cursor-pointer text-center text-sm font-bold text-[#AC87C5] " required>
                    <i class="ti ti-circle-plus text-5xl"></i>
                    <span id="upload-text" class="mt-2">Unggah gambar/poster/banner<br>Direkomendasikan 724 x 340px dan tidak lebih dari 2Mb</span>
                    <img id="box" src="" alt="Preview Gambar" class="w-full h-full object-cover hidden">
                </label>
            </div>
            <div class="bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] mx-auto rounded-b-xl w-[900px] h-[920px]">
                <label for="judul" class="block px-10 py-2 text-white font-bold text-sm">Nama Event</label>
                <div class="flex justify-center">
                    <input type="text" class="px-4 w-11/12 h-10 bg-white shadow-2xl rounded-xl border-2 border-[#756AB6] form-control" name="judul" id="judul" aria-describedby="eventHelp" require placeholder="Nama Event" required>
                </div>
                <div class="flex gap-4">
                    <div class="flex-1">
                        <div class="relative">
                            <label for="kategori" class="block pl-10 py-2 text-white font-bold text-sm">Kategori</label>
                            <div class="pl-10 flex justify-start relative">
                                <input id="kategoriDropdownInput" type="text" class="px-4 w-full h-10 bg-white shadow-2xl rounded-xl border-2 border-[#756AB6] form-control" name="kategori" aria-describedby="kategoriHelp"  placeholder="Pilih Kategori" readonly required >
                                <div id="kategoriDropdownMenu" class="hidden absolute left-[200px] transform -translate-x-1/2 mt-1 w-full max-w-xs rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10">
                                    <ul class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="kategoriDropdownInput">
                                        <?php foreach ($kategori as $row) : ?>
                                            <li><button type="button" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"><?php echo $row["kategori"]; ?></button></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1">
                        <label for="lokasi" class="block pr-10 py-2 text-white font-bold text-sm">Lokasi</label>
                        <div class="pr-10 flex justify-start">
                            <input type="text" class="px-4 w-full h-10 bg-white shadow-2xl rounded-xl border-2 border-[#756AB6] form-control" name="lokasi" id="lokasi" aria-describedby="lokasiHelp"  placeholder="Pilih Lokasi" required>
                        </div>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="flex-1">
                        <label for="tanggal" class="block pl-10 py-2 text-white font-bold text-sm">Tanggal</label>
                        <div class="pl-10 flex justify-start">
                            <input type="date" class="px-4 w-full h-10 bg-white shadow-2xl rounded-xl border-2 border-[#756AB6] form-control" name="tanggal" id="tanggal" aria-describedby="tanggalHelp" placeholder="Pilih Tanggal" required>
                        </div>
                    </div>
                    <div class="flex-1">
                        <label for="waktu" class="block pr-10 py-2 text-white font-bold text-sm">Waktu</label>
                        <div class="pr-10 flex justify-start">
                            <input type="time" class="px-4 w-full h-10 bg-white shadow-2xl rounded-xl border-2 border-[#756AB6] form-control" name="waktu" id="waktu" aria-describedby="waktuHelp"  placeholder="Pilih Tanggal" required>
                        </div>
                    </div>
                </div>
                <label for="link_pendaftaran" class="block px-10 py-2 text-white font-bold text-sm">Link Pendaftaran</label>
                <div class="flex justify-center">
                    <input type="text" class="px-4 w-11/12 h-10 bg-white shadow-2xl rounded-xl border-2 border-[#756AB6] form-control" name="link_pendaftaran" id="link_pendaftaran" aria-describedby="pendafataranHelp" placeholder="Link Pendaftaran" required>
                </div>
                <label for="penyelenggara" class="block px-10 py-2 text-white font-bold text-sm">Nama Penyelenggara</label>
                <div class="flex justify-center">
                    <input type="text" class="px-4 w-11/12 h-10 bg-white shadow-2xl rounded-xl border-2 border-[#756AB6] form-control" name="penyelenggara" id="penyelenggara" aria-describedby="penyelenggaraHelp" placeholder="Nama Penyelenggara" required>
                </div>
                <label for="deskripsi" class="block px-10 py-2 text-white font-bold text-sm text">Deskripsi Event</label>
                <div class="flex justify-center">
                    <textarea type="text" class="text-justify px-4 w-11/12 h-96 bg-white shadow-2xl rounded-xl border-2 border-[#756AB6] form-control" name="deskripsi" id="deskripsi" aria-describedby="deskripsiHelp" required></textarea>
                </div>
                <div class="mx-auto rounded-xl w-80 h-10 border-2 border-white mt-10 hover:bg-[#E0AED0]  text-center">
                    <button type="submit" name="submit" class=" text-white text-sm font-bold pt-[8px]">
                        Daftar
                    </button>
                </div>
            </div>
        </div>
    </form>

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