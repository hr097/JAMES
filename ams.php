<?php


use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;  //@change as vnsgu server can't send SMTP email it will send it from root domain  
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
                        $this->userName = "root"; // localhost credentials
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

    public function sendEmail($recipientAddress,$subject,$mailtemplate,$cc="") // for sending template email to user
    {
        $mail = new PHPMailer(true);
        //Enable SMTP debugging.
        // $mail->SMTPDebug = 3;         for debugging                      
        //Set PHPMailer to use SMTP.
        //  $mail->isSMTP();           //@comment it as vnsgu server can't send SMTP email it will send it from root domain    
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

        $mail->addCC($cc);

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
        else// default user connected as "User"
        {
            $userType=2;
        }
        
        if($_SERVER['SERVER_NAME']==="localhost")
        {
            $userType=3;
        }
       

        $this->set_server_configuration();

        $this->todayDate= date("d/m/Y"); // fetch today date
        $this->todayTime = date("h:i:s A",  time()); // fetch current time

        $this->serverName = "localhost"; 
        $databaseName = "vnsguit_james"; 

        if(!$this->ams_db_connect($databaseName,$userType))
        {
            echo "
            
            <!DOCTYPE html>

            <html lang='en'>

                <head>

                    <meta charset='utf-8'>

                    <meta name='viewport' content='width=device-width, initial-scale=1'>



                    <title>AMS | Service Unavailable</title>



                        <!-- Meta data about page -->

                        <meta charset='UTF-8'>

                        <meta http-equiv='X-UA-Compatible' content='IE=edge'>

                        <meta name='viewport' content='width=device-width, initial-scale=1.0'>

                        

                        <!-- Search Engine use --->

                        <meta name='author' content='Team JPD-AMS'/>

                        <meta name='description' content='An efficient & relible Attendance Management System for J.P. Dower Institute of Information Science and Technology'/>

                        <meta name='key words' content='JPD AMS,Attendance Management System,J.P. Dower Institute of Information Science and Technology'/>

                        <meta http-equiv='refresh' content='120'>



                        <!-- Google fonts -->

                        <link rel='preconnect' href='https://fonts.googleapis.com'>

                        <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>

                        <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&display=swap' rel='stylesheet'>



                        <link rel='shortcut icon' href='../assets/logos/favicon.ico'>



                    <style>

                    html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}code{font-family:monospace,monospace;font-size:1em}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}code{font-family:Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-gray-400{--border-opacity:1;border-color:#cbd5e0;border-color:rgba(203,213,224,var(--border-opacity))}.border-t{border-top-width:1px}.border-r{border-right-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-xl{max-width:36rem}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.uppercase{text-transform:uppercase}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wider{letter-spacing:.05em}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@-webkit-keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes  spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@-webkit-keyframes ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@keyframes  ping{0%{transform:scale(1);opacity:1}75%,to{transform:scale(2);opacity:0}}@-webkit-keyframes pulse{0%,to{opacity:1}50%{opacity:.5}}@keyframes  pulse{0%,to{opacity:1}50%{opacity:.5}}@-webkit-keyframes bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@keyframes  bounce{0%,to{transform:translateY(-25%);-webkit-animation-timing-function:cubic-bezier(.8,0,1,1);animation-timing-function:cubic-bezier(.8,0,1,1)}50%{transform:translateY(0);-webkit-animation-timing-function:cubic-bezier(0,0,.2,1);animation-timing-function:cubic-bezier(0,0,.2,1)}}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}

                    </style>



                    <style>

                        body {

                            font-family: 'Poppins', sans-serif;, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, 'Noto Sans', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';

                        }

                    </style>

                </head>

                <body class='antialiased'>

                    <div class='relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0'>

                        <div class='max-w-xl mx-auto sm:px-6 lg:px-8'>

                            <div class='flex items-center pt-8 sm:justify-start sm:pt-0'>

                                <div class='px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider'>

                                    503                    </div>



                                <div class='ml-4 text-lg text-gray-500 uppercase tracking-wider'>

                                    Service Unavailable                    </div>

                            </div>

                        </div>

                    </div>

                </body>

            </html>
            
            ";
        }
    }

    function __destruct()
    {
        mysqli_close($this->db_connection);
    }

}



?>
