<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../model/User_Booked_Bus_List_Model.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$post = new User_Booked_Bus_List_Model($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$phn_no = $_POST["phn_no"];

$arr = $post->read($phn_no);

if(!empty($arr)) {
    echo json_encode(array('booked_bus_list' => $arr));
}

//    if ($post->signUP($phn_no, $password, $name)) {
//        echo json_encode(
//            array('signUp' => 'seccess')
//        );
//    }

