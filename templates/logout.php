<?php 
    session_start();
    session_unset();
    session_destroy();
    setcookie("email", "", time() - 36000, "/");
    setcookie("remember", "", time() - 36000, "/");
    //setcookie("pass", "", time() - 36000, "/");
    header('Location:../views/dangnhap.php');
?>