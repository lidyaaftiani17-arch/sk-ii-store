<?php

require_once "config/database.php";

$query = "SELECT * FROM produk ORDER BY id ASC";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Collection | SK-II</title>

    <link
        rel="stylesheet"
        href="assets/css/style.css"
    >

</head>

<body>


<!-- NAVBAR -->

<header class="luxury-navbar">

    <div class="nav-logo">

        <a href="index.php">
            SK-II
        </a>

        <span>
            LUXURY SKINCARE
        </span>

    </div>


    <nav class="nav-menu">

        <a href="index.php">
            Home
        </a>

        <a
            href="produk.php"
            class="active"
        >
            Collection
        </a>

        <a href="tentang.php">
            About
        </a>

        <a
            href="auth/login.php"
            class="nav-admin"
        >
            Admin
        </a>

    </nav>

</header>


<!-- PAGE HEADER -->

<section class="collection-header">

    <p class="section-label">
        THE SK-II COLLECTION
    </p>

    <h1>
        Refined Skincare,
        <br>
        Timeless Ritual.
    </h1>

    <p>
        Jelajahi rangkaian skincare SK-II yang
        dipilih untuk melengkapi ritual perawatan
        kulit dengan sentuhan premium dan elegan.
    </p>

</section>


<!-- PRODUCT COLLECTION -->

<section class="collection-section">

    <div class="collection-top">

        <span>
            OUR COLLECTION
        </span>

        <span>
            <?php echo mysqli_num_rows($result); ?> PRODUCTS
        </span>

    </div>


    <div class="luxury-product-grid">

        <?php while ($produk = mysqli_fetch_assoc($result)): ?>

            <article class="luxury-product-card">


                <!-- PRODUCT IMAGE -->

                <a
                    href="detail.php?id=<?php echo $produk['id']; ?>"
                    class="product-image-wrapper"
                >

                    <?php

                    $gambar =
                        "uploads/produk/" .
                        $produk['gambar'];

                    if (
                        !empty($produk['gambar']) &&
                        file_exists($gambar)
                    ):

                    ?>

                        <img
                            src="<?php echo htmlspecialchars($gambar); ?>"
                            alt="<?php echo htmlspecialchars($produk['nama']); ?>"
                        >

                    <?php else: ?>

                        <div class="product-image-placeholder">

                            <span>
                                SK-II
                            </span>

                            <small>
                                LUXURY SKINCARE
                            </small>

                        </div>

                    <?php endif; ?>

                </a>


                <!-- PRODUCT INFORMATION -->

                <div class="luxury-product-info">

                    <p class="product-category">
                        <?php
                        echo htmlspecialchars(
                            $produk['kategori']
                        );
                        ?>
                    </p>


                    <h2>
                        <?php
                        echo htmlspecialchars(
                            $produk['nama']
                        );
                        ?>
                    </h2>


                    <p class="product-description">
                        <?php
                        echo htmlspecialchars(
                            $produk['deskripsi']
                        );
                        ?>
                    </p>


                    <div class="product-bottom">

                        <span class="product-price">
                            Rp
                            <?php
                            echo number_format(
                                $produk['harga'],
                                0,
                                ',',
                                '.'
                            );
                            ?>
                        </span>


                        <a
                            href="detail.php?id=<?php echo $produk['id']; ?>"
                            class="product-link"
                        >
                            View Details →
                        </a>

                    </div>

                </div>

            </article>

        <?php endwhile; ?>

    </div>

</section>


<!-- CTA -->

<section class="luxury-cta">

    <p class="section-label">
        THE SK-II RITUAL
    </p>

    <h2>
        Discover Your
        <br>
        Signature Ritual.
    </h2>

    <a
        href="index.php"
        class="hero-button"
    >
        Back to Home
    </a>

</section>


<!-- FOOTER -->

<footer class="luxury-footer">

    <div>

        <h3>
            SK-II
        </h3>

        <p>
            Luxury skincare for timeless beauty.
        </p>

    </div>


    <div class="footer-links">

        <a href="index.php">
            Home
        </a>

        <a href="produk.php">
            Collection
        </a>

        <a href="tentang.php">
            About
        </a>

        <a href="auth/login.php">
            Admin
        </a>

    </div>


    <p class="copyright">
        © 2026 SK-II Luxury Store.
        All Rights Reserved.
    </p>

</footer>


</body>

</html>