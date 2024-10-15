<?php

$conn = mysqli_connect("localhost", "root", "", "event");


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
    }
    return $rows;
}

function getkategori()
{
    global $conn;
    $sql = "SELECT * FROM kategori";
    $result = $conn->query($sql);
    $kategori = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $kategori[] = $row;
        }
    }
    return $kategori;
}

function getEvents($kategori_id = null, $searchKeyword = null, $halamanAktif = 1, $jumlahDataPerHalaman = 9, $countOnly = false)
{
    global $conn;

    // Base SQL query to select events with approved status
    $sql = "SELECT events.*, kategori.kategori AS kategori_kategori 
            FROM events
            JOIN kategori ON events.kategori_id = kategori.id 
            WHERE events.status = 'disetujui'";

    $conditions = [];

    // Adding conditions based on parameters
    if ($kategori_id) {
        $kategori_id = $conn->real_escape_string($kategori_id); // Sanitize input
        $conditions[] = "events.kategori_id = '$kategori_id'";
    }
    if ($searchKeyword) {
        $keyword = $conn->real_escape_string($searchKeyword); // Sanitize input
        $conditions[] = "(events.judul LIKE '%$keyword%' OR 
                        events.deskripsi LIKE '%$keyword%' OR 
                        events.penyelenggara LIKE '%$keyword%' OR 
                        events.lokasi LIKE '%$keyword%' OR 
                        kategori.kategori LIKE '%$keyword%')";
    }

    // If there are conditions, append them to the SQL query
    if (!empty($conditions)) {
        $sql .= " AND " . implode(" AND ", $conditions);
    }

    // If $countOnly is true, only count the total number of rows
    if ($countOnly) {
        $result = $conn->query($sql);
        if (!$result) {
            die("Query failed: " . $conn->error);
        }
        return $result->num_rows;
    }

    // Pagination calculations
    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

    // Append ORDER BY clause for prioritizing upcoming events by ascending date and past events by descending date
    $sql .= " ORDER BY 
              CASE 
                  WHEN events.tanggal_mulai >= CURDATE() THEN 1
                  ELSE 2
              END ASC, 
              CASE 
                  WHEN events.tanggal_mulai >= CURDATE() THEN events.tanggal_mulai
                  ELSE NULL
              END ASC,
              CASE 
                  WHEN events.tanggal_mulai < CURDATE() THEN events.tanggal_mulai
                  ELSE NULL
              END DESC 
              LIMIT $awalData, $jumlahDataPerHalaman";

    // Execute the query
    $result = $conn->query($sql);
    if (!$result) {
        die("Query failed: " . $conn->error);
    }

    // Fetching results into an array
    $events = [];
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }

    return $events;
}

