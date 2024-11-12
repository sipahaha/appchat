<?php 
require '../lib/koneksi.php'; 
 
$chat_id = $_GET['chat_id']; 
$stmt = $pdo->prepare("SELECT tb_messages.*, tb_users.username FROM tb_messages JOIN tb_users ON tb_messages.user_id = tb_users.id WHERE chat_id = ?"); 
$stmt->execute([$chat_id]); 
$messages = $stmt->fetchAll(); 
 foreach ($messages as $message) {   
      echo "<div><strong>{$message['username']}:</strong> 
{$message['message']} <em>{$message['created_at']}</em></div>"; 
} 
?>