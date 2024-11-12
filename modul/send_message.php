<?php
include '../lib/koneksi.php';

$response = ['success' => false, 'error' => 'Terjadi kesalahan'];

// Pastikan semua data yang dibutuhkan ada
if (isset($_POST['chat_id'], $_POST['user_id'], $_POST['message'])) {
    $chat_id = $_POST['chat_id'];
    $user_id = $_POST['user_id'];
    $message = trim($_POST['message']); // Menghapus spasi kosong

    if (!empty($message)) {
        try {
            // Menyimpan pesan ke database
            $stmt = $pdo->prepare("INSERT INTO tb_messages (chat_id, user_id, message, created_at) VALUES (?, ?, ?, NOW())");
            $stmt->execute([$chat_id, $user_id, $message]);

            $response['success'] = true;
            $response['error'] = null;
        } catch (PDOException $e) {
            $response['error'] = 'Kesalahan database: ' . $e->getMessage();
        }
    } else {
        $response['error'] = 'Pesan tidak boleh kosong';
    }
} else {
    $response['error'] = 'Input tidak valid';
}

// Mengembalikan respons JSON
header('Content-Type: application/json');
echo json_encode($response);
