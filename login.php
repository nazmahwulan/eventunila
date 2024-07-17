<?php
include 'function.php';
session_start();

// // Bersihkan sesi yang telah kadaluarsa
// cleanExpiredSessions();

//cek cookie
if (isset($_COOKIE['login'])){
    if($_COOKIE['login'] == 'true') {
        $_SESSION['login'] = true;
    }
}

if (isset($_SESSION["login"])) {
    header("location:index.php");
    exit;
}

// Jika tombol login ditekan
if (isset($_POST["login"])) {
    // Ambil email dan password dari form
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Lakukan query untuk mencari pengguna berdasarkan email
    $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");

    // Jika query berhasil dan ditemukan pengguna dengan email yang diberikan
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Verifikasi kata sandi
        if (password_verify($password, $row["password"])) {
            // Kata sandi cocok, atur variabel sesi
            $_SESSION["login"] = true;
            //cek remember me
            if (isset($_POST['remember'])) {
                //buat cookie
                setcookie('login', 'true', time() + 60);
            }
            $_SESSION['users_id'] = $row['id']; // Simpan ID pengguna dalam sesi
            $_SESSION['nama'] = $row['nama'];
            $_SESSION['email'] = $row['email'];

            

            // // Atur cookie sesi
            // setSession($row['id'], $remember);

            // Redirect sesuai peran pengguna
            $role = strtolower($row["role"]); // Pastikan peran dibandingkan dalam huruf kecil
            if ($role == "pengguna") {
                header("location: index.php");
                exit(); // Pastikan tidak ada output lain sebelum header()
            } elseif ($role == "admin") {
                header("location: index.php");
                exit(); // Pastikan tidak ada output lain sebelum header()
            } else {
                $_SESSION['flash'] = [
                    'message' => 'Invalid role for user!',
                    'type' => 'error'
                ];
            }
        } else {
            $_SESSION['flash'] = [
                'message' => 'Email atau Kata Sandi Salah!',
                'type' => 'error'
            ];
        }
    } else {
        // Pengguna dengan email yang diberikan tidak ditemukan
        $_SESSION['flash'] = [
            'message' => 'Email atau Kata Sandi Salah!',
            'type' => 'error'
        ];
    }
}

// $current_user = getSession();

// if ($current_user) {
//     header("Location: index.php");
//     exit();
// }

// Cek apakah ada flashdata
$flash = isset($_SESSION['flash']) ? $_SESSION['flash'] : null;
unset($_SESSION['flash']); // Hapus flashdata setelah ditampilkan
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />

</head>

