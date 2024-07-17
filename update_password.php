<?php
include 'function.php'; // File koneksi dan fungsi

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Periksa token dan perbarui kata sandi
    $query = "UPDATE users SET password='$password', reset_token=NULL WHERE reset_token='$token'";
    if (mysqli_query($conn, $query)) {
        echo "Kata sandi berhasil diperbarui";
    } else {
        echo "Token tidak valid atau telah kadaluarsa.";
    }
}
?>
