<?php
include '../../function.php';
session_start();
$id = $_GET["id"];
if (hapus3($id) > 0) {
    // Set flashdata untuk sukses
    $_SESSION['flash'] = [
        'message' => 'Pengguna berhasil dihapus!',
        'type' => 'success'
    ];
} else {
    // Set flashdata untuk error
    $_SESSION['flash'] = [
        'message' => 'Pengguna gagal dihapus!',
        'type' => 'error'
    ];
}
// Redirect ke halaman kategori
header('Location:index.php');
exit;
