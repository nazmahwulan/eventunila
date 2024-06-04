<?php
$conn = mysqli_connect("localhost", "root", "", "wisuda");


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

// function getDbConnection() {
//     $conn = new mysqli('localhost', 'root', '', 'wisuda');
//     if ($conn->connect_error) {
//         die("Connection failed: " . $conn->connect_error);
//     }
//     return $conn;
// }

// function getDbConnection() {
//     $conn = new mysqli('localhost', 'root', '', 'wisuda');
//     if ($conn->connect_error) {
//         die("Connection failed: " . $conn->connect_error);
//     }
//     return $conn;
// }

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

function getEvents($kategori_id = null, $searchKeyword = null)
{
    global $conn;
    $sql = "SELECT events.*, kategori.kategori AS kategori_kategori FROM events
            JOIN kategori ON events.kategori_id = kategori.id";

    $conditions = [];
    if ($kategori_id) {
        $conditions[] = "kategori_id = $kategori_id";
    }
    if ($searchKeyword) {
        $conditions[] = "(events.judul LIKE '%$searchKeyword%' OR events.deskripsi LIKE '%$searchKeyword%' OR events.penyelenggara LIKE '%$searchKeyword%'
        OR events.lokasi LIKE '%$searchKeyword%' OR events.tanggal LIKE '%$searchKeyword%' OR events.waktu LIKE '%$searchKeyword%'
        OR events.kategori_id LIKE '%$searchKeyword%')";
    }
    if (count($conditions) > 0) {
        $sql .= " WHERE " . implode(" AND ", $conditions);
    }

    $result = $conn->query($sql);
    if (!$result) {
        die("Query failed: " . $conn->error);
    }
    $events = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $events[] = $row;
        }
    }
    return $events;
}


function registrasi($data)
{
    global $conn;

    $nama = strtolower(stripslashes($data["nama"]));
    $email = mysqli_real_escape_string($conn, $data["email"]);
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);


    //konfirmasi nama sudah ada apa blm 
    $result = mysqli_query($conn, "SELECT nama FROM users WHERE email = '$email'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
           alert('email sudah terdaftar');
           </script>";
        return false;
    }


    //cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
           alert('konfirmasi password tidak sesuai!');
           </script>";
        return false;
    }

    //enskripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Tentukan nilai default untuk kolom role
    $role = "pengguna";

    //tambahkan user baru ke dalam database
    mysqli_query($conn, "INSERT INTO users VALUES ('', '$nama','$email', '$password', '$role') ");
    return mysqli_affected_rows($conn);
}

