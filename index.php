<?php
// Menghubungkan ke database
require 'lib/koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat App</title>
    <link rel="stylesheet" href="style.css"> <!-- Gaya CSS untuk tampilan aplikasi -->
    <script src="script.js" defer></script> <!-- File JavaScript untuk AJAX dan interaktivitas -->
</head>
<body>
    <div class="container">
        <!-- Daftar Pengguna -->
        <div class="user-list">
            <h2>Daftar Pengguna</h2>
            <?php include 'modul/read_users.php'; ?> <!-- Memanggil daftar pengguna dari file read_user.php -->
        </div>

        <!-- Area Chat -->
        <div class="chat-area">
            <h2>Chat Room</h2>
            <div class="messages" id="messages">
                <?php include 'modul/read_messages.php'; ?> <!-- Memanggil pesan-pesan dari file read_message.php -->
            </div>

            <!-- Form Kirim Pesan -->
            <form id="chatForm" method="post">
                <input type="hidden" name="pengirim_id" value="1"> <!-- ID Pengirim, bisa diubah sesuai ID user -->
                <input type="hidden" name="penerima_id" value="2"> <!-- ID Penerima, bisa diubah sesuai tujuan -->
                <textarea name="isi_pesan" id="isi_pesan" placeholder="Tulis pesan..."></textarea>
                <button type="submit">Kirim</button>
            </form>
        </div>
    </div>
</body>
</html>
