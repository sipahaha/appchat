<?php 
include ('../lib/koneksi.php');

$id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT*FROM tb_chats WHERE id = $id ");
    $stmt->execute();
    $name = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Ambil daftar chat dari database
try {
    $stmt = $pdo->query("SELECT * FROM tb_chats");
    $chats = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
$stmt = $pdo->prepare("SELECT * FROM tb_users");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Application</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    body {
        background-color: #f8f9fa;
        margin: 20px;
    }

    .chat-container {
        max-width: 800px;
        margin: 0 auto;
        background-color: #ffffff;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    #messages {
        height: 300px;
        overflow-y: scroll;
        margin-bottom: 20px;
        padding: 10px;
        border: 1px solid #ced4da;
        border-radius: 5px;
        background-color: #e9ecef;
    }

    .message-item {
        margin-bottom: 10px;
    }

    .message-sender {
        font-weight: bold;
    }

    .message-content {
        margin-left: 10px;
        display: inline-block;
    }

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
        background-color: #d4edda;
        border-top-right-radius: 0;
    }

    .message-item.receiver {
        align-self: flex-start;
        background-color: #f8d7da;
        border-top-left-radius: 0;
    }

    .message-item::after {
        content: '';
        position: absolute;
        bottom: 0;
        width: 0;
        height: 0;
    }

    .message-item.sender::after {
        right: -10px;
        border-width: 10px 0 10px 10px;
        border-color: transparent transparent transparent #d4edda;
        border-style: solid;
    }

    .message-item.receiver::after {
        left: -10px;
        border-width: 10px 10px 10px 0;
        border-color: transparent #f8d7da transparent transparent;
        border-style: solid;
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
</head>

<body>

    <div class="chat-container">
        <h3 class="text-center">Chat Room</h3>

        <div id="messages">
            <!-- Pesan akan dimuat di sini -->
        </div>


        <form id="messageForm" class="mb-3">
            <div class="form-group">
                <label for="chat_id">Chat:</label>
                <select name="chat_id" id="chat_id" class="form-control" required>
                    <!-- Opsi chat diisi melalui PHP -->
                    <?php foreach ($chats as $chat): ?>
                    <option value="<?= htmlspecialchars($chat['id']); ?>"><?= htmlspecialchars($chat['chat_name']); ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="user_id">User:</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    <!-- Opsi user diisi melalui PHP -->
                    <?php foreach ($users as $user): ?>
                    <option value="<?= htmlspecialchars($user['id']); ?>"><?= htmlspecialchars($user['username']); ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea name="message" id="message" class="form-control" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Kirim</button>
        </form>
    </div>


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

</body>

</html>