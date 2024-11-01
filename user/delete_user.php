<?php 
include '../koneksi.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM tb_users WHERE id = ?");
$stmt->execute([$id]);

header("Location: read_users.php");
?>