<?php
   include '../controllers/c_user.php';
   $class = new C_user();

    $id = $_GET['id'];
    $rs = $class->DeleteUser($id);
    // var_dump($rs);
?>