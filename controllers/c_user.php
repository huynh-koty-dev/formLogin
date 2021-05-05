<?php include '../models/m_user.php' ?>

<?php

class C_user{
    public $models;
    public function __construct(){
        $this->models = new M_user();
    }

    public function UserList(){
        return  $this->models->ListUser();
    }

    public function DeleteUser($id){
        return $this->models->DeleteUser($id);
    }

    public function UpdateUser($id,$userName,$email,$pass){
        return  $this->models->UserUpdate($id,$userName,$email,$pass);  
    }

    public function UserId($id){
        return  $this->models->UserId($id);  
    }   
}
?>