<?php
include '../lib/koneksi.php';

$id = $_GET['id'];
$sql = "SELECT * FROM tb_chats WHERE id = '$id'";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$mess = $stmt->fetchAll();

$stmt = $pdo->query("SELECT * FROM tb_chats");
$chats = $stmt->fetchAll();

$stmt = $pdo->query("SELECT * FROM tb_users");
$users = $stmt->fetchAll();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = $_POST['message'];

    $stmt = $pdo->prepare("INSERT INTO tb_messages (message) VALUES ($message)");
    $stmt->execute(':messages', $message);

   header("Location: read_messages.php?chat_id=$chat_id");
}
?>

<form method="post">
    <div class="chat-input">
        <input type="text" placeholder="Type your message.." id="messages" name="message">
        <button id="sendMessageButton">Send</button>
    </div>
</form>