<?php 

 session_start(); 
    if(!isset($_COOKIE['email']) && !isset($_SESSION['login']) ){
        header('Location:views/dangnhap.php');
    }
    if(!isset($_SESSION['login']) && isset($_COOKIE['remember'])){
       // var_dump($_COOKIE['email']);
    $conn =  new PDO('mysql:host=localhost;dbname=myphp_db','root','');
    $sql = "SELECT * FROM admin WHERE email = :email";
    $statement = $conn->prepare($sql);
    $statement->execute(array(':email' => $_COOKIE['email']));
    //var_dump($conn);
    $resultset = $statement->rowCount();
    //var_dump($resultset);
    if($resultset>0){
        //var_dump($resultset);
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $_SESSION['login'] = true;
        $_SESSION['admin'] = $row['category'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['userName'] = $row['userName'];
        header('Location:index.php');
    }
    return $resultset;
}
else{
    if(isset($_SESSION['login'])){
        echo 'da co cookie '.$_COOKIE['email'];
    }else{
        echo 'ko co cookie';
        header("Location:views/dangnhap.php");  
    } 
}

              
?>
<h1>Hello: <?php echo $_SESSION['userName']; ?></h1><br><br>
<a href="views/users.php">List Users</a><br><br>
<a href="templates/logout.php">Logout</a>