function daftarAkun($data)
{
    global $conn;

    $nama = strtolower(stripslashes($data["nama"]));
    $email = mysqli_real_escape_string($conn, $data["email"]);
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    date_default_timezone_set('Asia/Jakarta'); // Sesuaikan dengan timezone Anda
    $created_at = date("Y-m-d H:i:s"); // Waktu saat ini

    // Konfirmasi apakah email sudah terdaftar
    $result = mysqli_query($conn, "SELECT nama FROM users WHERE email = '$email'");
    if (mysqli_fetch_assoc($result)) {
        $_SESSION['flash'] = [
            'message' => 'Email sudah terdaftar',
            'type' => 'error'
        ];
        header('Location: register.php');
        exit();
    }

    // Cek konfirmasi password
    if ($password !== $password2) {
        $_SESSION['flash'] = [
            'message' => 'Konfirmasi kata sandi tidak sesuai!',
            'type' => 'error'
        ];
        header('Location: register.php');
        exit();
    }

    // Enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Tentukan nilai default untuk kolom role
    $role = "pengguna";

    // Tambahkan user baru ke dalam database
    $query = "INSERT INTO users (nama, email, password, role, created_at) VALUES ('$nama','$email', '$password', '$role', '$created_at')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function editEvent($data) {
    global $conn;

    $id = $data["id"];
    $judul = htmlspecialchars($data["judul"]);
    $kategori_nama = htmlspecialchars($data["kategori"]); // Nama kategori diambil dari form
    $lokasi = htmlspecialchars($data["lokasi"]);
    $link_pendaftaran = htmlspecialchars($data["link_pendaftaran"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    $penyelenggara = htmlspecialchars($data["penyelenggara"]);


    $result = $conn->query("SELECT tanggal_mulai, tanggal_berakhir, waktu_mulai, waktu_berakhir FROM events WHERE event_id = '$id'");
    $row = $result->fetch_assoc();

    $tanggal_mulai = !empty($data['tanggal_mulai']) ? htmlspecialchars($data['tanggal_mulai']) : $row['tanggal_mulai'];
    $tanggal_berakhir = !empty($data['tanggal_berakhir']) ? htmlspecialchars($data['tanggal_berakhir']) : $row['tanggal_berakhir'];
    $waktu_mulai = !empty($data['waktu_mulai']) ? htmlspecialchars($data['waktu_mulai']) : $row['waktu_mulai'];
    $waktu_berakhir = !empty($data['waktu_berakhir']) ? htmlspecialchars($data['waktu_berakhir']) : $row['waktu_berakhir'];

    if ($_FILES['gambar']['error'] === 4) {
        $gambar = htmlspecialchars($data["gambar_lama"]);
    } else {
        $gambar = upload2();
        if (!$gambar) {
            return 'upload_error';
        }
    }

    // Ambil ID kategori berdasarkan nama kategori
    $query_kategori = "SELECT id FROM kategori WHERE kategori = ?";
    $stmt_kategori = $conn->prepare($query_kategori);
    $stmt_kategori->bind_param('s', $kategori_nama);
    $stmt_kategori->execute();
    $result_kategori = $stmt_kategori->get_result();

    if ($result_kategori->num_rows > 0) {
        $kategori = $result_kategori->fetch_assoc();
        $kategori_id = $kategori['id'];

        $query = "UPDATE events SET
                    judul = ?, kategori_id = ?, lokasi = ?, tanggal_mulai = ?, tanggal_berakhir = ?, waktu_mulai = ?, waktu_berakhir = ?, 
                    link_pendaftaran = ?, deskripsi = ?, penyelenggara = ?, gambar = ?
                    WHERE event_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param(
            "sisssssssssi",
            $judul,
            $kategori_id,
            $lokasi,
            $tanggal_mulai,
            $tanggal_berakhir,
            $waktu_mulai,
            $waktu_berakhir,
            $link_pendaftaran,
            $deskripsi,
            $penyelenggara,
            $gambar,
            $id
        );

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                return 'success';
            } else {
                return 'no_change';
            }
        } else {
            return 'update_error';
        }
    } else {
        return 'category_error';
    }
}






// Fungsi upload yang sama dengan yang digunakan di fungsi pengajuan
function upload2()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // Cek apakah ada gambar yang diupload
    if ($error === 4) {
        // Set flashdata untuk error pada gambar
        $_SESSION['flash'] = [
            'message' => 'Pilih Gambar Terlebih Dahulu.',
            'type' => 'error'
        ];
        return false;
    }

    // Cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        $_SESSION['flash'] = [
            'message' => 'Format Gambar Salah.',
            'type' => 'error'
        ];
        return false;
    }

    // Cek jika ukuran terlalu besar
    if ($ukuranFile > 2000000) {
        $_SESSION['flash'] = [
            'message' => 'Ukuran Gambar Terlalu Besar.',
            'type' => 'error'
        ];
        return false;
    }

    // Lolos pengecekan, gambar siap diupload
    // Generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
    return $namaFileBaru;
}

function pengajuan($data)
{
    global $conn;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $users_id = $_SESSION['users_id'];
        $judul = htmlspecialchars($data['judul']);
        $kategori_id = htmlspecialchars($data['kategori']);  // Nama kategori
        $lokasi = htmlspecialchars($data['lokasi']);
        $tanggal_mulai = htmlspecialchars($data['tanggal_mulai']);
        $tanggal_berakhir = htmlspecialchars($data['tanggal_berakhir']);
        $waktu_mulai = htmlspecialchars($data['waktu_mulai']);
        $waktu_berakhir = htmlspecialchars($data['waktu_berakhir']);
        $link_pendaftaran = htmlspecialchars($data['link_pendaftaran']);
        $deskripsi = htmlspecialchars($data['deskripsi']);
        $penyelenggara = htmlspecialchars($data['penyelenggara']);

        // // Hapus semua tag HTML dari deskripsi
        // $deskripsi = strip_tags($deskripsi);

        // Upload gambar
        $gambar = upload();
        if (!$gambar) {
            return false;
        }

        // Tentukan nilai default untuk kolom status
        $status = "Sedang Diajukan";

        // Ambil ID kategori berdasarkan nama kategori
        $query_kategori = "SELECT id FROM kategori WHERE kategori = ?";
        $stmt_kategori = $conn->prepare($query_kategori);
        $stmt_kategori->bind_param('s', $kategori_id);
        $stmt_kategori->execute();
        $result_kategori = $stmt_kategori->get_result();

        if ($result_kategori->num_rows > 0) {
            $kategori = $result_kategori->fetch_assoc();
            $kategori_id = $kategori['id'];

            // Query untuk menyimpan data
            $stmt = $conn->prepare("INSERT INTO events (users_id, judul, kategori_id, lokasi, tanggal_mulai, tanggal_berakhir, waktu_mulai, waktu_berakhir, link_pendaftaran, deskripsi, penyelenggara, status, gambar) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param(
                "sssssssssssss",
                $users_id,
                $judul,
                $kategori_id,
                $lokasi,
                $tanggal_mulai,
                $tanggal_berakhir,
                $waktu_mulai,
                $waktu_berakhir,
                $link_pendaftaran,
                $deskripsi,
                $penyelenggara,
                $status,
                $gambar
            );

            if ($stmt->execute()) {
                return true;
            } else {
                throw new Exception("Failed to insert event: " . $stmt->error);
            }
        } else {
            throw new Exception("Kategori tidak ditemukan");
        }
    }
}



