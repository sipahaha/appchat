<?php
include 'koneksi.php';

$chat_id = $_GET['chat_id'];
$stmt = $pdo->prepare("SELECT * FROM tb_messages WHERE chat_id = ?");
$stmt->execute([$chat_id]);
$messages = $stmt->fetchAll();
?>

<table>
    <tr>
        <th>ID</th>
        <th>User</th>
        <th>Message</th>
        <th>Waktu</th>
    </tr>
    <?php foreach($messages as $message): ?>
        <tr>
            <td><?= $message['id'] ?></td>
            <td>
                <?php
                $user_stmt = $pdo->prepare("SELECT username FROM tb_users WHERE id = ?");
                $user_stmt->execute([$message['user_id']]);
                $user = $user_stmt->fetch();
                echo $user['username'];
                ?>
            </td>
            <td><?= $message['message'] ?></td>
            <td><?= $message['created_at'] ?></td>
        </tr>
    <?php endforeach; ?>

</table>