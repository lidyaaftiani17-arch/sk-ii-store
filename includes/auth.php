<?php

session_start();


// Mengecek apakah admin sudah login

if (!isset($_SESSION['admin_id'])) {

    header("Location: ../auth/login.php");

    exit;

}

?>