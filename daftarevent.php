<?php
include 'navbar.php';
include 'function.php';


if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit();
}

//cek apakah tombol submit sudah ditekan apa belum
if(isset($_POST["submit"])){
    if(pengajuan ($_POST) > 0){
        echo "<script>
        alert('event berhasil diajukan!');
        document.location.href = 'daftarevent.php'
        </script>";
    }else {
        echo"<script>
        alert('event gagal  diajukan!');
        document.location.href = 'daftarevent.php'
        </script>";
    }
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
</head>

</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="flex flex-col">
            <div class="mx-auto shadow-2xl rounded-t-xl w-[900px] h-[400px] border-2 border-[#AC87C5] mt-20">
                <label for="gambar">Unggah Gambar
                    <input type="file" name="gambar" id="gambar">
                </label>
            </div>
            <div class="bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] mx-auto rounded-b-xl w-[900px] h-[920px]">
                <label for="judul" class="block px-10 py-2 text-white font-bold text-sm">Nama Event</label>
                <div class="flex justify-center">
                    <input type="text" class="px-4 w-11/12 h-10 bg-white shadow-2xl rounded-xl border-2 border-[#756AB6] form-control" name="judul" id="judul" aria-describedby="eventHelp" require placeholder="Nama Event">
                </div>
                <div class="flex gap-4">
                    <div class="flex-1">
                        <div class="relative">
                            <label for="kategori_id" class="block pl-10 py-2 text-white font-bold text-sm">Kategori</label>
                            <div class="pl-10 flex justify-start items-center">
                                <input type="text" class="px-4 w-full h-10 bg-white shadow-2xl rounded-xl border-2 border-[#756AB6] form-control" name="kategori_id" id="kategori_id" aria-describedby="kategoriHelp" require placeholder="Pilih Kategori">
                                <div class="absolute inset-y-100 right-0 flex items-center pr-3 pointer-events-none">
                                    <button id="dropdownButton">
                                        <i class="ti ti ti-chevron-down ps-2 text-[#AC87C5] text-xl"></i>
                                    </button>
                                    <div id="dropdownMenu" class="hidden absolute top-[-15px] right-[-10px] w-[200px] bg-white p-[20px] m-[10px] rounded-xl">
                                        <div class="flex flex-col">
                                            <div>eefef</div>
                                            <div>eefef</div>
                                            <div>eefef</div>
                                            <div>eefef</div>
                                            <div>eefef</div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1">
                        <label for="lokasi" class="block pr-10 py-2 text-white font-bold text-sm">Lokasi</label>
                        <div class="pr-10 flex justify-start">
                            <input type="text" class="px-4 w-full h-10 bg-white shadow-2xl rounded-xl border-2 border-[#756AB6] form-control" name="lokasi" id="lokasi" aria-describedby="lokasiHelp" require placeholder="Pilih Lokasi">
                        </div>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="flex-1">
                        <label for="tanggal" class="block pl-10 py-2 text-white font-bold text-sm">Tanggal</label>
                        <div class="pl-10 flex justify-start">
                            <input type="date" class="px-4 w-full h-10 bg-white shadow-2xl rounded-xl border-2 border-[#756AB6] form-control" name="tanggal" id="tanggal" aria-describedby="tanggalHelp" require placeholder="Pilih Tanggal">
                        </div>
                    </div>
                    <div class="flex-1">
                        <label for="waktu" class="block pr-10 py-2 text-white font-bold text-sm">Waktu</label>
                        <div class="pr-10 flex justify-start">
                            <input type="time" class="px-4 w-full h-10 bg-white shadow-2xl rounded-xl border-2 border-[#756AB6] form-control" name="waktu" id="waktu" aria-describedby="waktuHelp" require placeholder="Pilih Tanggal">
                        </div>
                    </div>
                </div>
                <label for="link_pendaftaran" class="block px-10 py-2 text-white font-bold text-sm">Link Pendaftaran</label>
                <div class="flex justify-center">
                    <input type="text" class="px-4 w-11/12 h-10 bg-white shadow-2xl rounded-xl border-2 border-[#756AB6] form-control" name="link_pendaftaran" id="link_pendaftaran" aria-describedby="pendafataranHelp" require placeholder="Link Pendaftaran">
                </div>
                <label for="penyelenggara" class="block px-10 py-2 text-white font-bold text-sm">Nama Penyelenggara</label>
                <div class="flex justify-center">
                    <input type="text" class="px-4 w-11/12 h-10 bg-white shadow-2xl rounded-xl border-2 border-[#756AB6] form-control" name="penyelenggara" id="penyelenggara" aria-describedby="penyelenggaraHelp" require placeholder="Nama Penyelenggara">
                </div>
                <label for="deskripsi" class="block px-10 py-2 text-white font-bold text-sm text">Deskripsi Event</label>
                <div class="flex justify-center">
                    <textarea type="text" class="text-justify px-4 w-11/12 h-96 bg-white shadow-2xl rounded-xl border-2 border-[#756AB6] form-control" name="deskripsi" id="deskripsi" aria-describedby="deskripsiHelp"></textarea>
                </div>
                <div class="mx-auto rounded-xl w-80 h-10 border-2 border-white mt-10 hover:bg-[#E0AED0]  text-center">
                    <button type="submit" name="submit" class=" text-white text-sm font-bold pt-[8px]">
                        Daftar
                    </button>
                </div>
            </div>
        </div>
    </form>

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
</body>

</html>