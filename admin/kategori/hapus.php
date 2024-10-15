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

    // Query data kategori berdasarkan ID
    $kategori = query("SELECT * FROM kategori WHERE id = $id");

    // Periksa apakah kategori ditemukan
    if (count($kategori) === 0) {
        // Jika tidak ditemukan, sertakan halaman error
        include '../../error.php';
        exit;
    } else {
        // Cek apakah ada event yang menggunakan kategori ini
        $eventTerkait = query("SELECT COUNT(*) as jumlah FROM events WHERE kategori_id = $id");

        if ($eventTerkait[0]['jumlah'] > 0) {
            // Jika kategori digunakan oleh event, set flashdata untuk error
            $_SESSION['flash'] = [
                'message' => 'Kategori tidak dapat dihapus karena sedang digunakan oleh event!',
                'type' => 'error'
            ];
        } else {
            // Jika tidak ada event yang menggunakan kategori, lanjutkan penghapusan
            if (hapusKategori($id) > 0) {
                // Set flashdata untuk sukses
                $_SESSION['flash'] = [
                    'message' => 'Kategori berhasil dihapus!',
                    'type' => 'success'
                ];
            } else {
                // Set flashdata untuk error jika gagal menghapus kategori
                $_SESSION['flash'] = [
                    'message' => 'Kategori gagal dihapus!',
                    'type' => 'error'
                ];
            }
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
