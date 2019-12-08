<?php
class Purchase_Ticket_Model
{
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    //get post
    public function purchase($logical_id, $phn_no, $seat_no, $date){

        if($this->checkValidUser($phn_no)==0 ||  $this->checkValid_Logical_id($logical_id)==0)
            return false;

        $booked_by='own';
        $ticket_id = 'T'.$this->countTciketRow();
        $bus_no = $this->getBusNo($logical_id);
        $flag = 1;

        if($this->checkValid_bus_no($bus_no)==0)
            return false;

        $query ="INSERT INTO ticket (ticket_id, logical_id, user_phn_no, seat_no, date_time, booked_by, purchase_datetime, flag, bus_no) 
                VALUES ('$ticket_id', '$logical_id', '$phn_no', '$seat_no', '$date', '$booked_by', current_timestamp(), '$flag', '$bus_no')";

        $cnt = $this->conn->prepare($query);
        $cnt->execute();

        return true;
    }

    private function countTciketRow(){

        $query ="SELECT COUNT(*) AS c FROM ticket";

        $cnt = $this->conn->prepare($query);
        $cnt->execute();

        $ans = 0;
        foreach ($cnt as $r){
            $ans=$r['c'];
        }
        return $ans+1;
    }

    private function getBusNo($logical_id){

        $query ="SELECT Bus_no AS b
                FROM logical
                WHERE ID = '$logical_id'";

        $cnt = $this->conn->prepare($query);
        $cnt->execute();

        $ans = "";
        foreach ($cnt as $r){
            $ans=$r['b'];
        }
        return $ans;
    }

    private function checkValidUser($phn_no){

        $query = "SELECT Phone_no
            FROM user
            WHERE Phone_no='$phn_no'";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if($stmt->rowCount()>0) {return 1;}

        return 0;
    }

    private function checkValid_Logical_id($id){

        $query = "SELECT ID
            FROM logical
            WHERE ID='$id'";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if($stmt->rowCount()>0) {return 1;}

        return 0;
    }

    private function checkValid_bus_no($bus_no){

        $query = "SELECT Bus_no
            FROM Bus
            WHERE Bus_no='$bus_no'";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if($stmt->rowCount()>0) {return 1;}

        return 0;
    }
}
