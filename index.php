<?php
session_start(); 
include "lib/koneksi.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); 
    exit();
}

$username = $_SESSION['username'];
?>

<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama</title>
</head>
<body>
    <h1>Selamat datang, <?php echo htmlspecialchars($username); ?>!</h1>
    <p>Ini adalah halaman utama setelah login.</p>
    
    <h2>Menu</h2>
    <ul>
        <li><a href="profile.php">Profil Saya</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</body>
</html>