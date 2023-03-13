<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Employee.php';

//Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

//Instantiate Employee object
$post = new Employee($db);

//Query Employee
$result = $post->read();
//Get row count
$num = $result->rowCount();

//Check if posts

if($num > 0){
    //Employee array
    $posts_arr = array();
    $posts_arr['data']=array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $post_item = array(
            'id'=> $id,
            'firstname' => $firstname,
            'surname' => $surname,
            'dob' => $dob,
            'salary' => $salary
        );

        //Push to "data"
        array_push($posts_arr['data'], $post_item);
    }

    //Turn to JSON & output
    echo json_encode($posts_arr);

}else{
    //no posts
    echo json_encode(
        array('message' => 'No Employees Found')
    );

}
