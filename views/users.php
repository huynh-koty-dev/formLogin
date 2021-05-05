<?php
    session_start();
    include '../controllers/c_user.php';
    $class = new C_user();
    $rows = $class->UserList();
    // if(!isset($_COOKIE['remember'])){
    //     setcookie("email", "", time() - 36000, "/");
    // }
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
         header('Location:users.php');
     }
     return $resultset;
 }
    if(isset($_SESSION['login'])){
    
    
?>
<div>
    <button class="btn btn-success" onclick="window.location= 'dangky.php'">them tai khoan</button>
</div>
<div>
    <p><?php if(isset( $_SESSION['message_error'])){
    echo  $_SESSION['message_error'];
} ?></p>
    <table border="1" cellpadding='5' cellspacing="0">
        <tr>
            <th>id</th>
            <th>Ten nguoi dung</th>
            <th>email</th>
            <th>Sua</th>
            <th>Xoa</th>
        </tr>
        <?php foreach($rows as $u){ ?>
        <tr>
            <td><?php echo $u['id'] ?></td>
            <td><?php echo $u['userName'] ?></td>
            <td><?php echo $u['email']?></td>
            <td><a href="../templates/update.php?id=<?php echo $u['id'] ?>">update</a></td>
            <td><a href="../templates/delete.php?id=<?php echo $u['id'] ?> "
                    onclick=" return confirm('Are you sure about that!');">delete</a></td>
        </tr>
        <?php } ?>
    </table>
    <br>
    <a href="../index.php">return index page</a>
</div>

<?php  
}else{
    header("Location:dangnhap.php");
} ?>