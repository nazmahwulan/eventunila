<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
</head>

<body>
    <div class="bg-gradient-to-r from-[#AC87C5] to-[#E0AED0]">
        <div class="items-center flex px-28 py-6 justify-between">
            <a class="text-white text-4xl font-bold" href="index.php">EventUnila</a>
            <div class="flex gap-4">
            <form action="halamanevent.php" method="post" class="flex items-center">
                    <input type="text" class="block px-4 w-96 mx-auto h-10  rounded-l-xl" name="keyword" placeholder="Cari Event" value="<?php echo isset($_POST['keyword']) ? htmlspecialchars($_POST['keyword']) : ''; ?>" autocomplete="off" required>
                    <button type="submit" name="cari3" class="ti ti-search text-white px-2 w-10 h-10 rounded-r-xl bg-[#AC87C5]">
                    </button>
                </form>
                
                <?php
                session_start(); // Mulai sesi
                if (isset($_SESSION['nama'])) {
                    // Jika sesi nama telah diatur, artinya pengguna sudah login
                ?>
                    <div class="relative">
                        <button id="dropdownButton" class="flex items-center space-x-2">
                            <i class="ti ti-user-circle ps-2 text-white text-4xl"></i>
                        </button>
                        <div id="navbarDropdownMenu" class="absolute hidden top-100 right-[-10px] w-[320px] bg-white p-[20px] m-[10px] rounded-xl">
                            <div class="flex">
                                <i class="mr-[15px] ti ti-user-circle text-[#AC87C5] text-4xl"></i>
                                <div class="flex items-center"><?= $_SESSION['nama'] ?></div>
                            </div>
                            <hr class="border-0 h-[1px] w-full bg-[#AC87C5] mt-[15px] mb-[10px]">
                            <a class="flex items-center mt-[12px]" href="profilsaya.php?id=<?php echo $_SESSION["users_id"]; ?>">
                                <p class="text-[#AC87C5]">Profil Saya</p>
                            </a>
                            <a class="flex items-center mt-[12px]" href="eventsaya.php?id=<?php echo $_SESSION["users_id"]; ?>">
                                <p class="text-[#AC87C5]">Event Saya</p>
                            </a>
                            <hr class="border-0 h-[1px] w-full bg-[#AC87C5] mt-[15px] mb-[10px]">
                            <a class="flex items-center mt-[12px]" href="logout.php">
                                <p class="text-red-600 font-bold">Log Out</p>
                            </a>
                        </div>
                    </div>
                <?php
                } else {
                    // Jika sesi nama belum diatur, artinya pengguna belum login
                ?>
                    <div class="mx-auto rounded-xl w-24 h-10 border-2 border-white hover:bg-[#E0AED0]">
                        <div class="text-center text-white text-sm font-bold pt-[8px]">
                            <a href="register.php">Daftar</a>
                        </div>
                    </div>
                    <div class="mx-auto rounded-xl w-24 h-10 border-2 border-white hover:bg-[#E0AED0]">
                        <div class="text-center text-white text-sm font-bold pt-[8px]">
                            <a href="login.php">Masuk</a>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>


    <!-- <div class="bg-gradient-to-r from-[#AC87C5] to-[#E0AED0]">
    <div class="flex items-center px-28 py-6 justify-between">
        <a class="text-white text-4xl font-bold" href="index.php">EventUnila</a>
        <div class="flex-grow mx-8">
            <form action="halamanevent.php" method="post" class="flex items-center w-full">
                <input type="text" class="block w-full px-4 h-10 rounded-l-xl" name="keyword" placeholder="Cari Event" value="<?php echo isset($_POST['keyword']) ? htmlspecialchars($_POST['keyword']) : ''; ?>" autocomplete="off" required>
                <button type="submit" name="cari3" class="ti ti-search text-white px-2 w-10 h-10 rounded-r-xl bg-[#AC87C5]"></button>
            </form>
        </div>
        <div class="flex items-center gap-4">
            <?php
            session_start(); // Mulai sesi
            if (isset($_SESSION['nama'])) {
                // Jika sesi nama telah diatur, artinya pengguna sudah login
            ?>
                <div class="relative">
                    <button id="dropdownButton" class="flex items-center space-x-2">
                        <i class="ti ti-user-circle ps-2 text-white text-4xl"></i>
                    </button>
                    <div id="navbarDropdownMenu" class="absolute hidden top-100 right-[-10px] w-[320px] bg-white p-[20px] m-[10px] rounded-xl">
                        <div class="flex">
                            <i class="mr-[15px] ti ti-user-circle text-[#AC87C5] text-4xl"></i>
                            <div class="flex items-center"><?= $_SESSION['nama'] ?></div>
                        </div>
                        <hr class="border-0 h-[1px] w-full bg-[#AC87C5] mt-[15px] mb-[10px]">
                        <a class="flex items-center mt-[12px]" href="profilsaya.php?id=<?php echo $_SESSION["users_id"]; ?>">
                            <p class="text-[#AC87C5]">Profil Saya</p>
                        </a>
                        <a class="flex items-center mt-[12px]" href="eventsaya.php?id=<?php echo $_SESSION["users_id"]; ?>">
                            <p class="text-[#AC87C5]">Event Saya</p>
                        </a>
                        <hr class="border-0 h-[1px] w-full bg-[#AC87C5] mt-[15px] mb-[10px]">
                        <a class="flex items-center mt-[12px]" href="logout.php">
                            <p class="text-red-600 font-bold">Log Out</p>
                        </a>
                    </div>
                </div>
            <?php
            } else {
                // Jika sesi nama belum diatur, artinya pengguna belum login
            ?>
                <div class="mx-auto rounded-xl w-24 h-10 border-2 border-white hover:bg-[#E0AED0]">
                    <div class="text-center text-white text-sm font-bold pt-[8px]">
                        <a href="register.php">Daftar</a>
                    </div>
                </div>
                <div class="mx-auto rounded-xl w-24 h-10 border-2 border-white hover:bg-[#E0AED0]">
                    <div class="text-center text-white text-sm font-bold pt-[8px]">
                        <a href="login.php">Masuk</a>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div> -->

</body>

</html>