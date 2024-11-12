<?php
session_start();
require '../lib/koneksi.php';

// Mengecek jika session user_id sudah diset atau belum
$user_id = isset($_SESSION['id']) ? $_SESSION['id'] : null;

// Mengambil daftar chat dari database
try {
    $stmt = $pdo->query("SELECT * FROM tb_chats");
    $chats = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}

// Validasi parameter chat_id
$chat_id = isset($_GET['chat_id']) ? $_GET['chat_id'] : null;
if (!$chat_id) {
    echo "Chat ID tidak ditemukan.";
    exit();
}
?>
<div class="message-container" style="height: 54vh; overflow-y: auto;">
    <?php
    try {
        $stmt = $pdo->prepare("
            SELECT tb_messages.*, tb_users.username, DATE_FORMAT(tb_messages.created_at, '%H:%i, %d %M %Y') as formatted_time
            FROM tb_messages
            JOIN tb_users ON tb_messages.user_id = tb_users.id
            WHERE chat_id = ?
            ORDER BY created_at
        ");
        $stmt->execute([$chat_id]);
        while ($messages = $stmt->fetch()) {
            $isOwn = $user_id && $messages['user_id'] == $user_id;
    ?>
    <div class="message-wrapper <?= $isOwn ? 'text-end' : 'text-start'; ?> mb-3">
        <div class="message-bubble <?= $isOwn ? 'bg-sender text-dark' : 'bg-light'; ?> p-2 d-inline-block rounded">
            <div class="message-header">
                <strong><?= htmlspecialchars($messages['username']) ?></strong>
            </div>
            <div class="message-content">
                <?= htmlspecialchars($messages['message']) ?>
            </div>
            <div class="message-footer">
                <i><small class="text-muted"><?= $messages['formatted_time'] ?></small></i>
            </div>
        </div>
    </div>
    <?php
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>
</div>
<form action="create_message.php" method="POST" class="mt-3">
    <input type="hidden" name="chat_id" value="<?= htmlspecialchars($chat_id) ?>">
    <div class="input-group">
        <input type="text" name="message" class="form-control" placeholder="Kirim Pesan">
        <button type="submit" class="btn btn-outline-primary">Kirim</button>
    </div>
</form>
