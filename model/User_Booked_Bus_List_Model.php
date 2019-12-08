<?php

class User_Booked_Bus_List_Model{
    private $conn;
    private $table_logical = 'user';
    private $table_ticket = 'user';
    private $table_bus = 'user';


    public function __construct($db) {$this->conn = $db;}

    //get post
    public function read($phn_no)
    {
        $query = "SELECT l.dep_time_hour, l.dep_time_minute, b.author, l.fare, t.date_time, b.bus_no
                FROM ticket AS t
                    JOIN 
                    logical AS l ON t.logical_id = l.id
                    JOIN
                    Bus AS b ON l.bus_no = b.bus_no
                WHERE t.user_phn_no = '$phn_no' ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $data = array();
        foreach($stmt as $result){

            $jf['dep_time_hour']=$result['dep_time_hour'];
            $jf['dep_time_minute']=$result['dep_time_minute'];
            $jf['author']=$result['author'];
            $jf['fare']=$result['fare'];
            $jf['date_time']=$result['date_time'];
            $jf['bus_no']=$result['bus_no'];

            array_push($data, $jf);
        }

        return $data;
    }

}