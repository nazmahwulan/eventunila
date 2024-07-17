<?php
include '../../function.php';
session_start();

// Periksa apakah peran pengguna adalah admin
if ($_SESSION['user_role'] !== 'admin') {
    // Jika tidak, arahkan ke halaman lain atau tampilkan pesan error
    header('Location:../../index.php');
    exit;
}

//pagination
$jumlahDataPerHalaman = 5;
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

// Keyword pencarian
$keyword = '';
if (isset($_POST["cari2"])) {
    $keyword = $_POST["keyword"];
} elseif (isset($_GET["keyword"])) {
    $keyword = $_GET["keyword"];
}

// Query dasar
$queryBase = "SELECT * FROM users";

// Tambahkan kondisi pencarian jika ada keyword
$querySearch = "";
if (!empty($keyword)) {
    $querySearch = " WHERE (users.nama LIKE '%$keyword%' 
        OR users.email LIKE '%$keyword%' 
        OR users.role LIKE '%$keyword%')";
}

// Hitung total data
$queryCount = $queryBase . $querySearch;
$users = query($queryCount);
$jumlahData = count($users);
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);

// Query dengan LIMIT untuk pagination
$query = $queryBase . $querySearch . " ORDER BY users.created_at DESC LIMIT $awalData, $jumlahDataPerHalaman";
$pengguna = query($query);

// Cek apakah ada flashdata
$flash = isset($_SESSION['flash']) ? $_SESSION['flash'] : null;
unset($_SESSION['flash']); // Hapus flashdata setelah ditampilkan


// include '../../function.php';
// session_start();

// // Pagination settings
// $jumlahDataPerHalaman = 2;

// // Default query untuk mendapatkan semua pengguna
// $query = "SELECT * FROM users";

// // Jika tombol cari ditekan
// if (isset($_POST["cari2"])) {
//     $keyword = $_POST["keyword"];
//     $query = "SELECT * FROM users WHERE nama LIKE '%$keyword%' OR email LIKE '%$keyword%' OR role LIKE '%$keyword%'";
//     $_SESSION['keyword'] = $keyword; // Simpan keyword dalam sesi untuk pencarian di halaman berikutnya
// } elseif (isset($_SESSION['keyword'])) {
//     $keyword = $_SESSION['keyword'];
//     $query = "SELECT * FROM users WHERE nama LIKE '%$keyword%' OR email LIKE '%$keyword%' OR role LIKE '%$keyword%'";
// } else {
//     unset($_SESSION['keyword']); // Hapus keyword dari sesi jika tidak ada pencarian
// }

// // Hitung total data berdasarkan query pencarian
// $events = query($query);
// $jumlahData = count($events);
// $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);

// // Ambil halaman aktif dari URL jika ada
// $halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
// $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

// // Tambahkan LIMIT untuk pagination
// $query .= " LIMIT $awalData, $jumlahDataPerHalaman";
// $pengguna = query($query);

