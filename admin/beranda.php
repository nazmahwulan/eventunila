<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
</head>

<body>
    <div class="flex p-5 gap-4 bg-gradient-to-r from-[#AC87C5] to-[#E0AED0]">
        <div class="bg-white shadow-xl w-1/5 h-full rounded-xl">
            <a class="text-[#AC87C5] font-bold text-4xl py-6 flex justify-center" href="index.php">EventUnila</a>
            <nav class=" w-full flex flex-col ">
		<a class="nav-link gap-3 px-10 py-2.5 my-1 text-base flex items-center text-[#AC87C5] hover:w-11/12 hover:rounded-r-full hover:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5] active:w-11/12 active:rounded-r-full active:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5] group" href="/event/admin/beranda.php">
			<i class="ti ti-dashboard ps-2 text-2xl group-hover:text-white group-active:text-white"></i><span class="group-hover:text-white group-active:text-white">Beranda</span>
		</a>
		<a class="nav-link gap-3 px-10 py-2.5 my-1 text-base flex items-center text-[#AC87C5] hover:w-11/12 hover:rounded-r-full hover:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5] active:w-11/12 active:rounded-r-full active:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5] group" href="/event/admin/event/index.php">
			<i class="ti ti-calendar-event  ps-2 text-2xl group-hover:text-white group-active:text-white"></i> <span class="group-hover:text-white group-active:text-white">Event</span>
		</a>
		<a class="nav-link gap-3 px-10 py-2.5 my-1 text-base flex items-center text-[#AC87C5] hover:w-11/12 hover:rounded-r-full hover:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5]  active:w-11/12 active:rounded-r-full active:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5] group" href="/event/admin/kategori/index.php">
			<i class="ti ti-category ps-2 text-2xl group-hover:text-white group-active:text-white"></i><span class="group-hover:text-white group-active:text-white">Kategori</span>
		</a>
		<a class="nav-link gap-3 px-10 py-2.5 my-1 text-base flex items-center text-[#AC87C5] hover:w-11/12 hover:rounded-r-full hover:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5]  active:w-11/12 active:rounded-r-full active:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5] group" href="/event/admin/pengguna/index.php">
			<i class="ti ti-users ps-2 text-2xl group-hover:text-white group-active:text-white"></i><span class="group-hover:text-white group-active:text-white">Pengguna</span>
		</a>
		<a class="nav-link gap-3 px-10 py-2.5 my-1 text-base flex items-center text-[#AC87C5] hover:w-11/12 hover:rounded-r-full hover:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5]  active:w-11/12 active:rounded-r-full active:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5] group" href="logout.php">
			<i class="ti ti-logout ps-2 text-2xl group-hover:text-white group-active:text-white"></i><span class="group-hover:text-white group-active:text-white">Keluar</span>
		</a>
	</nav>

            <div class="px-12 mt-40 mb-10">
                <hr class="border-[#AC87C5] border-1 mb-8">
                <i class="ti ti-user-circle ps-2  text-[#AC87C5] text-4xl"></i>
                <p class="text-[#AC87C5] text-base font-bold mt-2">Nazmah Wulan</p>
            </div>
        </div>

        <div class="">
            <h1 class="text-white font-bold text-4xl py-6 ">Beranda</h1>
            <div class="flex justify-center">
                <hr class="border-white border-1 w-[1050px]">
            </div>
            <div class="flex mt-10 gap-3 mb-10">
                <div class="bg-white rounded-xl shadow-xl w-72 h-32 ml-6 ">
                    <div class="flex gap-6 justify-center">
                        <i class="ti ti-calendar-event mt-7 ml-[-15px] text-6xl text-[#AC87C5]"></i>
                        <h1 class="text-[#AC87C5] text-lg font-bold mt-6">Jumlah Event
                            <p class="flex justify-center text-4xl">10</p>
                        </h1>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-xl w-72 h-32 ml-6 ">
                    <div class="flex gap-6 justify-center">
                        <i class="ti ti-category mt-7 ml-[-15px] text-6xl text-[#AC87C5] "></i><span>
                            <h1 class="text-[#AC87C5] text-lg font-bold mt-6">Jumlah Kategori
                                <p class="flex justify-center text-4xl">10</p>
                            </h1>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-xl w-72 h-32 ml-6 ">
                    <div class="flex gap-6 justify-center">
                        <i class="ti ti-users mt-7 ml-[-15px] text-6xl text-[#AC87C5] "></i><span>
                            <h1 class="text-[#AC87C5] text-lg font-bold mt-6">Jumlah Pengguna
                                <p class="flex justify-center text-4xl">10</p>
                            </h1>
                    </div>
                </div>
            </div>
            <div class="flex mt-10 gap-3 mb-10">
                <div class="bg-white rounded-xl shadow-xl w-72 h-32 ml-6 ">
                    <div class="flex gap-6 justify-center">
                        <i class="ti ti-calendar-event mt-7 ml-[-15px] text-6xl text-[#AC87C5]"></i>
                        <h1 class="text-[#AC87C5] text-lg font-bold mt-6">Jumlah Event
                            <p class="flex justify-center text-4xl">10</p>
                        </h1>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-xl w-72 h-32 ml-6 ">
                    <div class="flex gap-6 justify-center">
                        <i class="ti ti-category mt-7 ml-[-15px] text-6xl text-[#AC87C5] "></i><span>
                            <h1 class="text-[#AC87C5] text-lg font-bold mt-6">Jumlah Kategori
                                <p class="flex justify-center text-4xl">10</p>
                            </h1>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-xl w-72 h-32 ml-6 ">
                    <div class="flex gap-6 justify-center">
                        <i class="ti ti-category mt-7 ml-[-15px] text-6xl text-[#AC87C5] "></i><span>
                            <h1 class="text-[#AC87C5] text-lg font-bold mt-6">Jumlah Kategori
                                <p class="flex justify-center text-4xl">10</p>
                            </h1>
                    </div>
                </div>
            </div>
        </div>


    </div>




    <script src="../script.js"></script>


</body>

</html>