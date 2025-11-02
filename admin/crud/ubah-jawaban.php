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
    exit; // TAMBAHKAN exit
}

// Ambil ID dari URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Menyiapkan variabel untuk pesan alert dari session
$alert_message = '';
if (isset($_SESSION['alert_message'])) {
    $alert_message = $_SESSION['alert_message'];
    unset($_SESSION['alert_message']); // Hapus pesan dari session agar tidak tampil lagi
}

// Validasi ID
if ($id == 0) {
    $_SESSION['alert_message'] = '
            <div id="alert-2" class="flex items-center p-4 text-[var(--text-danger)] rounded-2xl bg-[var(--bg-danger)]" role="alert">
            <svg class="shrink-0 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
                <div class="ms-3 me-4 text-md font-medium">
                    ID Tidak Valid!
                </div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-[var(--bg-danger)]/30 text-[var(--text-danger)] rounded-lg cursor-pointer focus:ring-2 p-1.5 transition duration-300 border border-[var(--bg-danger)] inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-2" aria-label="Close">
                <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>';
    header("Location: ../portal-lomba/data-peserta.php");
    exit;
}

// Ambil data peserta yang akan diubah
$data_peserta = mysqli_query($koneksi, "SELECT * FROM tb_jawaban_lomba WHERE id = $id");
if (mysqli_num_rows($data_peserta) == 0) {
    $_SESSION['alert_message'] = '
            <div id="alert-2" class="flex items-center p-4 text-[var(--text-danger)] rounded-2xl bg-[var(--bg-danger)]" role="alert">
            <svg class="shrink-0 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
                <div class="ms-3 me-4 text-md font-medium">
                    Data tidak di temukan!
                </div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-[var(--bg-danger)]/30 text-[var(--text-danger)] rounded-lg cursor-pointer focus:ring-2 p-1.5 transition duration-300 border border-[var(--bg-danger)] inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-2" aria-label="Close">
                <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>';
    header("Location: ../portal-lomba/data-peserta.php");
    exit;
}

$peserta = mysqli_fetch_assoc($data_peserta);

// Ambil data input lomba yang aktif
$input_lomba = mysqli_query($koneksi, "SELECT * FROM tb_input_lomba WHERE status='aktif' ORDER BY id ASC");

// Proses Ubah Data
if (isset($_POST['ubah'])) {
    $kelas = mysqli_real_escape_string($koneksi, $_POST['kelas']);
    $jurusan = mysqli_real_escape_string($koneksi, $_POST['jurusan']);

    // Validasi
    if (empty($kelas) || empty($jurusan)) {
        $_SESSION['alert_message'] = '
            <div id="alert-2" class="flex items-center p-4 text-[var(--text-danger)] rounded-2xl bg-[var(--bg-danger)]" role="alert">
            <svg class="shrink-0 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
                <div class="ms-3 me-4 text-md font-medium">
                    Harap isi semua bidang yang diperlukan!
                </div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-[var(--bg-danger)]/30 text-[var(--text-danger)] rounded-lg cursor-pointer focus:ring-2 p-1.5 transition duration-300 border border-[var(--bg-danger)] inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-2" aria-label="Close">
                <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>';
        exit;
    } else {
        // Bangun query UPDATE dinamis
        $sql_update = "UPDATE tb_jawaban_lomba SET kelas = '$kelas', jurusan = '$jurusan'";

        // Tambahkan kolom dinamis
        mysqli_data_seek($input_lomba, 0);
        while ($input = mysqli_fetch_assoc($input_lomba)) {
            $nama_kolom = "input_" . $input['id'];
            $value = mysqli_real_escape_string($koneksi, $_POST[$nama_kolom] ?? '');

            $sql_update .= ", $nama_kolom = '$value'";
        }

        $sql_update .= " WHERE id = $id";
        $result = mysqli_query($koneksi, $sql_update);

        if ($result) {
            $_SESSION['alert_message'] = '
            <div id="alert-2" class="flex items-center p-4 text-[var(--text-success)] rounded-2xl bg-[var(--bg-success)]" role="alert">
            <svg class="shrink-0 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
                <div class="ms-3 me-4 text-md font-medium">
                    Data berhasil diubah!
                </div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-[var(--bg-success)]/30 text-[var(--text-success)] rounded-lg cursor-pointer focus:ring-2 p-1.5 transition duration-300 border border-[var(--bg-success)] inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-2" aria-label="Close">
                <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>';
            header("Location: ../portal-lomba/data-peserta.php");
            exit;
        } else {
            $_SESSION['alert_message'] = '
            <div id="alert-2" class="flex items-center p-4 text-[var(--text-danger)] rounded-2xl bg-[var(--bg-danger)]" role="alert">
            <svg class="shrink-0 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
                <div class="ms-3 me-4 text-md font-medium">
                    Gagal update data!
                </div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-[var(--bg-danger)]/30 text-[var(--text-danger)] rounded-lg cursor-pointer focus:ring-2 p-1.5 transition duration-300 border border-[var(--bg-danger)] inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-2" aria-label="Close">
                <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>';
            header("Location: ../portal-lomba/data-peserta.php");
            exit;
        }
    }
}

