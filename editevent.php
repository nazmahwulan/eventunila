<?php
ob_start(); // Memulai output buffering
// include 'navbar.php';
include 'function.php';

// if (!isset($_SESSION["login"])) {
//     header("location:login.php");
//     exit;
// }

// Periksa apakah parameter ID ada dan valid
if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = intval($_GET["id"]);
    // Query data pengguna berdasarkan ID
    $events = query("SELECT events.*, kategori.kategori 
    FROM events 
    JOIN kategori ON events.kategori_id = kategori.id 
    WHERE events.event_id = $id");
    // Periksa apakah pengguna ditemukan
    if (count($events) === 0) {
        $isValidEvent = false;
    } else {
        // Ambil data pengguna jika ada
        $event = $events[0];
        $isValidEvent = true;
        // $hashedPassword = $user["password"];

        // // Menampilkan hanya sebagian dari hashed password, misalnya 3 karakter pertama dan 3 karakter terakhir
        // $shortPassword = substr($hashedPassword, 0, 3) . '...' . substr($hashedPassword, -3);
    }
    // } else {
    //     // Jika tidak ada ID atau ID tidak valid, sertakan halaman error
    //     include 'error.php';
    //     exit;
}

// // ambil data di URL
// if (isset($_GET["id"])) {
//     $id = $_GET["id"];
//     // query data event berdasarkan id
//     $event = query("SELECT events.*, kategori.kategori 
//     FROM events 
//     JOIN kategori ON events.kategori_id = kategori.id 
//     WHERE events.event_id = $id")[0];
// } else {
//     // jika tidak ada id, redirect ke halaman lain atau tampilkan pesan error
//     header('Location: /event/index.php');
//     exit;
// }

$kategori = query("SELECT * FROM kategori");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <style>
        .ql-container {
            height: 200px;
            border: none !important;
            /* Hilangkan border default Quill */
        }

        .ql-toolbar {
            border: none !important;
            /* Hilangkan border default Quill */
        }

        .ql-editor {
            min-height: 200px;
            /* Atur tinggi minimum sesuai kebutuhan */
        }
    </style>
</head>

