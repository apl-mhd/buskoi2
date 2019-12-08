<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../model/Bus_current_location_Model.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$post = new Bus_current_location_Model($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$bus_no = $_POST["bus_no"];

$arr = $post->read($bus_no);

if(!empty($arr)) {
    echo json_encode(array('location' => $arr));
}

//    if ($post->signUP($phn_no, $password, $name)) {
//        echo json_encode(
//            array('signUp' => 'seccess')
//        );
//    }

