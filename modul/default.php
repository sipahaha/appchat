<?php
require 'lib/koneksi.php';

// Memulai sesi jika belum dimulai
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$username = $_SESSION['username'] ?? 'Anonymous';
// Menambahkan chat baru ke database
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['chat_name'])) {
    $chat_name = $_POST['chat_name'];

    // Memasukkan chat baru ke database
    $sql = "INSERT INTO tb_chats (chat_name) VALUES (:chat_name)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':chat_name', $chat_name);
    $stmt->execute();

    // Mendapatkan ID chat yang baru dimasukkan
    $chat_id = $pdo->lastInsertId();
    
    if ($chat_id) {
        $_SESSION['chat_id'] = $chat_id; // Menyimpan chat_id ke sesi
    }

   
}

// Mengambil daftar chat dari database
$stmt = $pdo->prepare("SELECT * FROM tb_chats");
$stmt->execute();
$chats = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Mendapatkan chat_id dari query string, atau set null jika belum ada
$chat_id = isset($_GET['chat_id']) ? $_GET['chat_id'] : null;
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
    /* Reset styling */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Arial', sans-serif;
}

/* Kontainer utama */
.chat-container {
    display: flex;
    height: 100vh;
    background-color: #f9f9f9;
    color: #333;
}

/* Daftar Chat */
.chat-list {
    width: 30%;
    background-color: #34495e;
    color: #ecf0f1;
    padding: 20px;
    overflow-y: auto;
    border-right: 3px solid #bdc3c7;
}

.chat-list h2 {
    font-size: 24px;
    margin-bottom: 20px;
    text-transform: uppercase;
    color: #ecf0f1;
    font-weight: bold;
}

.chat-list div a {
    display: block;
    padding: 10px;
    margin: 10px 0;
    border-radius: 5px;
    color: #ecf0f1;
    text-decoration: none;
    transition: background 0.3s;
}

.chat-list div a:hover {
    background-color: #2980b9;
}

/* Form untuk menambah chat */
.add-chat-form {
    display: flex;
    margin-bottom: 20px;
}

.add-chat-form input {
    width: 70%;
    padding: 10px;
    margin-right: 5px;
    border: 2px solid #2980b9;
    border-radius: 5px;
    font-size: 16px;
}

.add-chat-form button {
    padding: 10px 20px;
    background-color: #2980b9;
    color: #ecf0f1;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background 0.3s;
}

.add-chat-form button:hover {
    background-color: #3498db;
}

/* Jendela Chat */
.chat-window {
    width: 70%;
    display: flex;
    flex-direction: column;
    background-color: #ecf0f1;
    padding: 20px;
    overflow-y: auto;
}

.greeting-header {
    color: #2980b9; /* Warna biru terang untuk judul */
    font-size: 32px;
    font-weight: bold;
    text-align: center;
    margin-bottom: 20px;
    text-transform: uppercase;
}

.default-view {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    height: 100%;
}

.default-view h2 {
    font-size: 28px;
    margin-bottom: 20px;
    color: #2980b9;
    font-weight: bold;
}

.default-view p {
    font-size: 18px;
    color: #7f8c8d;
    line-height: 1.6;
}

/* Responsif untuk ukuran layar kecil */
@media (max-width: 768px) {
    .chat-container {
        flex-direction: column;
    }

    .chat-list {
        width: 100%;
        border-right: none;
        border-bottom: 2px solid #bdc3c7;
    }

    .chat-window {
        width: 100%;
    }

    .add-chat-form input {
        width: 60%;
    }

    .add-chat-form button {
        width: 30%;
    }
}

</style>
<body>
    <div class="chat-container">
        <!-- Daftar Chat -->
        <div class="chat-list">
            <h2>Chats</h2>
            
            <!-- Form untuk menambah chat -->
            <form action="" method="POST" class="add-chat-form">
                <input type="text" name="chat_name" placeholder="New chat name" required>
                <button type="submit">Add Chat</button>
            </form>
            
            <?php foreach ($chats as $chat): ?>
                <div>
                    <a href="modul/read_chat.php?chat_id=<?= $chat['id'] ?>" class="chat-link">
                        <?= htmlspecialchars($chat['chat_name']); ?>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
            
            <!-- Jendela Chat atau Halaman Default -->
            <div class="chat-window">
                <div class="default-view">
                    <h2>Welcome to the Chat App!</h2>
                    <p>Choose a chat from the list on the left or create a new one.</p>
                    <a href="?page=keluar" class="btn btn-danger">Logout</a>
                </div>
        </div>
    </div>
</body>
</html>