function selamatkanWaktu()
{
    date_default_timezone_set('Asia/Jakarta');
    $jam = date("G");

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

$username = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Unknown';
$sapaan = selamatkanWaktu();
?>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ubah Jawaban - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link href="../../styles/output.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="shortcut icon" href="../../assets/img/logo-osis.png" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body class="font-[montserrat]">

    <!-- Main Content Dashboard -->
    <div class="px-4 md:px-4 lg:px-8">
        <div class="grid grid-cols-2 gap-4 mt-6 sm:mt-4">
            <div class="flex items-center justify-start h-10 md:h-20">
                <h1 class="text-lg md:text-2xl lg:text-2xl font-bold text-[var(--txt-primary2)]">
                    Interaksi
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
                <!-- PERBAIKAN: Link kembali ke data-peserta.php -->
                <a href="../portal-lomba/data-peserta.php"
                    class="w-fit focus:outline-none text-[var(--txt-primary)] bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-xl text-sm md:text-md px-5 py-2.5 shadow-lg hover:shadow-none transition duration-300 cursor-pointer">
                    Kembali
                </a>
                <h1 class="text-md md:text-lg lg:text-xl xl:text-2xl font-semibold text-[var(--txt-primary2)] text-center md:text-end mt-4 lg:mt-0">
                    Jawaban - Ubah Data
                </h1>
            </div>

            <div class="flex w-full items-center justify-center mt-4">
                <!-- PERBAIKAN: Form action diisi dan width diperlebar -->
                <form class="space-y-4 w-full lg:w-2/3" method="POST" action="">
                    <div class="mb-6">
                        <?php echo $alert_message; ?>
                    </div>
                    <!-- Data Dasar -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="kelas" class="block mb-2 text-lg font-normal text-[var(--txt-primary2)]">
                                Kelas
                            </label>
                            <select id="kelas" name="kelas" required
                                class="bg-transparent border border-[var(--bg-primary)]/50 text-[var(--txt-primary2)] text-md rounded-xl focus:ring-[var(--txt-primary2)]/80 focus:border-[var(--txt-primary2)]/80 block w-full p-2.5">
                                <option value="">Pilih Kelas</option>
                                <option value="X" <?= ($peserta['kelas'] == 'X') ? 'selected' : '' ?>>X</option>
                                <option value="XI" <?= ($peserta['kelas'] == 'XI') ? 'selected' : '' ?>>XI</option>
                                <option value="XII" <?= ($peserta['kelas'] == 'XII') ? 'selected' : '' ?>>XII</option>
                            </select>
                        </div>

                        <div>
                            <label for="jurusan" class="block mb-2 text-lg font-normal text-[var(--txt-primary2)]">
                                Jurusan
                            </label>
                            <select id="jurusan" name="jurusan" required
                                class="bg-transparent border border-[var(--bg-primary)]/50 text-[var(--txt-primary2)] text-md rounded-xl focus:ring-[var(--txt-primary2)]/80 focus:border-[var(--txt-primary2)]/80 block w-full p-2.5">
                                <option value="">Pilih Jurusan</option>
                                <option value="Desain Komunikasi Visual" <?= ($peserta['jurusan'] == 'Desain Komunikasi Visual') ? 'selected' : '' ?>>Desain Komunikasi Visual</option>
                                <option value="Rekayasa Perangkat Lunak" <?= ($peserta['jurusan'] == 'Rekayasa Perangkat Lunak') ? 'selected' : '' ?>>Rekayasa Perangkat Lunak</option>
                                <option value="Teknik Komputer Jaringan" <?= ($peserta['jurusan'] == 'Teknik Komputer Jaringan') ? 'selected' : '' ?>>Teknik Komputer Jaringan</option>
                                <option value="Animasi" <?= ($peserta['jurusan'] == 'Animasi') ? 'selected' : '' ?>>Animasi</option>
                                <option value="Broadcasting TV" <?= ($peserta['jurusan'] == 'Broadcasting TV') ? 'selected' : '' ?>>Broadcasting TV</option>
                                <option value="Game Development" <?= ($peserta['jurusan'] == 'Game Development') ? 'selected' : '' ?>>Game Development</option>
                            </select>
                        </div>
                    </div>

                    <!-- Input Dinamis -->
                    <?php
                    // Reset pointer query untuk memastikan loop berjalan
                    mysqli_data_seek($input_lomba, 0);

                    // Debug: Cek apakah ada input lomba
                    if (mysqli_num_rows($input_lomba) == 0) {
                        echo '<div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4">
                                Tidak ada input lomba yang aktif.
                              </div>';
                    }

                    while ($tampil_input_lomba = mysqli_fetch_assoc($input_lomba)) :
                        $nama_kolom = "input_" . $tampil_input_lomba['id'];
                        $nilai = $peserta[$nama_kolom] ?? '';
                    ?>
                        <div class="mb-6">
                            <label for="input_<?= $tampil_input_lomba['id']; ?>"
                                class="block mb-2 text-lg font-normal text-[var(--txt-primary2)]">
                                <?= $tampil_input_lomba['label_lomba'] . ' ' . $tampil_input_lomba['emoji']; ?>
                            </label>
                            <input
                                type="<?= $tampil_input_lomba['jenis_input']; ?>"
                                id="input_<?= $tampil_input_lomba['id']; ?>"
                                name="input_<?= $tampil_input_lomba['id']; ?>"
                                value="<?= htmlspecialchars($nilai) ?>"
                                class="bg-transparent border border-[var(--bg-primary)]/50 text-[var(--txt-primary2)] text-md rounded-xl focus:ring-[var(--txt-primary2)]/80 focus:border-[var(--txt-primary2)]/80 block w-full p-2.5"
                                placeholder="Masukkan <?= $tampil_input_lomba['label_lomba']; ?>"
                                required />
                        </div>
                    <?php endwhile; ?>

                    <button type="submit" name="ubah"
                        class="w-full text-[var(--txt-primary)] bg-[var(--text-warning)] hover:bg-[var(--text-warning)]/80 focus:ring-4 focus:outline-none focus:ring-[var(--txt-primary2)]/60 font-bold rounded-xl text-lg cursor-pointer px-5 py-2.5 text-center mt-4 transition duration-500">
                        Ubah Data
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>