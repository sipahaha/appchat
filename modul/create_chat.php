<?php
require 'lib/koneksi.php';
$stmt = $pdo->prepare("SELECT * FROM tb_chats");
$stmt->execute();
$chats = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<table>
  <thead>
    <tr>
      <th>Chat Name</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($chats as $chat): ?>
      <tr>
        <td><?php echo $chat['id']; ?></td>
        <td><?php echo $chat['chat_name']; ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>