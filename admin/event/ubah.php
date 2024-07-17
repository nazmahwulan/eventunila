<?php
include '../../function.php';
session_start();

// Periksa apakah peran pengguna adalah admin
if ($_SESSION['user_role'] !== 'admin') {
    // Jika tidak, arahkan ke halaman lain atau tampilkan pesan error
    header('Location:../../index.php');
    exit;
}

// Ambil data di URL
if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = intval($_GET["id"]);
    // Query data event berdasarkan ID
    $events = query("SELECT events.*, kategori.kategori FROM events JOIN kategori ON events.kategori_id = kategori.id WHERE events.event_id = $id");

    // Periksa apakah event ditemukan
    if (count($events) === 0) {
        // Jika tidak ditemukan, sertakan halaman error
        include '../../error.php';
        exit;
    } else {
        // Jika ditemukan, ambil data event
        $event = $events[0];
    }
} else {
    // Jika tidak ada ID atau ID tidak valid, sertakan halaman error
    include '../../error.php';
    exit;
}

$kategori = query("SELECT * FROM kategori");

// Cek apakah tombol submit sudah ditekan
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
    // Redirect ke halaman yang sama dengan ID
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
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
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
                <a class="nav-link gap-3 py-2.5 px-10 my-1 text-base flex items-center text-[#AC87C5] hover:w-11/12 hover:rounded-r-full hover:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5]  active:w-11/12 active:rounded-r-full active:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5] group" href="/event/index.php">
                    <i class="ti ti-arrows-exchange ps-2 text-2xl group-hover:text-white group-active:text-white"></i><span class=" group-hover:text-white group-active:text-white">Dahsboard Pengguna</span>
                </a>
                <a class="nav-link gap-3 px-10 py-2.5 my-1 text-base flex items-center text-[#AC87C5] hover:w-11/12 hover:rounded-r-full hover:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5]  active:w-11/12 active:rounded-r-full active:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5] group" href="../../logout.php">
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
                <a class="nav-link gap-3 py-2.5 px-12 my-1 text-base flex items-center text-[#AC87C5] hover:w-11/12 hover:rounded-r-full hover:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5]  active:w-11/12 active:rounded-r-full active:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5] group" href="/event/index.php">
                    <i class="ti ti-arrows-exchange ps-2 text-2xl group-hover:text-white group-active:text-white"></i><span class=" group-hover:text-white group-active:text-white">Dahsboard Pengguna</span>
                </a>
                <a class="nav-link gap-3 px-12 py-2.5 my-1 text-base flex items-center text-[#AC87C5] hover:w-11/12 hover:rounded-r-full hover:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5]  active:w-11/12 active:rounded-r-full active:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5] group" href="../../logout.php">
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
            <div class="flex justify-center lg:justify-start lg:gap-[275px]">
                <h1 class="hidden lg:block text-white font-bold text-4xl my-6 mx-5">Event</h1>
                <?php if ($flash) : ?>
                    <div id="flash-message" class="flex justify-center items-center my-4">
                        <div class="flex items-center px-4 py-2 rounded-xl bg-white text-black font-semibold shadow-2xl">
                            <?php if ($flash['type'] == 'success') : ?>
                                <i class="ti ti-circle-check-filled text-2xl text-[#9BCF53] mr-2"></i>
                            <?php elseif ($flash['type'] == 'error') : ?>
                                <i class="ti ti-circle-x-filled text-2xl text-[#FF0000] mr-2"></i>
                            <?php endif; ?>
                            <div class="text-center">
                                <?php echo $flash['message']; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="hidden lg:flex justify-center">
                <hr class="border-white border-1 w-[1000px]">
            </div>
            <h2 class="text-white font-bold text-2xl lg:text-4xl flex justify-center my-6">Detail Event</h2>

            <div class="flex justify-center mt-6">
                <div class="bg-white rounded-xl w-[340px] md:w-[1000px] h-3/5 mx-10 lg:mx-5  pt-6">
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?php echo $event["event_id"]; ?> ">
                        <label for="judul" class="block mx-4 md:mx-8 lg:mx-10 my-2 text-[#AC87C5] font-bold text-sm">Nama Event</label>
                        <div class="flex justify-center">
                            <input type="text" class="px-4 w-11/12 h-10 bg-gray-100  rounded-xl border-2 border-[#756AB6] form-control" name="judul" id="judul" value="<?php echo $event["judul"]; ?>" disabled>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex-1">
                                <label for="kategori" class="block ml-4 md:ml-8 lg:ml-10 my-2 text-[#AC87C5] font-bold text-sm">Kategori</label>
                                <div class="ml-4 md:ml-8 lg:ml-10 flex justify-start">
                                    <input type="text" class="px-4 w-full h-10 bg-gray-100  rounded-xl border-2 border-[#756AB6] form-control" name="kategori" id="kategori" value="<?php echo $event["kategori"]; ?>" disabled>
                                </div>
                            </div>
                            <div class="flex-1">
                                <label for="lokasi" class="block mr-4 md:mr-8 lg:mr-10 my-2 text-[#AC87C5] font-bold text-sm">Lokasi</label>
                                <div class="mr-4 md:mr-8 lg:mr-10flex justify-start">
                                    <input type="text" class="px-4 w-full h-10 bg-gray-100  rounded-xl border-2 border-[#756AB6] form-control" name="lokasi" id="lokasi" value="<?php echo $event["lokasi"]; ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex-1">
                                <label for="tanggal" class="block ml-4 md:ml-8 lg:ml-10 my-2 text-[#AC87C5] font-bold text-sm">Tanggal</label>
                                <div class="ml-4 md:ml-8 lg:ml-10 flex justify-start">
                                    <input type="date" class="px-4 w-full h-10 bg-gray-100  rounded-xl border-2 border-[#756AB6] form-control" name="tanggal" id="tanggal" value="<?php echo $event["tanggal"]; ?>" disabled>
                                </div>
                            </div>
                            <div class="flex-1">
                                <label for="waktu" class="block mr-4 md:mr-8 lg:mr-10 my-2 text-[#AC87C5] font-bold text-sm">Waktu</label>
                                <div class="mr-4 md:mr-8 lg:mr-10 flex justify-start">
                                    <input type="time" class="px-4 w-full h-10 bg-gray-100  rounded-xl border-2 border-[#756AB6] form-control" name="waktu" id="waktu" value="<?php echo $event["waktu"]; ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <label for="link_pendaftaran" class="block mx-4 md:mx-8 lg:mx-10 my-2 text-[#AC87C5] font-bold text-sm">Link Pendaftaran</label>
                        <div class="flex justify-center">
                            <input type="text" class="px-4 w-11/12 h-10 bg-gray-100  rounded-xl border-2 border-[#756AB6] form-control" name="link_pendaftaran" id="link_pendaftaran" required value="<?php echo $event["link_pendaftaran"]; ?>" disabled>
                        </div>
                        <label for="penyelenggara" class="block mx-4 md:mx-8 lg:mx-10 my-2 text-[#AC87C5] font-bold text-sm">Nama Penyelenggara</label>
                        <div class="flex justify-center">
                            <input type="text" class="px-4 w-11/12 h-10 bg-gray-100  rounded-xl border-2 border-[#756AB6] form-control" name="penyelenggara" id="penyelenggara" value="<?php echo $event["penyelenggara"]; ?>" disabled>
                        </div>
                        <label for="deskripsi" class="block mx-4 md:mx-8 lg:mx-10 my-2 text-[#AC87C5] font-bold text-sm">Deskripsi Event</label>
                        <div class="flex justify-center">
                            <div class="rounded-2xl w-11/12 border-2 border-[#AC87C5] max-h-60 overflow-y-auto">
                                <h1 class="text-black text-base text-justify px-4 py-2 bg-gray-100">
                                    <?php echo htmlspecialchars_decode($event["deskripsi"]); ?>
                                </h1>
                            </div>
                        </div>
                        <div class="relative">
                            <label for="status" class="block mx-4 md:mx-8 lg:mx-10 my-2 text-[#AC87C5] font-bold text-sm">Status</label>
                            <div class="flex justify-center">
                                <input id="statusDropdownInput" type="text" class="px-4 w-11/12 h-10 bg-white  rounded-xl border-2 border-[#756AB6] form-control" name="status" id="status" aria-describedby="penyelenggaraHelp" value="<?php echo $event["status"]; ?>" readonly>
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

    <script script src="../../script.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Ambil path URL halaman saat ini
            let currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.nav-link');

            console.log("Current Path:", currentPath);

            // Jika currentPath mengandung 'ubah.php', ubah menjadi path yang sesuai dengan index.php
            if (currentPath.includes('ubah.php')) {
                currentPath = '/event/admin/event/index.php';
            }

            navLinks.forEach(link => {
                // Ambil path dari URL tautan
                const linkPath = new URL(link.href).pathname;
                console.log("Link Path:", linkPath);

                // Periksa apakah currentPath cocok dengan linkPath
                if (currentPath === linkPath) {
                    console.log("Active link found:", link.href);
                    // Tambahkan kelas aktif jika path sesuai
                    link.classList.add('bg-gradient-to-b', 'from-[#AC87C5]', 'via-[#E0AED0]', 'to-[#FFE5E5]', 'w-11/12', 'rounded-r-full', 'text-white');
                } else {
                    // Hapus kelas aktif jika path tidak sesuai
                    link.classList.remove('w-11/12', 'rounded-r-full', 'text-white');
                }
            });
        });
    </script>
</body>

</html>