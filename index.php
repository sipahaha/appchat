<?php

session_start(); // Mulai session
// Koneksi ke database
$servername = "localhost"; // Ganti dengan server Anda jika perlu
$username = "root"; // Ganti dengan username database Anda
$password = "sipa2402"; // Ganti dengan password database Anda
$dbname = "chatapp";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect ke halaman login jika belum login
    exit();
}

// Ambil informasi pengguna dari session
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