<body>
<?php if (isset($isValidEvent) && $isValidEvent) : ?>
    <?php
        ob_start(); // Memulai buffer output
        include 'navbar.php';

        // session_start();

        // Periksa apakah pengguna sudah login
        if (!isset($_SESSION["login"])) {
            header("Location: login.php");
            exit;
        }

        // cek apakah tombol submit sudah ditekan apa belum
        // Contoh penggunaan fungsi ubah3
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = ubah3($_POST);
            if ($result === 'success') {
                // Set flashdata untuk sukses
                $_SESSION['flash'] = [
                    'message' => 'Event berhasil diubah!',
                    'type' => 'success'
                ];
            } elseif ($result === 'no_change') {
                // Set flashdata untuk tidak ada perubahan
                $_SESSION['flash'] = [
                    'message' => 'Tidak ada perubahan yang dilakukan pada event.',
                    'type' => 'error'
                ];
            } elseif ($result === 'category_error') {
                // Set flashdata untuk error kategori tidak ditemukan
                $_SESSION['flash'] = [
                    'message' => 'Kategori tidak ditemukan',
                    'type' => 'error'
                ];
            } elseif ($result === 'update_error') {
                // Set flashdata untuk error update
                $_SESSION['flash'] = [
                    'message' => 'Event gagal diubah!',
                    'type' => 'error'
                ];
            }
            // Redirect ke halaman yang sama dengan id
            header('Location: editevent.php?id=' . $_POST['id']);
            exit;
        }

        // Cek apakah ada flashdata
        $flash = isset($_SESSION['flash']) ? $_SESSION['flash'] : null;
        unset($_SESSION['flash']); // Hapus flashdata setelah ditampilkan
        ob_end_flush(); // Mengakhiri output buffering dan mengirimkan output
        ?>
        <div class="flex flex-wrap list-none mx-14 my-5 lg:mx-32 ">
            <div class="flex hover:text-[#756AB6] font-semibold">
                <a href="index.php">
                    <i class="ti ti-home-filled pr-2"></i>Home</a>
            </div>
            <span class="mx-2">/</span>
            <div class="flex hover:text-[#756AB6] font-semibold">
                <a href="eventsaya.php?id=<?php echo $_SESSION["users_id"]; ?>">Event Saya</a>
            </div>
            <span class="mx-2">/</span>
            <li class="text-[#756AB6] font-semibold">Edit Event</li>
        </div>

        <?php if ($flash) : ?>
            <div id="flash-message" class="flex justify-center items-center my-4">
                <div class="flex items-center px-4 py-2 rounded-xl bg-white border-2 border-[#AC87C5]  text-black font-semibold">
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

        <form action="" method="post" enctype="multipart/form-data" id="eventForm">
            <input type="hidden" name="id" value="<?php echo $event["event_id"]; ?> ">
            <div class="flex flex-col">
                <div class="mx-auto rounded-t-xl w-[340px] md:w-[740px] lg:w-[900px] h-[200px] md:h-[400px] border-2 border-[#AC87C5] overflow-hidden relative flex flex-col justify-center items-center">
                    <input type="file" name="gambar" id="gambar" class="hidden">
                    <input type="hidden" name="gambar_lama" id="gambar_lama" value="<?php echo $event['gambar']; ?>">
                    <label for="gambar" id="upload-label" class="flex flex-col items-center justify-center w-full h-full cursor-pointer text-center text-sm font-bold text-[#AC87C5] " required>
                        <img id="box" src="" alt="Preview Gambar" class="w-full h-full object-cover hidden">
                    </label>
                </div>
                <div class="bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] mx-auto rounded-b-xl w-[340px] md:w-[740px] lg:w-[900px] md:h-[800px] h-[750px]">
                    <label for="judul" class="block mx-4 md:mx-8 lg:mx-10 my-2 text-white font-bold text-sm">Nama Event</label>
                    <div class="flex justify-center">
                        <input type="text" class="px-4 w-11/12 h-10 bg-white  rounded-xl border-2 border-[#756AB6] form-control" name="judul" id="judul" aria-describedby="eventHelp" require placeholder="Nama Event" value="<?php echo $event["judul"]; ?>">
                    </div>
                    <div class="flex gap-4">
                        <div class="flex-1">
                            <div class="relative">
                                <label for="kategori" class="block ml-4 md:ml-8 lg:ml-10 my-2 text-white font-bold text-sm">Kategori</label>
                                <div class="ml-4 md:ml-8 lg:ml-10 flex justify-start relative">
                                    <input id="kategoriDropdownInput" type="text" class="px-4 w-full h-10 bg-white rounded-xl border-2 border-[#756AB6] form-control" name="kategori" aria-describedby="kategoriHelp" placeholder="Pilih Kategori" readonly required value="<?php echo $event["kategori"]; ?>">
                                    <div id="kategoriDropdownMenu" class="hidden absolute left-[70px] md:left-[160px] top-[50px] transform -translate-x-1/2 w-full max-w-xs rounded-xl shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10">
                                        <ul class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="kategoriDropdownInput">
                                            <?php foreach ($kategori as $row) : ?>
                                                <li><button type="button" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"><?php echo $row["kategori"]; ?></button></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex-1">
                            <label for="lokasi" class="block mr-4 md:mr-8 lg:mr-10 my-2 text-white font-bold text-sm">Lokasi</label>
                            <div class="mr-4 md:mr-8 lg:mr-10 flex justify-start">
                                <input type="text" class="px-4 w-full h-10 bg-white rounded-xl border-2 border-[#756AB6] form-control" name="lokasi" id="lokasi" aria-describedby="lokasiHelp" placeholder="Pilih Lokasi" required value="<?php echo $event["lokasi"]; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="flex-1">
                            <label for="tanggal" class="block ml-4 md:ml-8 lg:ml-10 my-2 text-white font-bold text-sm">Tanggal</label>
                            <div class="ml-4 md:ml-8 lg:ml-10 flex justify-start">
                                <input type="date" class="px-4 w-full h-10 bg-white rounded-xl border-2 border-[#756AB6] form-control" name="tanggal" id="tanggal" aria-describedby="tanggalHelp" placeholder="Pilih Tanggal" required value="<?php echo $event["tanggal"]; ?>">
                            </div>
                        </div>
                        <div class="flex-1">
                            <label for="waktu" class="block mr-4 md:mr-8 lg:mr-10 my-2 text-white font-bold text-sm">Waktu</label>
                            <div class="mr-4 md:mr-8 lg:mr-10 flex justify-start">
                                <input type="time" class="px-4 w-full h-10 bg-white rounded-xl border-2 border-[#756AB6] form-control" name="waktu" id="waktu" aria-describedby="waktuHelp" placeholder="Pilih Tanggal" required value="<?php echo $event["waktu"]; ?>">
                            </div>
                        </div>
                    </div>
                    <label for="link_pendaftaran" class="block mx-4 md:mx-8 lg:mx-10 my-2 text-white font-bold text-sm">Link Pendaftaran</label>
                    <div class="flex justify-center">
                        <input type="text" class="px-4 w-11/12 h-10 bg-white rounded-xl border-2 border-[#756AB6] form-control" name="link_pendaftaran" id="link_pendaftaran" aria-describedby="pendafataranHelp" placeholder="Link Pendaftaran" required value="<?php echo $event["link_pendaftaran"]; ?>">
                    </div>
                    <label for="penyelenggara" class="block mx-4 md:mx-8 lg:mx-10 my-2 text-white font-bold text-sm">Nama Penyelenggara</label>
                    <div class="flex justify-center">
                        <input type="text" class="px-4 w-11/12 h-10 bg-white rounded-xl border-2 border-[#756AB6] form-control" name="penyelenggara" id="penyelenggara" aria-describedby="penyelenggaraHelp" placeholder="Nama Penyelenggara" required value="<?php echo $event["penyelenggara"]; ?>">
                    </div>
                    <label for="deskripsi" class="block mx-4 md:mx-8 lg:mx-10 my-2 text-white font-bold text-sm">Deskripsi Event</label>
                    <div class="flex justify-center">
                        <div class="rounded-xl w-11/12 h-64 bg-white rounded-xl border-2 border-[#756AB6]">
                            <input type="hidden" id="deskripsi" value="<?php echo $event["deskripsi"]; ?>">
                            <div id="editor-container"></div>
                        </div>
                    </div>
                    <input type="hidden" name="deskripsi" id="hidden-deskripsi">
                    <div class="mx-auto rounded-xl w-60 md:w-80 h-10 border-2 border-white my-6 md:mt-10 hover:bg-[#E0AED0]  text-center">
                        <button type="submit" name="submit" class=" text-white text-sm font-bold pt-[8px]">
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <div class="bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] mt-20 py-16 px-10 lg:px-28">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                <div class="mb-6 md:mb-0">
                    <p class="text-white font-bold text-2xl md:text-4xl">EventUnila</p>
                    <p class="text-gray-500 font-bold text-sm mt-4">Kumpulan Pengalaman, <br> Ayo bergabung bersama di EventUnila!</p>
                    <div class="flex flex-col md:flex-row gap-4 text-white font-bold text-sm mt-4">
                        <a href="about.php">Tentang Kami</a>
                        <a href="kontak.php">Kontak</a>
                        <a href="kebijakan.php">Kebijakan Pribadi</a>
                    </div>
                </div>
                <div class="text-white font-bold text-sm">
                    <p>Jl. Prof. Sumantri Brojonegoro No.1 Gedong Meneng, <br>Bandar Lampung.</p>
                    <div class="flex gap-5 md:gap-10 text-white text-2xl mt-4">
                        <a href="https://web.facebook.com/OfficialUnila/?_rdc=1&_rdr"><i class="ti ti-brand-facebook"></i></a>
                        <a href="https://twitter.com/official_unila"><i class="ti ti-brand-twitter"></i></a>
                        <a href="https://www.instagram.com/official_unila"><i class="ti ti-brand-instagram"></i></a>
                        <a href="https://www.tiktok.com/@official_unila"><i class="ti ti-brand-tiktok"></i></a>
                        <a href="https://www.youtube.com/c/OfficialUnila"><i class="ti ti-brand-youtube"></i></a>
                    </div>
                    <div class="mt-6">
                        <p>&copy; 2024 EventUnila. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    <?php else : ?>
        <?php
        include 'error.php';
        ?>
    <?php endif; ?>

    <script>
        // Mendapatkan URL gambar dari input hidden
        var gambarUrl = document.getElementById('gambar_lama').value;
        var box = document.getElementById('box');

        // Jika gambar URL tidak kosong, setel src gambar dan tampilkan elemen gambar
        if (gambarUrl) {
            box.src = 'img/' + gambarUrl; // Ganti 'img/' sesuai dengan path gambar Anda
            box.classList.remove('hidden');
        }

        const dropdownInput = document.getElementById('kategoriDropdownInput');
        const dropdownMenu = document.getElementById('kategoriDropdownMenu');
        if (dropdownInput && dropdownMenu) {
            const options = dropdownMenu.querySelectorAll('button');

            dropdownInput.addEventListener('click', () => {
                dropdownMenu.classList.toggle('hidden');
            });

            options.forEach(option => {
                option.addEventListener('click', (event) => {
                    dropdownInput.value = event.target.textContent;
                    dropdownMenu.classList.add('hidden');
                });
            });

            document.addEventListener('click', (event) => {
                if (!dropdownInput.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });
        }

        document.addEventListener('DOMContentLoaded', (event) => {
            var quill = new Quill('#editor-container', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline'],
                        [{
                            'list': 'ordered'
                        }, {
                            'list': 'bullet'
                        }],
                        [{
                            'align': []
                        }],
                        [{
                            'color': []
                        }, {
                            'background': []
                        }],
                    ]
                }
            });

            // Set the content of the editor with the value from the hidden input
            var deskripsi = document.getElementById('deskripsi').value;
            quill.root.innerHTML = deskripsi;

            document.getElementById('eventForm').onsubmit = function(event) {
                var deskripsi = quill.root.innerHTML;
                document.getElementById('hidden-deskripsi').value = deskripsi;
                console.log("Deskripsi yang dikirim:", deskripsi);

                if (deskripsi === '') {
                    console.error("Deskripsi kosong!");
                    event.preventDefault(); // Batalkan pengiriman form
                }
            };
        });
    </script>
    <script src="script.js"></script>
</body>

</html>