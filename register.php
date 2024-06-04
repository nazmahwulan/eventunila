<?php

include 'function.php';

if (isset($_POST["register"])) {
    if (registrasi($_POST) > 0) {
        echo "<script>
        alert('user baru berhasil ditambahkan!');
        </script>";
        header("location:login.php");
    } else {
        echo mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
</head>

<body>
    <div class="py-2">
        <div class="flex flex-wrap list-none mb-4 px-44 ">
            <div class="flex hover:text-[#756AB6] font-semibold">
                <a href="index.php">
                    <i class="ti ti-home-filled pr-2"></i>Beranda</a>
            </div>
            <span class="mx-2">/</span>
            <li class="text-[#756AB6] font-semibold">Register</li>
        </div>

        <div class="flex px-40">
            <div class="flex-1 mx-auto bg-gradient-to-t from-[#756AB6] to-[#E0AED0] shadow-2xl rounded-l-xl w-[500px] h-[500px]">
                <img src="img/login.png" alt="">
            </div>
            <div class="flex-1 mx-auto bg-white shadow-2xl rounded-r-xl w-[500px] h-[500px]">
                <div class="py-10">
                    <h1 class="flex justify-center text-black font-bold text-3xl ">Pendaftaran Akun</h1>
                    <p class="py-2 flex justify-center text-grey  text-sm">Yuk, daftarkan akunmu sekarang juga!</p>
                </div>
                <!-- form -->
                <form action="" method="post">
                    <!-- Nama Lengkap -->
                    <div class="mt-[-50px]">
                        <label for="nama" class="block px-16 py-2 text-gray-500 font-bold text-sm">Nama Lengkap</label>
                        <div class="flex justify-center">
                            <input type="text" class="block px-4 w-96 h-10 bg-white shadow-2xl rounded-xl border-2 border-[#756AB6] form-control" name="nama" id="nama" aria-describedby="emailHelp" required placeholder="Masukan Nama">
                        </div>
                        <!-- Email-->
                        <label for="email" class="block px-16 py-2 text-gray-500 font-bold text-sm">Alamat Email</label>
                        <div class="flex justify-center">
                            <input type="text" class="block px-4 w-96 h-10 bg-white shadow-2xl rounded-xl border-2 border-[#756AB6] form-control" name="email" id="email" aria-describedby="emailHelp" required placeholder="Masukan Email">
                        </div>
                        <!-- password -->
                        <label for="password" class="block px-16 py-2 text-gray-500 font-bold text-sm">Kata Sandi</label>
                        <div class="flex justify-center">
                            <input type="password" class="block px-4 w-[350px] h-10 bg-white shadow-2xl rounded-l-xl border-2 border-[#756AB6]" name="password" id="password" required placeholder="Masukan Kata Sandi">
                            <button id="togglePassword" type="button" class="text-white px-2 w-10 h-10 rounded-r-xl bg-[#756AB6]">
                                <i id="eyeIconOpen" class="ti ti-eye hidden"></i>
                                <i id="eyeIconClosed" class="ti ti-eye-off"></i>
                            </button>
                        </div>
                        <!-- konfirmasi password -->
                        <label for="password2" class="block px-16 py-2 text-gray-500 font-bold text-sm">Konfirmasi Kata Sandi</label>
                        <div class="flex justify-center">
                            <input type="password" class="block px-4 w-96 h-10 bg-white shadow-2xl rounded-xl border-2 border-[#756AB6] form-control" name="password2" id="password2" required placeholder="Konfirmasi Kata Sandi">
                        </div>
                        <!-- button -->
                        <div class="text-center mx-auto mt-4 rounded-xl w-96 h-10 bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] hover:bg-none hover:border-2 hover:border-[#AC87C5] group">
                            <button type="submit" name="register" class=" text-white text-sm font-bold pt-[8px] group-hover:text-[#AC87C5]">
                                Daftar
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <script src="script.js"></script>
</body>

</html>