<?php

session_start();

require_once "../config/database.php";


$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';


// Mencari username di database
$query = "SELECT * FROM admin WHERE username = ?";

$stmt = mysqli_prepare($conn, $query);

mysqli_stmt_bind_param($stmt, "s", $username);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);


if (mysqli_num_rows($result) === 1) {

    $admin = mysqli_fetch_assoc($result);


    // Mengecek password
    if (password_verify($password, $admin['password'])) {


        // Membuat session
        $_SESSION['admin_id'] = $admin['id'];

        $_SESSION['admin_nama'] = $admin['nama'];

        $_SESSION['admin_username'] = $admin['username'];


        // Masuk ke halaman admin
        header("Location: ../admin/index.php");

        exit;


    } else {

        echo "
        <script>
            alert('Password yang dimasukkan salah.');
            window.location='login.php';
        </script>
        ";

    }

} else {

    echo "
    <script>
        alert('Username tidak ditemukan.');
        window.location='login.php';
    </script>
    ";

}

?>