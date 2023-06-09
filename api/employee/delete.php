<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,
Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Employee.php';

//Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

//Instantiate blog post object
$emp = new Employee($db);

//Get raw posted data
$data = json_decode(file_get_contents("php://input"));

//Set ID to update
$emp->id = $data->id;

//Delete post
if($emp->delete()){
    echo json_encode(
        array('message' => 'Employee Deleted')
    );
}   else {
    echo json_encode(
        array('message' => 'Employee Not Deleted')
    );
}