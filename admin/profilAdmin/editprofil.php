<?php
ob_start(); // Memulai buffer output
session_start(); // Memulai sesi

include '../../function.php';

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
    header('Location: /event/admin/profilAdmin/editprofil.php?id=' . $id);
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
    <div class="flex p-5 gap-4 bg-gradient-to-r from-[#AC87C5] to-[#E0AED0]">
        <div class="bg-white shadow-xl w-1/5 h-full rounded-xl">
            <a class="text-[#AC87C5] font-bold text-4xl py-6 flex justify-center" href="index.php">EventUnila</a>
            <nav class=" w-full flex flex-col ">
                <a class="nav-link gap-3 px-10 py-2.5 my-1 text-base flex items-center text-[#AC87C5] hover:w-11/12 hover:rounded-r-full hover:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5] active:w-11/12 active:rounded-r-full active:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5] group" href="/event/admin/beranda.php">
                    <i class="ti ti-dashboard ps-2 text-2xl group-hover:text-white group-active:text-white"></i><span class="group-hover:text-white group-active:text-white">Beranda</span>
                </a>
                <a class="nav-link gap-3 px-10 py-2.5 my-1 text-base flex items-center text-[#AC87C5] hover:w-11/12 hover:rounded-r-full hover:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5] active:w-11/12 active:rounded-r-full active:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5] group" href="/event/admin/event/index.php">
                    <i class="ti ti-calendar-event  ps-2 text-2xl group-hover:text-white group-active:text-white"></i> <span class="group-hover:text-white group-active:text-white">Event</span>
                </a>
                <a class="nav-link gap-3 px-10 py-2.5 my-1 text-base flex items-center text-[#AC87C5] hover:w-11/12 hover:rounded-r-full hover:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5]  active:w-11/12 active:rounded-r-full active:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5] group" href="/event/admin/kategori/index.php">
                    <i class="ti ti-category ps-2 text-2xl group-hover:text-white group-active:text-white"></i><span class="group-hover:text-white group-active:text-white">Kategori</span>
                </a>
                <a class="nav-link gap-3 px-10 py-2.5 my-1 text-base flex items-center text-[#AC87C5] hover:w-11/12 hover:rounded-r-full hover:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5]  active:w-11/12 active:rounded-r-full active:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5] group" href="/event/admin/pengguna/index.php">
                    <i class="ti ti-users ps-2 text-2xl group-hover:text-white group-active:text-white"></i><span class="group-hover:text-white group-active:text-white">Pengguna</span>
                </a>
                <a class="nav-link gap-3 px-10 py-2.5 my-1 text-base flex items-center text-[#AC87C5] hover:w-11/12 hover:rounded-r-full hover:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5]  active:w-11/12 active:rounded-r-full active:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5] group" href="/event/admin/profilAdmin/index.php?id=<?php echo $_SESSION["users_id"]; ?>">
                    <i class="ti ti-users ps-2 text-2xl group-hover:text-white group-active:text-white"></i><span class="group-hover:text-white group-active:text-white">Profile</span>
                </a>
                <a class="nav-link gap-3 px-10 py-2.5 my-1 text-base flex items-center text-[#AC87C5] hover:w-11/12 hover:rounded-r-full hover:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5]  active:w-11/12 active:rounded-r-full active:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5] group" href="../logout.php">
                    <i class="ti ti-logout ps-2 text-2xl group-hover:text-white group-active:text-white"></i><span class="group-hover:text-white group-active:text-white">Keluar</span>
                </a>
            </nav>

            <div class="px-12 mt-40 mb-10">
                <hr class="border-[#AC87C5] border-1 mb-8">
                <i class="ti ti-user-circle ps-2  text-[#AC87C5] text-4xl"></i>
                <p class="text-[#AC87C5] text-base font-bold mt-2"><?= ucwords(strtolower($_SESSION['nama'])) ?></p>
            </div>
        </div>

        <div class="">
            <h1 class="text-white font-bold text-4xl py-6 ">Profil</h1>
            <div class="flex justify-center">
                <hr class="border-white border-1 w-[1050px]">
            </div>
            <?php if ($flash) : ?>
                <div id="flash-message" class="flex-1">
                    <div class="px-4 py-2 rounded-xl text-white <?php echo ($flash['type'] == 'success') ? 'bg-green-500' : ($flash['type'] == 'error' ? 'bg-red-500' : ($flash['type'] == 'warning' ? 'bg-yellow-500' : 'bg-blue-500')); ?>">
                        <?php echo $flash['message']; ?>
                    </div>
                </div>
            <?php endif; ?>
            <h2 class="text-white font-bold text-4xl flex justify-center py-6">Edit Profil</h2>
            <div class="bg-white w-[1000px] shadow-xl rounded-xl p-6 mx-6">
                <form action="" method="post">
                    <input type="hidden" name="id" value="<?php echo $users["id"]; ?>">
                    <div class="">
                        <label for="nama" class="block px-[160px] py-2 text-gray-500 font-bold text-sm">Nama</label>
                        <div class="flex justify-center">
                            <input type="text" class="px-4 w-8/12 h-10 bg-white shadow-2xl rounded-xl border-2 border-[#756AB6]" name="nama" id="nama" value="<?php echo $users["nama"]; ?>" required>
                        </div>
                        <label for="email" class="block px-[160px] py-2 text-gray-500 font-bold text-sm">Email</label>
                        <div class="flex justify-center">
                            <input type="text" class="bg-gray-100 px-4 w-8/12 h-10 bg-white shadow-2xl rounded-xl border-2 border-[#756AB6]" name="email" id="email" value="<?php echo $users["email"]; ?>" required disabled>
                        </div>

                        <h3 class="px-[160px] block mt-4 text-[#756AB6] font-bold text-lg">Ubah Kata Sandi</h3>

                        <label for="password1" class="block px-[160px] py-2 text-gray-500 font-bold text-sm">Kata Sandi Lama</label>
                        <div class="flex justify-center">
                            <input type="password" class="px-4 w-8/12 h-10 bg-white shadow-2xl rounded-xl border-2 border-[#756AB6]" name="password1" id="password1" placeholder="Masukan Kata Sandi Lama">
                        </div>
                        <label for="password2" class="block px-[160px] py-2 text-gray-500 font-bold text-sm">Kata Sandi Baru</label>
                        <div class="flex justify-center">
                            <input type="password" class="px-4 w-8/12 h-10 bg-white shadow-2xl rounded-xl border-2 border-[#756AB6]" name="password2" id="password2" placeholder="Masukan Kata Sandi Baru">
                        </div>
                        <label for="password3" class="block px-[160px] py-2 text-gray-500 font-bold text-sm">Konfirmasi Kata Sandi Baru</label>
                        <div class="flex justify-center">
                            <input type="password" class="px-4 w-8/12 h-10 bg-white shadow-2xl rounded-xl border-2 border-[#756AB6]" name="password3" id="password3" placeholder="Masukan Konfirmasi Kata Sandi Baru">
                        </div>
                        <!-- button -->
                        <div class="text-center mx-auto my-10 rounded-xl w-96 h-10 bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] hover:bg-none hover:border-2 hover:border-[#AC87C5] group">
                            <button type="submit" name="submit" class=" text-white text-sm font-bold pt-[8px] group-hover:text-[#AC87C5]">
                                Simpan
                            </button>
                        </div>
                    </div>
                </form>
                <script src="../../script.js"></script>
</body>

</html>