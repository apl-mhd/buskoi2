<?php

 class Sign_In_Up_Model{
     private $conn;
     private $table = 'user';


     public function __construct($db){
         $this->conn = $db;
     }

     //get post
     public function read($query){

         $stmt = $this->conn->prepare($query);
         $stmt->execute();
         return $stmt;
     }

     public function signIn($phn, $pass){

         $query = 'SELECT Phone_no, password FROM '
             . $this->table
             . ' WHERE Phone_no="' . $phn. '" AND password="' . $pass . '";';

         $stmt = $this->conn->prepare($query);
         $stmt->execute();
         if($stmt->rowCount()>0){return true;}

         return false;
     }

     // Create Post
     public function signUp($phn, $pass, $name)
     {
         $q = 'SELECT Phone_no FROM '
             .$this->table
             .' WHERE Phone_no= "'.$phn.'" ';

         $stmt = $this->conn->prepare($q);
         $stmt->execute();
         if($stmt->rowCount()>0){return false;}


         $query =  'INSERT INTO '.$this->table.'(Phone_no, Name, password)
                    VALUES ("'.$phn.'", "'.$name.'", "'.$pass.'")';

         // Prepare statement
         $stmt = $this->conn->prepare($query);

         if ($stmt->execute()) {
             return true;
         }

         printf("Error: %s.\n", $stmt->error);
         return false;
     }
 }