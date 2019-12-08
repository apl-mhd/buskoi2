<?php
class Database{

    private $host = "localhost";
    private $db_name = "bus_koi";
    private $user_name = "root";
    private $password = "";
    private $conn;

    public function connect(){

        $this->conn = null;
        try{

            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->user_name, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }catch(PDOException $e){
            echo "connection error " . $e->getMessage();
        }
        return $this->conn;
    }
}
