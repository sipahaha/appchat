<?php
require '../lib/koneksi.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM tb_chats WHERE id =?");
$stmt->execute(['id']);

header("Location: read_chat.php");
?>