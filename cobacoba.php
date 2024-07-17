<?php
include 'function.php';
session_start();

if (isset($_POST["register"])) {
  if (registrasi($_POST) > 0) {
    echo "<script>
        alert('user baru berhasil ditambahkan!');
        </script>";
    header("location:login.php");
  } else {
    echo mysqli_error($conn);
  }
}
// Cek apakah ada flashdata
$flash = isset($_SESSION['flash']) ? $_SESSION['flash'] : null;
unset($_SESSION['flash']); // Hapus flashdata setelah ditampilkan
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Deskripsi Singkat</title>
  <!-- Tailwind CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
  <div class="flex flex-nowrap justify-center mx-40 gap-96">
    <div class="flex flex-wrap list-none">
      <div class="flex hover:text-[#756AB6] font-semibold">
        <a href="index.php">
          <i class="ti ti-home-filled pr-2"></i>Beranda</a>
      </div>
      <span class="mx-2">/</span>
      <li class="text-[#756AB6] font-semibold">Daftar</li>
    </div>
    <div class=" w-2/12 h-full shadow-xl bg-slate-400 flex justify-center">
      <p class="text-center">hfhgfhgfh</p>
    </div>
    <div class="">gtrg</div>
  </div>
  <div class="flex justify-center gap-80">
    <div class="flex-none w-14 h-14 ...">
      01
    </div>
    <div class=" hidden grow w-40 h-14 shadow-xl bg-slate-400">
      02
    </div>
    <div class="flex-none w-14 h-14 ...">
      03
    </div>
  </div>

</body>

</html>