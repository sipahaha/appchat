<?php
session_start(); 
include "lib/koneksi.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); 
    exit();
}


?>

<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama</title>
</head>

<body>
  
    <?php
        $page = isset($_GET['page'])?$_GET['page']:null;
        if(isset($page)) {
            if ($page=='create') {
                include "modul/create_chat.php";
             }
            }else{
                include "modul/default.php";
            }

             ?>
</body>

</html>