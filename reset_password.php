<?php
include 'function.php'; // File koneksi dan fungsi
session_start();

date_default_timezone_set('Asia/Jakarta'); // Sesuaikan dengan timezone Anda

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE reset_token='$token'");
    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        $current_time = date("Y-m-d H:i:s");
        if ($current_time < $user['token_expired']) {
            // Token masih berlaku
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $password = $_POST['password'];
                $password2 = $_POST['password2'];

                if ($password !== $password2) {
                    $_SESSION['flash'] = [
                        'message' => 'Konfirmasi Kata Sandi tidak sesuai',
                        'type' => 'error'
                    ];
                } else {
                    $new_password = password_hash($password, PASSWORD_BCRYPT);
                    $query = "UPDATE users SET password='$new_password', reset_token=NULL, token_expired=NULL WHERE reset_token='$token'";
                    if (mysqli_query($conn, $query)) {
                        $_SESSION['flash'] = [
                            'message' => 'Kata Sandi berhasil diubah',
                            'type' => 'success'
                        ];
                        header('Location: login.php');
                        exit();
                    } else {
                        $_SESSION['flash'] = [
                            'message' => 'Gagal mengubah Kata Sandi. Silakan coba lagi',
                            'type' => 'error'
                        ];
                    }
                }
            }
        } else {
            $_SESSION['flash'] = [
                'message' => 'Token sudah tidak berlaku lagi',
                'type' => 'error'
            ];
            header('Location: forgot_password.php');
            exit();
        }
    } else {
        $_SESSION['flash'] = [
            'message' => 'Token tidak valid',
            'type' => 'error'
        ];
        header('Location: forgot_password.php');
        exit();
    }
} else {
    header('Location: forgot_password.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />

</head>

<body>
    <div class="flex justify-center items-center h-screen bg-gray-100">
        <div class="bg-white p-8 rounded-xl shadow-md w-96">
            <h2 class="text-2xl font-bold mb-6 text-center">Reset Kata Sandi</h2>
            <form action="" method="post">
                <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                <div class="mb-2">
                    <label for="password" class="block text-sm font-bold text-gray-500 my-2">Kata Sandi Baru</label>
                    <div class="flex justify-center">
                        <input type="password" class="block px-4 md:w-[345px] w-[320px] h-10 bg-white  rounded-l-xl border-2 border-[#AC87C5] focus:outline-none focus:[#756AB6] focus:border-[#756AB6]" name="password" id="password" required placeholder="Masukan Kata Sandi">
                        <button id="togglePassword" type="button" class="text-white px-2 w-10 h-10 rounded-r-xl bg-[#756AB6]">
                            <i id="eyeIconOpen" class="ti ti-eye hidden"></i>
                            <i id="eyeIconClosed" class="ti ti-eye-off"></i>
                        </button>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="confirm_password" class="block text-sm font-bold text-gray-500 my-2">Konfirmasi Kata Sandi Baru</label>
                    <input type="password" name="password2" id="password2" class="w-full h-10 px-4 py-2 border-2 border-[#AC87C5] rounded-xl focus:outline-none focus:[#756AB6] focus:border-[#756AB6]" required>
                </div>
                <button type="submit" class="w-full h-10 font-bold text-sm bg-[#AC87C5] text-white py-2 rounded-xl hover:bg-[#756AB6]">Reset Kata Sandi</button>
            </form>
        </div>
    </div>
    <script>
        // Toggle password visibility
        const togglePasswordButton = document.getElementById('togglePassword');
        if (togglePasswordButton) {
            togglePasswordButton.addEventListener('click', function() {
                const passwordField = document.getElementById('password');
                const confirmPasswordField = document.getElementById('password2');
                const eyeIconOpen = document.getElementById('eyeIconOpen');
                const eyeIconClosed = document.getElementById('eyeIconClosed');
                const isPassword = passwordField.getAttribute('type') === 'password';

                if (isPassword) {
                    passwordField.setAttribute('type', 'text');
                    confirmPasswordField.setAttribute('type', 'text');
                    eyeIconOpen.classList.remove('hidden');
                    eyeIconClosed.classList.add('hidden');
                } else {
                    passwordField.setAttribute('type', 'password');
                    confirmPasswordField.setAttribute('type', 'password');
                    eyeIconOpen.classList.add('hidden');
                    eyeIconClosed.classList.remove('hidden');
                }
            });
        }

        const passwordInput = document.getElementById('password');

        passwordInput.addEventListener('input', function() {
            const password = passwordInput.value;

            if (password.length < 8) {
                passwordInput.setCustomValidity('Password harus memiliki setidaknya 8 karakter.');
            } else {
                passwordInput.setCustomValidity('');
            }
        });
    </script>

    <!-- <script src="script.js"></script> -->
</body>

</html>