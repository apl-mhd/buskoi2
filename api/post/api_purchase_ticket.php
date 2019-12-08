<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../model/Purchase_Ticket_Model.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$post = new Purchase_Ticket_Model($db);

$logical_id = "L1";
$phn_no = "8080";
$seat_no = "A3";
$date = "2019-12-10";

$b = $post->purchase($logical_id, $phn_no, $seat_no, $date);

if($b) echo "success";
else echo "failed";

// Get raw posted data