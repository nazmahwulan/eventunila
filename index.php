<?php
include 'function.php';
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

$event = query("SELECT *FROM events WHERE events.status ='disetujui' ORDER BY id");

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

<body>
    <div class="bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] h-[750px] md:h-[850px] lg:h-[700px]">
        <div class="flex flex-col lg:flex-row items-center mx-4 md:mx-20 md:pt-10">
            <div class="flex-1">
                <img class="w-[350px] md:w-[450px] lg:w-[550px] mt-10 md:mt-0" src="img/join.png" alt="Join Image">
            </div>
            <div class="flex-1 mt-10 lg:mt-0">
                <h1 class="text-white font-bold text-xl md:text-2xl lg:text-4xl text-center lg:text-left">
                    Temukan event seru <br/>
                    untuk meningkatkan keterampilan <br />
                    dan pengetahuan kamu!<br />
                    <span class="text-gray-500 text-sm">Pilih dan ikuti beragam event seru dan menarik di Universitas Lampung</span>
                </h1>
            </div>
        </div>
    </div>


    <div class="bg-gradient-to-t from-[#756AB6] to-[#E0AED0] shadow-2xl rounded-xl mx-auto w-11/12 lg:w-10/12 xl:w-11/12 h-auto mb-10 mt-[-100px] lg:mt-[-100px] p-8 md:mt-[-150px]">
        <div class="flex flex-col lg:flex-row justify-center items-center">
            <h2 class="text-white text-center my-5 lg:text-left lg:px-12 font-bold text-2xl lg:text-3xl mb-4 lg:mb-0 md:mt-[-20px] ">Manfaat mengikuti <br> Event di Unila?</h2>
            <div class="flex flex-wrap justify-around w-full lg:w-3/4">
                <div class="text-center mb-4">
                    <div class="mx-auto px-3.5 py-2.5 text-4xl bg-white rounded-full w-16 h-16 text-[#AC87C5]">
                        <i class="ti ti-bulb"></i>
                    </div>
                    <p class="mt-4 text-center font-bold text-white text-sm ">Meningkatkan soft <br> skill dan hard skill </p>
                </div>
                <div class="text-center mb-4">
                    <div class="mx-auto px-3.5 py-2.5 text-4xl bg-white rounded-full w-16 h-16 text-[#AC87C5]">
                        <i class="ti ti-bulb"></i>
                    </div>
                    <p class="mt-4 text-center font-bold text-white text-sm">Meningkatkan keterampilan <br> dan pengetahuan </p>
                </div>
                <div class="text-center mb-4">
                    <div class="mx-auto px-3.5 py-2.5 text-4xl bg-white rounded-full w-16 h-16 text-[#AC87C5]">
                        <i class="ti ti-bulb"></i>
                    </div>
                    <p class="mt-4 text-center font-bold text-white text-sm">Menambah relasi <br> dan pengalaman </p>
                </div>
            </div>
        </div>
    </div>

    <div class="px-28">
        <h3 class="text-[#756AB6] font-bold text-2xl md:text-3xl text-center lg:text-left">Event Mendatang</h3>
    </div>

    <div class="grid gap-8 my-12 mx-10 lg:mx-28 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
        <?php foreach ($event as $row) : ?>
            <?php
            $date = date_create($row['tanggal']);
            $time = date_create($row['waktu']);
            ?>
            <div class="rounded-xl border-2 border-[#AC87C5]">
                <a href="detailevent.php?id=<?php echo $row["id"]; ?>">
                    <img class="rounded-t-xl w-full h-52 object-cover" src="img/<?php echo $row["gambar"]; ?>" alt="Event Image">
                    <div class="mx-8 my-6">
                        <h4 class="truncate text-xl font-bold mb-2"><?php echo $row["judul"]; ?></h4>
                        <div class="flex justify-between mb-2 text-[#AC87C5] font-bold">
                            <div class="flex items-center gap-2">
                                <i class="ti ti-calendar text-base"></i>
                                <p class="text-sm text-start"><?php echo date_format($date, "d M Y"); ?></p>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="ti ti-clock text-base"></i>
                                <p class="text-sm text-start"><?php echo date_format($time, "H:i"); ?> WIB</p>
                            </div>
                        </div>
                        <p class="truncate text-justify text-sm"><?php echo $row["deskripsi"]; ?></p>
                    </div>
                    <hr class="border-[#AC87C5]">
                    <div class="text-base font-bold text-center px-10 py-2"><?php echo $row["penyelenggara"]; ?></div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>


    <a href="halamanevent.php">
        <div class="text-center mx-auto mt-4 rounded-xl w-44 h-10 bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] hover:bg-none hover:border-2 hover:border-[#AC87C5] group">
            <button type="submit" name="event" class=" text-white text-sm font-bold pt-[8px] group-hover:text-[#AC87C5]">
                Lihat Event Lainnnya
            </button>
        </div>
    </a>

    <div class="bg-gradient-to-r from-[#AC87C5] to-[#FFE5E5] flex flex-col justify-center md:flex-row items-center px-20 my-24 h-72">
        <div class="mx-auto">
            <h5 class="font-bold text-white md:text-3xl lg:text-5xl text-2xl text-center">
                Daftarkan Event <br />
                mu Sekarang!<br />
            </h5>
            <div class="mx-auto mt-4 rounded-xl w-44 h-10 border-2 border-white text-center hover:bg-[#E0AED0]">
                <div class="mt-1">
                    <a class="text-white text-sm font-bold" href="daftarevent.php">Buat Event</a>
                </div>
            </div>
        </div>
        <div class="hidden md:block mx-auto md:mx-auto mr-[100px] shadow-2xl bg-[#756AB6] rounded-xl w-[350px] h-[350px]">
            <img class="w-[550px] ml-[30px] mb-[300px]" src="img/joinn.png">
        </div>
    </div>


    <div class="bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] mt-20 md:mt-40 py-16 px-10 lg:px-28">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
            <div class="mb-6 md:mb-0">
                <p class="text-white font-bold text-2xl md:text-4xl">EventUnila</p>
                <p class="text-gray-500 font-bold text-sm mt-4">Kumpulan Pengalaman, <br> Ayo bergabung bersama di EventUnila!</p>
                <div class="flex flex-col md:flex-row gap-4 text-white font-bold text-sm mt-4">
                    <a href="about.php">Tentang Kami</a>
                    <a href="kontak.php">Kontak</a>
                    <a href="kebijakan.php">Kebijakan Pribadi</a>
                </div>
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
    <script src="script.js"></script>
</body>

</html>