<?php

require 'function.php';

if (isset($_POST["register"])) {
    if (registrasi($_POST) > 0) {
        echo "<script>
        alert('user baru berhasil ditambahkan!');
        </script>";
    } else{
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

</head>

<body>
    <div class="flex py-12 px-40">
        
        <div class="flex-1 mx-auto bg-white shadow-2xl rounded-r-xl w-[500px] h-[500px]">
            <div class="py-10">
                <h1 class="flex justify-center text-black font-bold text-3xl ">Pendaftaran Akun</h1>
                <p class="py-2 flex justify-center text-grey  text-sm">Yuk, daftarkan akunmu sekarang juga!</p>
            </div>
            <!-- form -->
            <form action="" method="post">
                <!-- Nama Lengkap -->
                <div class="mt-[-50px]">
                    <label for="username" class="block px-16 py-2 text-gray-500 font-bold text-sm">Username</label>
                    <div class="flex justify-center">
                        <input type="text" class="block px-4 w-96 h-10 bg-white shadow-2xl rounded-xl border-2 border-[#756AB6] form-control" name="username" id="username" aria-describedby="emailHelp" require placeholder="Masukan Nama Kamu">
                    </div>
                    <!-- password -->
                    <label for="password" class="block px-16 py-2 text-gray-500 font-bold text-sm">Kata Sandi</label>
                    <div class="flex justify-center">
                        <input type="password" class="block px-4 w-96 h-10 bg-white shadow-2xl rounded-xl border-2 border-[#756AB6] form-control" name="password" id="password" require placeholder="Masukan Kata Sandi">
                    </div>
                    <!-- konfirmasi password -->
                    <label for="password2" class="block px-16 py-2 text-gray-500 font-bold text-sm">Konfirmasi Kata Sandi</label>
                    <div class="flex justify-center">
                        <input type="password" class="block px-4 w-96 h-10 bg-white shadow-2xl rounded-xl border-2 border-[#756AB6] form-control" name="password2" id="password2" require placeholder="Konfirmasi Kata Sandi">
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
</body>

</html>