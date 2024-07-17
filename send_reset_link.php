<?php
include 'vendor/autoload.php'; // Sesuaikan dengan path Anda jika berbeda
include 'function.php'; // File koneksi dan fungsi
session_start();

date_default_timezone_set('Asia/Jakarta'); // Sesuaikan dengan timezone Anda
$current_time = date("Y-m-d H:i:s");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Cek apakah email terdaftar
    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($result) === 1) {
        $token = bin2hex(random_bytes(50)); // Generate random token
        $expiry = date("Y-m-d H:i:s", strtotime('+2 minutes')); // Token expired in 5 minutes
        $query = "UPDATE users SET reset_token='$token', token_expired='$expiry' WHERE email='$email'";
        if (mysqli_query($conn, $query)) {
            // URL reset password
            $resetLink = "http://localhost/event/reset_password.php?token=$token";

            // Konfigurasi email
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'unilaevent@gmail.com'; // Ganti dengan email Anda
                $mail->Password = 'dfoz rcjb kbcs rhvo'; // Ganti dengan password aplikasi
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                // Penerima email
                $mail->setFrom('unilaevent@gmail.com', 'EVENT UNILA');
                $mail->addAddress($email);

                // Konten email
                $mail->isHTML(true);
                $mail->Subject = 'Reset Password';
                $mail->Body    = "Klik link ini untuk reset password Anda: <a href='$resetLink'>$resetLink</a>";

                $mail->send();
                $_SESSION['flash'] = [
                    'message' => 'Link reset kata sandi telah dikirim ke email Anda.',
                    'type' => 'success'
                ];
            } catch (Exception $e) {
                $_SESSION['flash'] = [
                    'message' => "Gagal mengirim email. Error: {$mail->ErrorInfo}",
                    'type' => 'error'
                ];
            }
        } else {
            $_SESSION['flash'] = [
                'message' => 'Gagal mengupdate token reset.',
                'type' => 'error'
            ];
        }
    } else {
        $_SESSION['flash'] = [
            'message' => 'Email tidak terdaftar.',
            'type' => 'error'
        ];
    }

    // Redirect ke halaman sebelumnya atau halaman lain
    header('Location: forgot_password.php');
    exit();
}
?>
