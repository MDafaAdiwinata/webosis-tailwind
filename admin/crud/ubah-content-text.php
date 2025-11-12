<?php

session_start();
include "../../koneksi.php";

if (!isset($_SESSION['username'])) {
    echo "
        <script>
            alert('Silahkan Login Terlebih Dahulu!');
            window.location.href = '../index.php';
        </script>
        ";
}

// Ambil username dari session untuk ditampilkan
$username = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Unknown';

$ambilMainText = mysqli_query($koneksi, "SELECT * FROM tb_main_content_text WHERE id_content_text='$_GET[kode]'");
$tampilMainText = mysqli_fetch_array($ambilMainText);

// Menyiapkan variabel untuk pesan alert dari session
$alert_message = '';
if (isset($_SESSION['alert_message'])) {
    $alert_message = $_SESSION['alert_message'];
    unset($_SESSION['alert_message']);
}

// Proses Update Data Aspirasi - DIPERBAIKI
if (isset($_POST['ubah'])) {
    $id_content_text = mysqli_real_escape_string($koneksi, $_POST['id_content_text']);
    $judul_portal = mysqli_real_escape_string($koneksi, $_POST['judul_portal']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $link_teknis = mysqli_real_escape_string($koneksi, $_POST['link_teknis']);
    $link_reels = mysqli_real_escape_string($koneksi, $_POST['link_reels']);
    $link_contact = mysqli_real_escape_string($koneksi, $_POST['link_contact']);

    // Update database
    $query = "UPDATE tb_main_content_text SET 
              judul_portal = '$judul_portal', 
              deskripsi = '$deskripsi',
              link_teknis = '$link_teknis', 
              link_reels = '$link_reels',
              link_contact = '$link_contact'
              WHERE id_content_text = '$id_content_text'";

    if (mysqli_query($koneksi, $query)) {
        $_SESSION['alert_message'] = '
        <div id="alert-2" class="flex items-center p-4 text-[var(--text-success)] rounded-2xl bg-[var(--bg-success)]" role="alert">
            <svg class="shrink-0 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
                <div class="ms-3 me-4 text-sm md:text-md font-medium">
                    Data Main Content TEXT telah berhasil diperbarui.
                </div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-[var(--bg-success)]/30 text-[var(--text-success)] rounded-lg cursor-pointer focus:ring-2 p-1.5 transition duration-300 border border-[var(--bg-success)] inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-2" aria-label="Close">
                <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>';
        header("Location: ../portal-lomba/main-content.php");
        exit;
    } else {
        $_SESSION['alert_message'] = '
        <div id="alert-2" class="flex items-center p-4 text-[var(--text-danger)] rounded-2xl bg-[var(--bg-danger)]" role="alert">
            <svg class="shrink-0 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
                <div class="ms-3 me-4 text-sm md:text-md font-medium">
                    Data gagal ditambahkan. (Harap Coba lagi). gagal terus? hubungi operator/admin!
                </div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-[var(--bg-danger)]/30 text-[var(--text-danger)] rounded-lg cursor-pointer focus:ring-2 p-1.5 transition duration-300 border border-[var(--bg-danger)] inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-2" aria-label="Close">
                <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>';
        header("Location: ../portal-lomba/main-content.php");
        exit;
    }
}

function selamatkanWaktu()
{
    date_default_timezone_set('Asia/Jakarta');
    $jam = date("G"); // 0-23

    if ($jam >= 0 && $jam < 12) {
        return "Selamat Pagi";
    } elseif ($jam >= 12 && $jam < 15) {
        return "Selamat Siang";
    } elseif ($jam >= 15 && $jam < 18) {
        return "Selamat Sore";
    } else {
        return "Selamat Malam";
    }
}

// Memanggil fungsi dan menampilkan hasilnya
$sapaan = selamatkanWaktu();

// Ambil username dari session untuk ditampilkan
$username = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Unknown';
?>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Main Content Text - Admin Dashboard</title>

    <!-- Flowbite CSS -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <link href="../../styles/output.css" rel="stylesheet" />

    <!-- Aos -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <!-- Website Osis SMK Bi icon -->
    <link rel="shortcut icon" href="../../assets/img/logo-osis.png" type="image/x-icon" />

    <!-- Font - Montserrat -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
</head>

<body class="font-[montserrat]">

    <!-- Main Content Dashboard -->
    <div class="px-4 md:px-4 lg:px-8">
        <div class="grid grid-cols-2 gap-4 mt-6 sm:mt-4">
            <div class="flex items-center justify-start h-10 md:h-20">
                <h1 class="text-lg md:text-2xl lg:text-2xl font-bold text-[var(--txt-primary2)]">
                    Portal Lomba
                </h1>
            </div>
            <div class="flex items-center justify-end h-10 md:h-20">
                <h1 class="text-end text-md md:text-lg lg:text-xl font-light text-[var(--txt-primary2)]/80">
                    <?php echo $sapaan; ?>,
                    <?php echo $username; ?>!
                </h1>
            </div>
        </div>

        <hr class="w-full border border-[var(--txt-primary2)]/20 mt-6 sm:mt-2 mb-10">

        <div class="flex flex-col gap-6">
            <div class="grid grid-cols-1 md:grid-cols-2 items-center justify-center gap-4">
                <a href="../portal-lomba/main-content.php"
                    class="w-fit focus:outline-none text-[var(--txt-primary)] bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-xl text-sm md:text-md px-5 py-2.5 shadow-lg hover:shadow-none transition duration-300 cursor-pointer">
                    Kembali
                </a>
                <h1 class="text-lg lg:text-xl xl:text-2xl font-semibold text-[var(--txt-primary2)] text-center md:text-end mt-4 lg:mt-0">
                    Main Content Text - Ubah Data
                </h1>
            </div>

            <div class="flex w-full items-center justify-center mt-4">
                <form class="space-y-4 w-full lg:w-2/5 mb-32" action="" method="POST" enctype="multipart/form-data">
                    <!-- Input Tersembunyi untuk ID dan gambar lama -->
                    <input type="hidden" name="id_content_text" value="<?= $tampilMainText['id_content_text']; ?>">
                    <div class="mb-6">
                        <label for="judul_portal"
                            class="block mb-2 text-lg font-normal text-[var(--txt-primary2)]">
                            Judul Portal Lomba
                        </label>
                        <input type="text" name="judul_portal" id="judul_portal" value="<?php echo $tampilMainText['judul_portal'] ?>"
                            class="bg-transparent border border-[var(--bg-primary)]/50 text-[var(--txt-primary2)] text-md rounded-xl focus:ring-[var(--txt-primary2)]/80 focus:border-[var(--txt-primary2)]/80 block w-full p-2.5" required />
                    </div>
                    <div>
                        <label for="deskripsi"
                            class="block mb-2 text-lg font-normal text-[var(--txt-primary2)]">
                            Deskripsi
                        </label>
                        <textarea id="deskripsi" rows="4" name="deskripsi"
                            class="bg-transparent border border-[var(--bg-primary)]/50 text-[var(--txt-primary2)] text-md rounded-xl focus:ring-[var(--txt-primary2)]/80 focus:border-[var(--txt-primary2)]/80 block w-full p-2.5"><?= $tampilMainText['deskripsi'] ?></textarea>
                    </div>

                    <div class="mb-6">
                        <label for="link_teknis"
                            class="block mb-2 text-lg font-normal text-[var(--txt-primary2)]">
                            Link Teknis
                        </label>
                        <input type="text" name="link_teknis" id="link_teknis" value="<?php echo $tampilMainText['link_teknis'] ?>"
                            class="bg-transparent border border-[var(--bg-primary)]/50 text-[var(--txt-primary2)] text-md rounded-xl focus:ring-[var(--txt-primary2)]/80 focus:border-[var(--txt-primary2)]/80 block w-full p-2.5" required />
                    </div>
                    <div class="mb-6">
                        <label for="link_reels"
                            class="block mb-2 text-lg font-normal text-[var(--txt-primary2)]">
                            Link Reels
                        </label>
                        <input type="text" name="link_reels" id="link_reels" value="<?php echo $tampilMainText['link_reels'] ?>"
                            class="bg-transparent border border-[var(--bg-primary)]/50 text-[var(--txt-primary2)] text-md rounded-xl focus:ring-[var(--txt-primary2)]/80 focus:border-[var(--txt-primary2)]/80 block w-full p-2.5" required />
                    </div>
                    <div class="mb-6">
                        <label for="link_contact"
                            class="block mb-2 text-lg font-normal text-[var(--txt-primary2)]">
                            Link Kontak
                        </label>
                        <input type="text" name="link_contact" id="link_contact" value="<?php echo $tampilMainText['link_contact'] ?>"
                            class="bg-transparent border border-[var(--bg-primary)]/50 text-[var(--txt-primary2)] text-md rounded-xl focus:ring-[var(--txt-primary2)]/80 focus:border-[var(--txt-primary2)]/80 block w-full p-2.5" required />
                    </div>
                    <button type="submit" name="ubah"
                        class="w-full text-[var(--txt-primary2)] bg-[var(--bg-secondary)] hover:bg-[var(--bg-secondary)]/80 focus:ring-4 focus:outline-none focus:ring-[var(--txt-primary2)]/60 font-bold rounded-xl text-lg cursor-pointer px-5 py-2.5 text-center mt-4 transition duration-500">
                        Ubah
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Flowbite Script -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

</body>

</html>