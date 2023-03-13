<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,
Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../Models/Employee.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

$emp = new Employee($db);

//Get raw data posted
$data = json_decode(file_get_contents("php://input"));

$emp->firstname = $data->firstname;
$emp->surname = $data->surname;
$emp->dob = $data->dob;
$emp->salary = $data->salary;

//POST employee
if($emp->create()){
    echo json_encode(
        array('message' => 'Employee added to database')
    );
}
    else{
        echo json_encode(
            array('message' => 'Employee not created')
        );
    }
