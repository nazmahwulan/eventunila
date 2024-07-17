<?php
include 'function.php';
session_start();

if (isset($_SESSION["login"])) {
    header("location:index.php");
    exit;
}

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
// Cek apakah ada flashdata
$flash = isset($_SESSION['flash']) ? $_SESSION['flash'] : null;
unset($_SESSION['flash']); // Hapus flashdata setelah ditampilkan
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
    <div class="flex justify-start gap-0 md:gap-[50px] lg:gap-[70px]">
        <div class="flex flex-wrap list-none mx-14 mt-10 lg:my-10 lg:mx-44">
            <div class="flex hover:text-[#756AB6] font-semibold">
                <a href="index.php">
                    <i class="ti ti-home-filled pr-2"></i>Beranda</a>
            </div>
            <span class="mx-2">/</span>
            <li class="text-[#756AB6] font-semibold">Daftar</li>
        </div>
        <?php if ($flash) : ?>
            <div id="flash-message" class="flex justify-center items-center lg:my-4">
                <div class="flex items-center px-4 py-2 rounded-xl bg-white shadow-xl text-black font-semibold shadow-2xl">
                    <?php if ($flash['type'] == 'success') : ?>
                        <i class="ti ti-circle-check-filled text-2xl text-[#9BCF53] mr-2"></i>
                    <?php elseif ($flash['type'] == 'error') : ?>
                        <i class="ti ti-circle-x-filled text-2xl text-[#706868] mr-2"></i>
                    <?php endif; ?>
                    <div class="text-center">
                        <?php echo $flash['message']; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div class="lg:flex lg:mx-40 lg:mb-20">
        <div class="lg:flex-1 lg:bg-gradient-to-t from-[#756AB6] to-[#E0AED0] lg:shadow-2xl lg:rounded-none lg:rounded-l-xl lg:w-[500px] lg:h-[580px]">
            <img class="hidden lg:block lg:my-8" src="img/login.png" alt="">
        </div>

        <div class="flex-1 mx-auto md:mt-10 lg:mt-0 md:bg-white md:shadow-2xl md:w-7/12 md:h-[600px] md:rounded-xl lg:bg-white lg:rounded-none lg:rounded-r-xl lg:w-[500px] lg:h-[580px] lg:shadow-2xl">
            <div class="md:py-10 py-10 ">
                <h1 class="flex justify-center text-black font-bold text-3xl ">Pendaftaran Akun</h1>
                <p class="my-2 flex justify-center text-grey  text-sm">Yuk, daftarkan akunmu sekarang juga!</p>
            </div>
            <!-- form -->
            <form action="" method="post">
                <!-- Nama Lengkap -->
                <div class="lg:mt-[-20px]">
                    <label for="nama" class="block md:mx-12 lg:mx-16 mx-10 my-2 text-gray-500 font-bold text-sm">Nama Lengkap</label>
                    <div class="flex justify-center">
                        <input type="text" class="block px-4 md:w-96 w-10/12 h-10 bg-white rounded-xl border-2 border-[#756AB6] form-control" name="nama" id="nama" aria-describedby="emailHelp" required placeholder="Masukan Nama">
                    </div>
                    <!-- Email-->
                    <label for="email" class="block md:mx-12 lg:mx-16 mx-10 my-2 text-gray-500 font-bold text-sm">Alamat Email</label>
                    <div class="flex justify-center">
                        <input type="email" class="block px-4 md:w-96 w-10/12 h-10 bg-white rounded-xl border-2 border-[#756AB6] form-control" name="email" id="email" aria-describedby="emailHelp" required placeholder="you@example.com">
                    </div>
                    <!-- password -->
                    <label for="password" class="block md:mx-12 lg:mx-16 mx-10 my-2 text-gray-500 font-bold text-sm">Kata Sandi</label>
                    <div class="flex justify-center">
                        <input type="password" minlength="8" class="block px-4 md:w-[345px] w-[320px] h-10 bg-white  rounded-l-xl border-2 border-[#756AB6]" name="password" id="password" required placeholder="Masukan Kata Sandi">
                        <button id="togglePassword" type="button" class="text-white px-2 w-10 h-10 rounded-r-xl bg-[#756AB6]">
                            <i id="eyeIconOpen" class="ti ti-eye hidden"></i>
                            <i id="eyeIconClosed" class="ti ti-eye-off"></i>
                        </button>
                    </div>
                    <!-- konfirmasi password -->
                    <label for="password2" class="block md:mx-12 lg:mx-16 mx-10 my-2 text-gray-500 font-bold text-sm">Konfirmasi Kata Sandi</label>
                    <div class="flex justify-center">
                        <input type="password" class="block px-4 md:w-96 w-10/12 h-10 bg-white rounded-xl border-2 border-[#756AB6] form-control" name="password2" id="password2" required placeholder="Konfirmasi Kata Sandi">
                    </div>
                    <!-- button -->
                    <div class="text-center mx-auto mt-8 rounded-xl md:w-96 w-10/12 h-10 bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] hover:bg-none hover:border-2 hover:border-[#AC87C5] group">
                        <button type="submit" name="register" class=" text-white text-sm font-bold pt-[8px] group-hover:text-[#AC87C5]">
                            Daftar
                        </button>
                    </div>
                    <div class="mt-4">
                        <div class="flex gap-1 justify-center">
                            <h2 class="text-sm font-semibold">Sudah punya akun? </h2>
                            <a href="login.php" class="text-sm text-[#AC87C5] hover:text-[#756AB6] font-semibold">Masuk sekarang</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
    <script src="script.js"></script>
    <script>
        const passwordInput = document.getElementById('password');

        passwordInput.addEventListener('input', function() {
            const password = passwordInput.value;

            if (password.length < 8) {
                passwordInput.setCustomValidity('Password harus memiliki setidaknya 8 karakter.');
            } else {
                passwordInput.setCustomValidity('');
            }
        });

        const emailInput = document.getElementById('email');

        emailInput.addEventListener('input', function() {
            if (emailInput.validity.typeMismatch || !emailInput.checkValidity()) {
                emailInput.classList.add('invalid');
            } else {
                emailInput.classList.remove('invalid');
            }
        });
    </script>
</body>

</html>