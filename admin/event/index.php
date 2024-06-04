<?php
include '../../function.php';
session_start();

//pagination
$jumlahDataPerHalaman = 2;
$events = query("SELECT * FROM events");
$jumlahData = count($events);
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

// Query gabungan untuk mengambil data dari tabel events dan users
$event = query("SELECT users.nama AS nama, events.*,kategori.kategori FROM events JOIN users ON events.users_id = users.id JOIN 
kategori ON events.kategori_id = kategori.id LIMIT $awalData, $jumlahDataPerHalaman");

//tombol cari ditekan
if (isset($_POST["cari"])) {
    $event = cari($_POST["keyword"]);
}

// Update status berdasarkan tanggal pelaksanaan
foreach ($event as & $row) {
    $tanggal = strtotime($row['tanggal']);
    $sekarang = time();

    // Jika tanggal pelaksanaan sudah lewat, ubah status menjadi "Selesai"
    if ($tanggal < $sekarang) {
        $row['tanggal'] = 'selesai';
    } else {
        // Jika tanggal pelaksanaan masih mendatang, biarkan tanggal tetap "Mendatang"
        $row['tanggal'] = 'mendatang';
    }
}
unset($row); // Untuk menghindari referensi yang tidak diinginkan di loop berikutnya

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
            <h1 class="text-white font-bold text-4xl py-6">Event</h1>
            <div class="flex justify-center">
                <hr class="border-white border-1 w-[1050px]">
            </div>
            <h2 class="text-white font-bold text-4xl flex justify-center py-6">Daftar Event</h2>
            <div class="bg-white w-[1000px] shadow-xl rounded-xl p-6 mx-6">
                <div class="flex justify-end items-center gap-4 mb-5">
                    <?php if ($flash) : ?>
                        <div id="flash-message" class="flex-1">
                            <div class="px-4 py-2 rounded-xl text-white <?php echo ($flash['type'] == 'success') ? 'bg-green-500' : ($flash['type'] == 'error' ? 'bg-red-500' : ($flash['type'] == 'warning' ? 'bg-yellow-500' : 'bg-blue-500')); ?>">
                                <?php echo $flash['message']; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <form action="" method="post" class="flex items-center">
                        <input type="text" class="block px-4 w-40 h-10 bg-white rounded-l-xl border-2 border-[#AC87C5]" name="keyword" placeholder="Cari Event" autocomplete="off" value="<?php echo isset($_POST['keyword']) ? htmlspecialchars($_POST['keyword']) : ''; ?>" required>
                        <button type="submit" name="cari" class="ti ti-search text-white px-2 w-10 h-10 rounded-r-xl bg-[#AC87C5]">
                            </button>
                    </form>
                    <div class="bg-gradient-to-b from-[#AC87C5] to-[#E0AED0] rounded-xl w-44 h-10 hover:bg-none hover:border-2 hover:border-[#AC87C5] group">
                        <div class="text-center pt-[6px]">
                            <a class="text-white gap-2 text-base flex justify-center font-bold group-hover:text-[#AC87C5]" href="../../daftarevent.php">
                                <i class="ti ti-plus text-xl font-bold "></i><span>Tambah Event</span>
                            </a>
                        </div>
                    </div>
                </div>

                <table class="min-w-full divide-y divide-gray-200 w-full">
                    <thead class="">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-sm font-bold uppercase tracking-wider">#</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-sm font-bold uppercase tracking-wider">User</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-sm font-bold uppercase tracking-wider">Nama Event</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-sm font-bold uppercase tracking-wider">Kategori</th>
                            <th scope="col" class="px-32 py-3 text-left text-xs font-sm font-bold uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-10 py-3 text-left text-xs font-sm font-bold uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if (empty($event)) : ?>
                            <tr>
                                <td colspan="6" class="px-4 py-2 text-center text-sm leading-tight">
                                    Data Tidak Ditemukan
                                </td>
                            </tr>
                        <?php else : ?>
                            <?php $i  = $awalData +1; ?>
                            <?php foreach ($event as $row) : ?>
                                <?php
                                $status = strtolower($row['status']); // Mengonversi status menjadi huruf kecil
                                $eventStatus = strtolower($row['tanggal']); // Mendapatkan status tanggal (mendatang atau selesai)

                                // Menentukan kelas warna berdasarkan status pengajuan
                                $statusClass = '';
                                if ($status === 'disetujui') {
                                    $statusClass = 'bg-emerald-600'; // Hijau untuk disetujui
                                } elseif ($status === 'ditolak') {
                                    $statusClass = 'bg-rose-600'; // Merah untuk ditolak
                                } elseif ($status === 'sedang diajukan') {
                                    $statusClass = 'bg-yellow-500'; // Kuning untuk sedang diajukan
                                } else {
                                    $statusClass = 'bg-gray-500'; // Warna default jika status tidak dikenali
                                }

                                // Menentukan kelas warna untuk status event mendatang atau selesai
                                $eventStatusClass = '';
                                if ($eventStatus === 'mendatang') {
                                    $eventStatusClass = 'bg-[#E0AED0]'; // Biru muda untuk event mendatang
                                } elseif ($eventStatus === 'selesai') {
                                    $eventStatusClass = 'bg-[#756AB6] '; // Merah tua untuk event selesai
                                }

                                ?>

                                <tr>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm leading-tight"><?php echo $i; ?></td>
                                    <td class="px-4 py-2 whitespace-normal text-sm leading-tight"><?php echo $row["nama"]; ?></td>
                                    <td class="px-4 py-2 whitespace-normal text-sm leading-tight"><?php echo $row["judul"]; ?></td>
                                    <td class="px-4 py-2 whitespace-normal text-sm leading-tight"><?php echo $row["kategori"]; ?></td>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm leading-tight">
                                        <div class="flex gap-2">
                                            <span class="<?php echo $statusClass; ?> rounded-xl w-32 h-8 flex items-center justify-center text-white font-bold"><?php echo ($row['status']); ?></span>
                                            <span class="<?php echo $eventStatusClass; ?> rounded-xl w-32 h-8 text-sm font-bold text-white flex items-center justify-center"><?php echo ucfirst($row['tanggal']); ?></span>
                                        </div>
                                    </td>
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
                <div class="flex justify-end mt-4">
                    <?php if ($halamanAktif > 1) : ?>
                        <a class="border border-[#AC87C5] rounded-xl p-2 mx-1 text-xs font-bold" href="?halaman=<?= $halamanAktif - 1; ?>">&laquo;</a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                        <?php if ($i == $halamanAktif) : ?>
                            <a class="border-2 border-[#AC87C5] rounded-xl p-2 mx-1 text-xs font-bold text-white bg-[#AC87C5]" href="?halaman=<?= $i; ?>"><?= $i; ?> </a>
                        <?php else : ?>
                            <a class=" border-2 border-[#AC87C5] rounded-xl p-2 mx-1 text-xs font-bold" href="?halaman=<?= $i; ?>"><?= $i; ?> </a>
                        <?php endif; ?>
                    <?php endfor; ?>

                    <?php if ($halamanAktif < $jumlahHalaman) : ?>
                        <a class="border-2 border-[#AC87C5] rounded-xl p-2 mx-1 text-xs font-bold" href="?halaman=<?= $halamanAktif + 1; ?>">&raquo;</a>
                    <?php endif; ?>
                </div>
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