<?php


use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once("vendor/autoload.php");

class AMS
{
    private const CLIPHERING = "AES-128-CTR"; // Store the cipher method
    private const ENC_DEC_KEY = "kGj2Yb3Cu5cs121jsn53bEa774kI353uIa"; // encryption key and decryption key
    private const ENC_DEC_IV = '0101010101010101'; // Non-NULL Initialization Vector for encryption-decryption
    private const OPTIONS = 0; // options  for disjunction of the flags

    private $db_connection;
    private $serverName;
    private $userName;
    private $password;

    public $todayDate;
    public $todayTime;
    
    
    //* START:: PRIVATE FUNCTIONS */

    private function set_server_configuration()
    {    
        ini_set("date.timezone","Asia/calcutta"); // set time  zone for india
        date_default_timezone_set('Asia/Calcutta'); // for php file
        ini_set('session.use_strict_mode',1); //enable strict mode to prevent session fixation attacks
        ini_set('session.use_trans_sid',0); //This will tell PHP not to include the identifier in the URL, and not to read the URL for identifiers.
        ini_set('session.use_only_cookies',1);//This will tell PHP to never use URLs with session identifiers.
    
        ini_set('session.use_cookies',1); // to allow store session ID in  clientside
        
        ini_set('session.cookie_httponly', 1);    // Prevents javascript XSS attacks aimed to steal the session ID
        ini_set('session.use_only_cookies', 1);   // Prevent Session ID from being passed through  URLs
        ini_set('session.name','lxy2Se2k3Un23l5u5E657S9jsn0NI8d05f4AnU53r'); // set session name
        
        /* extra things configuration in server */

        // ini_set('display_errors',0); // for display error
        // ini_set('display_startup_errors',0); // for display startup error
        // ini_set('file_uploads',1); // turn on file upload
        // ini_set('allow_url_include',0); // for allowing external link http/https files with include/require
        // ini_set('mysqli.reconnect',1); // recomend the MYSQL
        // ini_set('mysqli.rollback_on_cached_plink',1); //rollback changes in db when connection is half closed

        //ini_set('session.hash_function', 'sha512'); // remove in php 7.0+
        //ini_set('session.hash_bits_per_character',6); //remove in php 7.0+
        //ini_set('session.entropy_file','/dev/urandom'); //remove in php 7.0+
        //ini_set('session.entropy_length',256);  //remove in php 7.0+
        //int_set('upload_tmp_dir','___give___path__here'); // session storage path
        
        $secure = false; // if you only want to receive the cookie over HTTPS
        $httponly = true; // prevent JavaScript access to session cookie 
        $samesite = 'Strict';

        session_set_cookie_params([
            'lifetime' => 0,
            'path' => '/',
            'domain' => $_SERVER['HTTP_HOST'],
            'secure' => $secure ,
            'httponly' => $httponly,
            'samesite' => $samesite
        ]);
    }

    private function ams_db_connect($database,$userType)
    {   
        if($userType===1 || $userType===2 || $userType===3)  //@CHANGE =>3 IS FOR LOCALHOST TESTING & DEVELOPMENT PURPOSE
        {

            switch($userType)
            {
                case 1:{
                        $this->userName = "vnsguit_james_admin";
                        $this->password = "dwvg?Z^qSK9";
                        break;
                        }
                case 2:{
                        $this->userName = "vnsguit_james_user";
                        $this->password = "bfrq_f+UwGSr";
                        break;
                        }
                default: 
                    {
                        $this->userName = "root"; //@CHANGE
                        $this->password = "";
                        break; 
                    }
            }

            $this->db_connection = mysqli_connect($this->serverName,$this->userName,$this->password,$database);

            if(!$this->db_connection)
            {   
                //echo mysqli_connect_error();
                return false;
            }
            else
            {
                return true;
            }
        }
        else
        {
            return false;
        }
    }

    //* END:: PRIVATE FUNCTIONS  */

    //* START:: PUBLIC FUNCTIONS  */

    public function connection()
    {   
        return($this->db_connection);
    }
    
    public function Debug()// to debug error on production
    {
        error_reporting(E_ALL); 
        ini_set('display_errors', 1);
    }

