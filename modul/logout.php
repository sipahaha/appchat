<?php
if (session_status()) {
    session_start();
}

session_destroy();
header("Location: index.php");
exit;
?>
