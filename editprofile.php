<?php
include 'function.php';

// Periksa apakah parameter ID ada dan valid
if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = intval($_GET["id"]);
    // Query data pengguna berdasarkan ID
    $users = query("SELECT * FROM users WHERE id=$id");

    // Periksa apakah pengguna ditemukan
    if (count($users) === 0) {
        $isValidUser = false;
    } else {
        // Ambil data pengguna jika ada
        $user = $users[0];
        $isValidUser = true;
    } 
}

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
            header('Location: profilesaya.php?id=' . $id);
            exit;
        }

        // Cek apakah ada flashdata
        $flash = isset($_SESSION['flash']) ? $_SESSION['flash'] : null;
        unset($_SESSION['flash']); // Hapus flashdata setelah ditampilkan

        ob_end_flush(); // Mengakhiri dan mengirim buffer output
        ?>
        <div class="flex flex-wrap list-none mx-14 mt-10 lg:mx-32">
            <div class="flex hover:text-[#756AB6] font-semibold">
                <a href="index.php">
                    <i class="ti ti-home-filled pr-2"></i>Beranda</a>
            </div>
            <span class="mx-2">/</span>
            <div class="flex hover:text-[#756AB6] font-semibold">
                <a href="profilesaya.php?id=<?php echo $_SESSION["users_id"]; ?>">Profile Saya</a>
            </div>
            <span class="mx-2">/</span>
            <li class="text-[#756AB6] font-semibold">Edit Profile</li>
        </div>

        <div class="flex justify-center my-8">
            <h1 class="text-[#756AB6] font-bold text-3xl">Edit Profile Saya</h1>
        </div>
        <h2 class="mx-10 lg:mx-[340px] md:mx-[70px] block mt-4 text-[#756AB6] font-bold text-lg">Detail Profile</h2>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $user["id"]; ?>">
            <div class="">
                <div class="mx-10 lg:mx-[340px] md:mx-[70px]">
                    <label for="nama" class="block  my-2 text-gray-500 font-bold text-sm">Nama</label>
                    <div class="flex justify-center">
                        <input type="text" class="px-4 w-full h-10 bg-white  rounded-xl border-2 border-[#AC87C5] focus:outline-none focus:[#756AB6] focus:border-[#756AB6]" name="nama" id="nama" value="<?php echo $user["nama"]; ?>" required>
                    </div>
                </div>
                <div class="mx-10 lg:mx-[340px] md:mx-[70px]">
                    <label for="email" class="block  mt-2 md:mt-4 my-2 text-gray-500 font-bold text-sm">Email</label>
                    <div class="flex justify-center">
                        <input type="text" class="bg-gray-100 px-4 w-full h-10 bg-white  rounded-xl border-2 border-[#AC87C5] focus:outline-none focus:[#756AB6] focus:border-[#756AB6]" name="email" id="email" value="<?php echo $user["email"]; ?>" required disabled>
                    </div>
                </div>
                <h3 class="px-10 lg:px-[340px] md:px-[70px] block mt-4 text-[#AC87C5] focus:outline-none focus:[#756AB6] focus:border-[#756AB6] font-bold text-lg">Ubah Kata Sandi</h3>
                <div class="mx-10 lg:mx-[340px] md:mx-[70px]">
                    <label for="password1" class="block mt-2 md:mt-4 my-2 text-gray-500 font-bold text-sm">Kata Sandi Lama</label>
                    <div class="flex justify-center">
                        <input type="password" class="px-4 w-full h-10 bg-white  rounded-xl border-2 border-[#AC87C5] focus:outline-none focus:[#756AB6] focus:border-[#756AB6]" name="password1" id="password1" placeholder="Masukan Kata Sandi Lama">
                    </div>
                </div>
                <div class="mx-10 lg:mx-[340px] md:mx-[70px]">
                    <label for="password2" class="block  mt-2 py-2 text-gray-500 font-bold text-sm">Kata Sandi Baru</label>
                    <div class="flex justify-center">
                        <input type="password" class="px-4 w-full h-10 bg-white  rounded-xl border-2 border-[#AC87C5] focus:outline-none focus:[#756AB6] focus:border-[#756AB6]" name="password2" id="password2" placeholder="Masukan Kata Sandi Baru">
                    </div>
                </div>
                <div class="mx-10 lg:mx-[340px] md:mx-[70px]">
                    <label for="password3" class="block  mt-2 my-2 text-gray-500 font-bold text-sm">Konfirmasi Kata Sandi Baru</label>
                    <div class="flex justify-center">
                        <input type="password" class="px-4 w-full h-10 bg-white  rounded-xl border-2 border-[#AC87C5] focus:outline-none focus:[#756AB6] focus:border-[#756AB6]" name="password3" id="password3" placeholder="Masukan Konfirmasi Kata Sandi Baru">
                    </div>
                </div>
                <!-- button -->
                <div class="mx-10 lg:mx-[340px] md:mx-[70px]">
                <div class="flex justify-center">
                    <button type="submit" name="submit" class="text-center my-10 rounded-xl md:w-96 lg:w-96 w-full h-10 bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] hover:bg-none hover:border-2 hover:border-[#AC87C5] text-white text-sm font-bold hover:text-[#AC87C5]">
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
                    <!-- <div class="flex flex-col md:flex-row gap-4 text-white font-bold text-sm mt-4">
                        <a href="about.php">Tentang Kami</a>
                        <a href="kontak.php">Kontak</a>
                        <a href="kebijakan.php">Kebijakan Pribadi</a>
                    </div> -->
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