<body>
    <div class="flex justify-start gap-0 lg:gap-[60px]">
        <div class="flex flex-wrap list-none mx-14 mt-10 lg:my-10 lg:mx-44">
            <div class="flex hover:text-[#756AB6] font-semibold">
                <a href="index.php">
                    <i class="ti ti-home-filled pr-2"></i>Beranda</a>
            </div>
            <span class="mx-2">/</span>
            <li class="text-[#756AB6] font-semibold">Masuk</li>
        </div>
        <?php if ($flash) : ?>
            <div id="flash-message" class="hidden lg:block flex justify-center items-center lg:my-4  ">
                <div class="flex items-center px-4 py-2 rounded-xl bg-white shadow-xl text-black font-semibold shadow-2xl">
                    <?php if ($flash['type'] == 'success') : ?>
                        <i class="ti ti-circle-check-filled text-2xl text-[#9BCF53] mr-2"></i>
                    <?php elseif ($flash['type'] == 'error') : ?>
                        <i class="ti ti-circle-x-filled text-2xl text-[#FF0000] mr-2"></i>
                    <?php endif; ?>
                    <div class="text-center">
                        <?php echo $flash['message']; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>


    <div class="lg:flex lg:mx-40">
        <div class="lg:flex-1 lg:bg-gradient-to-t from-[#756AB6] to-[#E0AED0] lg:shadow-2xl lg:rounded-l-xl lg:w-[500px] lg:h-[500px]">
            <img class="hidden lg:block" src="img/login.png" alt="">
        </div>

        <?php if ($flash) : ?>
            <div id="flash-message" class="lg:hidden flex justify-center items-center lg:my-4 mt-4 ">
                <div class="flex items-center px-4 py-2 rounded-xl bg-white shadow-xl  text-black font-semibold shadow-2xl">
                    <?php if ($flash['type'] == 'success') : ?>
                        <i class="ti ti-circle-check-filled text-2xl text-[#9BCF53] mr-2"></i>
                    <?php elseif ($flash['type'] == 'error') : ?>
                        <i class="ti ti-circle-x-filled text-2xl text-[#FF0000] mr-2"></i>
                    <?php endif; ?>
                    <div class="text-center">
                        <?php echo $flash['message']; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="flex-1 mx-auto md:mt-10 lg:mt-0 md:bg-white md:shadow-2xl md:w-7/12 md:h-[500px] md:rounded-xl lg:bg-white lg:rounded-none lg:rounded-r-xl lg:w-[500px] lg:h-[500px] lg:shadow-2xl">
            <div class="mt-4 mb-10 md:pt-10 ">
                <h1 class="flex justify-center text-black font-bold text-3xl ">Masuk ke Akun</h1>
                <p class="my-2 flex justify-center font-semibold  text-sm">Yuk, lanjutin mencari event kamu di EventUnila</p>
            </div>
            <!-- form -->
            <form action="" method="post">
                <!-- username -->
                <label for="email" class="block md:mx-12 lg:mx-16 mx-10 my-2 text-gray-500 font-bold text-sm">Alamat email</label>
                <div class="flex justify-center">
                    <input type="text" class="block px-4 md:w-96 w-10/12 h-10 bg-white rounded-xl border-2 border-[#756AB6]" name="email" id="email" aria-describedby="emailHelp" required placeholder="Masukan Email Kamu">
                </div>
                <!-- password -->
                <label for="password" class="block md:mx-12 lg:mx-16 mx-10 my-2 text-gray-500 font-bold text-sm">Kata Sandi</label>
                <div class="flex justify-center">
                    <input type="password" class="block px-4 md:w-[345px] w-[320px] h-10 bg-white  rounded-l-xl border-2 border-[#756AB6]" name="password" id="password" required placeholder="Masukan Kata Sandi">
                    <button id="togglePassword" type="button" class="text-white px-2 w-10 h-10 rounded-r-xl bg-[#756AB6]">
                        <i id="eyeIconOpen" class="ti ti-eye hidden"></i>
                        <i id="eyeIconClosed" class="ti ti-eye-off"></i>
                    </button>
                </div>
                <!-- checkbox -->
                <div class="flex justify-between">
                    <div class="flex items-center gap-2 md:mx-12 lg:mx-16 mx-10">
                        <label for="remember" class="my-2 text-gray-500 font-bold text-sm">Ingat Saya</label>
                        <input type="checkbox" class="" name="remember" id="remember">
                    </div>
                    <a href="forgot_password.php" class=" text-gray-500 font-bold text-sm mx-10 my-2 md:mx-12 lg:mx-16">Lupa kata sandi?</a>
                </div>

                <!-- button -->
                <div class="text-center mx-auto mt-4 rounded-xl md:w-96 w-10/12 h-10 bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] hover:bg-none hover:border-2 hover:border-[#AC87C5] group">
                    <button type="submit" name="login" class=" text-white text-sm font-bold pt-[8px] group-hover:text-[#AC87C5]">
                        Masuk
                    </button>
                </div>
                <div class="mt-4">
                    <div class="flex gap-1 justify-center">
                    <h2 class="text-sm font-semibold">Belum punya akun? Ayo</h2>
                    <a href="register.php" class="text-sm text-[#AC87C5] hover:text-[#756AB6] font-semibold">Daftar Sekarang</a>
                    </div>
                    <!-- <div class="mx-auto rounded-xl md:w-96 w-10/12 h-10 border-2 border-[#AC87C5] hover:bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] hover:border-none group">
                        <div class="text-center text-[#AC87C5] text-sm font-bold pt-[8px] group-hover:text-white">
                            <a href="register.php">Daftar</a>
                        </div>
                    </div> -->
                </div>
            </form>
        </div>
    </div>
    </div>
    <script src="script.js"></script>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            var passwordField = document.getElementById('password');
            var eyeIconOpen = document.getElementById('eyeIconOpen');
            var eyeIconClosed = document.getElementById('eyeIconClosed');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIconOpen.classList.remove('hidden');
                eyeIconClosed.classList.add('hidden');
            } else {
                passwordField.type = 'password';
                eyeIconOpen.classList.add('hidden');
                eyeIconClosed.classList.remove('hidden');
            }
        });

        // Alert notifikasi
        const flashMessage = document.getElementById('flash-message');
        if (flashMessage) {
            setTimeout(() => {
                flashMessage.classList.add('opacity-0');
                setTimeout(() => {
                    flashMessage.remove();
                }, 1000);
            }, 1000);
        }
    </script>
</body>

</html>