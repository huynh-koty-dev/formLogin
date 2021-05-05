<?php include '../controllers/c_login.php'; ?>

<?php
    $class = new C_login();
    if($_SERVER['REQUEST_METHOD']==='POST'){
        $email = $_POST['adminEmail'];
        $pass = $_POST['adminPass'];
        $remember =$_POST['remember'];
        $num = $class->Login($email,$pass,isset($_POST['remember'])?$_POST['remember']:'');     
        
    }
?>