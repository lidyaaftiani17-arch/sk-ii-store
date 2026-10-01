<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | SK-II</title>

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body class="login-page">


    <div class="login-container">


        <!-- BAGIAN KIRI -->

        <div class="login-brand">

            <div class="login-logo">
                SK-II
            </div>

            <p>
                LUXURY SKINCARE
            </p>

            <span>
                Manage your collection<br>
                with elegance.
            </span>

        </div>


        <!-- BAGIAN KANAN -->

        <div class="login-form-container">

            <p class="login-label">
                ADMIN ACCESS
            </p>

            <h1>
                Welcome Back
            </h1>

            <p class="login-description">
                Silakan masuk untuk mengelola
                koleksi produk SK-II.
            </p>


            <form action="proses_login.php" method="POST">


                <div class="form-group">

                    <label for="username">
                        Username
                    </label>

                    <input
                        type="text"
                        id="username"
                        name="username"
                        placeholder="Masukkan username"
                        required
                    >

                </div>


                <div class="form-group">

                    <label for="password">
                        Password
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Masukkan password"
                        required
                    >

                </div>


                <button
                    type="submit"
                    class="login-submit"
                >
                    Sign In
                </button>


            </form>


            <a href="../index.php" class="back-home">
                ← Kembali ke Website
            </a>

        </div>

    </div>


</body>

</html>