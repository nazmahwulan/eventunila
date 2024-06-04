<?php
include 'function.php';
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $users_id = $_SESSION['users_id'];
    $judul = $_POST['judul'];
    $kategori_id = $_POST['kategori_id'];
    $lokasi = $_POST['lokasi'];
    $tanggal = $_POST['tanggal'];
    $waktu = $_POST['waktu'];
    $link_pendaftaran = $_POST['link_pendaftaran'];
    $deskripsi = $_POST['deskripsi'];
    $penyelenggara = $_POST['penyelenggara'];

    //upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    // Tentukan nilai default untuk kolom acc
    $acc = "0";

    // Query untuk menyimpan data
    $stmt = $conn->prepare("INSERT INTO event (users_id, judul, kategori_id, lokasi, tanggal, waktu, link_pendaftaran, deskripsi, penyelenggara, acc, gambar) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssssssss", 
        $users_id, 
        $judul, 
        $kategori_id, 
        $lokasi, 
        $tanggal, 
        $waktu, 
        $link_pendaftaran, 
        $deskripsi, 
        $penyelenggara, 
        $acc, 
        $gambar
    );

    if ($stmt->execute()) {
        echo "Data successfully submitted!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

function upload() {
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    //cek apakah ada gambar yg diupload
    if ($error === 4) {
        echo "<script>alert('pilih gambar terlebih dahulu');</script>";
        return false;
    }

    //cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>alert('Yang anda upload bukan gambar');</script>";
        return false;
    }

    //jika ukurannya terlalu besar
    if ($ukuranFile > 1000000) {
        echo "<script>alert('ukuran gambar terlalu besar');</script>";
        return false;
    }

    //lolos pengecekan, gambar siap diupload
    //generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
    return $namaFileBaru;
}
?>
