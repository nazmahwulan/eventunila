<?php
include 'function.php';
include 'navbar.php';

$id = $_GET["id"];
//query data mahasiswa berdasarkan id
$event = query("SELECT * FROM events WHERE id=$id")[0];
$date = date_create($event['tanggal']);
$time = date_create($event['waktu']);
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

</head>

</head>

<body>
    <div class="flex flex-wrap list-none my-4 px-32 mt-20">
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
        <img class="mx-auto shadow-2xl rounded-2xl w-10/12 h-[500px]" src="img/<?php echo $event["gambar"]; ?>" alt="">
        <h1 class="px-28 py-16 text-3xl font-bold text-[#AC87C5]"><?php echo $event["judul"]; ?></h1>
        <div class="flex px-28 gap-8">
            <div class="flex-1 h-auto w-11/12 mx-auto">
                <div class="col-span-2 shadow-2xl rounded-2xl border-2 border-[#AC87C5] ">
                    <h1 class="text-black text-base text-justify px-8 py-4"><?php echo $event["deskripsi"]; ?></h1>
                </div>
            </div>
            <div class="h-auto">
                <div class="shadow-2xl rounded-2xl border-2 border-[#AC87C5]">
                    <div class="px-6 py-4">
                        <h1 class="text-2xl font-bold text-gray-500 py-6">Detail Event</h1>
                        <hr class="border-gray-500 border-1 w-[300px] ">
                        <p class="text-base font-bold text-gray-500 pt-4">Tanggal</p>
                        <div class="gap-4 flex items-center">
                            <i class="ti ti-calendar text-2xl pl-2 pt-2 text-[#AC87C5]"></i>
                            <p class="pt-2 text-base font-bold text-[#AC87C5]"><?php echo date_format($date, "d M Y"); ?></p>
                        </div>
                        <p class="text-base font-bold text-gray-500 pt-4">Waktu</p>
                        <div class="gap-4 flex items-center">
                            <i class="ti ti-clock text-2xl pl-2 pt-2 text-[#AC87C5]"></i>
                            <p class="pt-2 text-base font-bold text-[#AC87C5]"><?php echo date_format($time, "H:i"); ?> WIB </p>
                        </div>
                        <p class="text-base font-bold text-gray-500 pt-4">Tempat</p>
                        <div class="gap-4 flex items-center">
                            <i class="ti ti-map-pin pl-2 pt-2 text-2xl text-[#AC87C5]"></i>
                            <p class="pt-2 text-base font-bold text-[#AC87C5]"><?php echo $event["lokasi"]; ?></p>
                        </div>
                        <div class="mx-auto bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] rounded-full w-64 h-10 my-8 hover:bg-none hover:border-2 hover:border-[#AC87C5] group">
                            <div class="text-center text-white text-sm font-bold pt-[8px] group-hover:text-[#AC87C5]">
                                <a href="<?php echo $event["link_pendaftaran"]; ?>">Daftar Event</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="flex items-center px-28 bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] mt-[100px] h-[200px]">
        <div class="flex-1 ">
            <div class="text-white font-bold text-4xl">EventUnila</div>
            <div class="text-gray-500 font-bold text-sm mt-4">Kumpulan Pengalaman, <br> Ayo bergabung bersama di EventUnila!</div>
            <div class="flex gap-4 text-white font-bold text-sm mt-4">
                <a href="about.php">Tentang Kami </a>
                <a href="kontak.php">Kontak</a>
                <a href="kebijakan.php">Kebijakan Pribadi</a>
            </div>
        </div>
        <div class="flex-1 ml-[400px]">
            <div class=" flex text-white font-bold text-sm">Jl. Prof. Sumantri Brojonegoro No.1 Gedong Meneng, <br>
                Bandar Lampung.</div>
            <div class="flex text-white text-2xl gap-10 mt-4">
                <a href="https://web.facebook.com/OfficialUnila/?_rdc=1&_rdr"><i class="fab fa-facebook-f "></i></a>
                <a href="https://twitter.com/official_unila"><i class="fab fa-twitter "></i></a>
                <a href="https://www.instagram.com/official_unila"><i class="fab fa-instagram "></i></a>
                <a href="https://www.tiktok.com/@official_unila"><i class="fab fa-tiktok "></i></a>
                <a href="https://www.youtube.com/c/OfficialUnila"><i class="fab fa-youtube "></i></a>
            </div>
            <div class="text-white font-bold text-sm mt-4">
                <p>copyright EventUnila © 2024 all rights reserved</p>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>