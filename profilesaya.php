<?php
include 'function.php';
include 'navbar.php';
ob_start(); // Memulai buffer output

$id = $_GET["id"];
//query data mahasiswa berdasarkan id
$users = query("SELECT *FROM users WHERE id=$id")[0];

// Cek apakah ada flashdata
$flash = isset($_SESSION['flash']) ? $_SESSION['flash'] : null;
unset($_SESSION['flash']); // Hapus flashdata setelah ditampilkan
ob_end_flush(); // Mengakhiri dan mengirim buffer output
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
    <?php if ($flash) : ?>
        <div id="flash-message" class="w-full h-12 flex items-center justify-center my-8">
            <div class="px-4 py-2 rounded-xl text-white <?php echo ($flash['type'] == 'success') ? 'bg-green-500' : ($flash['type'] == 'error' ? 'bg-red-500' : ($flash['type'] == 'warning' ? 'bg-yellow-500' : 'bg-blue-500')); ?>">
                <?php echo $flash['message']; ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="flex flex-wrap list-none mx-14 mt-10 lg:mx-32">
        <div class="flex hover:text-[#756AB6] font-semibold">
            <a href="index.php">
                <i class="ti ti-home-filled pr-2"></i>Home</a>
        </div>
        <span class="mx-2">/</span>
        <li class="text-[#756AB6] font-semibold">Profil Saya</li>
    </div>

    <div class="flex justify-center my-8">
        <h1 class="text-[#756AB6] font-bold text-3xl">Profil Saya</h1>
    </div>
    <div class="flex justify-end mx-9 md:mx-[70px] lg:mx-[340px]">
    <a href="editprofil.php?id=<?php echo $users["id"]; ?>" class="hover:text-[#AC87C5] hover:bg-none hover:border-2 hover:border-[#AC87C5] ti ti-edit bg-gradient-to-b from-[#AC87C5] to-[#E0AED0] rounded-xl w-8 h-8 text-sm  text-white flex items-center justify-center"></a>
    </div>
    <input type="hidden" name="id" value="<?php echo $users["id"]; ?> ">
    <div class="md:h-[470px]">
        <label for="nama" class="block mx-10 lg:mx-[340px] md:mx-[70px] my-2  text-gray-500 font-bold text-sm">Nama</label>
        <div class="flex justify-center">
            <input type="text" class="bg-gray-100 px-4 w-10/12 lg:w-6/12 h-10 bg-white rounded-xl border-2 border-[#756AB6]" name="nama" id="nama" value="<?php echo $users["nama"]; ?>" disabled>
        </div>
        <label for="email" class="block mx-10 lg:mx-[340px] md:mx-[70px]  md:mt-4 my-2 text-gray-500 font-bold text-sm">Email</label>
        <div class="flex justify-center">
            <input type="text" class="bg-gray-100 px-4 w-10/12 lg:w-6/12 h-10 bg-white rounded-xl border-2 border-[#756AB6]" name="email" id="email" value="<?php echo $users["email"]; ?>" disabled>
        </div>
        <label for="password" class="block mx-10 lg:mx-[340px] md:mx-[70px] md:mt-4 my-2 text-gray-500 font-bold text-sm">Kata Sandi</label>
        <div class="flex justify-center mb-24">
            <input type="password" class="bg-gray-100 px-4 w-10/12 lg:w-6/12 h-10 bg-white rounded-xl border-2 border-[#756AB6]" name="password" id="password" value="<?php echo $users["password"]; ?>" disabled>
        </div>
    </div>

    <!--footer-->
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