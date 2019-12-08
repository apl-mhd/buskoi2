<?php
 header('Access-Control-Allow-Origin: *');
 header('Content-type: application/json');

 include_once '../../config/Database.php';
 include_once '../../model/Sign_In_Up_Model.php';

 $database = new Database();
 $db = $database->connect();

 $post = new SignInModel($db);

 $result = $post->read('SELECT EMPLOYEE_ID, FIRST_NAME FROM employees');
 $row_count = $result->rowCount();

 if ($row_count > 0){
     $post_array = array();
     $post_array['data'] = array();

     while ($row = $result->fetch(PDO::FETCH_ASSOC)){

         $post_item =  array(
             'id' => $row['EMPLOYEE_ID'],
             'first_name' => $row['FIRST_NAME']
         );

         array_push($post_array['data'], $post_item);
     }
     echo json_encode($post_array);

 }else{
     echo json_encode(array('meassage'=>'no post found'));
 }