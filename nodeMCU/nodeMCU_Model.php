<?php

class nodeMCU_Model{
    private $conn;

    public function __construct($db) {$this->conn = $db;}

    //get post
    public function update_location($bus_no, $lat, $lng)
    {
        $query =    "UPDATE Bus
                    SET Last_lat = $lat, Last_lon = $lng
                    WHERE Bus_No = '$bus_no'";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

    }

    public function accident_occurs($bus_no, $bus_lat, $bus_lng)
    {
        //hospital
        $query_hospital =    "SELECT lat, lon, contact_no 
	                         FROM hospital";
        $stmt_hospital = $this->conn->prepare($query_hospital);
        $stmt_hospital->execute();
        $arr_hospital = $this->nearest($stmt_hospital, $bus_lat, $bus_lng);

        $hospital_cntct_no = $arr_hospital[0];
        if(!empty($hospital_cntct_no))
            $this->send_alart('hospital: '.$hospital_cntct_no);

        //police
        $query_police =    "SELECT lat, lon, contact_no 
	                         FROM police";
        $stmt_police = $this->conn->prepare($query_police);
        $stmt_police->execute();
        $arr_police = $this->nearest($stmt_police, $bus_lat, $bus_lng);

        $police_cntct_no = $arr_police[0];
        if(!empty($police_cntct_no))
            $this->send_alart('police: '.$police_cntct_no);

        //sos
        $query_sos =   "SELECT sos1
                        FROM sos AS s
                        WHERE s.User_phone_no = ANY (SELECT t.user_phn_no
                                                    FROM ticket AS t
                                                    WHERE t.bus_no = '$bus_no' AND t.flag = 1)";
        $stmt_sos = $this->conn->prepare($query_sos);
        $stmt_sos->execute();

        foreach ($stmt_sos as $result) {

            $sos1 = $result['sos1'];
            if(!empty($sos1))
                $this->send_alart('sos: '.$sos1);
        }


        $q = "INSERT INTO accident_record 
(bus_no, date_time, bus_lat, bus_lon, alert_hospital_lat, alert_hospital_lon, hospital_contact_no, alert_police_lat, alert_police_lon, police_contact_no) 
VALUES ('$bus_no', current_timestamp(), $bus_lat, $bus_lng, $arr_hospital[1], $arr_hospital[2], '$arr_hospital[0]', $arr_police[1], $arr_police[2], '$arr_police[0]')";

        $s = $this->conn->prepare($q);
        $s->execute();
    }

    private function nearest($stmt, $b_lat, $b_lon)
    {
        $min = 99999.9;
        $contact_no = "";
        $get_lat = 0.0;
        $get_lon = 0.0;

        foreach ($stmt as $result) {

            $lat = $result['lat'];
            $lon = $result['lon'];

            $m = sqrt( pow(($lat-$b_lat), 2) + pow(($lon-$b_lon),2) );
            if($m<$min){
                $min=$m;
                $get_lat=$lat;
                $get_lon=$lon;
                $contact_no = $result['contact_no'];
            }
        }
        $arr = array($contact_no, $get_lat, $get_lon);
        return $arr;
    }


    private function send_alart($phn_no){
        echo $phn_no."\n";
    }

}