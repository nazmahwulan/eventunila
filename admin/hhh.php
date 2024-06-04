<?php
include '../function.php';

$kategori = query("SELECT *FROM kategori");


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/2eb34c602e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
</head>

<body>

    <form action="" method="post" class="">
        <input type="text" class="" name="keyword" placeholder="Cari Event" autocomplete="off">
        <button type="submit" name="cari" class=""></button>
    </form>
    <div class="flex-1">
        <div class="relative">
            <label for="kategori_id" class="block pl-10 py-2 text-white font-bold text-sm">Kategori</label>
            <div class="pl-10 flex justify-start">
                <input id="kategoriDropdownInput" type="text" class="px-4 w-full h-10 bg-white shadow-2xl rounded-xl border-2 border-[#756AB6] form-control" name="kategori_id" aria-describedby="kategoriHelp" required placeholder="Pilih Kategori" readonly>
            </div>
            <div id="kategoriDropdownMenu" class="hidden absolute left-0 right-0 mt-1 w-full rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                <ul class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="kategoriDropdownInput">
                    <?php foreach ($kategori as $row) : ?>
                        <li><button type="button" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"><?php echo $row["kategori"]; ?></button></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- <script>
    // JavaScript untuk menangani pembukaan dan penutupan dropdown
    document.getElementById('kategoriDropdownInput').addEventListener('click', function() {
        var dropdownMenu = document.getElementById('kategoriDropdownMenu');
        dropdownMenu.classList.toggle('hidden');
    });

    // Menyembunyikan dropdown jika klik di luar dropdown
    document.addEventListener('click', function(event) {
        var dropdownMenu = document.getElementById('kategoriDropdownMenu');
        var input = document.getElementById('kategoriDropdownInput');
        if (!input.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });
</script> -->

    <script src="../script.js"></script>

</body>