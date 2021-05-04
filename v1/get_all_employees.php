<?php
    // include headers
    header("Access-Control-Allow-Origin: *");
    // it allow all origins like  localhost, any domain or sub-domain 
    header("Access-Control-Allow-Methods: GET");
    // method type
    // ***************------------------------------------------***************
    // include database.php
    include_once ("../config/database.php");
    //include student.php
    include_once ("../classes/employees.php");

    //creat object from database class
    $db = new Database();
    
    $connection = $db->connect();

    //creat object from Employee class

    $employee = new Employee($connection);

    if($_SERVER['REQUEST_METHOD']==='GET'){
        $data = $employee->get_all_data();
        if($data->num_rows>0){
            $employees['records']=array();
            while($row = $data->fetch_assoc()){
                array_push($employees['records'],array(
                    'id'=>$row['emp_id'],
                    'fullName'=>$row['fullName'],
                    'email'=>$row['email'],
                    'username'=>$row['username'],
                    'created_on'=>date("d-m-y",strtotime($row['created_on']))

                ));
            }
            http_response_code(200); //ok
            echo json_encode(array(
                "status"=>1,
                "data"=>$employees['records']
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