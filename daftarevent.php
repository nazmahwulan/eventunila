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
    <div class="bg-gradient-to-r from-[#AC87C5] to-[#E0AED0]">
        <div class="items-center flex px-28 py-6 justify-between">
            <a class="text-white text-4xl font-bold" href="index.php">EventUnila</a>
        </div>
    </div>

    <div class="flex flex-col">
        <div class="mx-auto shadow-2xl rounded-t-2xl w-[900px] h-[400px] border-2 border-[#AC87C5] mt-20"></div>
        <div class="bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] mx-auto rounded-b-2xl w-[900px] h-[850px]">
            <div class="px-10 py-2 text-gray-500 font-bold text-sm">Nama Event</div>
            <div class="flex justify-center">
                <input type="text" class="px-4 w-11/12 h-10 bg-white shadow-2xl rounded-lg border-2 border-[#756AB6] form-control" name="email" id="email" aria-describedby="emailHelp" require placeholder="Masukan Email Kamu">
            </div>
            <div class="flex gap-4">
                <div class="flex-1">
                    <div class="pl-10 py-2 text-gray-500 font-bold text-sm">Kategori</div>
                    <div class="pl-10 flex justify-start">
                        <input type="text" class="px-4 w-full h-10 bg-white shadow-2xl rounded-lg border-2 border-[#756AB6] form-control" name="kategori" id="kategori" aria-describedby="emailHelp" require placeholder="Pilih Kategori">
                    </div>
                </div>
                <div class="flex-1">
                    <div class="pr-10 py-2 text-gray-500 font-bold text-sm">Lokasi</div>
                    <div class="pr-10 flex justify-start">
                        <input type="text" class="px-4 w-full h-10 bg-white shadow-2xl rounded-lg border-2 border-[#756AB6] form-control" name="lokasi" id="lokasi" aria-describedby="emailHelp" require placeholder="Pilih Lokasi">
                    </div>
                </div>
            </div>
            <div class="flex gap-4">
                <div class="flex-1">
                    <div class="pl-10 py-2 text-gray-500 font-bold text-sm">Tanggal</div>
                    <div class="pl-10 flex justify-start">
                        <input type="text" class="px-4 w-full h-10 bg-white shadow-2xl rounded-lg border-2 border-[#756AB6] form-control" name="tanggal" id="tanggal" aria-describedby="emailHelp" require placeholder="Pilih Tanggal">
                    </div>
                </div>
                <div class="flex-1">
                    <div class="pr-10 py-2 text-gray-500 font-bold text-sm">Waktu</div>
                    <div class="pr-10 flex justify-start">
                        <input type="text" class="px-4 w-full h-10 bg-white shadow-2xl rounded-lg border-2 border-[#756AB6] form-control" name="waktu" id="waktu" aria-describedby="emailHelp" require placeholder="Pilih Tanggal">
                    </div>
                </div>
            </div>
            <div class="px-10 py-2 text-gray-500 font-bold text-sm">Link Pendaftaran</div>
            <div class="flex justify-center">
                <input type="text" class="px-4 w-11/12 h-10 bg-white shadow-2xl rounded-lg border-2 border-[#756AB6] form-control" name="link" id="link" aria-describedby="emailHelp" require placeholder="Link Pendaftaran">
            </div>
            <div class="px-10 py-2 text-gray-500 font-bold text-sm text">Deskripsi Event</div>
            <div class="flex justify-center">
                <input type="text" class="text-center px-4 w-11/12 h-96 bg-white shadow-2xl rounded-lg border-2 border-[#756AB6] form-control" name="deskripsi" id="deskripsi" aria-describedby="emailHelp" require placeholder="Tuliskan Deskripsi">
            </div>
            <div class="mx-auto rounded-full w-80 h-10 border-2 border-white mt-10">
                <div class="text-center text-white text-sm font-bold pt-[8px]">
                    <a href="">Ajukan Event</a>
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
</body>

</html>