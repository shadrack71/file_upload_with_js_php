<?php

class Connection {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db_name = "webAppProject";
    
    public $conn;

    public function Connect(){
        $this-> conn = null;
        $dns = "mysql:host=".$this->host.";dbname=".$this->db_name;
        try{
            $pdo = new PDO($dns, $this->user,$this ->pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn = $pdo;


        }catch(PDOException $e){
            echo "Error connecting".$e -> getMessage();

        }
        return $this->conn;

    }






}