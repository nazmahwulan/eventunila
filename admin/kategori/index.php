<?php
include '../../function.php';
$kategori = query("SELECT *FROM kategori");
session_start();
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const flashMessage = document.getElementById('flash-message');
            if (flashMessage) {
                setTimeout(() => {
                    flashMessage.classList.add('opacity-0');
                    setTimeout(() => {
                        flashMessage.remove();
                    }, 1000); // Waktu animasi untuk transisi opacity
                }, 3000); // Waktu menunggu sebelum menutup
            }
        });
    </script>
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
            <h2 class="text-white font-bold text-4xl flex justify-center py-6">Daftar Kategori</h2>
            <div class="bg-white w-[1000px] shadow-xl rounded-xl p-6 mx-6">
                <div class="flex justify-end gap-2 mb-5">
                    <?php if ($flash) : ?>
                        <div id="flash-message" class="flex-1">
                            <div class="px-4 py-2 rounded-xl text-white <?php echo ($flash['type'] == 'success') ? 'bg-green-500' : ($flash['type'] == 'error' ? 'bg-red-500' : ($flash['type'] == 'warning' ? 'bg-yellow-500' : 'bg-blue-500')); ?>">
                                <?php echo $flash['message']; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="bg-gradient-to-b from-[#AC87C5] to-[#E0AED0] rounded-xl w-44 h-10 hover:bg-none hover:border-2 hover:border-[#AC87C5] group">
                        <div class="text-center pt-[6px]">
                            <a class="text-white gap-2 text-base flex justify-center font-bold group-hover:text-[#AC87C5] " href="tambah.php">
                                <i class="ti ti-plus text-xl font-bold "></i><span>Tambah Kategori</span>
                            </a>
                        </div>
                    </div>
                </div>
                <table class="min-w-full divide-y divide-gray-200 w-full">
                    <thead>
                        <tr>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-sm font-bold uppercase tracking-wider">#</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-sm font-bold uppercase tracking-wider">Kategori</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-sm font-bold uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if (empty($kategori)) : ?>
                            <tr>
                                <td colspan="6" class="px-4 py-2 text-center text-sm leading-tight">
                                    Tidak ada data
                                </td>
                            </tr>
                        <?php else : ?>
                            <?php $i = 1; ?>
                            <?php foreach ($kategori as $row) : ?>
                                <tr>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm leading-tight"><?php echo $i; ?></td>
                                    <td class="px-4 py-2 whitespace-normal text-sm leading-tight"><?php echo $row["kategori"]; ?></td>


                                    <td class="px-4 py-2 whitespace-nowrap text-sm leading-tight">
                                        <div class="flex gap-2">
                                            <a href="ubah.php?id=<?php echo $row["id"]; ?>" class=" ti ti-edit bg-gradient-to-b from-[#AC87C5] to-[#E0AED0] rounded-xl w-8 h-8 text-sm  text-white flex items-center justify-center hover:bg-none hover:border-2 hover:border-[#AC87C5] hover:text-[#AC87C5]"></a>
                                            <a href="hapus.php?id=<?php echo $row["id"]; ?>" onclick="return confirm('yakin?');" class="ti ti-trash bg-gradient-to-b from-[#AC87C5] to-[#E0AED0] rounded-xl w-8 h-8 text-sm text-white flex items-center justify-center hover:bg-none hover:border-2 hover:border-[#AC87C5] hover:text-[#AC87C5]"></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="../../script.js"></script>


</body>

</html>