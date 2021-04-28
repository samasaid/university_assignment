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

    $data = json_decode(file_get_contents('php://input'));
    if(!empty($data->fullName) && !empty($data->email) && !empty($data->username) && !empty($data->password) && !empty($data->repeatPassword)){
            $employee->fullName = $data->fullName;
            $employee->email = $data->email;
            $employee->username = $data->username;
            $employee->password = sha1($data->password);
            $employee->repeatPassword = sha1($data->repeatPassword);

            if(!empty($employee->check_email())){
                http_response_code(200); //ok
                echo json_encode(array(
                    "status"=>0,
                    "messege"=>"This email aready exist , please try again"
                ));
            }elseif(!empty($employee->check_username())){
                http_response_code(200); //ok
                echo json_encode(array(
                    "status"=>0,
                    "messege"=>"This username aready exist , please try again"
                ));
            }elseif(!empty($employee->password) && !empty($employee->repeatPassword) && ($employee->password) != ($employee->repeatPassword) ){
                http_response_code(200); //ok
                echo json_encode(array(
                    "status"=>0,
                    "messege"=>"password not match , please try again"
                ));
            }else{

            if($employee->creat_employee()){
                http_response_code(200); //ok
                echo json_encode(array(
                    "status"=>1,
                    "messege"=>"Good , User created"
                ));  
            }else{
                http_response_code(404); // error
                echo json_encode(array(
                    "status"=>0,
                    "messege"=>"Sorry , User Not created"
                ));  
            }
        }


    }else{
        http_response_code(500); 
        echo json_encode(array(
            "status"=>0,
            "messege"=>"all fileds Required"
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