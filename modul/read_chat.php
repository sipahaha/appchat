<?php 
include '../lib/koneksi.php';

$stmt = $pdo->query("SELECT * FROM tb_chats");
$chats = $stmt->fetchAll();
?>
<table>
    <tr>
        <th>Id</th>
        <th>Chat Name</th>
    </tr>
    <?php foreach ($chats as $chat): ?>
        <tr>
            <td><?= htmlspecialchars($chat['id']) ?></td>
            <td><?= htmlspecialchars($chat['chat_name']) ?></td>
            <td>
                <a href="update_chat.php?id=<?= htmlspecialchars($chat['id']) ?>">Edit</a>
                <a href="delete_chat.php?id=<?= htmlspecialchars($chat['id']) ?>">Hapus</a>
            </td>
        </tr> 
    <?php endforeach; ?>
</table>
