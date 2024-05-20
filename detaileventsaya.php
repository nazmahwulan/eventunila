<?php

include "navbar.php";
?>;
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />

</head>

<body>
    <div class="rounded-xl  border-2 border-[#AC87C5] mx-auto w-[900px] h-[700px]">
        <img class="rounded-t-xl w-[900px] h-[400px] " src="img/event.jpg">
        <div class="grid grid-cols-3 px-10 py-10 ">
            <div class="flex flex-col">
                <h1 class="text-[#AC87C5] font-bold text-sm mb-2">Judul & Kategori</h1>
                <p>Strategic Implementation
                    of Business Intelligence for
                    Corporate Growth</p>
                <p class="mt-4">Seminar</p>
            </div>

            <div class="ml-16">
                <div class="flex flex-col">
                    <h2 class="text-[#AC87C5] font-bold text-sm mb-2">Tanggal & Waktu</h2>
                    <p>26 Apr 2024</p>
                    <p class="mt-10">14:00 - 17:30 WIB</p>
                </div>
            </div>
            <div class="flex flex-col">
                <h3 class="text-[#AC87C5] font-bold text-sm mb-2">Lokasi</h3>
                <p>Jakarta Design Center,
                    Jl. Gatot Subroto No.53, Tanah Abang,
                    Jakarta Pusat</p>
            </div>
        </div>
    </div>

    <!--footer-->
    <div class="flex items-center px-28 bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] mt-[50px] h-[200px]">
        <div class="flex-1 ">
            <p class="text-white font-bold text-4xl">EventUnila</p>
            <p class="text-gray-500 font-bold text-sm mt-4">Kumpulan Pengalaman, <br> Ayo bergabung bersama di EventUnila!</p>
            <div class="flex gap-4 text-white font-bold text-sm mt-4">
                <a href="about.php">Tentang Kami </a>
                <a href="kontak.php">Kontak</a>
                <a href="kebijakan.php">Kebijakan Pribadi</a>
            </div>
        </div>
        <div class="flex-1 ml-[400px]">
            <p class=" flex text-white font-bold text-sm">Jl. Prof. Sumantri Brojonegoro No.1 Gedong Meneng, <br>
                Bandar Lampung.</p>
            <div class="flex text-white text-2xl gap-10 mt-4">
                <a href="https://web.facebook.com/OfficialUnila/?_rdc=1&_rdr"><i class="ti ti-brand-facebook"></i></a>
                <a href="https://twitter.com/official_unila"><i class="ti ti-brand-twitter"></i></a>
                <a href="https://www.instagram.com/official_unila"><i class="ti ti-brand-instagram "></i></a>
                <a href="https://www.tiktok.com/@official_unila"><i class="ti ti-brand-tiktok"></i></a>
                <a href="https://www.youtube.com/c/OfficialUnila"><i class="ti ti-brand-youtube"></i></a>
            </div>
            <div class="text-white font-bold text-sm mt-4">
                <p>copyright EventUnila © 2024 all rights reserved</p>
            </div>
        </div>
    </div>
</body>

</html>