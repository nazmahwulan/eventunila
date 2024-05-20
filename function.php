<?php
$conn = mysqli_connect("localhost", "root", "", "event");


function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $row = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
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

// function getLoggedInUserID() {
//     if(isset($_SESSION['userID'])) {
//         return $_SESSION['userID'];
//     } else {
//         // Pengguna belum login atau sesi tidak ada
//         return null;
//     }
// }
// function getUserId($conn, $usersID) {
//     $result = mysqli_query($conn, "SELECT userID FROM users WHERE id = '$usersID'");
//     $row = mysqli_fetch_assoc($result);
//     return $row['userID'];
// }

// function getKategoriId($conn, $kategoriID) {
//     $result = mysqli_query($conn, "SELECT kategoriID FROM kategori WHERE id = '$kategoriID'");
//     $row = mysqli_fetch_assoc($result);
//     return $row['kategoriID'];
// }

function pengajuan($data)
{
    global $conn;

    $user_id = htmlspecialchars($data["users_id"]);
    $judul = htmlspecialchars($data["judul"]);
    $kategori_id = htmlspecialchars($data["kategori_id"]);
    $lokasi = htmlspecialchars($data["lokasi"]);
    $tanggal = htmlspecialchars($data["tanggal"]);
    $waktu = htmlspecialchars($data["waktu"]);
    $link_pendaftaran = htmlspecialchars($data["link_pendaftaran"]);
    $penyelenggara = htmlspecialchars($data["penyelenggara"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);

    //upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    // Mendapatkan nilai userID dan kategori_idID dari tabel masing-masing
    // $userID = getLoggedInUserID($conn, $usersID);
    // $kategori_idID = getkategori_idId($conn, $kategori_idID);

    // Tentukan nilai default untuk kolom acc
    $acc = "0";

    //tambahkan user baru ke dalam database
    mysqli_query($conn, "INSERT INTO event VALUES ('', '$user_id', '$judul', '$kategori_id', '$lokasi', '$tanggal', '$waktu', 
                '$link_pendaftaran', '$deskripsi', '$penyelenggara', '$acc'
                '$gambar') ");
    return mysqli_affected_rows($conn);
}


function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    //cek apakah ada gambar yg diupload
    if ($error === 4) {
        echo "<script>
        alert('pilih gambar terlebih dahulu');
        </script>";
        return false;
    }

    //cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
        alert('Yang anda upload bukan gambar');
        </script>";
        return false;
    }

    //jika ukurannya terlalu besar
    if ($ukuranFile > 1000000) {
        echo "<script>
        alert('ukuran gambar terlalu besar');
        </script>";
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
                ('', '$kategori')
                ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus ($id){
    global $conn;

    mysqli_query($conn, "DELETE FROM kategori WHERE id =$id");
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
