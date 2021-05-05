<?php
    class database{

        var $_dbh = '';
        var $_sql = '';
        var $_cursor = NULL;

        public function Database(){
            // $this->_dbh = new PDO('mysql:host=localhost;dbname=myphp_db','root','');
            // $this->_dbh->query('set names "utf8"');
            try {
                $this->_dbh = new PDO('mysql:host=localhost;dbname=myphp_db','root','');
                // echo "Connected successfully";
              } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
              }
        }
    }
?>