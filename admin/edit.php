<?php

require_once "../includes/auth.php";
require_once "../config/database.php";

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    header("Location: produk.php");
    exit;
}

// Ambil data produk berdasarkan ID
$query = "SELECT * FROM produk WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) !== 1) {
    header("Location: produk.php");
    exit;
}

$produk = mysqli_fetch_assoc($result);

$pesan = "";

// Jika form disubmit
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nama = trim($_POST['nama']);
    $kategori = trim($_POST['kategori']);
    $deskripsi = trim($_POST['deskripsi']);
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    // Jika admin memilih gambar baru
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {

        $nama_file_asli = $_FILES['gambar']['name'];
        $tmp_file = $_FILES['gambar']['tmp_name'];
        $ukuran_file = $_FILES['gambar']['size'];

        $ekstensi = strtolower(
            pathinfo($nama_file_asli, PATHINFO_EXTENSION)
        );

        $format_diizinkan = ['jpg', 'jpeg', 'png', 'webp'];

        if (!in_array($ekstensi, $format_diizinkan)) {

            $pesan = "Format gambar harus JPG, JPEG, PNG, atau WEBP.";

        } elseif ($ukuran_file > 5 * 1024 * 1024) {

            $pesan = "Ukuran gambar maksimal 5 MB.";

        } else {

            $nama_file_baru = uniqid("produk_") . "." . $ekstensi;

            $folder_upload = "../uploads/produk/";

            if (move_uploaded_file(
                $tmp_file,
                $folder_upload . $nama_file_baru
            )) {

                // Hapus gambar lama jika ada
                if (
                    !empty($produk['gambar']) &&
                    file_exists($folder_upload . $produk['gambar'])
                ) {
                    unlink($folder_upload . $produk['gambar']);
                }

                $gambar = $nama_file_baru;

                $query_update = "UPDATE produk
                                 SET nama = ?,
                                     kategori = ?,
                                     deskripsi = ?,
                                     harga = ?,
                                     stok = ?,
                                     gambar = ?
                                 WHERE id = ?";

                $stmt_update = mysqli_prepare(
                    $conn,
                    $query_update
                );

                mysqli_stmt_bind_param(
                    $stmt_update,
                    "sssdisi",
                    $nama,
                    $kategori,
                    $deskripsi,
                    $harga,
                    $stok,
                    $gambar,
                    $id
                );

                if (mysqli_stmt_execute($stmt_update)) {

                    header("Location: produk.php");
                    exit;

                } else {

                    $pesan = "Data produk gagal diperbarui.";
                }

            } else {

                $pesan = "Gambar baru gagal di-upload.";
            }
        }

    } else {

        // Jika tidak mengganti gambar
        $query_update = "UPDATE produk
                         SET nama = ?,
                             kategori = ?,
                             deskripsi = ?,
                             harga = ?,
                             stok = ?
                         WHERE id = ?";

        $stmt_update = mysqli_prepare(
            $conn,
            $query_update
        );

        mysqli_stmt_bind_param(
            $stmt_update,
            "sssdii",
            $nama,
            $kategori,
            $deskripsi,
            $harga,
            $stok,
            $id
        );

        if (mysqli_stmt_execute($stmt_update)) {

            header("Location: produk.php");
            exit;

        } else {

            $pesan = "Data produk gagal diperbarui.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Edit Produk | SK-II Store</title>

    <link
        rel="stylesheet"
        href="../assets/css/style.css"
    >

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

            <a
                href="../index.php"
                target="_blank"
            >
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

                <p class="admin-label">
                    PRODUCT MANAGEMENT
                </p>

                <h1>
                    Edit Produk
                </h1>

            </div>

        </div>


        <?php if ($pesan != ""): ?>

            <div class="alert-error">
                <?php
                echo htmlspecialchars($pesan);
                ?>
            </div>

        <?php endif; ?>


        <div class="form-card">

            <form
                method="POST"
                enctype="multipart/form-data"
            >

                <div class="form-group">

                    <label for="nama">
                        Nama Produk
                    </label>

                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        value="<?php
                        echo htmlspecialchars($produk['nama']);
                        ?>"
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
                        value="<?php
                        echo htmlspecialchars($produk['kategori']);
                        ?>"
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
                        rows="6"
                        required
                    ><?php
                    echo htmlspecialchars($produk['deskripsi']);
                    ?></textarea>

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
                            value="<?php
                            echo htmlspecialchars($produk['harga']);
                            ?>"
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
                            value="<?php
                            echo htmlspecialchars($produk['stok']);
                            ?>"
                            min="0"
                            required
                        >

                    </div>

                </div>


                <div class="form-group">

                    <label>
                        Gambar Saat Ini
                    </label>

                    <?php if (!empty($produk['gambar'])): ?>

                        <img
                            src="../uploads/produk/<?php
                            echo htmlspecialchars($produk['gambar']);
                            ?>"
                            alt="Gambar Produk"
                            class="current-product-image"
                        >

                    <?php else: ?>

                        <p class="no-image">
                            Belum ada gambar.
                        </p>

                    <?php endif; ?>

                </div>


                <div class="form-group">

                    <label for="gambar">
                        Ganti Gambar Produk
                    </label>

                    <input
                        type="file"
                        id="gambar"
                        name="gambar"
                        accept=".jpg,.jpeg,.png,.webp"
                    >

                    <small>
                        Kosongkan jika tidak ingin mengganti gambar.
                        Format JPG, JPEG, PNG, WEBP. Maksimal 5 MB.
                    </small>

                </div>


                <div class="form-actions">

                    <a
                        href="produk.php"
                        class="btn-secondary"
                    >
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="btn-primary"
                    >
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </main>

</div>

</body>

</html>