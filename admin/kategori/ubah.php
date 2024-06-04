<?php
//koneksi dengan database
include '../../function.php';
session_start();
//ambil data di URL
$id = $_GET["id"];
//query data mahasiswa berdasarkan id
$kategori = query("SELECT *FROM kategori WHERE id=$id")[0];

//cek apakah tombol submit sudah ditekan apa belum
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (ubah($_POST) > 0) {
        // Set flashdata untuk sukses
        $_SESSION['flash'] = [
            'message' => 'Kategori berhasil diubah!',
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
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                <a class="nav-link gap-3 px-10 py-2.5 my-1 text-base flex items-center text-[#AC87C5] hover:w-11/12 hover:rounded-r-full hover:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5]  active:w-11/12 active:rounded-r-full active:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5] group" href="/event/admin/keluar/index.php">
                    <i class="ti ti-logout ps-2 text-2xl group-hover:text-white group-active:text-white"></i><span class="group-hover:text-white group-active:text-white">Keluar</span>
                </a>
            </nav>

            <div class="px-12 mt-40 mb-10">
                <hr class="border-[#AC87C5] border-1 mb-8">
                <i class="ti ti-user-circle ps-2  text-[#AC87C5] text-4xl"></i>
                <p class="text-[#AC87C5] text-base font-bold mt-2">Nazmah Wulan</p>
            </div>
        </div>

        <div class="">
            <h1 class="text-white font-bold text-4xl py-6 ">Kategori</h1>
            <div class="flex justify-center">
                <hr class="border-white border-1 w-[1050px]">
            </div>
            <h2 class="text-white font-bold text-4xl flex justify-center py-6">Ubah Kategori</h2>
            <div class="flex justify-center">
                <div class="bg-white rounded-xl shadow-xl w-[1000px] h-3/5 mx-6 p-6">
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?php echo $kategori["id"]; ?> ">
                        <label for="kategori" class="text-[#AC87C5] font-bold text-lg">Kategori</label>
                        <div class="mt-2">
                            <input type="text" class="px-4 w-full h-10 bg-white shadow-2xl rounded-xl border-2 border-[#756AB6]" name="kategori" id="kategori" required value="<?php echo $kategori["kategori"]; ?>">
                        </div>
                        <div class="text-center  mt-4 rounded-xl w-24 h-8 bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] hover:bg-none hover:border-2 hover:border-[#AC87C5] group">
                            <button type="submit" name="submit" class=" text-white text-sm font-bold pt-[5px] group-hover:text-[#AC87C5]">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../../script.js"></script>

   
 
</body>

</html>