<?php
// Start the session
session_start();
if(isset($_SESSION['login']) ){
    header('Location:../index.php');
}
?>
<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>

<body>
    <div class="container">
        <section id="content">
            <form action="../templates/login.php" method="post">
                <h1>Admin Login</h1>
                <?php
			// var_dump($_SESSION['message_error']);
			if (isset($_SESSION['message_error']))
			{
				echo $_SESSION['message_error'];
				unset($_SESSION['message_error']);
			}
			
			?>
                <div>
                    <input type="email" placeholder="Username" name="adminEmail" />
                </div><br>
                <div>
                    <input type="password" placeholder="Password" name="adminPass" />
                </div><br>
                <div>
                    <input type="checkbox" name="remember" value="1"
                        <?php echo isset($_COOKIE['remember'])?'checked':'' ?>> Remember me.
                </div><br>
                <div>
                    <input type="submit" value="Log in" />
                </div><br>
            </form><!-- form -->
            <div class="button">
                <a href="dangky.php">Register</a>
            </div><!-- button -->
        </section><!-- content -->
    </div><!-- container -->
</body>
<style>
#content {
    position: absolute;
    top: 30%;
    left: 50%;
    transform: translate(-50%, -50%);

}
</style>

</html>