function pengajuan($data)
{
    global $conn;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $users_id = $_SESSION['users_id'];
        $judul = htmlspecialchars($data['judul']);
        $kategori_id = htmlspecialchars($data['kategori']);  // Nama kategori
        $lokasi = htmlspecialchars($data['lokasi']);
        $tanggal = htmlspecialchars($data['tanggal']);
        $waktu = htmlspecialchars($data['waktu']);
        $link_pendaftaran = htmlspecialchars($data['link_pendaftaran']);
        $deskripsi = htmlspecialchars($data['deskripsi']);
        $penyelenggara = htmlspecialchars($data['penyelenggara']);

        // Upload gambar
        $gambar = upload();
        if (!$gambar) {
            return false;
        }

        // Tentukan nilai default untuk kolom status
        $status = "sedang diajukan";

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
            $stmt = $conn->prepare("INSERT INTO events (users_id, judul, kategori_id, lokasi, tanggal, waktu, link_pendaftaran, deskripsi, penyelenggara, status, gambar) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param(
                "sssssssssss",
                $users_id,
                $judul,
                $kategori_id,
                $lokasi,
                $tanggal,
                $waktu,
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

    $kategori = htmlspecialchars($data["kategori"]);

    $query = "INSERT INTO kategori
                VALUES
                ('','$kategori')
                ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
    // $data->session->set_flashdata('message', '<div class="alert
    //  alert succes" role="alert"> Data Berhasil ditambahkan
    //  <button type="button" class "close" data-dismiss="alert" 
    //  aria-label="Close"><span aria-hidden="true">&times;</span>
    //   <button></div>');
}

function hapus($id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM kategori WHERE id =$id");
    return mysqli_affected_rows($conn);
}

function hapus2($id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM events WHERE id =$id");
    return mysqli_affected_rows($conn);
}

function hapus3($id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM users WHERE id =$id");
    return mysqli_affected_rows($conn);
}


function ubah($data)
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

function ubah2($data)
{
    global $conn;

    $id = $data["id"];
    $event = htmlspecialchars($data["status"]);

    $query = "UPDATE events SET
                status = '$event'
                WHERE id = $id
                ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cari($keyword)
{
    global $conn;

    // Placeholder untuk status event berdasarkan tanggal
    $mendatang = 'mendatang';
    $selesai = 'selesai';

    // Query dengan 4 placeholder sesuai dengan kolom yang dicari
    $query = "SELECT users.nama AS nama, events.*, kategori.kategori 
              FROM events 
              JOIN users ON events.users_id = users.id 
              JOIN kategori ON events.kategori_id = kategori.id
              WHERE judul LIKE ? OR
                    kategori_id LIKE ? OR
                    nama LIKE ? OR
                    status LIKE ? OR
                    (CASE 
                        WHEN tanggal >= CURDATE() THEN 'mendatang'
                        ELSE 'selesai'
                     END) LIKE ?";

    // Siapkan pernyataan
    $stmt = $conn->prepare($query);

    // Pastikan keyword dicocokkan dengan semua placeholder
    $keyword = "%$keyword%";
    $stmt->bind_param("sssss", $keyword, $keyword, $keyword, $keyword, $keyword);

    // Eksekusi pernyataan
    $stmt->execute();

    // Ambil hasilnya
    $result = $stmt->get_result();

    // Kembalikan hasil sebagai array asosiatif
    return $result->fetch_all(MYSQLI_ASSOC);
}


function cari2($keyword)
{
    global $conn;

    // Query dengan 7 placeholder sesuai dengan kolom yang dicari
    $query = "SELECT * FROM users
    WHERE nama LIKE ? OR
          email LIKE ? OR
          role LIKE ?";

    // Siapkan pernyataan
    $stmt = $conn->prepare($query);

    // Pastikan keyword dicocokkan dengan semua placeholder
    $keyword = "%$keyword%";
    $stmt->bind_param("sss", $keyword, $keyword, $keyword);

    // Eksekusi pernyataan
    $stmt->execute();

    // Ambil hasilnya
    $result = $stmt->get_result();

    // Kembalikan hasil sebagai array asosiatif
    return $result->fetch_all(MYSQLI_ASSOC);
}

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

// function ubahProfil($data) {
//     global $conn;

//     // Pastikan user_id tersimpan dalam session
//     if (!isset($_SESSION['user_id'])) {
//         echo "<script>
//                 alert('User ID tidak ditemukan');
//               </script>";
//         return false;
//     }

//     $user_id = $_SESSION['user_id'];
//     $password1 = $data["password1"];
//     $password2 = $data["password2"];
//     $password3 = $data["password3"];

//     // Ambil data pengguna dari database
//     $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
//     $stmt->bind_param("i", $user_id);
//     $stmt->execute();
//     $result = $stmt->get_result();
//     $user = $result->fetch_assoc();

//     if (!$user) {
//         echo "<script>
//                 alert('Pengguna tidak ditemukan');
//               </script>";
//         return false;
//     }

//     // Periksa apakah password lama cocok
//     if (!password_verify($password1, $user['password1'])) {  // pastikan kolomnya adalah 'password'
//         echo "<script>
//                 alert('Password lama salah');
//               </script>";
//         return false;
//     }

//     // Periksa apakah password baru dan konfirmasi password cocok
//     if ($password2 !== $password3) {
//         echo "<script>
//                 alert('Konfirmasi password tidak cocok');
//               </script>";
//         return false;
//     }

//     // Enkripsi password baru
//     $password2_hashed = password_hash($password2, PASSWORD_DEFAULT);

//     // Update password baru ke dalam database
//     $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
//     $stmt->bind_param("si", $password2_hashed, $user_id);
//     $stmt->execute();

//     if ($stmt->affected_rows > 0) {
//         echo "<script>
//                 alert('Password berhasil diubah');
//               </script>";
//         return true;
//     } else {
//         echo "<script>
//                 alert('Gagal mengubah password');
//               </script>";
//         return false;
//     }
// }

function ubahProfil($data)
{
    global $conn;

    $id = $_GET["id"];
    $nama = htmlspecialchars($data["nama"]);
    $password1 = mysqli_real_escape_string($conn, $data["password1"]);

    $query = "UPDATE users SET
                nama= '$nama', password='$password1'
                WHERE id = $id
                ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// function ubahProfil($data) {
//     global $conn;

//     $id = $data["id"];
//     $nama = htmlspecialchars($data["nama"]);
//     $password1= $data["password1"];
//     $password2 = $data["password2"];
//     $password3= $data["password3"];

//     // Ambil data pengguna dari database
//     $result = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id'");
//     $user = mysqli_fetch_assoc($result);

//     // Periksa apakah password lama cocok
//     if (!password_verify($password1, $user['password'])) {
//         echo "<script>
//                 alert('Password lama salah');
//               </script>";
//         return false;
//     }

//     // Periksa apakah password baru dan konfirmasi password cocok
//     if ($password2!== $password3) {
//         echo "<script>
//                 alert('Konfirmasi password tidak cocok');
//               </script>";
//         return false;
//     }

//     // Enkripsi password baru
//     $password2 = password_hash($password2, PASSWORD_DEFAULT);

//     // Update nama dan password baru ke dalam database
//     $query = "UPDATE users SET nama = '$nama', password = '$password2' WHERE id = '$id'";
//     mysqli_query($conn, $query);

//     return mysqli_affected_rows($conn);
// }

function countActiveEvents()
{
    global $conn;
    $sql = "SELECT COUNT(*) as count FROM events WHERE status = 'disetujui'";
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
    $sql = "SELECT COUNT(*) as count FROM users";
    $result = $conn->query($sql);
    $count = $result->fetch_assoc()['count'];
    return $count;
}
