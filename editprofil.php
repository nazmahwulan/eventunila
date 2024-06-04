<?php
include 'function.php';
include 'navbar.php';

$id = $_GET["id"];
//query data mahasiswa berdasarkan id
$users = query("SELECT *FROM users WHERE id=$id")[0];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (ubahProfil($_POST) > 0) {
        // Set flashdata untuk sukses
        $_SESSION['flash'] = [
            'message' => 'Profil berhasil diubah!',
            'type' => 'success'
        ];
    } else {
        // Set flashdata untuk error
        $_SESSION['flash'] = [
            'message' => 'Gagal menambahkan kategori!',
            'type' => 'error'
        ];
    }
    // Redirect ke halaman kategori
    header('Location: editprofil.php');
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
    <div class="flex flex-wrap list-none my-4 px-32 mt-20">
        <div class="flex hover:text-[#756AB6] font-semibold">
            <a href="index.php">
                <i class="ti ti-home-filled pr-2"></i>Beranda</a>
        </div>
        <span class="mx-2">/</span>
        <div class="flex hover:text-[#756AB6] font-semibold">
            <a href="profilsaya.php">Profil Saya</a>
        </div>
        <span class="mx-2">/</span>
        <li class="text-[#756AB6] font-semibold">Edit Profil</li>
    </div>

    <div class="flex justify-center my-8">
        <h1 class="text-[#756AB6] font-bold text-3xl">Edit Profil Saya</h1>
    </div>
    <h2 class="px-[340px] block mt-4 text-[#756AB6] font-bold text-lg">Detail Profil</h2>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $users["id"]; ?> ">
        <div class="">
            <label for="nama" class="block px-[340px] py-2 text-gray-500 font-bold text-sm">Nama</label>
            <div class="flex justify-center">
                <input type="text" class="px-4 w-6/12 h-10 bg-white shadow-2xl rounded-xl border-2 border-[#756AB6]" name="nama" id="nama" value="<?php echo $users["nama"]; ?>" required>
            </div>
            <label for="email" class="block px-[340px] py-2 text-gray-500 font-bold text-sm">Email</label>
            <div class="flex justify-center">
                <input type="text" class="bg-gray-100 px-4 w-6/12 h-10 bg-white shadow-2xl rounded-xl border-2 border-[#756AB6]" name="email" id="email" value="<?php echo $users["email"]; ?>" required disabled>
            </div>

            <h3 class="px-[340px] block mt-4 text-[#756AB6] font-bold text-lg">Ubah Kata Sandi</h3>

            <label for="password1" class="block px-[340px] py-2 text-gray-500 font-bold text-sm">Kata Sandi Lama</label>
            <div class="flex justify-center">
                <input type="password" class="px-4 w-6/12 h-10 bg-white shadow-2xl rounded-xl border-2 border-[#756AB6]" name="password1" id="password1" placeholder="Masukan Kata Sandi Lama">
            </div>
            <label for="password2" class="block px-[340px] py-2 text-gray-500 font-bold text-sm">Kata Sandi Baru</label>
            <div class="flex justify-center">
                <input type="password" class="px-4 w-6/12 h-10 bg-white shadow-2xl rounded-xl border-2 border-[#756AB6]" name="password2" id="password2" placeholder="Masukan Kata Sandi Baru">
            </div>
            <label for="password3" class="block px-[340px] py-2 text-gray-500 font-bold text-sm">Konfirmasi Kata Sandi Baru</label>
            <div class="flex justify-center">
                <input type="password" class="px-4 w-6/12 h-10 bg-white shadow-2xl rounded-xl border-2 border-[#756AB6]" name="password3" id="password3" placeholder="Masukan Konfirmasi Kata Sandi Baru">
            </div>
            <!-- button -->
            <div class="text-center mx-auto my-10 rounded-xl w-96 h-10 bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] hover:bg-none hover:border-2 hover:border-[#AC87C5] group">
                <button type="submit" name="submit" class=" text-white text-sm font-bold pt-[8px] group-hover:text-[#AC87C5]">
                    Simpan
                </button>
            </div>
        </div>
    </form>
    <!--footer-->
    <div class="flex items-center px-28 bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] h-[200px]">
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