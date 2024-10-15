<?php
include '../function.php';
session_start(); // Mulai sesi

if (!isset($_SESSION["login"])) {
    header("location:../login.php");
    exit;
}

// Periksa apakah peran pengguna adalah admin
if ($_SESSION['user_role'] !== 'admin') {
    // Jika tidak, arahkan ke halaman lain atau tampilkan pesan error
    header('Location:../index.php');
    exit;
}


$activeEvents = countActiveEvents();
$pendingEvents = countPendingEvents();
$rejectedEvents = countRejectedEvents();
$categories = countCategories();
$users = countUsers();
$admin = countAdmin();

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
    <div class="lg:flex bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] w-full md:h-screen lg:h-full py-6 lg:pt-5 lg:pb-5 lg:pl-5 lg:pr-[45px]">
        <div class="flex justify-between mx-10 pb-6 lg:mx-0 lg:pb-0">
            <a class="text-white font-bold text-2xl lg:hidden" href="/index.php">EventUnila</a>
            <button id="dropdownButton">
                <i id="dropdownIcon" class="ti ti-user-circle text-white text-3xl lg:hidden"></i>
            </button>
        </div>
        <div id="navbarDropdownMenu" class="lg:hidden hidden absolute w-8/12 md:w-4/12 left-[60px] md:left-[470px] top-[85px] bg-white rounded-xl mx-10">
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
                <a class="nav-link gap-3 px-10 py-2.5 my-1 text-base flex items-center text-[#AC87C5] hover:w-11/12 hover:rounded-r-full hover:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5]  active:w-11/12 active:rounded-r-full active:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5] group" href=".././logout.php">
                    <i class="ti ti-logout ps-2 text-2xl group-hover:text-white group-active:text-white"></i><span class="group-hover:text-white group-active:text-white">Keluar</span>
                </a>
            </nav>
        </div>

        <div class="bg-white shadow-xl lg:w-1/5 lg:h-full rounded-xl hidden lg:flex flex-col lg:mr-4">
            <a class="text-[#AC87C5] font-bold text-4xl py-6 flex justify-center" href="/index.php">EventUnila</a>
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
                <a class="nav-link gap-3 px-12 py-2.5 my-1 text-base flex items-center text-[#AC87C5] hover:w-11/12 hover:rounded-r-full hover:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5]  active:w-11/12 active:rounded-r-full active:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5] group" href=".././logout.php">
                    <i class="ti ti-logout ps-2 text-2xl group-hover:text-white group-active:text-white"></i><span class="group-hover:text-white group-active:text-white">Keluar</span>
                </a>
            </nav>

            <div class="px-12 mt-40 mb-10">
                <hr class="border-[#AC87C5] border-1 mb-8">
                <i class="ti ti-user-circle ps-2 text-[#AC87C5] text-4xl"></i>
                <p class="text-[#AC87C5] text-base font-bold mt-2"><?= ucwords(strtolower($_SESSION['nama'])) ?></p>
            </div>
        </div>

        <div class="">
            <div class="flex justify-center lg:hidden">
                <hr class="border-white border-1 w-full md:w-[1050px]">
            </div>
            <h1 class="text-white font-bold text-2xl text-center my-10 lg:hidden">Beranda</h1>
            <h1 class="hidden lg:block text-white font-bold text-4xl my-6 mx-5 ">Beranda</h1>
            <div class="hidden lg:flex justify-center">
                <hr class="border-white border-1 w-[985px]">
            </div>

            <div class="flex items-center justify-center lg:mt-10">
                <div class="grid gap-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 mb-10">
                    <div class="flex flex-col items-center justify-center bg-white text-[#AC87C5] py-6 px-10 shadow-lg rounded-xl w-[300px]">
                        <i class="ti ti-calendar-check text-6xl mb-4"></i>
                        <h2 class="text-3xl font-bold"><?= $activeEvents ?></h2>
                        <p class="text-lg font-semibold">Event Aktif</p>
                    </div>
                    <div class="flex flex-col items-center justify-center bg-white text-[#AC87C5] py-6 px-10 shadow-lg rounded-xl w-[300px]">
                        <i class="ti ti-calendar-clock text-6xl mb-4"></i>
                        <h2 class="text-3xl font-bold"><?= $pendingEvents ?></h2>
                        <p class="text-lg font-semibold">Event Pending</p>
                    </div>
                    <div class="flex flex-col items-center justify-center bg-white text-[#AC87C5] py-6 px-10 shadow-lg rounded-xl w-[300px]">
                        <i class="ti ti-calendar-x text-6xl mb-4"></i>
                        <h2 class="text-3xl font-bold"><?= $rejectedEvents ?></h2>
                        <p class="text-lg font-semibold">Event Ditolak</p>
                    </div>
                    <div class="flex flex-col items-center justify-center bg-white text-[#AC87C5] py-6 px-10 shadow-lg rounded-xl w-[300px]">
                        <i class="ti ti-category text-6xl mb-4"></i>
                        <h2 class="text-3xl font-bold"><?= $categories ?></h2>
                        <p class="text-lg font-semibold">Kategori</p>
                    </div>
                    <div class="flex flex-col items-center justify-center bg-white text-[#AC87C5] py-6 px-10 shadow-lg rounded-xl w-[300px]">
                        <i class="ti ti-user text-6xl mb-4"></i>
                        <h2 class="text-3xl font-bold"><?= $users ?></h2>
                        <p class="text-lg font-semibold">Pengguna</p>
                    </div>
                    <div class="flex flex-col items-center justify-center bg-white text-[#AC87C5] py-6 px-10 shadow-lg rounded-xl w-[300px]">
                        <i class="ti ti-user-check text-6xl mb-4"></i>
                        <h2 class="text-3xl font-bold"><?= $admin ?></h2>
                        <p class="text-lg font-semibold">Admin</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../script.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Navbar active link
            let currentUrl = window.location.href;
            document.querySelectorAll('.nav-link').forEach(function(link) {
                if (currentUrl === link.href) {
                    link.classList.add('active');
                    link.classList.add('text-white', 'w-11/12', 'rounded-r-full', 'bg-gradient-to-b', 'from-[#AC87C5]', 'via-[#E0AED0]', 'to-[#FFE5E5]');

                }
            });
        });
    </script>
</body>

</html>