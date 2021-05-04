<?php
    class Employee{

    // define variable
    public $fullName;
    public $email;
    public $username;
    public $password;
    public $repeatPassword;
    public $emp_id;

    private $conn;
    private $table_name;

    public function __construct($db)
    {
        $this->conn = $db;
        $this->table_name="employees_tbl";
    }
    // Insert employee data
    public function creat_employee(){
        //insert query
        $emp_query = "INSERT INTO ".$this->table_name." SET fullName =? ,email=? ,username=? ,password=?";
        $emp_obj = $this->conn->prepare($emp_query);
        $emp_obj->bind_param("ssss" , $this->fullName , $this->email , $this->username , $this->password);

        if($emp_obj->execute()){
            return true;
        }
        return false;
    }

    // check email
    public function check_email(){
        $email_query= "SELECT * from ".$this->table_name." WHERE email=?";
        $email_obj = $this->conn->prepare($email_query);
        $email_obj->bind_param("s" , $this->email);

        if($email_obj->execute()){
            $data = $email_obj->get_result();
          return  $data->fetch_assoc();
        }
        return array();
    }

      // check username
      public function check_username(){
        $username_query= "SELECT * from ".$this->table_name." WHERE username=?";
        $username_obj = $this->conn->prepare($username_query);
        $username_obj->bind_param("s" , $this->username);

        if($username_obj->execute()){
            $data = $username_obj->get_result();
          return  $data->fetch_assoc();
        }
        return array();
    }
    
    // get all employees data
    public function get_all_data(){

        $sql_query = "SELECT * from ".$this->table_name;
        $sql_obj = $this->conn->prepare($sql_query);
        
        $sql_obj->execute();
        return $sql_obj->get_result();
    
      }

    // get single employee data
    public function get_employee_data(){
        $get_query = "SELECT * from ".$this->table_name." WHERE emp_id = ?";
        $get_obj = $this->conn->prepare($get_query);
        $get_obj->bind_param("i", $this->emp_id);

        $get_obj->execute();
        $data= $get_obj->get_result();
        return $data->fetch_assoc();
    
      }

    // update employee information
    public function update_employee(){
        //sql query to update data
        $update_query = " UPDATE ".$this->table_name." SET fullName=? , email=? , username=? , password=? WHERE emp_id=?";

        //prepare the sql
        $update_obj = $this->conn->prepare($update_query);

        $this->name=htmlspecialchars(strip_tags($this->fullName));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->mobile=htmlspecialchars(strip_tags($this->username));
        $this->mobile=htmlspecialchars(strip_tags($this->password));
        $this->stud_id=htmlspecialchars(strip_tags($this->emp_id));

        $update_obj->bind_param("ssssi", $this->fullName, $this->email, $this->username, $this->password, $this->emp_id );

        if($update_obj->execute()){
            return true;
        }
            return false;
    } 

    //delete employee
    public function delete_employee(){
        //sql query to update data
        $delete_query = " DELETE from ".$this->table_name." WHERE emp_id=?";
        //prepare the sql
        $delete_obj = $this->conn->prepare($delete_query);
        $this->emp_id=htmlspecialchars(strip_tags($this->emp_id));
        $delete_obj->bind_param("i",$this->emp_id );

        if($delete_obj->execute()){
            return true;
        }else{
            return false;
        }
    }
   
}



?>