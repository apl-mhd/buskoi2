<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../model/Sign_In_Up_Model.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate blog post object
    $post = new Sign_In_Up_Model($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $status = $_POST["status"];
    $phn_no = $_POST["phn_no"];
    $password = $_POST["password"];
    $name = '';

    if($status == 'up'){
        $name = $_POST["name"];

        if ($post->signUP($phn_no, $password, $name)) {
            echo json_encode(
                array('signUp' => 'seccess')
            );
        } else {
            echo json_encode(
                array('signUp' => 'failed')
            );
        }

    }elseif ($status == 'in') {

        if ($post->signIn($phn_no, $password)){
            echo json_encode(
                array('signIn' => 'seccess')
            );
        } else {
            echo json_encode(
                array('signIn' => 'failed')
            );
        }
    }