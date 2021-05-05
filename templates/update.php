<?php
    
   include '../controllers/c_user.php';
   $class = new C_user();

   if(isset($_COOKIE['email']) ){
	
	$id = $_GET['id'];
    $row= $class->UserId($id);
    if(isset($_POST['id']) && isset($_POST['userName']) && isset($_POST['email']) && isset($_POST['password'])){
        $id1 = $_POST['id'];
        $userName = $_POST['userName']; 
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $class->UpdateUser($id1,$userName,$email,$pass);
    }
   
    
    
    
?>

<form action="update.php" method="post">
    <h1>Update User</h1>
    <?php
			// var_dump($_SESSION['message_error']);
			if (isset($_SESSION['message_error']))
			{
				echo $_SESSION['message_error'];
				unset($_SESSION['message_error']);
			}
			?>
    <div>
        <input type="number" value="<?php echo $row['id'] ?>" hidden name="id" />
    </div>
    <div>
        <input type="text" value="<?php echo $row['userName'] ?>" name="userName" />
    </div>
    <div>
        <input type="email" value="<?php echo $row['email'] ?>" readonly name="email" />
    </div>
    <div>
        <input type="password" name="password" />
    </div>
    <div>
        <input type="submit" value="Update" onclick="return confirm('Are you sure about that!');" />
    </div>
</form>

<?php
   }
   else{
	   header('Location:../views/dangnhap.php');
   }
?>