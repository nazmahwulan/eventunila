<?php
include 'function.php';
include 'navbar.php';

//pagination
$jumlahDataPerHalaman = 9;

// Mendapatkan halaman aktif dari parameter URL
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;

// Mendapatkan kata kunci pencarian dari URL
$searchKeyword = isset($_POST['keyword']) ? $_POST['keyword'] : (isset($_GET['keyword']) ? $_GET['keyword'] : '');

// Mendapatkan kategori dari URL
// Ambil kategori_id dari POST atau GET
$kategori_id = isset($_POST['kategori']) ? $_POST['kategori'] : (isset($_GET['kategori']) ? $_GET['kategori'] : '');

// Fungsi untuk mendapatkan nama kategori berdasarkan ID
function getCategoryNameById($id) {
    global $conn;
    $query = "SELECT kategori FROM kategori WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['kategori']; // Mengembalikan nama kategori
    }

    return null; // Kategori tidak ditemukan
}

// Ambil nama kategori berdasarkan ID
$kategori_nama = $kategori_id ? getCategoryNameById($kategori_id) : null;

// Mendapatkan total data yang sesuai dengan filter pencarian dan kategori
$totalEvents = getEvents($kategori_id, $searchKeyword, $halamanAktif, $jumlahDataPerHalaman, true);

// Menghitung jumlah halaman
$jumlahHalaman = ceil($totalEvents / $jumlahDataPerHalaman);

// Mendapatkan data event sesuai halaman aktif
$events = getEvents($kategori_id, $searchKeyword, $halamanAktif, $jumlahDataPerHalaman);


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

</head>

