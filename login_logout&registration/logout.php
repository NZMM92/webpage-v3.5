<?php
session_start();
if (isset($_SESSION['user_name'])) {
    session_destroy();
    $_SESSION = array();
}
header("location: ../index.php");
?>
