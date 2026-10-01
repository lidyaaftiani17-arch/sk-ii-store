<?php

require_once "config/database.php";


// Mengambil ID produk dari URL
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;


// Mengambil data produk berdasarkan ID
$query = "SELECT * FROM produk WHERE id = $id";

$result = mysqli_query($conn, $query);


// Mengecek apakah produk ditemukan
if (mysqli_num_rows($result) == 0) {

    echo "Produk tidak ditemukan.";
    exit;

}


$produk = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?php echo htmlspecialchars($produk['nama']); ?> | SK-II
    </title>

    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>


    <!-- NAVBAR -->

    <header class="navbar">

        <div class="logo">
            SK-II
        </div>

        <nav>

            <a href="index.php">
                Home
            </a>

            <a href="produk.php">
                Produk
            </a>

            <a href="tentang.php">
                Tentang
            </a>

            <a href="auth/login.php" class="login-btn">
                Login
            </a>

        </nav>

    </header>


    <!-- DETAIL PRODUK -->

    <section class="detail-section">

        <div class="detail-container">


            <!-- GAMBAR -->

            <div class="detail-image">

                <?php if (!empty($produk['gambar'])): ?>

                    <img
                        src="uploads/produk/<?php echo htmlspecialchars($produk['gambar']); ?>"
                        alt="<?php echo htmlspecialchars($produk['nama']); ?>"
                    >

                <?php else: ?>

                    <div class="detail-no-image">
                        SK-II
                    </div>

                <?php endif; ?>

            </div>


            <!-- INFORMASI -->

            <div class="detail-content">

                <p class="detail-category">
                    <?php echo htmlspecialchars($produk['kategori']); ?>
                </p>

                <h1>
                    <?php echo htmlspecialchars($produk['nama']); ?>
                </h1>

                <div class="detail-line"></div>

                <p class="detail-description">
                    <?php echo htmlspecialchars($produk['deskripsi']); ?>
                </p>


                <div class="detail-price">

                    Rp
                    <?php echo number_format($produk['harga'], 0, ',', '.'); ?>

                </div>


                <div class="detail-stock">

                    <?php if ($produk['stok'] > 0): ?>

                        Available · <?php echo $produk['stok']; ?> items

                    <?php else: ?>

                        Out of Stock

                    <?php endif; ?>

                </div>


                <div class="detail-actions">

                    <a
                        href="produk.php"
                        class="back-btn"
                    >
                        ← Back to Collection
                    </a>

                </div>

            </div>

        </div>

    </section>


    <!-- FOOTER -->

    <footer>

        <div class="footer-logo">
            SK-II
        </div>

        <p>
            Luxury Skincare Collection
        </p>

        <span>
            © 2026 SK-II Store
        </span>

    </footer>


</body>

</html>