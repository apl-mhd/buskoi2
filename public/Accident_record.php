<?php
class Accident_record
{
    private $conn;

    public function __construct($db) {$this->conn = $db;}

    //get post
    public function records()
    {
        $query =    "SELECT * FROM accident_record";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $arr = array();
        $i=0;

        foreach ($stmt as $result){

            $bus_no = $result['bus_no'];
            $date_time = $result['date_time'];
            $bus_lat = $result['bus_lat'];
            $bus_lon = $result['bus_lon'];
            $alert_hospital_lat = $result['alert_hospital_lat'];
            $alert_hospital_lon = $result['alert_hospital_lon'];
            $hospital_contact_no = $result['hospital_contact_no'];
            $alert_police_lat = $result['alert_police_lat'];
            $alert_police_lon = $result['alert_police_lon'];
            $olice_contact_no = $result['police_contact_no'];

            $tmp = array('$bus_no'=>$bus_no.' ',
                '$date_time'=>$date_time.' ',
                '$bus_lat'=>$bus_lat.' ',
                '$bus_lon'=>$bus_lon.' ',
                '$alert_hospital_lat'=>$alert_hospital_lat.' ',
                '$alert_hospital_lon'=>$alert_hospital_lon.' ',
                '$hospital_contact_no'=>$hospital_contact_no.' ----------#alert',
                '$alert_police_lat'=>$alert_police_lat.' ',
                '$alert_police_lon'=>$alert_police_lon.' ',
                '$olice_contact_no'=>$olice_contact_no.' ----------#alert');

            array_push($arr,array($i=>$tmp));
            $i++;
        }
        return $arr;
    }


    public function sos_records($bus_no){
        $query_sos =   "SELECT sos1, sos2, sos3
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
    }
}

//////////////////

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../config/Database.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$post = new Accident_record($db);

$ar = $post->records();
//print_r($ar);
foreach ($ar as $r){
    print_r($r);
    echo"\n";
}

