<?php
include '../../function.php';

session_start();

// ambil data di URL
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    // query data event berdasarkan id
    $event = query("SELECT events.*, kategori.kategori 
    FROM events 
    JOIN kategori ON events.kategori_id = kategori.id 
    WHERE events.id = $id")[0];
} else {
    // jika tidak ada id, redirect ke halaman lain atau tampilkan pesan error
    header('Location: /event/admin/event/index.php');
    exit;
}

$kategori = query("SELECT * FROM kategori");

// cek apakah tombol submit sudah ditekan apa belum
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (ubah2($_POST) > 0) {
        // Set flashdata untuk sukses
        $_SESSION['flash'] = [
            'message' => 'Event berhasil diubah!',
            'type' => 'success'
        ];
    } else {
        // Set flashdata untuk error
        $_SESSION['flash'] = [
            'message' => 'Event gagal diubah!',
            'type' => 'error'
        ];
    }
    // Redirect ke halaman yang sama dengan id
    header('Location: ubah.php?id=' . $id);
    exit;
}

// Cek apakah ada flashdata
$flash = isset($_SESSION['flash']) ? $_SESSION['flash'] : null;
unset($_SESSION['flash']); // Hapus flashdata setelah ditampilkan
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
    <div class="lg:flex bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] w-full h-full md:h-screen lg:h-full py-6 lg:p-5 ">
        <div class="flex justify-between mx-10 pb-6 lg:mx-0 lg:pb-0">
            <a class="text-white font-bold text-2xl lg:hidden" href="index.php">EventUnila</a>
            <button id="dropdownButton">
                <i id="dropdownIcon" class="ti ti-user-circle text-white text-3xl lg:hidden"></i>
            </button>
        </div>
        <div id="navbarDropdownMenu" class="lg:hidden hidden absolute w-8/12 md:w-4/12 left-[60px] md:left-[470px] top-[85px] bg-white rounded-xl mx-10  ">
            <nav class=" w-full flex flex-col">
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
                <a class="nav-link gap-3 px-10 py-2.5 my-1 text-base flex items-center text-[#AC87C5] hover:w-11/12 hover:rounded-r-full hover:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5]  active:w-11/12 active:rounded-r-full active:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5] group" href="/event/admin/profilAdmin/index.php">
                    <i class="ti ti-users ps-2 text-2xl group-hover:text-white group-active:text-white"></i><span class="group-hover:text-white group-active:text-white">Profile</span>
                </a>
                <a class="nav-link gap-3 px-10 py-2.5 my-1 text-base flex items-center text-[#AC87C5] hover:w-11/12 hover:rounded-r-full hover:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5]  active:w-11/12 active:rounded-r-full active:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5] group" href="../logout.php">
                    <i class="ti ti-logout ps-2 text-2xl group-hover:text-white group-active:text-white"></i><span class="group-hover:text-white group-active:text-white">Keluar</span>
                </a>
            </nav>
        </div>

        <div class="bg-white shadow-xl lg:w-1/5 lg:h-auto rounded-xl hidden lg:flex flex-col lg:mr-4">
            <a class="text-[#AC87C5] font-bold text-4xl py-6 flex justify-center" href="index.php">EventUnila</a>
            <nav class=" w-full flex flex-col ">
                <a class="nav-link gap-3 px-12 py-2.5 my-1 text-base flex items-center text-[#AC87C5] hover:w-11/12 hover:rounded-r-full hover:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5] active:w-11/12 active:rounded-r-full active:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5] group" href="/event/admin/beranda.php">
                    <i class="ti ti-dashboard ps-2 text-2xl group-hover:text-white group-active:text-white"></i><span class="group-hover:text-white group-active:text-white">Beranda</span>
                </a>
                <a class="nav-link gap-3 px-12 py-2.5 my-1 text-base flex items-center text-[#AC87C5] hover:w-11/12 hover:rounded-r-full hover:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5] active:w-11/12 active:rounded-r-full active:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5] group" href="/event/admin/event/index.php">
                    <i class="ti ti-calendar-event  ps-2 text-2xl group-hover:text-white group-active:text-white"></i> <span class="group-hover:text-white group-active:text-white">Event</span>
                </a>
                <a class="nav-link gap-3 px-12 py-2.5 my-1 text-base flex items-center text-[#AC87C5] hover:w-11/12 hover:rounded-r-full hover:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5]  active:w-11/12 active:rounded-r-full active:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5] group" href="/event/admin/kategori/index.php">
                    <i class="ti ti-category ps-2 text-2xl group-hover:text-white group-active:text-white"></i><span class="group-hover:text-white group-active:text-white">Kategori</span>
                </a>
                <a class="nav-link gap-3 px-12 py-2.5 my-1 text-base flex items-center text-[#AC87C5] hover:w-11/12 hover:rounded-r-full hover:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5]  active:w-11/12 active:rounded-r-full active:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5] group" href="/event/admin/pengguna/index.php">
                    <i class="ti ti-users ps-2 text-2xl group-hover:text-white group-active:text-white"></i><span class="group-hover:text-white group-active:text-white">Pengguna</span>
                </a>
                <a class="nav-link gap-3 px-12 py-2.5 my-1 text-base flex items-center text-[#AC87C5] hover:w-11/12 hover:rounded-r-full hover:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5]  active:w-11/12 active:rounded-r-full active:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5] group" href="/event/admin/profilAdmin/index.php?">
                    <i class="ti ti-users ps-2 text-2xl group-hover:text-white group-active:text-white"></i><span class="group-hover:text-white group-active:text-white">Profile</span>
                </a>
                <a class="nav-link gap-3 px-12 py-2.5 my-1 text-base flex items-center text-[#AC87C5] hover:w-11/12 hover:rounded-r-full hover:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5]  active:w-11/12 active:rounded-r-full active:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5] group" href="../logout.php">
                    <i class="ti ti-logout ps-2 text-2xl group-hover:text-white group-active:text-white"></i><span class="group-hover:text-white group-active:text-white">Keluar</span>
                </a>
            </nav>

            <div class="mx-12 mt-[440px] mb-10">
                <hr class="border-[#AC87C5] border-1 mb-8">
                <i class="ti ti-user-circle ps-2 text-[#AC87C5] text-4xl"></i>
                <p class="text-[#AC87C5] text-base font-bold mt-2"><?= ucwords(strtolower($_SESSION['nama'])) ?></p>
            </div>
        </div>


        <div class="">
        <div class="flex justify-center lg:hidden">
                <hr class="border-white border-1 w-full md:w-[1050px]">
            </div>
            <h1 class="hidden lg:block text-white font-bold text-4xl my-6 mx-5">Event</h1>
            <div class="hidden lg:flex justify-center">
                <hr class="border-white border-1 w-[1000px]">
            </div>
            <h2 class="text-white font-bold text-2xl lg:text-4xl flex justify-center my-6">Detail Event</h2>

            <!-- <div class="flex flex-wrap text-white list-none mx-14 my-5 lg:mx-10 ">
                <div class="flex font-semibold">
                    <a href="../beranda.php">
                        <i class="ti ti-home-filled pr-2"></i>Beranda</a>
                </div>
                <span class="mx-2">/</span>
                <a href="../event/index.php">
                    <li class="text-white font-semibold">Event</li>
                </a>
                <span class="mx-2">/</span>
                <a href="../event/ubah.php">
                    <li class="text-white font-semibold">Detail Event</li>
                </a>
            </div> -->

            <?php if ($flash) : ?>
                <div id="flash-message" class="flex-1">
                    <div class="px-4 py-2 rounded-xl text-white <?php echo ($flash['type'] == 'success') ? 'bg-green-500' : ($flash['type'] == 'error' ? 'bg-red-500' : ($flash['type'] == 'warning' ? 'bg-yellow-500' : 'bg-blue-500')); ?>">
                        <?php echo $flash['message']; ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="flex justify-center mt-6">
                <div class="bg-white rounded-xl w-[340px] md:w-[1000px] h-3/5 mx-10 lg:mx-5  pt-6">
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?php echo $event["id"]; ?> ">
                        <label for="judul" class="block mx-4 md:mx-8 lg:mx-10 my-2 text-[#AC87C5] font-bold text-sm">Nama Event</label>
                        <div class="flex justify-center">
                            <input type="text" class="px-4 w-11/12 h-10 bg-gray-100  rounded-xl border-2 border-[#756AB6] form-control" name="judul" id="judul" required value="<?php echo $event["judul"]; ?>" disabled>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex-1">
                                <label for="kategori" class="block ml-4 md:ml-8 lg:ml-10 my-2 text-[#AC87C5] font-bold text-sm">Kategori</label>
                                <div class="ml-4 md:ml-8 lg:ml-10 flex justify-start">
                                    <input type="text" class="px-4 w-full h-10 bg-gray-100  rounded-xl border-2 border-[#756AB6] form-control" name="kategori" id="kategori" required value="<?php echo $event["kategori"]; ?>" disabled>
                                </div>
                            </div>
                            <div class="flex-1">
                                <label for="lokasi" class="block mr-4 md:mr-8 lg:mr-10 my-2 text-[#AC87C5] font-bold text-sm">Lokasi</label>
                                <div class="mr-4 md:mr-8 lg:mr-10flex justify-start">
                                    <input type="text" class="px-4 w-full h-10 bg-gray-100  rounded-xl border-2 border-[#756AB6] form-control" name="lokasi" id="lokasi" required value="<?php echo $event["lokasi"]; ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex-1">
                                <label for="tanggal" class="block ml-4 md:ml-8 lg:ml-10 my-2 text-[#AC87C5] font-bold text-sm">Tanggal</label>
                                <div class="ml-4 md:ml-8 lg:ml-10 flex justify-start">
                                    <input type="date" class="px-4 w-full h-10 bg-gray-100  rounded-xl border-2 border-[#756AB6] form-control" name="tanggal" id="tanggal" required value="<?php echo $event["tanggal"]; ?>" disabled>
                                </div>
                            </div>
                            <div class="flex-1">
                                <label for="waktu" class="block mr-4 md:mr-8 lg:mr-10 my-2 text-[#AC87C5] font-bold text-sm">Waktu</label>
                                <div class="mr-4 md:mr-8 lg:mr-10 flex justify-start">
                                    <input type="time" class="px-4 w-full h-10 bg-gray-100  rounded-xl border-2 border-[#756AB6] form-control" name="waktu" id="waktu" required value="<?php echo $event["waktu"]; ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <label for="link_pendaftaran" class="block mx-4 md:mx-8 lg:mx-10 my-2 text-[#AC87C5] font-bold text-sm">Link Pendaftaran</label>
                        <div class="flex justify-center">
                            <input type="text" class="px-4 w-11/12 h-10 bg-gray-100  rounded-xl border-2 border-[#756AB6] form-control" name="link_pendaftaran" id="link_pendaftaran" required value="<?php echo $event["link_pendaftaran"]; ?>" disabled>
                        </div>
                        <label for="penyelenggara" class="block mx-4 md:mx-8 lg:mx-10 my-2 text-[#AC87C5] font-bold text-sm">Nama Penyelenggara</label>
                        <div class="flex justify-center">
                            <input type="text" class="px-4 w-11/12 h-10 bg-gray-100  rounded-xl border-2 border-[#756AB6] form-control" name="penyelenggara" id="penyelenggara" required value="<?php echo $event["penyelenggara"]; ?>" disabled>
                        </div>
                        <label for="deskripsi" class="block mx-4 md:mx-8 lg:mx-10 my-2 text-[#AC87C5] font-bold text-sm">Deskripsi Event</label>
                        <div class="flex justify-center">
                            <input type="text" class="text-justify px-4 w-11/12 h-64 bg-gray-100  rounded-xl border-2 border-[#756AB6] form-control" name="deskripsi" id="deskripsi" required value="<?php echo $event["deskripsi"]; ?>" disabled></textarea>
                        </div>
                        <div class="relative">
                            <label for="status" class="block mx-4 md:mx-8 lg:mx-10 my-2 text-[#AC87C5] font-bold text-sm">Status</label>
                            <div class="flex justify-center">
                                <input id="statusDropdownInput" type="text" class="px-4 w-11/12 h-10 bg-white  rounded-xl border-2 border-[#756AB6] form-control" name="status" id="status" aria-describedby="penyelenggaraHelp" required value="<?php echo $event["status"]; ?>" readonly>
                                <div id="statusDropdownMenu" class="hidden absolute left-[200px] transform -translate-x-1/2 mt-1 w-full max-w-xs rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10">
                                    <ul class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="statusDropdownInput">
                                        <li><button type="button" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sedang Diajukan</button></li>
                                        <li><button type="button" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Disetujui</button></li>
                                        <li><button type="button" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Ditolak</button></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="text-center my-6 mx-4 md:mx-8 lg:mx-10 rounded-xl w-24 h-8 bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] hover:bg-none hover:border-2 hover:border-[#AC87C5] group">
                            <button type="submit" name="submit" class=" text-white text-sm font-bold pt-[5px] group-hover:text-[#AC87C5]">
                                Simpan
                            </button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../../script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Ambil pathname dari current URL tanpa query string
            let currentPathname = window.location.pathname;
            console.log('Current URL Pathname:', currentPathname);

            // Loop melalui setiap link navbar dan periksa jika pathname-nya cocok dengan currentPathname tanpa query string
            document.querySelectorAll('.nav-link').forEach(function(link) {
                let linkPathname = new URL(link.href).pathname;
                console.log('Checking link Pathname:', linkPathname);

                // Menghapus string query dari pathname jika ada
                let linkPathnameWithoutQuery = linkPathname.split('?')[0];
                let currentPathnameWithoutQuery = currentPathname.split('?')[0];
                console.log('Current Pathname Without Query:', currentPathnameWithoutQuery);
                console.log('Link Pathname Without Query:', linkPathnameWithoutQuery);

                // Jika currentPathname mengandung linkPathname atau sebaliknya
                if (currentPathnameWithoutQuery.includes(linkPathnameWithoutQuery) || linkPathnameWithoutQuery.includes(currentPathnameWithoutQuery)) {
                    link.classList.add('active');
                    console.log('Match found:', link.href);
                    link.classList.add('text-white', 'w-11/12', 'rounded-r-full', 'bg-gradient-to-b', 'from-[#AC87C5]', 'via-[#E0AED0]', 'to-[#FFE5E5]');
                }
            });
        });
    </script> -->
</body>

</html>