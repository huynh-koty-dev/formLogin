<?php include '../connect/database.php'; ?>
<?php 
    class M_Register{
        public $conn;
        public function __construct(){
            $this->conn = new Database();
            $this->con  = $this->conn->_dbh;
        }
        public function Register($userName,$email,$pass,$rePass){
            // var_dump('sdafsdafa');
            //var_dump(password_hash($pass,PASSWORD_DEFAULT));
            if(strpos($userName,'<')!==false || strpos($userName,'/')!==false){
                session_start();
                $_SESSION['message_error'] = "<script>alert('UserName invalid!')</script>";
                header("Location:../views/dangky.php");
                return;
            }
            if($pass !== $rePass){
                session_start();
                $_SESSION['message_error'] = "<script>alert('Password not match!')</script>";
                header("Location:../views/dangky.php");
                return;
            }
            if(isset($email)){
                // $mysqli = new mysqli("localhost","root","","myphp_db");
                $sql ="SELECT * FROM admin WHERE email = '$email' LIMIT 1";
                
                // $result = $mysqli->query($sql);
                // var_dump($result->num_rows);
                $statement = $this->con->prepare($sql);
                $statement->execute();
                $resultset = $statement->rowCount();
              
                if($resultset>0){
                    session_start();
                    $_SESSION['message_error'] = "<script>alert('Email already exist. Please try another email!')</script>";
                    header("Location:../views/dangky.php");
                    return;
                }
            }
            if(empty($userName) || empty($email) || empty($pass) || empty($rePass)){
                session_start();
                $_SESSION['message_error'] = "<script>alert('Text fields must be not empty!')</script>"; 
                header("Location:../views/dangky.php");
                return;
            }
            else{
                session_start();
                $hash_password = password_hash($pass,PASSWORD_DEFAULT);
                $sql = "INSERT INTO admin(userName,email,password) VALUES(:userName,:email,:pass)";
                
                $statement = $this->con->prepare($sql);
                $statement->bindParam("userName", $userName, PDO::PARAM_STR);
                $statement->bindParam("email", $email, PDO::PARAM_STR);
                $statement->bindParam("pass", $hash_password, PDO::PARAM_STR);
                $rs = $statement->execute();
                if($rs){
                    if(isset($_SESSION['login'])){
                        header("Location:../views/users.php");
                    }else{
                        header("Location:../views/dangnhap.php");
                    }
                    
                }else{
                    
                    $_SESSION['message_error'] = 'Register failed!';
                    header("Location:../views/dangky.php");
                    return;
                }
            }
        }
    }
?>