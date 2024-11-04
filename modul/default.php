<?php
     $page = isset($_GET['page'])?$_GET['page']:null;
     if(isset($page)) {
         if ($page=='reademes') {
             include "modul/read_message.php";
          }
          if ($page=='createemes') {
            include "modul/create_message.php";
         }
        }else{
            include "modul/default.php";
        }
    ?>