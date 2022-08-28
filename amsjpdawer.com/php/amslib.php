<?php

class AMS
{   

    private $db_connection;
    private $serverName;
    private $userName;
    private $password;
    private $amsUserType;
    private $amsUserToken;

  //*--------------------------------------- PRIVATE AREA ---------------------------------------*/

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

   
    private function get_user_details($u,$p)
    {   
        $result = mysqli_query($this->db_connection,"select password,user_token,user_type from vw_users_auth where username='$u';");

        if(mysqli_num_rows($result)===1)
        {   
            $user = mysqli_fetch_assoc($result);

            if(password_verify($p,$user["password"])==1)
            {
            $this->amsUserType = $user['user_type'];
            $this->amsUserToken = $user['user_token'];
            }
        }
      
    }
    
   

  //*--------------------------------------- PRIVATE END ---------------------------------------*/

 //*--------------------------------------- PUBLIC AREA ---------------------------------------*/

    
    public function verify_user($u,$p)
    {   
        $result = mysqli_query($this->db_connection,"select username,password from vw_users_auth where username='$u';");

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

    public function verify_user_token($token)
    {
        $result = mysqli_query($this->db_connection,"select username,user_type from vw_users_auth where user_token='$token';");

        if(mysqli_num_rows($result)===1)
        {
            $user = mysqli_fetch_assoc($result);

            $this->amsUserType = (string)$user['user_type'];
  
            session_start();
            
            $_SESSION["_userId"] = $user['username'];
            $_SESSION["_userType"] = $this->amsUserType;
            
            if($this->amsUserType==="1")
            {
                $this->ams_redirect("./student/dashboard.php");
            }
            else if($this->amsUserType==="2")
            {
                $this->ams_redirect("./faculty/dashboard.php");
            }
            else if($this->amsUserType==="3")
            {
                $this->ams_redirect("./management/dashboard.php");
            }
            else if($this->amsUserType==="4")
            {
                $this->ams_redirect("./admin/dashboard.php");
            }
            else
            {
                $this->ams_redirect("./index.php");
            }
                
        }
        else
        {
            setcookie("__u9RmdkJ6","", time() - 3600, "/");
            $this->ams_redirect("../index.php");
        }

    }
    
    public function startSession($userName,$password,$ck=false)
    {    
         $this->get_user_details($userName,$password);

         if($ck===true)
         {    
            $this->amsUserToken = customEncrypt($this->amsUserToken);
            setcookie("__u9RmdkJ6",$this->amsUserToken,time()+(86400*7),"/","",false,true);
         }

        if($this->amsUserType!=null)
        {
            session_start();
            $_SESSION["_userId"] = $userName;
            $_SESSION["_userType"] = $this->amsUserType;
            
            if($this->amsUserType==="1")
            {
                $this->ams_redirect("./student/dashboard.php");
            }
            else if($this->amsUserType==="2")
            {
                $this->ams_redirect("./faculty/dashboard.php");
            }
            else if($this->amsUserType==="3")
            {
                $this->ams_redirect("./management/dashboard.php");
            }
            else if($this->amsUserType==="4")
            {
                $this->ams_redirect("./admin/dashboard.php");
            }
            else
            {
                $this->ams_redirect("./index.php");
            }
            
        }
        else
        {
            $this->ams_redirect("../index.php");
        }
    }

    public function ams_redirect($path)
    {
        header("Location:".$path);
        exit();
    }

  //*--------------------------------------- PUBLIC END ---------------------------------------*/

  function __construct($userType)
    {   
        $this->serverName = "localhost";
        $this->amsUserType=null;
        $this->amsUserToken=null;

        // if(is_null($userType))
        // {
        //     $this->db_connection  = null;
        // }
        // else
        // {   
            if($userType===0||$userType===1||$userType===2||$userType===3||$userType===4)
            {
                $this->userType = $userType;
                $this->set_ams_user_cred();
                if(!$this->ams_db_connect("james"))
                {
                    $this->ams_redirect("../index.php");
                }
            }
        //}
    }

   function __destruct()
    {
        mysqli_close($this->db_connection);
    }

}






