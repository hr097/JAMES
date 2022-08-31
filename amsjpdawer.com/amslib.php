<?php

const CLIPHERING = "AES-128-CTR"; // Store the cipher method
const ENC_DEC_KEY = "kGj2Yb3Cu5cs121jsn53bEa774kI353uIa"; // encryption key and decryption key
const ENC_DEC_IV = '0101010101010101'; // Non-NULL Initialization Vector for encryption-decryption
const OPTIONS = 0; // options  for disjunction of the flags 

trait CommanLibrary
{

function sanitizeInput($data) // to prevent XSS atatcks and SQL injection atatcks;
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


function customEncrypt($string) // encryption function
{
    if($string!=="")
    {
        $enc_str = openssl_encrypt($string, CLIPHERING,ENC_DEC_KEY,OPTIONS,ENC_DEC_IV);// Use openssl_encrypt() function to encrypt the data
        return $enc_str;
    }
    else
    {
        return "";
    }
}

function customDecrypt($encStr) // decryption function
{
    if($encStr!=="")
    {
        $dec_str=openssl_decrypt($encStr,CLIPHERING,ENC_DEC_KEY,OPTIONS,ENC_DEC_IV);// Use openssl_decrypt() function to decrypt the data
        return $dec_str;
    }
    else
    {
        return "";
    }
}

function generateCsrfToken() // to prevent csrf attacks
{
   // Check if a token is present for the current session
    if(!isset($_SESSION["_csrfToken"])) {
        // No token present, generate a new one
        $token = $this->customEncrypt(bin2hex(random_bytes(64)));
        $_SESSION["_csrfToken"] = $token;
    } else {
        // Reuse the token
        $token = $_SESSION["_csrfToken"];
    }
    return $token;
}

function init_user_session() // start session and regenerate the session ID
{
    session_start();
    session_regenerate_id();
}

function delete_user_session() // delete session and regenerate the session ID
{
    session_unset();
    session_destroy();
}

public function ams_redirect($path)
{
    header("Location:".$path);
    exit();
}

function checkCookies($cname)
{
    return(count($_COOKIE) > 0 && isset($_COOKIE[$cname]))?true:false;
}

function checkSession()
{   
    return ( (isset($_SESSION["_userId"]) && isset($_SESSION["_userType"]) && isset($_SESSION["_csrfToken"])) );
}

function redirect_ams_user($type)
{
        if($type===1)
        {
            $this->ams_redirect("./student/dashboard.php");
        }
        else if($type===2)
        {
            $this->ams_redirect("./faculty/dashboard.php");
        }
        else if($type===3)
        {
            $this->ams_redirect("./management/dashboard.php");
        }
        else if($type===4)
        {
            $this->ams_redirect("./admin/dashboard.php");
        }
        else
        {
            $this->ams_redirect("./index.php");
        }
}
}

//*--------------------------- COMMAN FUNCTION - END ------------------------------------//

class AMS
{    
    use CommanLibrary;
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
    private function generateOtp($length)
    {
    
    $generator = "1357902468";
  
    $result = "";
  
    for ($i = 1; $i <= $length; $i++) {
        $result .= substr($generator, (rand()%(strlen($generator))), 1);
    }
    
    return $result;
    }

    private function sendOtpEmail()
    {
        return($this->generateOtp(6));
    }
    
  //*--------------------------------------- PRIVATE END ---------------------------------------*/

 //*--------------------------------------- PUBLIC AREA ---------------------------------------*/
    
    // COOKIES::START()

    public function verify_user_token($token)
    {

     $result = mysqli_query($this->db_connection,"select username,user_type from vw_users_auth where user_token='$token';");

     if(mysqli_num_rows($result)===1)
     {
         $user = mysqli_fetch_assoc($result);

         $this->amsUserType = $user['user_type'];

         if($this->amsUserType!=="")
         {  
            $_SESSION["_userId"] = $user['username'];
            $_SESSION["_userType"] = $this->amsUserType;
            $_SESSION["_csrfToken"] = $this->generateCsrfToken();
            $this->redirect_ams_user(((int)$this->amsUserType));
         }
         else
         {
             $this->ams_redirect("./index.php");
         }
         
     }
     else
     {
         setcookie("__u9RmdkJ6","", time() - 3600, "/"); // delete token as it was tampered 
         $this->delete_user_session();
         $this->ams_redirect("./index.php");
     }

    }
    // COOKIES::END()
    
    // NORMAL LOGIN::START()

    public function verify_user($u,$p) // verfiy user and return type of user
    {   
        $result = mysqli_query($this->db_connection,"select username,password,user_token,user_type from vw_users_auth where username='$u';");

        if(mysqli_num_rows($result)===1)
        {
            $user = mysqli_fetch_assoc($result);

            if(password_verify($p,$user["password"])!==true)
            {    
                return -1;
            }
            else
            {   
                $this->amsUserType = $user['user_type'];
                $this->amsUserToken = $user['user_token'];
                return ((int)$user['user_type']);
            }
        }
        else
        {
            return 0;
        }
        
    }
   
    public function startSession($userName,$password,$ck=false)
    {    

        if($this->amsUserType!=="")
        {   
            if($ck===true)
            {    
                $userToken = $this->customEncrypt($this->amsUserToken);
                setcookie("__u9RmdkJ6",$userToken,time()+(86400*7),"/","",false,true);
            }

            $_SESSION["_userId"] = $userName;
            $_SESSION["_userType"] = $this->amsUserType;

        }
        else
        {
            $this->ams_redirect("./index.php");
        }
    }
    
    // NORMAL LOGIN::END()

    // FORGOT PASSWORD::START()

    public function user_exists($u) // verfiy user and return type of user
    {   
        $result = mysqli_query($this->db_connection,"select username,user_type from vw_users_auth where username='$u';");

        if(mysqli_num_rows($result)===1)
        {
            $user = mysqli_fetch_assoc($result);

            $this->amsUserType = $user['user_type'];
            
            $_SESSION["_resetUserId"] = $user['username'];
             
            return ($this->sendOtpEmail());
        }
        else
        {
            return 0;
        }
    }
        
    // FORGOT PASSWORD::END()


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
                    $this->ams_redirect("./index.php");
                }
            }
       // }
    }

   function __destruct()
    {
        mysqli_close($this->db_connection);
    }

}






