<?php
require 'lib/koneksi.php';
$stmt = $pdo->prepare("SELECT * FROM tb_chats");
$stmt->execute();
$chats = $stmt->fetchAll(PDO::FETCH_ASSOC);
$username = $_SESSION['username'];
?>
  </h1>
<?php
// Menambahkan chat baru ke database
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['chat_name'])) {
    $chat_name = $_POST['chat_name'];
    $sql = "INSERT INTO tb_chats (chat_name) VALUES (:chat_name)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':chat_name', $chat_name);
    $stmt->execute();
    header("Location: chat.php");
    exit();
}

// Mengambil daftar chat dari database
$sql = "SELECT * FROM tb_chats";
$stmt = $pdo->query($sql);
$chats = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Application</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    /* Reset default margin and padding */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
}

/* Chat container styles */
.chat-container {
    display: flex;
    height: 100vh;
}

/* Sidebar styles */
.sidebar {
    width: 300px;
    background-color: #fff;
    border-right: 1px solid #ddd;
    padding: 20px;
    position: relative;
}

/* Create chat form styles */
.create-chat {
    margin-bottom: 20px;
}

.create-chat input[type="text"] {
    width: calc(100% - 80px);
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin-right: 10px;
}

.create-chat button {
    padding: 10px;
    background-color: #25D366; /* WhatsApp green */
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.create-chat button:hover {
    background-color: #128C7E; /* Darker green on hover */
}

/* Chat list styles */
.chat-list {
    list-style-type: none;
    margin-top: 20px;
}

.chat-item {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin-bottom: 10px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.chat-item:hover {
    background-color: #f1f1f1; /* Light gray on hover */
}

/* Chat window styles */
.chat-window {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    background-color: #fff;
}

/* Chat header styles */
.chat-header {
    background-color: #25D366; /* WhatsApp green */
    color: white;
    padding: 15px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

/* Chat messages styles */
.chat-messages {
    flex-grow: 1;
    padding: 20px;
    overflow-y: auto;
}

.message {
    margin-bottom: 15px;
    padding: 10px;
    border-radius: 5px;
    max-width: 70%;
}

.incoming {
    background-color: #e5e5e5; /* Light gray for incoming messages */
    align-self: flex-start;
}

.outgoing {
    background-color: #25D366; /* WhatsApp green for outgoing messages */
    color: white;
    align-self: flex-end;
}

/* Chat input styles */
.chat-input {
    display: flex;
    padding: 10px;
    border-top: 1px solid #ddd;
}

.chat-input input[type="text"] {
    flex-grow: 1;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin-right: 10px;
}

.chat-input button {
    padding: 10px;
    background-color: #25D366; /* WhatsApp green */
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.chat-input button:hover {
    background-color: #128C7E;
}
</style>
<body>
    <div class="chat-container">
        <div class="sidebar">
            <div class="create-chat">
                <form method="POST" action="chat.php">
                    <input type="text" name="chat_name" placeholder="New Chat Name" maxlength="150" required>
                    <button type="submit">+ Create Chat</button>
                </form>
                <ul class="chat-list">
                    <?php foreach ($chats as $chat): ?>
                        <li class="chat-item"><a href="?page=create"><?php echo htmlspecialchars($chat['chat_name']); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            </div>
        
        <div class="chat-window">
            <div class="chat-header">
                <h2>Chat Room</h2>
            </div>
            <div class="chat-input">
                <input type="text" placeholder="Type your message.." id="messageInput">
                <button id="sendMessageButton">Send</button>
            </div>
        </div>
    </div>
</body>
</html>
