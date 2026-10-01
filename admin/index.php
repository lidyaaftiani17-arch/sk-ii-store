<?php

require_once "../includes/auth.php";
require_once "../config/database.php";


// Menghitung jumlah produk
$query_produk = "SELECT COUNT(*) AS total FROM produk";

$result_produk = mysqli_query($conn, $query_produk);

$data_produk = mysqli_fetch_assoc($result_produk);

$total_produk = $data_produk['total'];


// Menghitung total stok
$query_stok = "SELECT SUM(stok) AS total_stok FROM produk";

$result_stok = mysqli_query($conn, $query_stok);

$data_stok = mysqli_fetch_assoc($result_stok);

$total_stok = $data_stok['total_stok'] ?? 0;

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Admin | SK-II</title>

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body class="admin-page">


    <!-- SIDEBAR -->

    <aside class="admin-sidebar">

        <div class="admin-logo">
            SK-II
        </div>

        <p class="admin-label">
            ADMIN PANEL
        </p>


        <nav class="admin-menu">

            <a href="index.php" class="active">
                Dashboard
            </a>

            <a href="produk.php">
                Produk
            </a>

            <a href="../index.php">
                Lihat Website
            </a>

            <a href="logout.php">
                Logout
            </a>

        </nav>

    </aside>


    <!-- MAIN CONTENT -->

    <main class="admin-main">


        <div class="admin-top">

            <div>

                <p class="admin-small-title">
                    ADMIN DASHBOARD
                </p>

                <h1>
                    Welcome, <?php echo htmlspecialchars($_SESSION['admin_nama']); ?>
                </h1>

            </div>

        </div>


        <!-- STATISTICS -->

        <div class="admin-stat-grid">


            <div class="admin-stat-card">

                <p>
                    TOTAL PRODUK
                </p>

                <h2>
                    <?php echo $total_produk; ?>
                </h2>

                <span>
                    Produk dalam koleksi SK-II
                </span>

            </div>


            <div class="admin-stat-card">

                <p>
                    TOTAL STOK
                </p>

                <h2>
                    <?php echo $total_stok; ?>
                </h2>

                <span>
                    Total stok produk
                </span>

            </div>


            <div class="admin-stat-card">

                <p>
                    ADMIN
                </p>

                <h2>
                    01
                </h2>

                <span>
                    Administrator aktif
                </span>

            </div>


        </div>


        <!-- WELCOME CARD -->

        <section class="admin-welcome">

            <p class="admin-small-title">
                SK-II LUXURY STORE
            </p>

            <h2>
                Manage Your Collection
            </h2>

            <p>
                Gunakan dashboard ini untuk mengelola
                koleksi produk SK-II, menambahkan produk baru,
                mengubah informasi produk, atau menghapus
                produk yang sudah tidak tersedia.
            </p>

            <a href="produk.php" class="admin-primary-btn">
                Kelola Produk
            </a>

        </section>


    </main>


</body>

</html>