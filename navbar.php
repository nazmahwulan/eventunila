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
    <div class="bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] w-full ">
        <div class="items-center flex mx-10 lg:mx-28 py-6 justify-between">
            <a id="navbarTitle" class="text-white text-2xl md:text-4xl font-bold" href="index.php">EventUnila</a>
            <div class="flex gap-4 items-center md:gap-0">
                <button id="searchDropdownButton" class="text-2xl text-white">
                    <i id="searchIcon" class="ti ti-search sm:hidden"></i>
                </button>
                <div id="searchDropdownMenu" class="hidden absolute right-0 md:right-0 w-[420px] bg-gradient-to-r from-[#AC87C5] to-[#E0AED0]">
                    <form action="halamanevent.php" method="post" class="flex items-center p-5 w-full">
                        <button type="button" id="closeSearchButton" class="text-white font-bold text-2xl mr-4">
                            <i class="ti ti-chevron-left"></i>
                        </button>
                        <input type="text" class="block w-full h-10 px-4 border border-gray-300 rounded-l-xl focus:outline-none focus:ring-2 focus:ring-purple-500" name="keyword" placeholder="Cari Event" value="<?php echo isset($_POST['keyword']) ? htmlspecialchars($_POST['keyword']) : ''; ?>" autocomplete="off">
                        <button type="submit" name="cari3" class="text-white w-10 h-10 rounded-r-xl bg-[#AC87C5] flex items-center justify-center">
                            <i class="ti ti-search"></i>
                        </button>
                    </form>
                </div>
                <form action="halamanevent.php" method="post" class="hidden sm:flex">
                    <input type="text" class="block px-4 w-60 h-10  rounded-l-xl" name="keyword" placeholder="Cari Event" value="<?php echo isset($_POST['keyword']) ? htmlspecialchars($_POST['keyword']) : ''; ?>" autocomplete="off">
                    <button type="submit" name="cari3" class="ti ti-search  text-white px-2 w-10 h-10 rounded-r-xl bg-[#AC87C5]">
                    </button>
                </form>
                <div id="navbarIcons" class="flex items-center">
                    <!-- Konten Navbar lainnya -->
                    <?php
                    session_start(); // Mulai sesi

                    if (isset($_COOKIE['login'])){
                        if($_COOKIE['login'] == 'true') {
                            $_SESSION['login'] = true;
                        }
                    }

                    if (isset($_SESSION['nama'])) {
                        // Jika sesi nama telah diatur, artinya pengguna sudah login
                    ?>
                        <div class="relative md:mt-0 ml-0 md:ml-4 z-50">
                            <button id="dropdownButton" class="flex items-center space-x-2">
                                <i class="ti ti-user-circle ps-2 text-white text-3xl md:text-4xl"></i>
                            </button>
                            <div id="navbarDropdownMenu" class="absolute hidden border-2 border-[#AC87C5] top-[50px] md:top-[55px] right-[-10px] md:right-[-20px] w-[350px] bg-white p-[20px] m-[10px] rounded-xl">
                                <div class="flex items-center mx-2 gap-5">
                                    <i class="ti ti-user-circle text-[#AC87C5] text-4xl "></i>
                                    <div class="flex items-center font-semibold"><?= ucwords(strtolower($_SESSION['nama'])) ?></div>
                                </div>
                                <hr class="border-0 h-[1px] w-full bg-[#AC87C5] mt-[15px] mb-[10px]">
                                <a class="flex items-center mx-4 gap-7" href="profilesaya.php?id=<?php echo $_SESSION["users_id"]; ?>">
                                    <i class="text-xl ti ti-user text-[#AC87C5]"></i> <span class="text-[#AC87C5] font-semibold">Profile</span>
                                    <!-- <p class="text-[#AC87C5] font-semibold">Profil Saya</p> -->
                                </a>
                                <a class="flex items-center mx-4 gap-7 mt-[12px] "href="eventsaya.php?id=<?php echo $_SESSION["users_id"]; ?>">
                                    <i class="text-xl ti ti-calendar-event   text-[#AC87C5]"></i> <span class="text-[#AC87C5] font-semibold">Event Saya</span>
                                    <!-- <p class="text-[#AC87C5] font-semibold">Profil Saya</p> -->
                                </a>
                                <!-- <a class="flex items-center mt-[12px]" href="eventsaya.php?id=<?php echo $_SESSION["users_id"]; ?>">
                                    <p class="text-[#AC87C5] font-semibold">Event Saya</p>
                                </a> -->
                                <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') : ?>
                                    <!-- <hr class="border-0 h-[1px] w-full bg-[#AC87C5] mt-[15px] mb-[10px]"> -->
                                    <a class="flex items-center mx-4 gap-7 mt-[12px]" href="admin/beranda.php">
                                    <i class="text-xl ti ti-arrows-exchange  text-[#AC87C5]"></i> <span class="text-[#AC87C5] font-semibold">Dashboard Admin</span>
                                        <!-- <p class="text-[#AC87C5] font-semibold">Beralih ke Dashboard Admin</p> -->
                                    </a>
                                <?php endif; ?>
                                <hr class="border-0 h-[1px] w-full bg-[#AC87C5] mt-[15px] mb-[10px]">
                                <a class="flex items-center mx-4 gap-7 mt-[12px]" href="logout.php">
                                <i class=" text-xl ti ti-logout  text-red-600"></i> <span class="text-red-600 font-semibold">Keluar</span>
                                    <!-- <p class="text-red-600 font-bold">Keluar</p> -->
                                </a>
                            </div>
                        </div>
                    <?php
                    } else {
                        // Jika sesi nama belum diatur, artinya pengguna belum login
                    ?>
                        <div class="relative md:mt-0 md:ml-4 z-50">
                            <button id="dropdownButton" class="flex items-center sm:hidden">
                                <i id="dropdownIcon" class="ti ti-baseline-density-medium text-white text-2xl"></i>
                            </button>
                            <div id="navbarDropdownMenu" class="absolute hidden right-[-23px] w-[380px] h-[115px] top-[20px] border-2 border-[#AC87C5] bg-white mt-10 rounded-xl">
                                <p class="text-sm font-bold text-[#AC87C5] flex justify-start mx-5 mt-4">Masuk Ke Akunmu</p>
                                <div class="flex items-center justify-center gap-6 mt-4">
                                    <div class="rounded-xl w-40 h-10 border-2 border-[#AC87C5] hover:bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] hover:border-none group">
                                        <div class="text-center text-[#AC87C5] text-sm font-bold pt-[8px] group-hover:text-white">
                                            <a href="register.php">Daftar</a>
                                        </div>
                                    </div>
                                    <div class="rounded-xl w-40 h-10 bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] hover:bg-none hover:border-2 hover:border-[#AC87C5] group">
                                        <div class="text-center text-white text-sm font-bold pt-[8px] group-hover:text-[#AC87C5]">
                                            <a href="login.php">Masuk</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hidden sm:flex gap-4">
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
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('searchDropdownButton').addEventListener('click', function() {
            const searchDropdownMenu = document.getElementById('searchDropdownMenu');
            const navbarTitle = document.getElementById('navbarTitle');
            const navbarIcons = document.getElementById('navbarIcons');
            const searchIcon = document.getElementById('searchIcon');

            if (searchDropdownMenu.classList.contains('hidden')) {
                // Show search input, hide title and icons
                searchDropdownMenu.classList.remove('hidden');
                navbarTitle.classList.add('hidden');
                navbarIcons.classList.add('hidden');
                searchIcon.classList.remove('ti-search');
                searchIcon.classList.add('ti-chevron-left');
            } else {
                // Hide search input, show title and icons
                searchDropdownMenu.classList.add('hidden');
                navbarTitle.classList.remove('hidden');
                navbarIcons.classList.remove('hidden');
                searchIcon.classList.remove('ti-chevron-left');
                searchIcon.classList.add('ti-search');
            }
        });

        document.getElementById('closeSearchButton').addEventListener('click', function() {
            const searchDropdownMenu = document.getElementById('searchDropdownMenu');
            const navbarTitle = document.getElementById('navbarTitle');
            const navbarIcons = document.getElementById('navbarIcons');
            const searchIcon = document.getElementById('searchIcon');

            // Hide search input, show title and icons
            searchDropdownMenu.classList.add('hidden');
            navbarTitle.classList.remove('hidden');
            navbarIcons.classList.remove('hidden');
            searchIcon.classList.remove('ti-chevron-left');
            searchIcon.classList.add('ti-search');
        });

        // Optional: Close the search menu when clicking outside of it
        document.addEventListener('click', function(event) {
            const searchButton = document.getElementById('searchDropdownButton');
            const searchDropdownMenu = document.getElementById('searchDropdownMenu');
            const navbarTitle = document.getElementById('navbarTitle');
            const navbarIcons = document.getElementById('navbarIcons');
            const searchIcon = document.getElementById('searchIcon');

            if (!searchDropdownMenu.contains(event.target) && !searchButton.contains(event.target)) {
                searchDropdownMenu.classList.add('hidden');
                navbarTitle.classList.remove('hidden');
                navbarIcons.classList.remove('hidden');
                searchIcon.classList.remove('ti-chevron-left');
                searchIcon.classList.add('ti-search');
            }
        });

        document.getElementById('dropdownButton').addEventListener('click', function() {
            const dropdownMenu = document.getElementById('navbarDropdownMenu');
            const dropdownIcon = document.getElementById('dropdownIcon');

            dropdownMenu.classList.toggle('hidden');

            if (dropdownMenu.classList.contains('hidden')) {
                dropdownIcon.classList.remove('ti-x');
                dropdownIcon.classList.add('ti-baseline-density-medium');
            } else {
                dropdownIcon.classList.remove('ti-baseline-density-medium');
                dropdownIcon.classList.add('ti-x');
            }
        });
    </script>
    <script src="script.js"></script>

</body>

</html>