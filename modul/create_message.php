<?php
include '../lib/koneksi.php';

$stmt = $pdo->query("SELECT * FROM tb_chats");
$chats = $stmt->fetchAll();

$stmt = $pdo->query("SELECT * FROM tb_users");
$users = $stmt->fetchAll();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $chat_id = $_POST['chat_id'];
    $user_id = $_POST['user_id'];
    $message = $_POST['message'];

    $stmt = $pdo->prepare("INSERT INTO message (chat_id, user_id, message) VALUES ($chat_id, $user_id, $message)");
    $stmt->execute([$chat_id, $user_id, $message]);

   header("Location: read_messages.php?chat_id=$chat_id");
}
?>

<form method="post">
    Chat: 
    <select name="chat_id">
        <?php foreach ($chats as $chat): ?>
            <option value="<?=$chat['id'] ?>"><?=$chat['chat_name']?></option>
            <?php endforeach; ?>
    </select>
    User : 
    <select name="user_id">
        <?php foreach ($users as $user): ?>
            <option value="<?=$user['id']?>"><?=$user['username']?></option>
            <?php endforeach; ?>
    </select>
    Message : <textarea nama="message" required></textarea>
    <button type="submit">kirim</button>
</form>