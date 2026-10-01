<?php

require_once "../includes/auth.php";
require_once "../config/database.php";

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    header("Location: produk.php");
    exit;
}


// Ambil data produk terlebih dahulu
$query = "SELECT * FROM produk WHERE id = ?";

$stmt = mysqli_prepare($conn, $query);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $id
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);


// Cek apakah produk ditemukan
if (mysqli_num_rows($result) !== 1) {

    header("Location: produk.php");
    exit;

}

$produk = mysqli_fetch_assoc($result);


// Hapus data produk dari database
$query_delete = "DELETE FROM produk WHERE id = ?";

$stmt_delete = mysqli_prepare(
    $conn,
    $query_delete
);

mysqli_stmt_bind_param(
    $stmt_delete,
    "i",
    $id
);

if (mysqli_stmt_execute($stmt_delete)) {

    // Hapus gambar produk dari folder
    $folder_upload = "../uploads/produk/";

    if (
        !empty($produk['gambar']) &&
        file_exists($folder_upload . $produk['gambar'])
    ) {

        unlink(
            $folder_upload . $produk['gambar']
        );

    }

}


// Kembali ke halaman produk
header("Location: produk.php");
exit;

?>