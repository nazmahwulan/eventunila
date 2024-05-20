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
    <div class="flex justify-center gap-8 py-12 grid grid-cols-3 px-28">
        <div class="rounded-xl border-2 border-[#AC87C5] flex flex-col items-center justify-center">
            <a href="daftarevent.php" class="text-center">
                <i class="text-[#AC87C5] text-4xl font-bold ti ti-circle-plus"></i>
                <p class="text-[#AC87C5] font-bold">Buat Event <br> Baru</p>
            </a>
        </div>
        <div class="rounded-xl  border-2 border-[#AC87C5]">
            <img class="rounded-t-xl " src="img/event.jpg">
            <div class="flex flex-col">
                <h1 class="text-[#AC87C5] text-sm font-bold text-center mt-4 px-10">Seminar Internasional : “Building Sustainable Economy Through Smart City Development”</h1>
                <hr class="border-[#AC87C5] mt-4 w-[300px] mx-auto">
                <div class="text-[#AC87C5] text-sm font-bold mt-4 px-6">
                    <p>Tanggal & Waktu</p>
                    <p>26 Apr 2024</p>
                    <p>14:00 - 17:30 WIB</p>
                    <div class="mt-4">
                        <p>Lokasi</p>
                        <p>Jakarta Design Center,
                            Jl. Gatot Subroto No.53, Tanah Abang,
                            Jakarta Pusat</p>
                    </div>
                </div>
                <div class="py-6">
                    <div class="mx-auto rounded-xl w-40 h-10 border-2 border-red-600 text-center text-red-600 text-sm font-bold pt-[8px]">Sedang Diajukan</div>
                </div>
            </div>
        </div>



        <div class="rounded-xl  border-2 border-[#AC87C5]">
            <a href="detailevent.php">
                <img class="rounded-t-xl " src="img/event.jpg">
                <div class="px-8 py-6">
                    <h4 class="truncate text-xl font-bold mb-2">Seminar Internasional : “Building Sustainable Economy Through Smart City Development”</h4>
                    <div class="flex justify-between mb-2 text-[#AC87C5] font-bold">
                        <div class="flex gap-2">
                            <i class="ti ti-calendar text-sm"></i>
                            <p class="text-sm  text-start ">25 Mei 2024</p>
                        </div>
                        <div class="flex gap-2">
                            <i class="ti ti-clock text-sm"></i>
                            <p class="text-sm  text-start ">10:00 - 13:00</p>
                        </div>
                    </div>
                    <p class="truncate text-justify text-sm">Seminar nasional EEA 2023 merupakan salah satu rangkaian acara Electrical Engineering in Action 2023
                        yang berlangsung mulai 19 hingga 28 Oktober 2023. EEA 2023 merupakan sebuah wadah bagi para profesional,
                        praktisi, akademisi, mahasiswa, dan para pemangku kepentingan di bidang ketenagalistrikan dan teknik elektro
                        untuk berbagi pengetahuan, gagasan, dan inovasi terbaru dalam perkembangan sektor ini.</p>
                </div>
                <hr class="border-[#AC87C5] ">
                <div class="text-base font-bold text-center px-10 py-2 ">HIMATRO</div>
            </a>
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