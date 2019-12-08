<?php

class Bus_current_location_Model{

    private $conn;
    private $table_logical = 'user';
    private $table_ticket = 'user';
    private $table_bus = 'user';


    public function __construct($db){
        $this->conn = $db;
    }

    //get post
    public function read($bus_no)
    {
        $query =   "SELECT Last_lat, Last_lon
                    FROM Bus
                    WHERE Bus_No = '$bus_no' ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $data = array();
        foreach ($stmt as $result) {
            $jf['Last_lat'] = $result['Last_lat'];
            $jf['Last_lon'] = $result['Last_lon'];
            array_push($data, $jf);
        }

        return $data;
    }

}