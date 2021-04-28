<?php
    // include headers
    header("Access-Control-Allow-Origin: *");
    // it allow all origins like  localhost, any domain or sub-domain 
    header("Content-Type: application/json; charset=UTF-8");
    // data which we are getting inside request
    header("Access-Control-Allow-Methods: POST");
    // method type
    // ***************------------------------------------------***************
    // include database.php
    require_once ("../config/database.php");
    //include employees.php
    require_once ("../classes/employees.php");

    //creat object from database class
    $db = new Database();
    
    $connection = $db->connect();

    //creat object from Employee class

    $employee = new Employee($connection);

    if($_SERVER['REQUEST_METHOD']==='POST'){
        //submit data
        $data = json_decode(file_get_contents('php://input'));
       if(!empty($data->fullName) && !empty($data->email) && !empty($data->username) && !empty($data->password) && !empty($data->emp_id)){
        $employee->fullName = $data->fullName;
        $employee->email = $data->email;
        $employee->username = $data->username;
        $employee->emp_id = $data->emp_id;

        if($employee->update_employee()){
            http_response_code(200); //ok
            echo json_encode(array(
                "status"=>1,
                "messege"=>"success, data updated"
            ));
        }else{
            http_response_code(500); 
            echo json_encode(array(
                "status"=>0,
                "messege"=>"fail , data not updated"
            ));
        }
    }else{
        http_response_code(404); 
        echo json_encode(array(
            "status"=>0,
            "messege"=>"empty reqiuer inputs"
        ));
    }}else{
        http_response_code(503); 
        echo json_encode(array(
            "status"=>0,
            "messege"=>"access denied"
        ));
    }