function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    //cek apakah ada gambar yg diupload
    if ($error === 4) {
        // Set flashdata untuk error pada gambar
        $_SESSION['flash'] = [
            'message' => 'Pilih Gambar Terlebih Dahulu.',
            'type' => 'error'
        ];
        return false;
    }

    //cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        $_SESSION['flash'] = [
            'message' => 'Format Gambar Salah.',
            'type' => 'error'
        ];
        return false;
    }

    //jika ukurannya terlalu besar
    if ($ukuranFile > 2000000) {
        $_SESSION['flash'] = [
            'message' => 'Ukuran Gambar Terlalu Besar.',
            'type' => 'error'
        ];
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

function tambah($data)
{
    global $conn;

    // Ambil data dari form
    $kategori = htmlspecialchars($data["kategori"]);

    // Query INSERT dengan menyebutkan nama kolom
    $query = "INSERT INTO kategori (kategori) VALUES ('$kategori')";

    // Jalankan query
    mysqli_query($conn, $query);

    // Kembalikan jumlah baris yang terpengaruh
    return mysqli_affected_rows($conn);
}


function hapusKategori($id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM kategori WHERE id =$id");
    return mysqli_affected_rows($conn);
}

function hapusEvent($id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM events WHERE event_id =$id");
    return mysqli_affected_rows($conn);
}

function hapusPengguna($id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM users WHERE id =$id");
    return mysqli_affected_rows($conn);
}


function ubahKategori($data)
{
    global $conn;

    $id = $data["id"];
    $kategori = htmlspecialchars($data["kategori"]);

    $query = "UPDATE kategori SET
                kategori = '$kategori'
                WHERE id = $id
                ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function ubahEvent($data)
{
    global $conn;

    $id = $data["id"];
    $event = htmlspecialchars($data["status"]);

    $query = "UPDATE events SET
                status = '$event'
                WHERE event_id = $id
                ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// function cari($keyword)
// {
//     global $conn;

//     // Placeholder untuk status event berdasarkan tanggal
//     $mendatang = 'mendatang';
//     $selesai = 'selesai';

//     // Query dengan 4 placeholder sesuai dengan kolom yang dicari
//     $query = "SELECT users.nama AS nama, events.*, kategori.kategori 
//               FROM events 
//               JOIN users ON events.users_id = users.id 
//               JOIN kategori ON events.kategori_id = kategori.id
//               WHERE judul LIKE ? OR
//                     kategori LIKE ? OR
//                     nama LIKE ? OR
//                     status LIKE ? OR
//                     (CASE 
//                         WHEN tanggal >= CURDATE() THEN 'mendatang'
//                         ELSE 'selesai'
//                      END) LIKE ?";

//     // Siapkan pernyataan
//     $stmt = $conn->prepare($query);

//     // Pastikan keyword dicocokkan dengan semua placeholder
//     $keyword = "%$keyword%";
//     $stmt->bind_param("sssss", $keyword, $keyword, $keyword, $keyword, $keyword);

//     // Eksekusi pernyataan
//     $stmt->execute();

//     // Ambil hasilnya
//     $result = $stmt->get_result();

//     // Kembalikan hasil sebagai array asosiatif
//     return $result->fetch_all(MYSQLI_ASSOC);
// }


// function cari2($keyword)
// {
//     global $conn;

//     // Query dengan 7 placeholder sesuai dengan kolom yang dicari
//     $query = "SELECT * FROM users
//     WHERE nama LIKE ? OR
//           email LIKE ? OR
//           role LIKE ?";

//     // Siapkan pernyataan
//     $stmt = $conn->prepare($query);

//     // Pastikan keyword dicocokkan dengan semua placeholder
//     $keyword = "%$keyword%";
//     $stmt->bind_param("sss", $keyword, $keyword, $keyword);

//     // Eksekusi pernyataan
//     $stmt->execute();

//     // Ambil hasilnya
//     $result = $stmt->get_result();

//     // Kembalikan hasil sebagai array asosiatif
//     return $result->fetch_all(MYSQLI_ASSOC);
// }

// function cari3($keyword)
// {
//     global $conn;

//     // Query dengan 7 placeholder sesuai dengan kolom yang dicari
//     $query = "SELECT 
//     events.*,  kategori.kategori FROM events JOIN kategori ON events.kategori_id = kategori.id
//     WHERE judul LIKE ? OR
//           kategori_id LIKE ? OR
//           lokasi LIKE ? OR
//           penyelenggara LIKE ? OR
//           tanggal LIKE ? OR
//           waktu LIKE ? OR
//           deskripsi LIKE ?";

//     // Siapkan pernyataan
//     $stmt = $conn->prepare($query);

//     // Pastikan keyword dicocokkan dengan semua placeholder
//     $keyword = "%$keyword%";
//     $stmt->bind_param("sssssss", $keyword, $keyword, $keyword, $keyword, $keyword, $keyword, $keyword);

//     // Eksekusi pernyataan
//     $stmt->execute();

//     // Ambil hasilnya
//     $result = $stmt->get_result();

//     // Kembalikan hasil sebagai array asosiatif
//     return $result->fetch_all(MYSQLI_ASSOC);
// }

function ubahProfil($data)
{
    global $conn;

    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $password1 = $data["password1"];
    $password2 = $data["password2"];
    $password3 = $data["password3"];

    // Ambil data pengguna dari database
    $result = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id'");
    $user = mysqli_fetch_assoc($result);

    // Periksa apakah semua field password kosong
    if (empty($password1) && empty($password2) && empty($password3)) {
        // Update hanya nama ke dalam database
        $query = "UPDATE users SET nama = '$nama' WHERE id = '$id'";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    // Periksa apakah salah satu field password diisi
    if (!empty($password1) || !empty($password2) || !empty($password3)) {
        // Periksa apakah password lama cocok
        if (!password_verify($password1, $user['password'])) {
            echo "<script>
                    alert('Password lama salah');
                  </script>";
            return false;
        }

        // Periksa apakah password baru dan konfirmasi password cocok
        if ($password2 !== $password3) {
            echo "<script>
                    alert('Konfirmasi password tidak cocok');
                  </script>";
            return false;
        }

        // Enkripsi password baru
        $password2 = password_hash($password2, PASSWORD_DEFAULT);

        // Update nama dan password baru ke dalam database
        $query = "UPDATE users SET nama = '$nama', password = '$password2' WHERE id = '$id'";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    // Jika tidak ada field password yang diisi, update hanya nama
    $query = "UPDATE users SET nama = '$nama' WHERE id = '$id'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function countActiveEvents()
{
    global $conn;
    $sql = "SELECT COUNT(*) as count FROM events WHERE status = 'disetujui'";
    $result = $conn->query($sql);
    $count = $result->fetch_assoc()['count'];
    return $count;
}

function countPendingEvents()
{
    global $conn;
    $sql = "SELECT COUNT(*) as count FROM events WHERE status = 'sedang diajukan'";
    $result = $conn->query($sql);
    $count = $result->fetch_assoc()['count'];
    return $count;
}

function countRejectedEvents()
{
    global $conn;
    $sql = "SELECT COUNT(*) as count FROM events WHERE status = 'ditolak'";
    $result = $conn->query($sql);
    $count = $result->fetch_assoc()['count'];
    return $count;
}

function countCategories()
{
    global $conn;
    $sql = "SELECT COUNT(*) as count FROM kategori";
    $result = $conn->query($sql);
    $count = $result->fetch_assoc()['count'];
    return $count;
}

function countUsers()
{
    global $conn;
    $sql = "SELECT COUNT(*) as count FROM users WHERE role = 'pengguna'";
    $result = $conn->query($sql);
    $count = $result->fetch_assoc()['count'];
    return $count;
}

function countAdmin()
{
    global $conn;
    $sql = "SELECT COUNT(*) as count FROM users WHERE role = 'admin'";
    $result = $conn->query($sql);
    $count = $result->fetch_assoc()['count'];
    return $count;
}
