<?php 
session_start();
include ('../lib/koneksi.php');

$chat_id = $_GET['chat_id'];
$stmt = $pdo->prepare("SELECT m.*, u.username FROM tb_messages m JOIN tb_users u ON m.user_id = u.id WHERE m.chat_id = :chat_id ORDER BY m.created_at ASC");
$stmt->execute(['chat_id' => $chat_id]);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($messages as $message) {
    // Asumsikan Anda memiliki cara untuk mengidentifikasi pengirim
    $isSender = ($message['user_id'] == $_SESSION['user_id']); // Ganti dengan logika ID pengguna yang sebenarnya

    echo '<div class="message-item ' . ($isSender ? 'sender' : 'receiver') . '">';
    echo '<div class="message-sender">' . htmlspecialchars($message['username']) . '</div>';
    echo '<div class="message-content">' . htmlspecialchars($message['message']) . '</div>';
    echo '<div class="message-time">' . date('H:i', strtotime($message['created_at'])) . '</div>';
    echo '</div>';
}

?>

<style>
      #messages {
    height: 300px;
    overflow-y: auto;
    padding: 10px;
    border: 1px solid #ced4da;
    border-radius: 5px;
    background-color: #f1f1f1;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.message-item {
    max-width: 60%;
    padding: 10px 15px;
    border-radius: 20px;
    position: relative;
    margin-bottom: 10px;
    display: inline-block;
    word-wrap: break-word;
}

.message-item.sender {
    align-self: flex-end;
    background-color: #d4edda; /* Hijau muda */
    border-top-right-radius: 0;
}

.message-item.receiver {
    align-self: flex-start;
    background-color: #f8d7da; /* Merah muda */
    border-top-left-radius: 0;
}

.message-sender {
    font-weight: bold;
    margin-bottom: 5px;
    color: #333;
}

.message-time {
    font-size: 0.8em;
    color: #6c757d;
    text-align: right;
    margin-top: 5px;
}
</style>