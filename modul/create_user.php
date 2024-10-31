<?php
include '../lib/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];

    $stmt = $pdo->prepare("INSERT INTO tb_users (username, email) VALUES (?, ?)");
    $stmt->execute([$username, $email]); // Perbaiki dari excute ke execute

    header("Location: read_users.php");
    exit(); // Tambahkan exit setelah header untuk memastikan script berhenti
}
?>

<form method="post">
    <div class="mb-3">
        <label for=""> Username: </label>
        <input type="text" name="username" required>
    </div>
    <div class="mb-3">
        <label for=""> Email: </label>
        <input type="text" name="email" required>
    </div>
    <button type="submit">Simpan</button>
</form>