<body>
    <div class="mx-10 lg:mx-28  mt-[50px] lg:mt-[100px] flex justify-between">
        <h1 class="text-[#756AB6] font-bold text-2xl md:text-3xl text-justify md:hidden">Event <br> Mendatang</h1>
        <h1 class="text-[#756AB6] font-bold text-2xl md:text-3xl hidden md:block">Event Mendatang</h1>
        <form action="halamanevent.php" method="get" class="my-5 md:mt-[-6px]">
            <div class="relative inline-block w-32 md:w-44">
                <select name="kategori" class="block appearance-none w-full px-4 pr-8 h-10 bg-white border-2 border-[#756AB6] rounded-xl leading-tight focus:outline-none focus:bg-white focus:border-purple-500" onchange="this.form.submit()">
                    <option class="text-black font-bold text-sm" value="">Pilih Kategori</option>
                    <?php
                    $kategori = getkategori();
                    foreach ($kategori as $row) {
                        $selected = (isset($_GET['kategori']) && $_GET['kategori'] == $row['id']) ? 'selected' : '';
                        echo "<option value='" . $row['id'] . "' $selected>" . $row['kategori'] . "</option>";
                    }
                    ?>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                    </svg>
                </div>
            </div>
        </form>
    </div>

    <div class="flex flex-wrap list-none mx-14  my-5 lg:mx-32 ">
        <div class="flex hover:text-[#756AB6] font-semibold">
            <a href="index.php">
                <i class="ti ti-home-filled pr-2"></i>Beranda</a>
        </div>
        <span class="mx-2">/</span>
        <a href="halamanevent.php">
            <li class="text-[#756AB6] font-semibold">Event</li>
        </a>
    </div>

    <div class="md:h-auto lg:h-full">
        <?php if ($searchKeyword && empty($events)) : ?>
            <div class="mx-10 lg:mx-28">
                <p>Data tidak ditemukan untuk kata kunci"<?php echo htmlspecialchars($searchKeyword); ?>".</p>
            </div>
        <?php else : ?>
        <?php if ($kategori_nama && empty($events)) : ?>
            <div class="mx-10 lg:mx-28">
                <p>Data tidak ditemukan untuk kategori "<?php echo htmlspecialchars($kategori_nama); ?>".</p>
            </div>
        <?php else : ?>
                <div class="flex justify-center grid gap-8 my-5 mx-10 lg:mx-28 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                    <?php foreach ($events as $row) : ?>
                        <?php
                        $tanggalMulai = $row["tanggal_mulai"];
                        $tanggalAkhir = $row["tanggal_berakhir"];

                        // Format tanggal
                        $formattedTanggalMulai = date('d M Y', strtotime($tanggalMulai));
                        $formattedTanggalAkhir = date('d M Y', strtotime($tanggalAkhir));

                        // Cek jika tanggal mulai dan akhir sama
                        if ($tanggalMulai == $tanggalAkhir) {
                            $tanggalTampil = $formattedTanggalMulai;
                        } else {
                            $tanggalTampil = $formattedTanggalMulai . " - " . $formattedTanggalAkhir;
                        }

                        // Update status berdasarkan tanggal pelaksanaan
                        $tanggal = strtotime($row['tanggal_berakhir']);
                        $sekarang = time();

                        // Jika tanggal pelaksanaan sudah lewat, ubah status menjadi "Selesai"
                        if ($tanggal < $sekarang) {
                            $row['tanggal'] = 'selesai';
                        } else {
                            // Jika tanggal pelaksanaan masih mendatang, biarkan status tetap "mendatang"
                            $row['tanggal'] = 'mendatang';
                        }

                        $eventStatus = strtolower($row['tanggal']); // Mendapatkan status tanggal (mendatang atau selesai)
                        // Menentukan kelas warna untuk status event mendatang atau selesai
                        $eventStatusClass = '';
                        if ($eventStatus === 'mendatang') {
                            $eventStatusClass = 'bg-red-600'; // Biru muda untuk event mendatang
                        } elseif ($eventStatus === 'selesai') {
                            $eventStatusClass = 'bg-green-600 '; // Merah tua untuk event selesai
                        }

                        ?>
                        <div class="rounded-xl border-2 border-[#AC87C5]">
                            <a href="detailevent.php?id=<?php echo $row["event_id"]; ?>">
                                <div class="relative w-full h-52">
                                    <img class="rounded-t-xl w-full h-52" src="img/<?php echo $row["gambar"]; ?>">
                                    <!-- <span class="<?php echo $eventStatusClass; ?> absolute top-2 right-2 rounded-xl w-32 h-8 text-sm text-white flex items-center justify-center"><?php echo ucfirst($row['tanggal']); ?></span>
                                <?php if ($status === 'sedang diajukan') : ?>
                                    <a href="editevent.php?id=<?php echo $row["event_id"]; ?>" class="ti ti-edit absolute top-2 right-2 bg-white border-2 border-[#AC87C5] rounded-xl w-8 h-8 text-sm text-[#AC87C5] flex items-center justify-center"></a>
                                <?php endif; ?> -->
                                </div>
                                <!-- <img class="rounded-t-xl w-full h-52" src="img/<?php echo $row["gambar"]; ?>" alt="Event Image"> -->
                                <div class="mx-8 my-6">
                                    <!-- <span class="<?php echo $eventStatusClass; ?> mb-4 rounded-xl w-32 h-8 text-sm font-bold text-white flex items-center justify-center"><?php echo ucfirst($row['tanggal']); ?></span> -->
                                    <h4 class="truncate text-xl font-bold mb-2"><?php echo htmlspecialchars($row["judul"]); ?></h4>
                                    <div class="flex justify-between mb-2 text-[#AC87C5] font-bold">
                                        <div class="flex items-center gap-2">
                                            <i class="ti ti-calendar text-base"></i>
                                            <p class="text-sm text-start"><?php echo $tanggalTampil; ?></p>
                                        </div>
                                    </div>
                                    <div class="truncate text-justify text-sm">
                                        <?php echo strip_tags(htmlspecialchars_decode($row["deskripsi"])); ?>
                                    </div>
                                </div>
                                <hr class="border-[#AC87C5]">
                                <div class="text-base font-bold text-center px-10 py-2"><?php echo htmlspecialchars($row["penyelenggara"]); ?></div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <div class="flex justify-end my-5 mx-10 lg:mx-28 lg:my-10">
        <?php if ($halamanAktif > 1) : ?>
            <a class="border-2 border-[#AC87C5] rounded-xl p-2 mx-1 text-xs font-bold" href="?halaman=<?= $halamanAktif - 1; ?>&keyword=<?= urlencode($searchKeyword); ?>&kategori=<?= urlencode($kategori_id); ?>">&laquo;</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
            <?php if ($i == $halamanAktif) : ?>
                <a class="border-2 border-[#AC87C5] rounded-xl p-2 mx-1 text-xs font-bold text-white bg-[#AC87C5]" href="?halaman=<?= $i; ?>&keyword=<?= urlencode($searchKeyword); ?>&kategori=<?= urlencode($kategori_id); ?>"><?= $i; ?></a>
            <?php else : ?>
                <a class="border-2 border-[#AC87C5] rounded-xl p-2 mx-1 text-xs font-bold" href="?halaman=<?= $i; ?>&keyword=<?= urlencode($searchKeyword); ?>&kategori=<?= urlencode($kategori_id); ?>"><?= $i; ?></a>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if ($halamanAktif < $jumlahHalaman) : ?>
            <a class="border-2 border-[#AC87C5] rounded-xl p-2 mx-1 text-xs font-bold" href="?halaman=<?= $halamanAktif + 1; ?>&keyword=<?= urlencode($searchKeyword); ?>&kategori=<?= urlencode($kategori_id); ?>">&raquo;</a>
        <?php endif; ?>
    </div>

    <div class="mx-10 lg:mx-28 my-[50px] lg:my-[50px] flex justify-between">
        <h1 class="text-[#756AB6] font-bold text-2xl md:text-3xl text-justify md:hidden">Berita Kegiatan di<br>Universitas Lampung</h1>
        <h1 class="text-[#756AB6] font-bold text-2xl md:text-3xl hidden md:block">Berita Kegiatan di Universitas Lampung</h1>
    </div>

    <?php
    $urls = [
        "https://www.unila.ac.id/feed/"
    ];

    // Fungsi untuk mengambil dan menyimpan data RSS feed ke cache
    function getCachedRSS($url, $cacheFile, $cacheDuration = 3600)
    {
        // Periksa apakah cache sudah ada dan masih valid
        if (file_exists($cacheFile) && (time() - filemtime($cacheFile) < $cacheDuration)) {
            // Ambil data dari cache
            return simplexml_load_file($cacheFile);
        } else {
            // Ambil data dari URL RSS
            $rssData = @file_get_contents($url);
            if ($rssData !== false) {
                // Simpan data RSS ke file cache
                file_put_contents($cacheFile, $rssData);
                return simplexml_load_string($rssData);
            }
        }
        return false;
    }

    foreach ($urls as $url) {
        $url = trim($url);
        $cacheFile = 'cache/' . md5($url) . '_rss_cache.xml'; // Nama file cache berdasarkan hash URL
        $feeds = getCachedRSS($url, $cacheFile);

        if ($feeds === false) {
            echo "<h1>Invalid RSS feed URL: $url</h1>";
            continue;
        }

        if (!empty($feeds)) {
            $site = $feeds->channel->title;
            $sitelink = $feeds->channel->link;
    ?>

            <div class="relative mx-10 lg:mx-28 group">
                <div class="flex overflow-hidden gap-8" id="slider">
                    <?php
                    $i = 0;
                    foreach ($feeds->channel->item as $item) {
                        $namespaces = $item->getNamespaces(true);
                        $content = $item->children($namespaces['content'])->encoded;
                        $creator = $item->children($namespaces['dc'])->creator;

                        // Mengambil URL gambar dari konten
                        $img_url = '';
                        if (preg_match('/<img[^>]+src="([^">]+)"/i', $content, $match)) {
                            $img_url = $match[1];
                        }

                        $title = $item->title;
                        $link = $item->link;
                        $description = $item->description;
                        $postDate = $item->pubDate;
                        $pubDate = date('d M Y', strtotime($postDate));

                        if ($i >= 10) break;
                    ?>

                        <div class="rounded-xl border-2 border-[#AC87C5] flex-shrink-0 w-full sm:w-[calc(100%-2rem)] md:w-[calc((100%-2*1rem)/2)] lg:w-[calc((100%-2*2rem)/3)]">
                            <a target="_blank" href="<?php echo $link; ?>">
                                <?php if ($img_url) : ?>
                                    <img class="rounded-t-xl w-full h-52" src="<?php echo $img_url; ?>">
                                <?php endif; ?>
                                <div class="mx-8 my-6">
                                    <h2 class="truncate text-xl font-bold mb-2"><?php echo $title; ?></h2>
                                    <div class="flex justify-between text-sm mb-2 text-[#AC87C5] font-bold">
                                        <div class="flex items-center gap-2">
                                            <h3><?php echo $creator; ?></h3>
                                            <p> - <?php echo $pubDate; ?></p>
                                        </div>
                                    </div>
                                    <div class="truncate text-justify text-sm mb-2">
                                        <?php echo $description; ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php
                        $i++;
                    }
                    ?>
                </div>

                <!-- Tombol Navigasi -->
                <button id="prev" class="absolute top-1/2 left-0 transform -translate-y-1/2 p-3 bg-[#AC87C5] text-white rounded-xl focus:outline-none opacity-0 group-hover:opacity-100 transition-opacity">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button id="next" class="absolute top-1/2 right-0 transform -translate-y-1/2 p-3 bg-[#AC87C5] text-white rounded-xl focus:outline-none opacity-0 group-hover:opacity-100 transition-opacity">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
    <?php
        } else {
            echo "<h2>No items found for URL: $url</h2>";
        }
    }
    ?>

    </div>

    <div class="bg-gradient-to-r from-[#AC87C5] to-[#E0AED0] mt-20 md:mt-40 py-16 px-10 lg:px-28">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
            <div class="mb-6 md:mb-0">
                <p class="text-white font-bold text-2xl md:text-4xl">EventUnila</p>
                <p class="text-gray-500 font-bold text-sm mt-4">Kumpulan Pengalaman, <br> Ayo bergabung bersama di EventUnila!</p>
                <!-- <div class="flex flex-col md:flex-row gap-4 text-white font-bold text-sm mt-4">
                    <a href="about.php">Tentang Kami</a>
                    <a href="kontak.php">Kontak</a>
                    <a href="kebijakan.php">Kebijakan Pribadi</a>
                </div> -->
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
    <script src="script.js"></script>
    <script>
        const slider = document.getElementById('slider');
        const nextButton = document.getElementById('next');
        const prevButton = document.getElementById('prev');
        let scrollAmount = 0;

        nextButton.addEventListener('click', () => {
            const scrollWidth = slider.scrollWidth;
            const clientWidth = slider.clientWidth;
            const maxScroll = scrollWidth - clientWidth;

            if (scrollAmount < maxScroll) {
                scrollAmount += clientWidth + 32; // Menambahkan gap sebesar 32px (8*4px)
                slider.scrollTo({
                    top: 0,
                    left: scrollAmount,
                    behavior: 'smooth'
                });
            }
        });

        prevButton.addEventListener('click', () => {
            if (scrollAmount > 0) {
                scrollAmount -= slider.clientWidth + 32;
                slider.scrollTo({
                    top: 0,
                    left: scrollAmount,
                    behavior: 'smooth'
                });
            }
        });
    </script>
</body>

</html>