    public function sanitizeInput($data) // to prevent XSS atatcks and SQL injection atatcks;
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = mysqli_real_escape_string($this->db_connection,$data);
        return $data;
    }

    public function customEncrypt($string) // encryption function
    {
        if($string!=="")
        {
            $enc_str = openssl_encrypt($string, self::CLIPHERING,self::ENC_DEC_KEY,self::OPTIONS,self::ENC_DEC_IV);// Use openssl_encrypt() function to encrypt the data
            return $enc_str;
        }
        else
        {
            return "";
        }
    }

    public function customDecrypt($encStr) // decryption function
    {
        if($encStr!=="")
        {
            $dec_str=openssl_decrypt($encStr,self::CLIPHERING,self::ENC_DEC_KEY,self::OPTIONS,self::ENC_DEC_IV);// Use openssl_decrypt() function to decrypt the data
            return $dec_str;
        }
        else
        {
            return "";
        }
    }

    public function generateCsrfToken() // to prevent csrf attacks
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

    public function init_user_session() // start session and regenerate the session ID
    {   
        session_start();
        session_regenerate_id();
    }

    public function delete_user_session() // delete session and regenerate the session ID
    {
        session_unset();
        session_destroy();
    }

    public function ams_redirect($path) // redirect to particular page
    {
        header("Location:".$path);
        exit();
    }
    
    public function checkSession() // check if currently user is active/inactive in browser
    {   
        return((isset($_SESSION["_userId"]) && isset($_SESSION["_userType"]) && isset($_SESSION["_csrfToken"])) );
    }

    public function redirect_ams_user($type)
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
    public function startSession($userName,$amsUserType)
    {     
        $_SESSION["_userId"] = $userName;
        $_SESSION["_userType"] = $amsUserType;
    }

    public function generateOtp($length) // generate OTP
    {
    
    $generator = "1357902468";
  
    $result = "";
  
    for ($i = 1; $i <= $length; $i++) {
        $result .= substr($generator, (rand()%(strlen($generator))), 1);
    }
    
    return $result;
    }

    public function checkResetPermission()
    {
        return ( (isset($_SESSION["_resetUserId"]) && isset($_SESSION["_reset"]) && ($_SESSION["_reset"]==="1")));
    }

    public function page_expire()
    {   
        unset($_SESSION['_reset']);
    }

    public function sendEmail($recipientAddress,$subject,$mailtemplate) // for sending template email to user
    {
        $mail = new PHPMailer(true);
        //Enable SMTP debugging.
        // $mail->SMTPDebug = 3;         for debugging                      
        //Set PHPMailer to use SMTP.
        //  $mail->isSMTP();           //@@@@@@@@ changed as vnsgu server can't send SMTP email it will send it from root domain    
        //Set SMTP host name                          
        $mail->Host = "smtp.gmail.com";
        //Set this to true if SMTP host requires authentication to send email
        $mail->SMTPAuth = true;                          
        //Provide username and password     
        $mail->Username = "ams.jpd@gmail.com";                 
        $mail->Password = "wlvbwdxvlbkotlik";     //@token                       
        //If SMTP requires TLS encryption then set it
        $mail->SMTPSecure = "tls";                           
        //Set TCP port to connect to
        $mail->Port = 587;                                   

        $mail->From = "ams.jpd@gmail.com";
        $mail->FromName = "JPD AMS";

        $mail->addAddress($recipientAddress);

        $mail->isHTML(true);

        $mail->Subject = $subject;
        $mail->Body = $mailtemplate;

        $mail->AltBody = "No email body!";

        try {
            $mail->send();
            return (true);
        } catch (Exception $e) {
            // echo "Mailer Error: " . $mail->ErrorInfo; // to print error if any
            return (false);
        }

    }

    
    //* END:: PUBLIC FUNCTIONS  */

    function __construct($userType="")
    {   

        if($userType=="Admin")
        {
            $userType=1;
        }
        else// if($userType=="User" || $userType=="") // BY DEFAULT DB WILL  BE CONNECTED AS USER IF NOTHING IS PASSED
        {
            $userType=3;
        }
        
        //$userType=3; //!localhost development enabled

        $this->set_server_configuration();

        $this->todayDate= date("d/m/Y"); // fetch today date
        $this->todayTime = date("h:i:s A",  time()); // fetch current time

        $this->serverName = "localhost"; 
        $databaseName = "vnsguit_james"; 

        if(!$this->ams_db_connect($databaseName,$userType))
        {
            //$this->ams_redirect("./index.php");
            echo "503-Service unavailable!";
        }
    }

    function __destruct()
    {
        mysqli_close($this->db_connection);
    }

}



?>