<?php include '../controllers/c_register.php'; 

    $class = new C_register();
    if($_SERVER['REQUEST_METHOD']==='POST'){
        $userName =trim(preg_replace('/\s+/',' ', $_POST['user_name']));
        $email = trim(preg_replace('/\s+/',' ', $_POST['email'])); 
        $pass = trim(preg_replace('/\s+/',' ', $_POST['password'])); 
        $rePass = trim(preg_replace('/\s+/',' ', $_POST['confirm_password'])); 
        $class->Register($userName,$email,$pass,$rePass);
    }
?>