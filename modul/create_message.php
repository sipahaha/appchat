<?php
require '../lib/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $chat_id = $_POST['chat_id'];
    $message = $_POST['message'];
    $username = $_SESSION['username'] ?? 'Anonymous';
    $sql = "SELECT * FROM tb_chats";
    $stmt = $pdo->prepare("INSERT INTO tb_messages (chat_id, username, message) VALUES (:chat_id, :username, :message)");
    $stmt->bindParam(':chat_id', $chat_id);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':message', $message);
    $stmt->execute();

    header("Location: index.php?chat_id=" . $chat_id); // Redirect kembali ke halaman chat
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f5f5f5;
        }
        .chat-container {
            width: 400px;
            height: 600px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }
        .chat-header {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            font-size: 18px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .chat-messages {
            flex-grow: 1;
            padding: 10px;
            overflow-y: auto;
            background-color: #f9f9f9;
            border-bottom: 2px solid #ddd;
        }
        .chat-input-container {
            display: flex;
            padding: 10px;
            background-color: #fff;
            border-radius: 0 0 8px 8px;
        }
        #messageInput {
            flex-grow: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-right: 10px;
            font-size: 14px;
        }
        #sendMessageBtn {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        #sendMessageBtn:hover {
            background-color: #45a049;
        }
        .message {
            margin-bottom: 10px;
            padding: 8px;
            background-color: #e1f7d5;
            border-radius: 4px;
            max-width: 80%;
            word-wrap: break-word;
        }
        .message.from-user {
            background-color: #d1e7ff;
            margin-left: auto;
            text-align: right;
        }
    </style>
</head>
<body>

<div class="chat-container">
    <div class="chat-header">
        Chat Room
    </div>
    <center>
    <p class="text-center"><?= $sql['chat_name']?></p>
    </center>
    <div class="chat-messages" id="chatMessages">
        <!-- Messages will appear here -->
    </div>
    <div class="chat-input-container">
        <input type="text" id="messageInput" placeholder="Type your message" />
        <button id="sendMessageBtn">Send</button>
    </div>
</div>

<script>
    // JavaScript to handle chat functionality
    const messageInput = document.getElementById("messageInput");
    const sendMessageBtn = document.getElementById("sendMessageBtn");
    const chatMessages = document.getElementById("chatMessages");

    // Function to display messages
    function displayMessage(message, isUser) {
        const messageElement = document.createElement("div");
        messageElement.classList.add("message");
        if (isUser) {
            messageElement.classList.add("from-user");
        }
        messageElement.textContent = message;
        chatMessages.appendChild(messageElement);

        // Auto-scroll to the latest message
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    // Event listener for the send button
    sendMessageBtn.addEventListener("click", () => {
        const message = messageInput.value.trim();
        if (message) {
            displayMessage(message, true); // Show the user's message
            messageInput.value = ""; // Clear input field
        }
    });

    // Event listener for pressing "Enter" in the input field
    messageInput.addEventListener("keypress", (e) => {
        if (e.key === "Enter" && messageInput.value.trim() !== "") {
            sendMessageBtn.click(); // Trigger the send button click event
        }
    });
</script>

</body>
</html>