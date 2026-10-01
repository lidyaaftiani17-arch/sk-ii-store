<?php

require_once "../includes/auth.php";
require_once "../config/database.php";


$query = "SELECT * FROM produk ORDER BY id DESC";

$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kelola Produk | SK-II</title>

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

            <a href="index.php">
                Dashboard
            </a>

            <a href="produk.php" class="active">
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


    <!-- MAIN -->

    <main class="admin-main">


        <!-- HEADER -->

        <div class="admin-product-header">

            <div>

                <p class="admin-small-title">
                    PRODUCT MANAGEMENT
                </p>

                <h1>
                    Kelola Produk
                </h1>

                <p class="admin-product-description">
                    Kelola koleksi produk skincare SK-II
                    melalui halaman administrator.
                </p>

            </div>


            <a
                href="tambah.php"
                class="admin-primary-btn"
            >
                + Tambah Produk
            </a>

        </div>


        <!-- PRODUCT TABLE -->

        <div class="admin-table-container">

            <table class="admin-table">

                <thead>

                    <tr>

                        <th>
                            No
                        </th>

                        <th>
                            Produk
                        </th>

                        <th>
                            Kategori
                        </th>

                        <th>
                            Harga
                        </th>

                        <th>
                            Stok
                        </th>

                        <th>
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    <?php

                    $no = 1;

                    while ($produk = mysqli_fetch_assoc($result)):

                    ?>

                    <tr>

                        <td>
                            <?php echo $no++; ?>
                        </td>


                        <td>

                            <div class="admin-product-name">

                                <?php if (!empty($produk['gambar'])): ?>

                                    <img
                                        src="../uploads/produk/<?php echo htmlspecialchars($produk['gambar']); ?>"
                                        alt="<?php echo htmlspecialchars($produk['nama']); ?>"
                                    >

                                <?php else: ?>

                                    <div class="admin-no-image">
                                        SK-II
                                    </div>

                                <?php endif; ?>


                                <div>

                                    <strong>
                                        <?php echo htmlspecialchars($produk['nama']); ?>
                                    </strong>

                                    <span>
                                        ID #<?php echo $produk['id']; ?>
                                    </span>

                                </div>

                            </div>

                        </td>


                        <td>
                            <?php echo htmlspecialchars($produk['kategori']); ?>
                        </td>


                        <td>
                            Rp <?php echo number_format($produk['harga'], 0, ',', '.'); ?>
                        </td>


                        <td>
                            <?php echo $produk['stok']; ?>
                        </td>


                        <td>

                            <div class="admin-actions">

                                <a
                                    href="edit.php?id=<?php echo $produk['id']; ?>"
                                    class="edit-btn"
                                >
                                    Edit
                                </a>


                                <a
                                    href="hapus.php?id=<?php echo $produk['id']; ?>"
                                    class="delete-btn"
                                    onclick="return confirm('Yakin ingin menghapus produk ini?');"
                                >
                                    Hapus
                                </a>

                            </div>

                        </td>

                    </tr>

                    <?php endwhile; ?>


                    <?php if (mysqli_num_rows($result) === 0): ?>

                        <tr>

                            <td
                                colspan="6"
                                class="empty-table"
                            >
                                Belum ada produk.
                            </td>

                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>


    </main>


</body>

</html>