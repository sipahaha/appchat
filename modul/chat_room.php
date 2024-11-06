<?php
    $id = $_GET['id'];
    $sql = "SELECT * FROM tb_chats WHERE id = ':id'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $mess = $stmt->fetchAll();

?>