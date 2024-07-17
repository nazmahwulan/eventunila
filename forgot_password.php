<?php
session_start();

if (isset($_SESSION["login"])) {
    header("location:index.php");
    exit;
}

// // Cek apakah ada flashdata
$flash = isset($_SESSION['flash']) ? $_SESSION['flash'] : null;
unset($_SESSION['flash']); // Hapus flashdata setelah ditampilkan
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />

</head>

<body>
    <div class="bg-gray-100 min-h-screen flex flex-col justify-center items-center relative">
        <?php if ($flash) : ?>
            <div id="flash-message" class="absolute top-0 left-0 right-0 flex justify-center items-center py-4 z-50">
                <div class="flex items-center px-4 py-2 rounded-xl bg-white shadow-xl text-black font-semibold">
                    <?php if ($flash['type'] == 'success') : ?>
                        <i class="ti ti-circle-check-filled text-2xl text-[#9BCF53] mr-2"></i>
                    <?php elseif ($flash['type'] == 'error') : ?>
                        <i class="ti ti-circle-x-filled text-2xl text-[#FF0000] mr-2"></i>
                    <?php endif; ?>
                    <div class="text-center">
                        <?php echo $flash['message']; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="flex items-center justify-center w-full">
            <div class="bg-white p-8 rounded-xl shadow-md w-96">
                <h2 class="text-2xl font-bold mb-6 text-center">Lupa Kata Sandi</h2>
                <form action="send_reset_link.php" method="post">
                    <label for="email" class="block text-sm font-bold text-gray-500 my-2">Email</label>
                    <input type="email" id="email" name="email" required class="mt-1 mb-4 block w-full h-10 px-3 py-2 border-2 border-[#AC87C5] rounded-xl focus:outline-none focus:[#756AB6] focus:border-[#756AB6]">
                    <button type="submit" class="w-full h-10 font-bold text-sm bg-[#AC87C5] text-white py-2 rounded-xl hover:bg-[#756AB6]">Kirim Link Reset</button>
                </form>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>