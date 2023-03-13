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
$emp = new Employee($db);

//Query Employee
$result = $emp->read();
$result = $emp->read();
//Get row count
$num = $result->rowCount();

//Check if employee found

if($num > 0){
    //Employee array
    $get_arr = array();
    $get_arr['data']=array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $get_item = array(
            'id'=> $id,
            'firstname' => $firstname,
            'surname' => $surname,
            'dob' => $dob,
            'salary' => $salary
        );

        //Push to "data"
        array_push($get_arr['data'], $get_item);
    }

    //Turn to JSON & output
    echo json_encode($get_arr);

}else{
    //no employees
    echo json_encode(
        array('message' => 'No Employees Found')
    );

}
