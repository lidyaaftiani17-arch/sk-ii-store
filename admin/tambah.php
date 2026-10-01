<?php

require_once "../includes/auth.php";
require_once "../config/database.php";

$pesan = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nama = trim($_POST['nama']);
    $kategori = trim($_POST['kategori']);
    $deskripsi = trim($_POST['deskripsi']);
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    // Cek apakah gambar sudah dipilih
    if (!isset($_FILES['gambar']) || $_FILES['gambar']['error'] !== UPLOAD_ERR_OK) {
        $pesan = "Silakan pilih gambar produk.";
    } else {

        $nama_file_asli = $_FILES['gambar']['name'];
        $tmp_file = $_FILES['gambar']['tmp_name'];
        $ukuran_file = $_FILES['gambar']['size'];

        // Ambil ekstensi file
        $ekstensi = strtolower(pathinfo($nama_file_asli, PATHINFO_EXTENSION));

        // Format gambar yang diperbolehkan
        $format_diizinkan = ['jpg', 'jpeg', 'png', 'webp'];

        if (!in_array($ekstensi, $format_diizinkan)) {

            $pesan = "Format gambar harus JPG, JPEG, PNG, atau WEBP.";

        } elseif ($ukuran_file > 5 * 1024 * 1024) {

            $pesan = "Ukuran gambar maksimal 5 MB.";

        } else {

            // Buat nama file baru agar tidak bentrok
            $nama_file = uniqid("produk_") . "." . $ekstensi;

            // Lokasi penyimpanan gambar
            $folder_upload = "../uploads/produk/";

            // Pindahkan gambar
            if (move_uploaded_file($tmp_file, $folder_upload . $nama_file)) {

                // Simpan data ke database
                $query = "INSERT INTO produk 
                          (nama, kategori, deskripsi, harga, stok, gambar)
                          VALUES (?, ?, ?, ?, ?, ?)";

                $stmt = mysqli_prepare($conn, $query);

                mysqli_stmt_bind_param(
                    $stmt,
                    "sssdis",
                    $nama,
                    $kategori,
                    $deskripsi,
                    $harga,
                    $stok,
                    $nama_file
                );

                if (mysqli_stmt_execute($stmt)) {

                    header("Location: produk.php");
                    exit;

                } else {

                    $pesan = "Produk gagal ditambahkan: " . mysqli_error($conn);
                }

            } else {

                $pesan = "Gambar gagal di-upload.";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Produk | SK-II Store</title>

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<div class="admin-layout">

    <aside class="sidebar">

        <div class="sidebar-logo">
            SK-II
            <span>ADMIN PANEL</span>
        </div>

        <nav class="sidebar-menu">

            <a href="index.php">
                Dashboard
            </a>

            <a href="produk.php" class="active">
                Produk
            </a>

            <a href="../index.php" target="_blank">
                Lihat Website
            </a>

            <a href="logout.php">
                Logout
            </a>

        </nav>

    </aside>


    <main class="admin-content">

        <div class="admin-topbar">

            <div>
                <p class="admin-label">PRODUCT MANAGEMENT</p>
                <h1>Tambah Produk</h1>
            </div>

        </div>


        <?php if ($pesan != ""): ?>

            <div class="alert-error">
                <?php echo htmlspecialchars($pesan); ?>
            </div>

        <?php endif; ?>


        <div class="form-card">

            <form method="POST" enctype="multipart/form-data">

                <div class="form-group">

                    <label for="nama">
                        Nama Produk
                    </label>

                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        placeholder="Contoh: SK-II Facial Treatment Essence"
                        required
                    >

                </div>


                <div class="form-group">

                    <label for="kategori">
                        Kategori
                    </label>

                    <input
                        type="text"
                        id="kategori"
                        name="kategori"
                        placeholder="Contoh: Essence"
                        required
                    >

                </div>


                <div class="form-group">

                    <label for="deskripsi">
                        Deskripsi Produk
                    </label>

                    <textarea
                        id="deskripsi"
                        name="deskripsi"
                        rows="5"
                        placeholder="Masukkan deskripsi singkat produk..."
                        required
                    ></textarea>

                </div>


                <div class="form-row">

                    <div class="form-group">

                        <label for="harga">
                            Harga
                        </label>

                        <input
                            type="number"
                            id="harga"
                            name="harga"
                            placeholder="Contoh: 3080000"
                            min="0"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label for="stok">
                            Stok
                        </label>

                        <input
                            type="number"
                            id="stok"
                            name="stok"
                            placeholder="Contoh: 20"
                            min="0"
                            required
                        >

                    </div>

                </div>


                <div class="form-group">

                    <label for="gambar">
                        Gambar Produk
                    </label>

                    <input
                        type="file"
                        id="gambar"
                        name="gambar"
                        accept=".jpg,.jpeg,.png,.webp"
                        required
                    >

                    <small>
                        Format: JPG, JPEG, PNG, WEBP. Maksimal 5 MB.
                    </small>

                </div>


                <div class="form-actions">

                    <a href="produk.php" class="btn-secondary">
                        Batal
                    </a>

                    <button type="submit" class="btn-primary">
                        Simpan Produk
                    </button>

                </div>

            </form>

        </div>

    </main>

</div>

</body>

</html>