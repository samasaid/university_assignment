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
    include_once ("../config/database.php");
    //include employees.php
    include_once ("../classes/employees.php");

    //creat object from database class
    $db = new Database();
    
    $connection = $db->connect();

    //creat object from Employee class

    $employee = new Employee($connection);

    if($_SERVER['REQUEST_METHOD']==='POST'){
        $param = json_decode(file_get_contents('php://input'));
        if(!empty($param->emp_id)){
            $employee->emp_id = $param->emp_id;
            $employee_data = $employee->get_employee_data();
            if(!empty($employee_data)){
                http_response_code(200); //ok
                echo json_encode(array(
                "status"=>1,
                "data"=>$employee_data
            ));
            }else{
                http_response_code(500); 
                echo json_encode(array(
                    "status"=>0,
                    "messege"=>"user not found"
                ));
            }
        
        }else{
             http_response_code(404); 
             echo json_encode(array(
            "status"=>0,
            "messege"=>"empty reqiuer inputs"
             ));
             }
        }else{
        http_response_code(503); 
        echo json_encode(array(
            "status"=>0,
            "messege"=>"access denied"
        ));
    }



 ?>