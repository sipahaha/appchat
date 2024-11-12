<?php
include('../lib/koneksi.php');

// Ambil user_id dari query string
$user_id = $_GET['user_id'] ?? null;

if ($user_id) {
    $stmt = $pdo->prepare("SELECT * FROM tb_messages WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $messages = $stmt->fetchAll();
} else {
    echo "User ID tidak ditemukan.";
    exit;
}
?>

<table>
    <tr>
        <th>ID</th>
        <th>User</th>
        <th>Message</th>
        <th>Waktu</th>
    </tr>
    <?php foreach ($messages as $message): ?>
    <tr>
        <td><?= htmlspecialchars($message['id']) ?></td>
        <td>
            <?php
                $user_stmt = $pdo->prepare("SELECT username FROM tb_users WHERE id = ?");
                $user_stmt->execute([$message['user_id']]);
                $user = $user_stmt->fetch();
                echo htmlspecialchars($user['username']);
                ?>
        </td>
        <td><?= htmlspecialchars($message['message']) ?></td>
        <td><?= htmlspecialchars($message['created_at']) ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<!-- Tambahkan ini di dalam file read_messages.php -->
<form id="messageForm"> Chat:
    <select name="chat_id" id="chat_id">
        <!-- Opsi chat diisi melalui PHP -->
    </select>
    User:
    <select name="user_id" id="user_id">
        <!-- Opsi user diisi melalui PHP -->
    </select>
    Message: <textarea name="message" id="message" required></textarea>
    <button type="submit">Kirim</button>
</form>

<div id="messages"></div>

<script>
document.getElementById('messageForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    fetch('send_message.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadMessages();
                document.getElementById('message').value =
                ''; // Clear the message input         } else {             alert('Error: ' + data.error); 
            }
        });
});

function loadMessages() {
    fetch('load_messages.php?chat_id=' + document.getElementById('chat_id').value)
        .then(response => response.text())
        .then(html => {
            document.getElementById('messages').innerHTML = html;
        });
}

// Load messages on page load loadMessages(); 
</script>