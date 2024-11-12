<?php 
include 'lib/koneksi.php';

$stmt = $pdo->query("SELECT * FROM tb_chats");
$chats = $stmt->fetchAll();
?>

<ul class="chat-list">
                    <?php foreach ($chats as $chat): ?>
                        <li class="chat-item"><a href="?page=chat_room&id=<?=$chat['id'];?>"><?php echo htmlspecialchars($chat['chat_name']); ?></a></li>
                    <?php endforeach; ?>
                </ul>
