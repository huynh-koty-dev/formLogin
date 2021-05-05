<?php include '../connect/database.php'; ?>
<?php 
    class M_login{
        public $conn;
        public function __construct(){
            $this->conn = new Database();
            $this->con  = $this->conn->_dbh;
        }
        public function Login($email,$pass,$remember){
            if(empty($email) || empty($pass)){
                session_start();
                $_SESSION['message_error'] = "<script>alert('Email or Password must be not empty!')</script>";
                header("Location:../views/dangnhap.php");
                return;
            }
            else{
                //  $email = mysqli_real_escape_string($this->con,$email);
                //  $pass = sha1(mysqli_real_escape_string($this->con,$pass));
                // var_dump(password_hash('ngunguoi123', PASSWORD_DEFAULT));
                // var_dump($pass);
                //  var_dump(password_verify('1234', '$2y$10$XlzsxlsELuHlmdDJPZ0OkOzcOsamOwUINrqCiKuskONgxmhZOHyRK'));
                //  die();
                $sql = "SELECT*FROM admin WHERE email = :email ";//AND password = :pass LIMIT 1
                $statement = $this->con->prepare($sql);
                $statement->execute(array(':email' => $email));
                $resultset = $statement->rowCount();
                if($resultset>0){
                    // var_dump('here');
                    //var_dump($pass);
                    $row = $statement->fetch(PDO::FETCH_ASSOC);
                    if($email == $row['email']){
                        //var_dump($email);
                        //var_dump($row['password']);
                        //$pass_verify = password_verify($pass,'$2y$10$iwDSag6evbUYM9JVXFaPTe7j.NDAdBhJNup80o3EzpwZ6aviv1BDu');
                        //var_dump($pass_verify);
                        if(password_verify($pass,$row['password'])){
                            //var_dump($row['password'],$pass);
                            if(isset($remember)){
                                setcookie("email", $row['email'], time() + 36000, "/");
                                setcookie("pass", $pass, time() + 36000, "/");  
                                setcookie("remember",$remember, time() + 36000, "/");  
                                // setcookie("remember_email",$row['email'], time() + 36000, "/");  
                                // setcookie("remember_pass",$pass, time() + 36000, "/");  
                                
                            }
                            else{
                                setcookie("email", $row['email'], time() + 36000, "/");
                                setcookie("pass", $pass, time() + 36000, "/");  
                                // setcookie("remember_email",$row['email'], time() + 36000, "/");  
                                // setcookie("remember_pass",$pass, time() + 36000, "/");  
                            }
                            session_start();
                            $_SESSION['login'] = true;
                            $_SESSION['admin'] = $row['category'];
                            $_SESSION['userName']= $row['userName'];
                            $_SESSION['email']= $row['email'];
                            $_SESSION['id']= $row['id'];
                            $_SESSION["login_time_stamp"] = time(); 
                            header("Location:../index.php");
                            return $resultset;   

                            
                        }else{
                            //var_dump('failed');
                            header("Location:../views/dangnhap.php");
                            session_start();
                            $_SESSION['message_error'] = "<script>alert('Email or Password not match!')</script>";
                            return;
                        }
                    }
                    

                   
                }else{
                    header("Location:../views/dangnhap.php");
                    // $login_err = "Invalid username or password.";
                    // return $login_err;
                    session_start();
                    $_SESSION['message_error'] =  "<script>alert('Email or Password not match!')</script>";
                    return;
                }
            }
            
            
        }
    }
?>