<?php
ob_start(); // Memulai buffer output
// session_start(); // Memulai sesi

include 'function.php';
include 'navbar.php';

// ambil data di URL
$id = $_GET["id"];
// query data users berdasarkan id
$users = query("SELECT * FROM users WHERE id = $id")[0];

// cek apakah tombol submit sudah ditekan apa belum
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
            'message' => 'Profil gagal diubah!',
            'type' => 'error'
        ];
    }
    // Redirect ke halaman yang sama dengan id
    header('Location: editprofil.php?id=' . $id);
    exit;
}

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
    <title>Edit Profil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
</head>

<body>
    <?php if ($flash) : ?>
        <div id="flash-message" class="flex justify-center my-4">
            <div class="px-4 py-2 rounded-xl text-white <?php echo ($flash['type'] == 'success') ? 'bg-green-500' : 'bg-red-500'; ?>">
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
        <div class="flex hover:text-[#756AB6] font-semibold">
            <a href="profilesaya.php?id=<?php echo $_SESSION["users_id"]; ?>">Profil Saya</a>
        </div>
        <span class="mx-2">/</span>
        <li class="text-[#756AB6] font-semibold">Edit Profil</li>
    </div>

    <div class="flex justify-center my-8">
        <h1 class="text-[#756AB6] font-bold text-3xl">Edit Profil Saya</h1>
    </div>
    <h2 class="mx-10 lg:mx-[340px] md:mx-[70px] block mt-4 text-[#756AB6] font-bold text-lg">Detail Profil</h2>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $users["id"]; ?>">
        <div class="">
            <label for="nama" class="block mx-10 lg:mx-[340px] md:mx-[70px] my-2 text-gray-500 font-bold text-sm">Nama</label>
            <div class="flex justify-center">
                <input type="text" class="px-4 w-10/12 lg:w-6/12 h-10 bg-white shadow-2xl rounded-xl border-2 border-[#756AB6]" name="nama" id="nama" value="<?php echo $users["nama"]; ?>" required>
            </div>
            <label for="email" class="block mx-10  lg:mx-[340px] md:mx-[70px] mt-2 md:mt-4 my-2 text-gray-500 font-bold text-sm">Email</label>
            <div class="flex justify-center">
                <input type="text" class="bg-gray-100 px-4 lg:w-6/12 w-10/12 h-10 bg-white shadow-2xl rounded-xl border-2 border-[#756AB6]" name="email" id="email" value="<?php echo $users["email"]; ?>" required disabled>
            </div>

            <h3 class="px-10 lg:px-[340px] md:px-[70px] block mt-4 text-[#756AB6] font-bold text-lg">Ubah Kata Sandi</h3>

            <label for="password1" class="block mx-10 lg:mx-[340px] md:mx-[70px] mt-2 md:mt-4 my-2 text-gray-500 font-bold text-sm">Kata Sandi Lama</label>
            <div class="flex justify-center">
                <input type="password" class="px-4 lg:w-6/12 w-10/12 h-10 bg-white shadow-2xl rounded-xl border-2 border-[#756AB6]" name="password1" id="password1" placeholder="Masukan Kata Sandi Lama">
            </div>
            <label for="password2" class="block mx-10  lg:mx-[340px] md:mx-[70px] mt-2 py-2 text-gray-500 font-bold text-sm">Kata Sandi Baru</label>
            <div class="flex justify-center">
                <input type="password" class="px-4 lg:w-6/12 w-10/12 h-10 bg-white shadow-2xl rounded-xl border-2 border-[#756AB6]" name="password2" id="password2" placeholder="Masukan Kata Sandi Baru">
            </div>
            <label for="password3" class="block mx-10  lg:mx-[340px] md:mx-[70px] mt-2 my-2 text-gray-500 font-bold text-sm">Konfirmasi Kata Sandi Baru</label>
            <div class="flex justify-center">
                <input type="password" class="px-4 lg:w-6/12 w-10/12 h-10 bg-white shadow-2xl rounded-xl border-2 border-[#756AB6]" name="password3" id="password3" placeholder="Masukan Konfirmasi Kata Sandi Baru">
            </div>
            <!-- button -->
            <div class="text-center mx-auto my-10 rounded-xl md:w-96 lg:w-96 w-64 h-10 bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] hover:bg-none hover:border-2 hover:border-[#AC87C5] group">
                <button type="submit" name="submit" class=" text-white text-sm font-bold pt-[8px] group-hover:text-[#AC87C5]">
                    Simpan
                </button>
            </div>
        </div>
    </form>
    <!--footer-->
    <div class="bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] mt-28 py-16 px-10 lg:px-28">
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