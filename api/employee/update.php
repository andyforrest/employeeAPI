<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,
Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Employee.php';

//Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

//Instantiate Employee object
$emp = new Employee($db);

//Get raw posted data
$data = json_decode(file_get_contents("php://input"));

//Set ID to update
$emp->id = $data->id;

$emp->firstname = $data->firstname;
$emp->surname = $data->surname;
$emp->dob = $data->dob;
$emp->salary = $data->salary;

//Update employee
if($emp->update()){
    echo json_encode(
        array('message' => 'Employee Updated')
    );
}   else {
    echo json_encode(
        array('message' => 'Employee Not Updated')
    );
}