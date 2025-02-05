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
    
    // Query data pengguna berdasarkan ID
    $pengguna = query("SELECT * FROM users WHERE id = $id");

    // Periksa apakah pengguna ditemukan
    if (count($pengguna) === 0) {
        // Jika tidak ditemukan, sertakan halaman error
        include '../../error.php';
        exit;
    } else {
        // Cek apakah pengguna memiliki event
        $eventCount = query("SELECT COUNT(*) AS total_event FROM events WHERE users_id = $id");
        
        if ($eventCount[0]['total_event'] > 0) {
            // Jika pengguna memiliki event, tolak penghapusan
            $_SESSION['flash'] = [
                'message' => 'Pengguna tidak dapat dihapus karena memiliki event yang aktif!',
                'type' => 'error'
            ];
        } else {
            // Lanjutkan penghapusan pengguna
            if (hapusPengguna($id) > 0) {
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
        }
        // Redirect ke halaman pengguna
        header('Location: index.php');
        exit;
    }
} else {
    // Jika tidak ada ID atau ID tidak valid, sertakan halaman error
    include '../../error.php';
    exit;
}
?>
