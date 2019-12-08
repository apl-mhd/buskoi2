<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../config/Database.php';
include_once 'nodeMCU_Model.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$post = new nodeMCU_Model($db);

// Get raw posted data
//$data = json_decode(file_get_contents("php://input"));

//$phn_no = $_POST["bus_no"];

//$update_lctn = $post->update_location("bus-2",1.1,2.2);
//$accdnt_occurs = $post->accident_occurs("bus-2",90.5,70.5);


//    if ($post->signUP($phn_no, $password, $name)) {
//        echo json_encode(
//            array('signUp' => 'seccess')
//        );
//    }

