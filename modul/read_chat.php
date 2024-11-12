<?php 
include ('../lib/koneksi.php');

// Ambil daftar chat dari database
try {
    $stmt = $pdo->query("SELECT * FROM tb_chats");
    $chats = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>


<form id="messageForm">
    <label for="chat_id">Chat:</label>
    <select name="chat_id" id="chat_id" required>
        <?php foreach ($chats as $chat): ?>
        <option value="<?= htmlspecialchars($chat['id']); ?>"><?= htmlspecialchars($chat['chat_name']); ?></option>
        <?php endforeach; ?>
    </select>

    <label for="user_id">User:</label>
    <select name="user_id" id="user_id" required>
        <!-- Opsi user diisi melalui PHP -->
        <?php
        // Ambil daftar pengguna dari database
        try {
            $stmt = $pdo->query("SELECT * FROM tb_users");
            $users = $stmt->fetchAll();
            foreach ($users as $user) {
                echo '<option value="' . htmlspecialchars($user['id']) . '">' . htmlspecialchars($user['username']) . '</option>';
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>
    </select>

    <label for="message">Message:</label>
    <textarea name="message" id="message" required></textarea>

    <button type="submit" name="btn">Kirim</button>
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
            document.getElementById('message').value = ''; // Bersihkan input pesan
        } else {
            alert('Error: ' + data.error);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat mengirim pesan.');
    });
});

function loadMessages() {
    const chatId = document.getElementById('chat_id').value;
    fetch('load_messages.php?chat_id=' + encodeURIComponent(chatId))
        .then(response => response.text())
        .then(html => {
            document.getElementById('messages').innerHTML = html;
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat memuat pesan.');
        });
}

// Memuat pesan saat halaman di-load
window.onload = loadMessages;
</script>
