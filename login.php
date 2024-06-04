<?php
include 'function.php';
session_start();

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
            $_SESSION['users_id'] = $row['id']; // Simpan ID pengguna dalam sesi
            $_SESSION['nama'] = $row['nama'];
            $_SESSION['email'] = $row['email'];

            // Redirect sesuai peran pengguna
            $role = strtolower($row["role"]); // Pastikan peran dibandingkan dalam huruf kecil
            if ($role == "pengguna") {
                header("location: index.php");
                exit(); // Pastikan tidak ada output lain sebelum header()
            } elseif ($role == "admin") {
                header("location: admin/beranda.php");
                exit(); // Pastikan tidak ada output lain sebelum header()
            } else {
                echo "Invalid role for user!";
            }
        } else {
            // Kata sandi tidak cocok
            echo "Username or password incorrect!";
        }
    } else {
        // Pengguna dengan email yang diberikan tidak ditemukan
        echo "Username or password incorrect!";
    }
}
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
    <div class="py-2">
        <div class="flex flex-wrap list-none mb-4 px-44 ">
            <div class="flex hover:text-[#756AB6] font-semibold">
                <a href="index.php">
                    <i class="ti ti-home-filled pr-2"></i>Beranda</a>
            </div>
            <span class="mx-2">/</span>
            <li class="text-[#756AB6] font-semibold">Login</li>
        </div>

        <div class="flex px-40">
            <div class="flex-1 mx-auto bg-gradient-to-t from-[#756AB6] to-[#E0AED0] shadow-2xl rounded-l-xl w-[500px] h-[500px]">
                <img src="img/login.png" alt="">
            </div>
            <div class="flex-1 mx-auto bg-white shadow-2xl rounded-r-xl w-[500px] h-[500px]">
                <div class="py-12">
                    <h1 class="flex justify-center text-black font-bold text-3xl ">Masuk ke Akun</h1>
                    <p class="py-2 flex justify-center text-grey  text-sm">Yuk, lanjutin mencari event kamu di EventUnila.</p>
                </div>
                <!-- form -->
                <form action="" method="post">
                    <div class="mt-[-30px]">
                        <!-- username -->
                        <label for="email" class="block px-16 py-2 text-gray-500 font-bold text-sm">Alamat email</label>
                        <div class="flex justify-center">
                            <input type="text" class="block px-4 w-96 h-10 bg-white shadow-2xl rounded-xl border-2 border-[#756AB6]" name="email" id="email" aria-describedby="emailHelp" required placeholder="Masukan Email Kamu">
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
                        <!-- checkbox -->
                        <a href="" class="flex justify-end px-16 py-2 text-gray-500 font-bold text-sm">Lupa kata sandi?</a>
                        <!-- button -->
                        <div class="text-center mx-auto mt-4 rounded-xl w-96 h-10 bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] hover:bg-none hover:border-2 hover:border-[#AC87C5] group">
                            <button type="submit" name="login" class=" text-white text-sm font-bold pt-[8px] group-hover:text-[#AC87C5]">
                                Login
                            </button>
                        </div>
                        <div class="mt-4">
                            <div class="mx-auto rounded-xl w-96 h-10 border-2 border-[#AC87C5] hover:bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] hover:border-none group">
                                <div class="text-center text-[#AC87C5] text-sm font-bold pt-[8px] group-hover:text-white">
                                    <a href="register.php">Daftar</a>
                                </div>
                            </div>
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