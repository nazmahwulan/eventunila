<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
    <div class="flex py-12 px-40">
        <div class="flex-1 mx-auto bg-gradient-to-t from-[#756AB6] to-[#E0AED0] shadow-2xl rounded-l-2xl w-[500px] h-[500px]">
            <img src="img/login.png" alt="">
        </div>
        <div class="flex-1 mx-auto bg-white shadow-2xl rounded-r-2xl w-[500px] h-[500px]">
            <div class="py-12">
                <h1 class="flex justify-center text-black font-bold text-3xl ">Pendaftaran Akun</h1>
                <p class="py-2 flex justify-center text-grey  text-sm">Yuk, daftarkan akunmu sekarang juga!</p>
            </div>
            <div class="mt-[-30px]">
                <div class="px-16 py-2 text-gray-500 font-bold text-sm">Nama Lengkap</div>
                <div class="flex justify-center">
                    <input type="text" class="px-4 w-96 h-10 bg-white shadow-2xl rounded-lg border-2 border-[#756AB6] form-control" name="nama" id="nama" aria-describedby="emailHelp" require placeholder="Masukan Nama Kamu">
                </div>
                <div class="px-16 py-2 text-gray-500 font-bold text-sm">Alamat Email</div>
                <div class="flex justify-center">
                    <input type="text" class="px-4 w-96 h-10 bg-white shadow-2xl rounded-lg border-2 border-[#756AB6] form-control" name="email" id="email" aria-describedby="emailHelp" require placeholder="Masukan Email Kamu">
                </div>
                <div class="px-16 py-2 text-gray-500 font-bold text-sm">Kata Sandi</div>
                <div class="flex justify-center">
                    <input type="Kata Sandi" class="px-4 w-96 h-10 bg-white shadow-2xl rounded-lg border-2 border-[#756AB6] form-control" name="Kata Sandi" id="Kata Sandi" placeholder="Kata Sandi" require>
                </div>
                <div class="mt-4">
                    <div class="mx-auto rounded-lg w-96 h-10 bg-gradient-to-r from-[#AC87C5] to-[#E0AED0]">
                        <div class="text-center text-white text-sm font-bold pt-[8px]">
                            <a href="login.php">Daftar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>