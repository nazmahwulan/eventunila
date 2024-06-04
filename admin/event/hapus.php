<?php
include '../../function.php';
session_start();
$id = $_GET["id"];
if (hapus2($id) > 0) {
    // Set flashdata untuk sukses
    $_SESSION['flash'] = [
        'message' => 'Event berhasil dihapus!',
        'type' => 'success'
    ];
} else {
    // Set flashdata untuk error
    $_SESSION['flash'] = [
        'message' => 'Event gagal dihapus!',
        'type' => 'error'
    ];
}
// Redirect ke halaman kategori
header('Location:index.php');
exit;