// // Cek apakah ada flashdata
// $flash = isset($_SESSION['flash']) ? $_SESSION['flash'] : null;
// unset($_SESSION['flash']); // Hapus flashdata setelah ditampilkan
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
    <div class="lg:flex bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] w-full h-screen lg:h-full py-6 lg:p-5 ">
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

        <div class="bg-white shadow-xl lg:w-1/5 lg:h-full rounded-xl hidden lg:flex flex-col lg:mr-4">
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
            <div class="flex justify-center lg:justify-start lg:gap-[240px]">
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
            <h2 class="text-white font-bold text-2xl lg:text-4xl flex justify-center my-6">Daftar Pengguna</h2>

            <div class="bg-white lg:w-[1000px] shadow-xl rounded-xl p-6 mx-10 lg:mx-5 overflow-x-auto ">
                <div class="flex justify-end gap-4 mb-5 w-[680px] lg:w-[950px]">
                    <form action="" method="post" class="flex items-center">
                        <input type="text" class="block px-4 w-40 h-10 bg-white rounded-l-xl border-2 border-[#AC87C5]" name="keyword" placeholder="Cari Pengguna" autocomplete="off" value="<?php echo isset($_POST['keyword']) ? htmlspecialchars($_POST['keyword']) : ''; ?>">
                        <button type="submit" name="cari2" class="ti ti-search text-white px-2 w-10 h-10 rounded-r-xl bg-[#AC87C5] ">
                        </button>
                    </form>
                </div>
                <table class="min-w-full divide-y divide-gray-200 w-full">
                    <thead class="">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-sm font-bold uppercase tracking-wider">#</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-sm font-bold uppercase tracking-wider">Nama</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-sm font-bold uppercase tracking-wider">Email</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-sm font-bold uppercase tracking-wider">Password</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-sm font-bold uppercase tracking-wider">Role</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-sm font-bold uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if (empty($pengguna)) : ?>
                            <tr>
                                <td colspan="6" class="px-4 py-2 text-center text-sm leading-tight">
                                    Data Tidak Ditemukan
                                </td>
                            </tr>
                        <?php else : ?>
                            <?php $i  = $awalData + 1; ?>
                            <?php foreach ($pengguna as $row) : ?>
                                <tr>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm leading-tight"><?php echo $i; ?></td>
                                    <td class="px-4 py-2 whitespace-normal text-sm leading-tight"><?php echo $row["nama"]; ?></td>
                                    <td class="px-4 py-2 whitespace-normal text-sm leading-tight"><?php echo $row["email"]; ?></td>
                                    <td class="px-4 py-2 whitespace-nowrap overflow-hidden overflow-ellipsis text-sm leading-tight">
                                        <?php echo str_repeat('●', min(strlen($row["password"]), 20)) . (strlen($row["password"]) > 20 ? '...' : ''); ?>
                                    </td>
                                    <td class="px-4 py-2 whitespace-normal text-sm leading-tight"><?php echo $row["role"]; ?></td>


                                    <td class="px-4 py-2 whitespace-nowrap text-sm leading-tight">
                                        <div class="flex gap-2">
                                            <!-- <a href="lihat.php?id=<?php echo $row["id"]; ?>" class=" ti ti-edit bg-gradient-to-b from-[#AC87C5] to-[#E0AED0] rounded-xl w-8 h-8 text-sm  text-white flex items-center justify-center"></a> -->
                                            <a onclick="openDeleteModal(<?= $row['id'] ?>)" class="ti ti-trash bg-gradient-to-b from-[#AC87C5] to-[#E0AED0] rounded-xl w-8 h-8 text-sm text-white flex items-center justify-center hover:bg-none hover:border-2 hover:border-[#AC87C5] hover:text-[#AC87C5]"></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>

                <!-- Modal Hapus -->
                <div id="deleteModal" class="fixed top-0 left-0 w-full h-full bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
                    <div class="bg-white p-8 rounded-xl w-2/3 md:w-6/12 lg:w-1/3">
                        <div class="text-center mb-4">
                            <h2 class="text-lg font-bold">Konfirmasi Penghapusan</h2>
                        </div>
                        <p class="mb-4">Apakah Anda yakin ingin menghapus item ini?</p>
                        <div class="text-center">
                            <button id="cancelDeleteButton" class="text-[#AC87C5] border-2 border-[#AC87C5] hover:bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] hover:border-none hover:text-white px-4 py-2 rounded-xl mr-2">Batal</button>
                            <button id="confirmDeleteButton" class="bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] hover:bg-none hover:border-2 hover:border-[#AC87C5] hover:text-[#AC87C5] text-white  px-4 py-2 rounded-xl">Hapus</button>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end mt-4 w-[750px] lg:w-[950px]">
                    <?php if ($halamanAktif > 1) : ?>
                        <a class="border-2 border-[#AC87C5] rounded-xl p-2 mx-1 text-xs font-bold" href="?halaman=<?= $halamanAktif - 1 ?>&keyword=<?= isset($keyword) ? $keyword : '' ?>">&laquo;</a>
                    <?php endif; ?>

                    <?php
                    $start = max(1, $halamanAktif - 1);
                    $end = min($jumlahHalaman, $halamanAktif + 1);
                    ?>

                    <?php if ($start > 1) : ?>
                        <a class="border-2 border-[#AC87C5] rounded-xl p-2 mx-1 text-xs font-bold" href="?halaman=1&keyword=<?= isset($keyword) ? $keyword : '' ?>">1</a>
                    <?php endif; ?>

                    <?php for ($i = $start; $i <= $end; $i++) : ?>
                        <?php if ($i == $halamanAktif) : ?>
                            <span class="border-2 border-[#AC87C5] rounded-xl p-2 mx-1 text-xs font-bold text-white bg-[#AC87C5]"><?= $i ?></span>
                        <?php else : ?>
                            <a class="border-2 border-[#AC87C5] rounded-xl p-2 mx-1 text-xs font-bold" href="?halaman=<?= $i ?>&keyword=<?= isset($keyword) ? $keyword : '' ?>"><?= $i ?></a>
                        <?php endif; ?>
                    <?php endfor; ?>

                    <?php if ($end < $jumlahHalaman) : ?>
                        <?php if ($end < $jumlahHalaman - 1) : ?>
                            <span class="border-2 border-[#AC87C5] rounded-xl p-2 mx-1 text-xs font-bold">...</span>
                        <?php endif; ?>
                        <a class="border-2 border-[#AC87C5] rounded-xl p-2 mx-1 text-xs font-bold" href="?halaman=<?= $jumlahHalaman ?>&keyword=<?= isset($keyword) ? $keyword : '' ?>"><?= $jumlahHalaman ?></a>
                    <?php endif; ?>

                    <?php if ($halamanAktif < $jumlahHalaman) : ?>
                        <a class="border-2 border-[#AC87C5] rounded-xl p-2 mx-1 text-xs font-bold" href="?halaman=<?= $halamanAktif + 1 ?>&keyword=<?= isset($keyword) ? $keyword : '' ?>">&raquo;</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="../../script.js"></script>
    <script>
        // Function to set the active nav-link
        function setActiveNavLink() {
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.nav-link');

            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                    link.classList.add('text-white', 'w-11/12', 'rounded-r-full', 'bg-gradient-to-b', 'from-[#AC87C5]', 'via-[#E0AED0]', 'to-[#FFE5E5]');
                } else {
                    link.classList.remove('active');
                }
            });
        }

        document.addEventListener('DOMContentLoaded', setActiveNavLink);

        // Fungsi untuk membuka modal
        function openDeleteModal(id) {
            var deleteModal = document.getElementById('deleteModal');
            deleteModal.classList.remove('hidden');

            // Setelah tombol Hapus di modal diklik, redirect ke halaman delete.php dengan id yang sesuai
            var confirmDeleteButton = document.getElementById('confirmDeleteButton');
            confirmDeleteButton.addEventListener('click', function() {
                window.location.href = 'hapus.php?id=' + id;
            });

            // Fungsi untuk menutup modal
            var cancelDeleteButton = document.getElementById('cancelDeleteButton');
            cancelDeleteButton.addEventListener('click', function() {
                deleteModal.classList.add('hidden');
            });
        }
    </script>

</html>