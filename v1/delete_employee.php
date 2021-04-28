<?php
// include headers
    header("Access-Control-Allow-Origin: *");
    // it allow all origins like  localhost, any domain or sub-domain 
    header("Access-Control-Allow-Methods: GET");
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

    if($_SERVER['REQUEST_METHOD']==='GET'){
        $param = isset($_GET['emp_id'])? $_GET['emp_id']:"";
        if(!empty($param)){
            $employee->emp_id = $param;
            if($employee->delete_employee()){
                http_response_code(200); //ok
                echo json_encode(array(
                "status"=>1,
                "data"=>"employee deleted"
            ));
            }else{
                http_response_code(500); 
                echo json_encode(array(
                    "status"=>0,
                    "messege"=>"fail , employee not deleted"
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