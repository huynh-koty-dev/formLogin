<?php 
    include '../models/m_register.php'
?>

<?php
    class C_register{
        public $models;
        public function __construct(){
            $this->models = new M_Register();
        }
        public function Register($userName, $email,$pass,$rePass){
            return $this->models->Register($userName, $email,$pass,$rePass);
        }
    }
?>