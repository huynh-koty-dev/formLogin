<?php include '../models/m_login.php' ?>

<?php

class C_login{
    public $models;
    public function __construct(){
        $this->models = new M_login();
    }
    public function Login($email,$pass,$remember){
        
        return $this->models->Login($email,$pass,$remember);

    }
}
?>