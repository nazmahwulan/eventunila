<?php
include '../../function.php';

session_start();
//ambil data di URL
$id = $_GET["id"];
//query data mahasiswa berdasarkan id
$event = query("SELECT events.*, kategori.kategori 
FROM events 
JOIN kategori ON events.kategori_id = kategori.id 
WHERE events.id = $id")[0];

$kategori = query("SELECT *FROM kategori");


//cek apakah tombol submit sudah ditekan apa belum
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
        <div class="bg-white shadow-xl w-1/5 h-auto rounded-xl">
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

            <div class="px-12 mt-[490px] mb-10">
                <hr class="border-[#AC87C5] border-1 mb-8">
                <i class="ti ti-user-circle ps-2  text-[#AC87C5] text-4xl"></i>
                <p class="text-[#AC87C5] text-base font-bold mt-2">Nazmah Wulan</p>
            </div>
        </div>

        <div class="">
            <h1 class="text-white font-bold text-4xl py-6 text-center">Detail Event</h1>
            <div class="flex justify-center">
                <hr class="border-white border-1 w-[1050px]">
            </div>
            <!-- <div class="rounded-xl  border-2 border-white">
                <img class="rounded-t-xl w-full h-[250px]" src="../../img/event.jpg">
                    <div class="flex flex-col">
                        <h1 class="text-white text-sm font-bold text-center mt-4 px-10"><?php echo $event["judul"]; ?></h1>
                        <hr class="border-white mt-4 w-[300px] mx-auto">
                        <div class="py-6">
                            <div class="mx-auto rounded-xl w-40 h-10 border-2 border-red-600 text-center text-red-600 text-sm font-bold pt-[8px]">Sedang Diajukan</div>
                        </div>
                    </div>
                </div> -->
            <div class="flex justify-center mt-6">
                <div class="bg-white rounded-xl shadow-xl w-[1000px] h-3/5 mx-6 pt-6">
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?php echo $event["id"]; ?> ">
                        <label for="judul" class="block px-10 py-2 text-[#AC87C5] font-bold text-sm">Nama Event</label>
                        <div class="flex justify-center">
                            <input type="text" class="px-4 w-11/12 h-10 bg-gray-100  rounded-xl border-2 border-[#756AB6] form-control" name="judul" id="judul" required value="<?php echo $event["judul"]; ?>" disabled>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex-1">
                                <label for="kategori" class="block pl-10 py-2 text-[#AC87C5] font-bold text-sm">Kategori</label>
                                <div class="pl-10 flex justify-start">
                                    <input type="text" class="px-4 w-full h-10 bg-gray-100  rounded-xl border-2 border-[#756AB6] form-control" name="kategori" id="kategori" required value="<?php echo $event["kategori"]; ?>" disabled>
                                </div>
                            </div>
                            <div class="flex-1">
                                <label for="lokasi" class="block pr-10 py-2 text-[#AC87C5] font-bold text-sm">Lokasi</label>
                                <div class="pr-10 flex justify-start">
                                    <input type="text" class="px-4 w-full h-10 bg-gray-100  rounded-xl border-2 border-[#756AB6] form-control" name="lokasi" id="lokasi" required value="<?php echo $event["lokasi"]; ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex-1">
                                <label for="tanggal" class="block pl-10 py-2 text-[#AC87C5] font-bold text-sm">Tanggal</label>
                                <div class="pl-10 flex justify-start">
                                    <input type="date" class="px-4 w-full h-10 bg-gray-100  rounded-xl border-2 border-[#756AB6] form-control" name="tanggal" id="tanggal" required value="<?php echo $event["tanggal"]; ?>" disabled>
                                </div>
                            </div>
                            <div class="flex-1">
                                <label for="waktu" class="block pr-10 py-2 text-[#AC87C5] font-bold text-sm">Waktu</label>
                                <div class="pr-10 flex justify-start">
                                    <input type="time" class="px-4 w-full h-10 bg-gray-100  rounded-xl border-2 border-[#756AB6] form-control" name="waktu" id="waktu" required value="<?php echo $event["waktu"]; ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <label for="link_pendaftaran" class="block px-10 py-2 text-[#AC87C5] font-bold text-sm">Link Pendaftaran</label>
                        <div class="flex justify-center">
                            <input type="text" class="px-4 w-11/12 h-10 bg-gray-100  rounded-xl border-2 border-[#756AB6] form-control" name="link_pendaftaran" id="link_pendaftaran" required value="<?php echo $event["link_pendaftaran"]; ?>" disabled>
                        </div>
                        <label for="penyelenggara" class="block px-10 py-2 text-[#AC87C5] font-bold text-sm">Nama Penyelenggara</label>
                        <div class="flex justify-center">
                            <input type="text" class="px-4 w-11/12 h-10 bg-gray-100  rounded-xl border-2 border-[#756AB6] form-control" name="penyelenggara" id="penyelenggara" required value="<?php echo $event["penyelenggara"]; ?>" disabled>
                        </div>
                        <label for="deskripsi" class="block px-10 py-2 text-[#AC87C5] font-bold text-sm">Deskripsi Event</label>
                        <div class="flex justify-center">
                            <input type="text" class="text-justify px-4 w-11/12 h-64 bg-gray-100  rounded-xl border-2 border-[#756AB6] form-control" name="deskripsi" id="deskripsi" required value="<?php echo $event["deskripsi"]; ?>" disabled></textarea>
                        </div>
                        <div class="relative">
                            <label for="status" class="block px-10 py-2 text-[#AC87C5] font-bold text-sm">Status</label>
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
                        <div class="text-center my-6 mx-10 rounded-xl w-24 h-8 bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] hover:bg-none hover:border-2 hover:border-[#AC87C5] group">
                            <button type="submit" name="submit" class=" text-white text-sm font-bold pt-[5px] group-hover:text-[#AC87C5]">
                                Simpan
                            </button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>

    <script src="../../script.js"></script>
</body>

</html>