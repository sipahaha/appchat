<?php
require 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];

    $stmt = $pdo->prepare("INSERT INTO tb_users (username, email) VALUES (?, ?)");
    $stmt->excute([$username, $email]);

    header("Location: read_users.php");
}
?>

<form  method="post">
    <div class="mb-3">
        <label for=""> Username: </label>
        <input type="text" name="username" required>
    </div>
</form>
