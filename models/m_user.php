<?php include '../connect/database.php'; ?>
<?php 
    class M_user{
        public $conn;
        public function __construct(){
            $this->conn = new Database();
            $this->con  = $this->conn->_dbh;
        }
        public function ListUser(){
            $sql = "SELECT * FROM admin";
            $statement = $this->con->prepare($sql);
            $statement->execute();
            $row = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            return $row;
            
        }
         public function DeleteUser($id){
            //var_dump('here');
             session_start();
             if(isset($_SESSION['login'])){
                 if($_SESSION['id']==$id){
                    $_SESSION['message_error'] = "tai khoan '".$_SESSION['userName']."' hien dang hoat dong";
                    header("Location:../views/users.php");
                 }else{
                    var_dump('here');
                   $sql = "DELETE FROM admin WHERE id = $id";
                   $statement = $this->con->prepare($sql);
                   $statement->execute();
                   $_SESSION['message_error'] = "";
                   header('Location:../views/users.php');
                }
             }
             
         }   

         public function UserUpdate($id,$userName,$email,$pass){
             var_dump($id,$userName,$email,$pass);
             $hash_password = password_hash($pass,PASSWORD_DEFAULT);
            if(empty($userName) || empty($email) ){
                session_start();
                $_SESSION['message_error'] = 'text field must be not empty';
            }
            else{
                if(empty($pass)){
                    var_dump('a');
                    $sql ="UPDATE admin 
                    SET userName = '$userName', email = '$email'
                    WHERE id = $id";
                    $statement = $this->con->prepare($sql);
                    $statement->execute();
                    $rs = $statement->rowCount();
                    if($rs>0){
                        header('Location:../views/users.php');
                        return $rs;
                      }else{
                        header("Location:../templates/update.php");
                        // $login_err = "Invalid username or password.";
                        // return $login_err;
                        session_start();
                        $_SESSION['message_error'] = 'Can not upadate! Please try again.';
                    } 
                }
                if(!empty($pass)){
                    
                    $sql ="UPDATE admin
                    SET userName = '$userName', email = '$email', password = '$hash_password'
                    WHERE id = $id";
                    $statement = $this->con->prepare($sql);
                    $statement->execute();
                    $rs = $statement->rowCount();
                    if($rs>0){
                        header('Location:../views/users.php');
                        return $rs;
                      }else{
                        header("Location:../templates/update.php");
                        // $login_err = "Invalid username or password.";
                        // return $login_err;
                        session_start();
                        $_SESSION['message_error'] = 'Can not upadate! Please try again.';
                    }
                }else{
                    header('Location:../views/users.php');
                }
                
                
              
            }
            
             
         }

         public function UserId($id){
            $sql = "SELECT * FROM admin WHERE id = $id";
            $statement = $this->con->prepare($sql);
            $statement->execute();
            $row = $statement->fetch(PDO::FETCH_ASSOC);
             return $row;
         }   
        
    }
?>