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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
        <div class="sidebar">
                   <?php include "modul/sidebar.php";?>
                </form>
            </div>
        </div>
        <div class="col-md-8"></div>
    </div>
  </div>
    <?php
        // $page = isset($_GET['page'])?$_GET['page']:null;
        // if(isset($page)) {
        //     if ($page=='create') {
        //         include "modul/create_chat.php";
        //      }
        //     if ($page=='logout') {
        //         include "modul/logout.php";
        //      }
        // }else{
        //         include "modul/default.php";
        //     }
            
             ?>
</body>

</html>