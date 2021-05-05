<?php

	
// Start the session
session_start();
// if(isset($_SESSION['login'])){
//     header('Location:../index.php');
// }
?>
<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>

<body>
    <div class="container">
        <section id="content">
            <form action="../templates/register.php" method="post">
                <h1>Register</h1>
                <?php
			// var_dump($_SESSION['message_error']);
			if (isset($_SESSION['message_error']))
			{
				echo $_SESSION['message_error'];
				unset($_SESSION['message_error']);
			}
			?>
                <div>
                    <input type="text" placeholder="Username" name="user_name" />
                </div>
                <div>
                    <input type="email" placeholder="Email" name="email" />
                </div>
                <div>
                    <input type="password" placeholder="Password" name="password" />
                </div>
                <div>
                    <input type="password" placeholder="Comfirm Password" name="confirm_password" />
                </div>
                <div>
                    <input type="submit" value="Register" />
                </div>
            </form><!-- form -->

        </section><!-- content -->
    </div><!-- container -->
</body>

</html>