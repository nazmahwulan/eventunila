<?php
include 'function.php';

// Periksa apakah parameter ID ada dan valid
$isValidEvent = isset($_GET['id']) && is_numeric($_GET['id']);

if ($isValidEvent) {
    $id = intval($_GET['id']);

    // Query untuk memeriksa apakah event ada di database
    $query = "SELECT * FROM events JOIN kategori ON events.kategori_id = kategori.id WHERE event_id = $id";
    $events = query($query);

    if (count($events) === 0) {
        $isValidEvent = false;
    } else {
        $event = $events[0];
    }
}

$tanggalMulai = $event["tanggal_mulai"];
$tanggalAkhir = $event["tanggal_berakhir"];
$waktuMulai = $event["waktu_mulai"];
$waktuAkhir = $event["waktu_berakhir"];

// Format tanggal
$formattedTanggalMulai = date('d M Y', strtotime($tanggalMulai));
$formattedTanggalAkhir = date('d M Y', strtotime($tanggalAkhir));

// Format waktu
$formattedWaktuMulai = date('H:i', strtotime($waktuMulai));
$formattedWaktuAkhir = date('H:i', strtotime($waktuAkhir));

// Cek jika tanggal mulai dan akhir sama
if ($tanggalMulai == $tanggalAkhir) {
    $tanggalTampil = $formattedTanggalMulai;
} else {
    $tanggalTampil = $formattedTanggalMulai . " - " . $formattedTanggalAkhir;
}

// Cek jika waktu mulai dan akhir sama
if ($waktuMulai == $waktuAkhir) {
    $waktuTampil = $formattedWaktuMulai;
} else {
    $waktuTampil = $formattedWaktuMulai . " - " . $formattedWaktuAkhir;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/2eb34c602e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
</head>

<body>
    <?php if ($isValidEvent) : ?>
        <?php include 'navbar.php'; ?>
        <div class="flex flex-wrap list-none mx-14 my-5 lg:mt-10 lg:mx-32">
            <div class="flex hover:text-[#756AB6] font-semibold">
                <a href="index.php">
                    <i class="ti ti-home-filled pr-2"></i>Beranda</a>
            </div>
            <span class="mx-2">/</span>
            <div class="flex hover:text-[#756AB6] font-semibold">
                <a href="halamanevent.php">Event</a>
            </div>
            <span class="mx-2">/</span>
            <li class="text-[#756AB6] font-semibold">Detail Event</li>
        </div>

        <div class="flex flex-col">
            <img class="bg-center bg-repeat bg-cover mx-auto rounded-2xl lg:w-10/12 md:w-[740px] md:h-[500px] w-[80vw] h-52" src="img/<?php echo $event["gambar"]; ?>" alt="">
            <h1 class="mx-10 lg:mx-28 my-10 lg:my-16 text-2xl md:text-3xl font-bold text-[#AC87C5]"><?php echo $event["judul"]; ?></h1>
            <div class="lg:flex mx-10 lg:mx-28 lg:gap-8">
                <div class="flex-1 h-auto w-[80vw] md:w-[740px] lg:w-11/12 mx-auto mb-10">
                    <div class="flex flex-col">
                        <div class="col-span-2 rounded-2xl border-2 border-[#AC87C5] ">
                            <h2 class="text-black text-base text-justify px-8 py-4"><?php echo htmlspecialchars_decode($event["deskripsi"]); ?>
                            </h2>
                        </div>
                        <div class="relative pl-4 flex items-center mt-10">
                            <p class="font-semibold text-base">Kategori</p>
                            <div class="h-full w-1 rounded-xl bg-[#AC87C5] absolute left-0"></div>
                        </div>
                        <div class="flex gap-2">
                            <div class="flex items-center justify-center bg-[#AC87C5] rounded-xl w-40 h-8 mt-2">
                                <div class="text-white">#
                                    <?php echo $event["kategori"]; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="h-auto w-[80vw] md:w-[350px]">
                        <div class="rounded-2xl border-2 border-[#AC87C5]">
                            <div class="px-6 py-4">
                                <h2 class="text-2xl font-bold text-gray-500 py-6">Detail Event</h2>
                                <hr class="border-gray-500 border-1 mx-auto w-full md:w-[300px]">
                                <p class="text-base font-bold text-gray-500 pt-4">Tanggal</p>
                                <div class="gap-4 flex items-center">
                                    <i class="ti ti-calendar text-2xl pl-2 pt-2 text-[#AC87C5]"></i>
                                    <p class="pt-2 text-base font-bold text-[#AC87C5]"><?php echo $tanggalTampil; ?></p>
                                </div>
                                <p class="text-base font-bold text-gray-500 pt-4">Waktu</p>
                                <div class="gap-4 flex items-center">
                                    <i class="ti ti-clock text-2xl pl-2 pt-2 text-[#AC87C5]"></i>
                                    <p class="pt-2 text-base font-bold text-[#AC87C5]"><?php echo $waktuTampil; ?> WIB </p>
                                </div>
                                <p class="text-base font-bold text-gray-500 pt-4">Tempat</p>
                                <div class="gap-4 flex items-center">
                                    <i class="ti ti-map-pin pl-2 pt-2 text-2xl text-[#AC87C5]"></i>
                                    <p class="pt-2 text-base font-bold text-[#AC87C5]"><?php echo $event["lokasi"]; ?></p>
                                </div>
                            </div>
                            <hr class="border-[#AC87C5]">
                            <div class="bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] rounded-b-xl">
                                <!-- <i class="flex items-center pl-10 ti ti-user-circle text-white text-4xl"></i> -->
                                <div class="flex flex-col items-center">
                                    <h3 class="text-sm font-bold text-white pt-2 px-10">Diselenggarakan oleh</h3>
                                    <p class="text-base font-bold text-white px-10 py-2"><?php echo $event["penyelenggara"]; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="h-auto w-[80vw] md:w-[350px] mt-5">
                        <div class="rounded-2xl border-2 border-[#AC87C5]">
                            <a target="_blank" href="<?php echo $event["link_pendaftaran"]; ?>">
                                <div class="flex justify-center">
                                    <button class="text-center text-white text-sm font-bold hover:text-[#AC87C5] bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] rounded-xl w-60 h-10 my-8 hover:bg-none hover:border-2 hover:border-[#AC87C5]">Daftar Event</button>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] mt-20 md:mt-40 py-16 px-10 lg:px-28">
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
            <?php include 'error.php'; ?>
        <?php endif; ?>
        <script src="script.js"></script>
</body>

</html>