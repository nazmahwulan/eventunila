<?php

include 'navbar.php';
// session_start();
// if (!isset($_SESSION["login"])) {
//     header("location:login.php");
//     exit;
// }
// if(!isset($_SESSION["login"]) && basename($_SERVER["SCRIPT_NAME"]) !== "login.php"){
//     header("location:login.php");
//     exit;
// }


?>

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

</head>

<body>
    <div class="bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] h-[750px]">
        <div class="flex items-center px-20">
            <div class="flex-1">
                <img class="w-[550px]" src="img/join.png">
            </div>
            <div class="flex-1 ">
                <h1 class=" text-white font-bold text-4xl">
                    Temukan event seru<br />
                    untuk meningkatkan keterampilan <br />
                    dan pengetahuan kamu!<br />
                    <span class="text-gray-500 text-sm">Pilih dan ikuti beragam event seru dan menarik di Universitas Lampung</span>
                </h1>
            </div>
        </div>
    </div>

    <div class="mx-auto bg-gradient-to-t from-[#756AB6] to-[#E0AED0] shadow-2xl rounded-xl w-11/12 h-48 mb-10 mt-[-90px]">
        <div class="flex">
            <h2 class="text-white font-bold text-3xl px-12 py-12">Manfaat mengikuti <br> Event di Unila?</h2>
            <div class="flex gap-28 py-8 ml-28">
                <div>
                    <div class="mx-auto px-3.5 py-2.5 text-4xl bg-white rounded-full w-16 h-16 text-[#AC87C5]">
                        <i class="ti ti-bulb "></i>
                    </div>
                    <p class="mt-4 text-center font-bold text-white">Meningkatkan soft <br> skill dan hard skill </p>
                </div>
                <div>
                    <div class="mx-auto px-3.5 py-2.5 bg-white rounded-full w-16 h-16">
                        <i class=""></i>
                    </div>
                    <p class="mt-4 text-center font-bold text-white">Meningkatkan keterampilan <br> dan pengetahuan </p>
                </div>
                <div>
                    <div class="mx-auto px-3.5 py-2.5 bg-white rounded-full w-16 h-16">
                        <i class=""></i>
                    </div>
                    <p class="mt-4 text-center font-bold text-white">Menambah relasi <br> dan pengalaman </p>
                </div>
            </div>
        </div>
    </div>

    <div class="px-28">
        <h3 class="text-[#756AB6] font-bold text-3xl">Event Mendatang</h3>
    </div>

    <div class="flex justify-center gap-8 py-12 grid grid-cols-3 px-28">
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

    <!-- <div class="mx-auto bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] rounded-xl w-44 h-10 hover:bg-none hover:border-2 hover:border-[#AC87C5] group ">
        <div class="text-center pt-[6px] ">
            <a class="text-white text-sm font-bold group-hover:text-[#AC87C5]" href="halamanevent.php">Lihat Event Lainnya</a>
        </div>
    </div> -->
    <div class="text-center mx-auto mt-4 rounded-xl w-44 h-10 bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] hover:bg-none hover:border-2 hover:border-[#AC87C5] group">
        <button type="submit" name="event" class=" text-white text-sm font-bold pt-[8px] group-hover:text-[#AC87C5]">
            Lihat Event Lainnnya
        </button>
    </div>

    <div class="bg-gradient-to-r from-[#AC87C5] to-[#FFE5E5] flex items-center px-20 mt-24 h-72">
        <div class="mx-auto">
            <h5 class="font-bold text-white text-5xl">
                Daftarkan Event <br />
                mu Sekarang!<br />
            </h5>
            <div class="mx-auto mt-4 rounded-xl w-44 h-10 border-2 border-white text-center hover:bg-[#E0AED0]">
                <div class="mt-1">
                    <a class="text-white text-sm font-bold" href="daftarevent.php">Buat Event</a>
                </div>
            </div>
        </div>
        <div class="mx-auto mr-[100px] shadow-2xl bg-[#756AB6] rounded-xl w-[350px] h-[350px]">
            <img class="w-[550px] ml-[30px] mb-[300px]" src="img/joinn.png">
        </div>
    </div>

    <div class="flex items-center px-28 bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] mt-[100px] h-[200px]">
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