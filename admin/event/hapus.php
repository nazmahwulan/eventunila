<?php
include '../../function.php';
session_start();

// Periksa apakah peran pengguna adalah admin
if ($_SESSION['user_role'] !== 'admin') {
    // Jika tidak, arahkan ke halaman lain atau tampilkan pesan error
    header('Location:../../index.php');
    exit;
}

// Ambil data di URL
if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = intval($_GET["id"]);
    // Query data event berdasarkan ID
    $events = query("SELECT * FROM events WHERE event_id = $id");

    // Periksa apakah event ditemukan
    if (count($events) === 0) {
        // Jika tidak ditemukan, sertakan halaman error
        include '../../error.php';
        exit;
    } else {
        // Jika ditemukan, lanjutkan penghapusan event
        if (hapusEvent($id) > 0) {
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
        header('Location: index.php');
        exit;
    }
} else {
    // Jika tidak ada ID atau ID tidak valid, sertakan halaman error
    include '../../error.php';
    exit;
}
?>

