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
                <a class="nav-link gap-3 px-10 py-2.5 my-1 text-base flex items-center text-[#AC87C5] hover:w-11/12 hover:rounded-r-full hover:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5]  active:w-11/12 active:rounded-r-full active:bg-gradient-to-b from-[#AC87C5] via-[#E0AED0] to-[#FFE5E5] group" href="/event/admin/keluar/index.php">
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
            <h1 class="text-white font-bold text-4xl py-6 ">Event</h1>
            <div class="flex justify-center">
                <hr class="border-white border-1 w-[1050px]">
            </div>
            <h2 class="text-white font-bold text-4xl flex justify-center py-6">Daftar Event</h2>

            <!-- <table class="mx-auto mt-10 bg-red-500 rounded-lg">
                <thead class="bg-gray-100 rounded-lg ">
                    <tr>
                        <th class="px-6 py-3 text-left font-medium text-gray-700 uppercase tracking-wider">Header 1</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-700 uppercase tracking-wider">Header 2</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-700 uppercase tracking-wider">Header 3</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">Data 1</td>
                        <td class="px-6 py-4 whitespace-nowrap">Data 2</td>
                        <td class="px-6 py-4 whitespace-nowrap">Data 3</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">Data 4</td>
                        <td class="px-6 py-4 whitespace-nowrap">Data 5</td>
                        <td class="px-6 py-4 whitespace-nowrap">Data 6</td>
                    </tr> -->
                    <div class="bg-white rounded-xl shadow-xl w-[1000px] h-3/5 mx-6">
                        <div class="flex justify-end pr-6 pt-6">
                            <div class="bg-gradient-to-b from-[#AC87C5] to-[#E0AED0] rounded-full w-44 h-10 ">
                                <div class="text-center pt-[6px] ">
                                    <a class="text-white gap-2 text-base flex justify-center" href="">
                                        <i class="ti ti-circle-plus text-xl"></i><span>Tambah Event</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="m-4 p-4">
                            <table class="w-full">
                                <thead class="w-full">
                                    <tr class="border border-solid border-l-0 border-r-0 ">
                                        <th class="px-4 py-2">#</th>
                                        <th class="px-4 py-2">Kategori</th>
                                        <th class="px-4 py-2">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="w-full">
                                        <td class="px-4 py-2">1</td>
                                        <td class="px-4 py-2">Malcolm Lockyer</td>
                                        <td class="px-4 py-2">
                                            <div class="flex gap-2">
                                                <div class="bg-gradient-to-b from-[#AC87C5] to-[#E0AED0] rounded-full w-24 h-8"></div>
                                                <div class="bg-gradient-to-b from-[#AC87C5] to-[#E0AED0] rounded-full w-24 h-8"></div>
                                                <div class="bg-gradient-to-b from-[#AC87C5] to-[#E0AED0] rounded-full w-24 h-8"></div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
        </div>
    </div>
    </div>

    <script src="../../script.js"></script>


</body>

</html>