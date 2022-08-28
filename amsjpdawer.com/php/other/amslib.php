<?php

class AMS
{   

    private $db_connection;
    private $validateUserApiToken;
    private $serverName;
    private $userName;
    private $password;
    private $userType;

  /*--------------------------------------- PRIVATE AREA ---------------------------------------*/

    private function ams_db_connect($database)
    {
        $this->db_connection = mysqli_connect($this->serverName,$this->userName,$this->password,$database);

        if(!$this->db_connection)
        {
            return false;
        }
        else
        {
            return true;
        }

    }

    private function set_ams_user_cred()
    {    
      
        switch($this->userType)
        {
            case 0:{
                    $this->userName = "ams-authenticator";
                    $this->password = "amsauth000";
                    break;
                    }
            case 1:{
                    $this->userName = "ams-student";
                    $this->password = "amsstudent111";
                    break;
                    }
            case 2:{
                    $this->userName = "ams-faculty";
                    $this->password = "amsfaculty222";
                    break;
                    }
            case 3:{
                    $this->userName = "ams-manager";
                    $this->password = "aamsmanager333";
                    break;
                    }
            case 4:{
                    $this->userName = "ams-admin";
                    $this->password = "amsadmin444";
                    break;
                    }       
        }

    }
  /*--------------------------------------- PRIVATE END ---------------------------------------*/

 /*--------------------------------------- PUBLIC AREA ---------------------------------------*/

    
    public function verify_user($u,$p)
    {   
        $result = mysqli_query($this->db_connection,"select * from vw_users_auth where username='$u';");

        if(mysqli_num_rows($result)===1)
        {
            $user = mysqli_fetch_assoc($result);

            if(password_verify($p,$user["password"])!=1)
            {    
                return -1;
            }
            else
            {
                return 1;
            }
        }
        else
        {
            return 0;
        }
        
    }

    public function ams_redirect($path)
    {
        header("Location:".$path);
    }

  /*--------------------------------------- PUBLIC END ---------------------------------------*/

  function __construct($userType=null)
    {   
        $this->serverName = "localhost";

        if(is_null($userType))
        {
            $this->db_connection  = null;
        }
        else
        {   
            if($userType===0||$userType===1||$userType===2||$userType===3||$userType===4)
            {
                $this->userType = $userType;
                $this->set_ams_user_cred();
                if(!$this->ams_db_connect("james"))
                {
                    $this->ams_redirect("../index.php");
                }
            }
        }
    }

   function __destruct()
    {
        mysqli_close($this->db_connection);
    }

}



/*-----------------------  COM FUN  ------------------------------------------*/

function sanitizeInput($data) // to prevent XSS atatcks and SQL injection atatcks;
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/*----------------------- COM FUN  END------------------------------------------*/
