<?php
    session_start();
    date_default_timezone_set('Asia/Jakarta');
    include "lib/koneksi.php";
    if (!isset($_SESSION['id'])) {
        include "login.php";
    }else{
        $iduser = $_SESSION['id'];
        $sqlResult = $conn->query("SELECT*FROM tb_users WHERE id='$id'");
        $vResult = $sqlResult->fetch_array();
    }
?>