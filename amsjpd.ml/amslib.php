<?php

//!unsecured Library

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "vendor/autoload.php";


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

function set_server_configuration()
{    
    ini_set('session.use_strict_mode',1); //enable strict mode to prevent session fixation attacks
    ini_set('session.use_trans_sid',0); //This will tell PHP not to include the identifier in the URL, and not to read the URL for identifiers.
    ini_set('session.use_only_cookies',1);//This will tell PHP to never use URLs with session identifiers.
   
    ini_set('session.use_cookies',1); // to allow stire session ID in  clientside
    
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
    // int_set('upload_tmp_dir','___give___path__here'); // session storage path
     
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
    private function sendEmail($recipientAddress,$subject,$mailtemplate)
    {
            $mail = new PHPMailer(true);
            //Enable SMTP debugging.
             // $mail->SMTPDebug = 3;         for debugging                      
            //Set PHPMailer to use SMTP.
            $mail->isSMTP();            
            //Set SMTP host name                          
            $mail->Host = "smtp.gmail.com";
            //Set this to true if SMTP host requires authentication to send email
            $mail->SMTPAuth = true;                          
            //Provide username and password     
            $mail->Username = "ams.jpd@gmail.com";                 
            $mail->Password = "wlvbwdxvlbkotlik";                           
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

    private function sendOtpEmail() // OTP EMAIL
    {   
        $otp = $this->generateOtp(6);
        while(strlen($otp)!==6)
        {
            $otp = $this->generateOtp(6);
        }
  
        $_SESSION['_userOtp'] = $otp;
        $username = $_SESSION['_resetUserId'];

        
        // > EMAIL CODE SENT BELOW


        $htmlContent = "
        
      <!DOCTYPE html>
      <html>
      <head>
          <title></title>
          <meta http-equiv='Content-Type' content='text/html, charset=utf-8' />
          <meta name='viewport' content='width=device-width, initial-scale=1'>
          <meta http-equiv='X-UA-Compatible' content='IE=edge' />
          <style type='text/css'>
             
              body,
              table,
              td,
              a {
                  -webkit-text-size-adjust: 100%;
                  -ms-text-size-adjust: 100%;
              }
      
              table,
              /* td {
                  mso-table-lspace: 0pt;
                  mso-table-rspace: 0pt;
              } */
      
              img {
                  -ms-interpolation-mode: bicubic;
              }
      
              
              img {
                  border: 0;
                  height: auto;
                  line-height: 100%;
                  outline: none;
                  text-decoration: none;
              }
      
              table {
                  border-collapse: collapse !important;
              }
      
              body {
                  height: 100% !important;
                  margin: 0 !important;
                  padding: 0 !important;
                  width: 100% !important;
              }
      
            
              a[x-apple-data-detectors] {
                  color: inherit !important;
                  text-decoration: none !important;
                  font-size: inherit !important;
                  font-family: inherit !important;
                  font-weight: inherit !important;
                  line-height: inherit !important;
              }
      
         
              @media screen and (max-width:600px) {
                  h1 {
                      font-size: 32px !important;
                      line-height: 32px !important;
                  }
              }
      
             
              div[style*='margin: 16px 0;'] {
                  margin: 0 !important;
              }
          </style>
      </head>
      
      <body style='background-color: #ffffff;margin: 0 !important; padding: 0 !important;'>
          
      
          <table border='0' cellpadding='0' cellspacing='0' width='100%'>
             
              <tr>
                  <td align='center' style ='background: #5755a5'>
                      <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                          <tr>
                              <td align='center' valign='top' style='padding: 40px 10px 40px 10px;'> </td>
                          </tr>
                      </table>
                  </td>
              </tr>
              <tr>
                  <td  align='center' style='padding: 0px 10px 0px 10px;background : #5755a5'>
                      <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                          <tr>
                              <td bgcolor='#ffffff' align='center' valign='top' style='padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #4b49ac; font-family: poppins; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;'>
                                  <h1 style='font-size: 35px; font-weight: 500; margin: 2;'><b>OTP Verification</b></h1> <img src='https://live.staticflickr.com/65535/52097859173_5b6d3573df_n.jpg' width='250' height='120' style='display: block; border: 0px;' />
                              </td>
                          </tr>
                      </table>
                  </td>
              </tr>
              
              <tr>
                  <td  align='center' style='padding: 0px 10px 0px 10px; background-color: #f4f4f4;'>
                      <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                          <tr>
                              <td bgcolor='#ffffff' align='center' style='padding: 20px 30px 20px 30px; color: #000000; font-family: poppins; font-size: 18px; font-weight: 400; line-height: 30px;'>
                                  <p style='margin: 0; '>Hello,<br>$username<br> Your <b>verification code</b> to reset your password is as follows </p>
                              </td>
                          </tr>
                      </table>
                  </td>
              </tr>
              <tr>
                <td bgcolor='#f4f4f4' align='center' style='padding: 0px 10px 0px 10px;'>
                    <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                      <tr>
                        <td bgcolor='#ffffff' align='left'>
                            <table width='100%' border='0' cellspacing='0' cellpadding='0'>
                                <tr>
                                    <td bgcolor='#ffffff' align='center' style='padding: 20px 30px 30px 30px;'>
                                        <table border='0' cellspacing='0' cellpadding='0'>
                                            <tr>
                                                <td align='center' style='border-radius: 3px;background : #5755a5' ><a href='#' target='_blank' style='font-size: 20px; font-family: poppins; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 6px; border: 1px solid #87C7E8; display: inline-block;'>$otp</a></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr> 
                    </table>
                </td>
              </tr>
              
              <tr>
                <td  align='center' style='padding: 0px 10px 0px 10px; background-color: #f4f4f4;'>
                    <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                        <tr>
                            <td bgcolor='#ffffff' align='center' style='padding: 0px 30px 40px 30px; color: #000000; font-family: poppins; font-size: 18px; font-weight: 400; line-height: 30px;'>
                                <p style='margin: 0; '> Please do not share this verification code as <br> it is <b>confidential</b> to user.</p>
                                <p style='margin:0;text-align: center;'><br>Regards,<br><b><a href = '#' style = 'color:black'>JPD AMS.</a></b></p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

              <tr>
                  <td bgcolor='#f4f4f4' align='center' style='padding: 30px 10px 40px 10px;'>
                      <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                          <tr>
                              <td align='center' style='background : #5755a5;padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: poppins; font-size: 18px; font-weight: 400; line-height: 30px;'>
                                  <h2 style='font-size:18px; font-weight: 400; color: #111111; margin: 0;'>Have any questions for us or need more information ? 
                                  <p style='margin: 0;'><a href='mailto:admin.jpd.ams@vnsgu.ac.in' target='_blank' style='color: black;'><b>Just shoot us an email!<br> We are always here to help.</b></a><a style='color:#000000;font-size:16px;' ><br>admin.jpd.ams@vnsgu.ac.in</a></p>
                              </td>
                          </tr>
                      </table>
                  </td>
              </tr>
          </table>
      </body>
      
      </html>
                    
        ";
    
        // > EMAIL CODE SENT BELOW
 
        return(($this->sendEmail($username,"OTP Verfication Code",$htmlContent))?1:-1);

    }
    private function sendResetEmail() // RESET PASSWORD EMAIL
    {
      // > EMAIL CODE SENT BELOW

      $username = $_SESSION['_resetUserId'];
      $htmlContent = "
        
      <!DOCTYPE html>
      <html>
      <head>
          <title></title>
          <meta http-equiv='Content-Type' content='text/html, charset=utf-8' />
          <meta name='viewport' content='width=device-width, initial-scale=1'>
          <meta http-equiv='X-UA-Compatible' content='IE=edge' />
          <style type='text/css'>
             
              body,
              table,
              td,
              a {
                  -webkit-text-size-adjust: 100%;
                  -ms-text-size-adjust: 100%;
              }
      
              table,
              /* td {
                  mso-table-lspace: 0pt;
                  mso-table-rspace: 0pt;
              } */
      
              img {
                  -ms-interpolation-mode: bicubic;
              }
      
              
              img {
                  border: 0;
                  height: auto;
                  line-height: 100%;
                  outline: none;
                  quotes: 23px; 
                  text-decoration: none;
              }
      
              table {
                  border-collapse: collapse !important;
              }
      
              body {
                  height: 100% !important;
                  margin: 0 !important;
                  padding: 0 !important;
                  width: 100% !important;
              }
      
            
              a[x-apple-data-detectors] {
                  color: inherit !important;
                  text-decoration: none !important;
                  font-size: inherit !important;
                  font-family: inherit !important;
                  font-weight: inherit !important;
                  line-height: inherit !important;
              }
      
         
              @media screen and (max-width:600px) {
                  h1 {
                      font-size: 32px !important;
                      line-height: 32px !important;
                  }
              }
      
             
              div[style*='margin: 16px 0;'] {
                  margin: 0 !important;
              }
          </style>
      </head>
      
      <body style='background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;'>
          
      
          <table border='0' cellpadding='0' cellspacing='0' width='100%'>
             
              <tr>
                  <td align='center' style ='background-color: #5755a5'>
                      <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                          <tr>
                              <td align='center' valign='top' style='padding: 40px 10px 40px 10px;'> </td>
                          </tr>
                      </table>
                  </td>
              </tr>
              <tr>
                  <td  align='center' style='padding: 0px 10px 0px 10px; background-color: #5755a5'>
                      <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                          <tr>
                              <td bgcolor='#ffffff' align='center' valign='top' style='padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #4b49ac; font-family: poppins; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;'>
                                  <h1 style='font-size: 35px; font-weight: 500; margin: 2;'><b>Password updated</b></h1> <img src='https://live.staticflickr.com/65535/52097859173_5b6d3573df_n.jpg' width='250' height='120' style='display: block; border: 0px;' />
                              </td>
                          </tr>
                      </table>
                  </td>
              </tr>
              
              <tr>
                  <td  align='center' style='padding: 0px 10px 0px 10px; background-color: #f4f4f4;'>
                      <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                          <tr>
                              <td bgcolor='#ffffff' align='center' style='padding: 20px 30px 0px 30px; color: #000000; font-family: poppins; font-size: 18px; font-weight: 400; line-height: 30px;'>
                                <p style='margin: 0; '>Hello,<br>$username<br><br> Your <b>Password</b> has been updated recently.<br><br></p>
                                <h5 id='cur_date'></h5>
                                <script type='text/javascript'>
                                var today = new Date();
                                let hours = today.getHours();
                                let minutes = today.getMinutes();
                                
                                // Check whether AM or PM
                                let meredium = hours >= 12 ? 'PM' : 'AM'; 
                                               
                                // Find current hour in AM-PM Format
                                hours = hours % 12; 
                                               
                                // To display '0' as '12'
                                hours = hours ? hours : 12; 
                                minutes = minutes < 10 ? '0' + minutes : minutes;
                                               
                               const dateTime = 'Date: '+today.getDate()+'/'+(today.getMonth()+1)+'/'+today.getFullYear()+'<br> Time : ' + hours + ':' + minutes + ' ' + meredium ;
                               
                               document.getElementById('cur_date').innerHTML = dateTime;
                            
                               </script>
                              </td>
                          </tr>
                      </table>
                  </td>
              </tr>
              
              <tr>
                <td  align='center' style='padding: 0px 10px 0px 10px; background-color: #f4f4f4;'>
                    <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                        <tr>
                            <td bgcolor='#ffffff' align='center' style='padding: 0px 30px 40px 30px; color: #000000; font-family: poppins; font-size: 18px; font-weight: 400; line-height: 30px;'>
                            <p style='margin: 0; '> Please login again to your respective dashboard using the new credentials.</p>
                            <p style='margin:0;text-align: center;'><br>Regards from,<br><b><a href = '#' style = 'color:black'>JPD AMS.</a></b></p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

              <tr>
                  <td bgcolor='#f4f4f4' align='center' style='padding: 30px 10px 40px 10px;'>
                      <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                          <tr>
                              <td align='center' style='background-color:#5755a5;padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: poppins; font-size: 18px; font-weight: 400; line-height: 30px;'>
                                  <h2 style='font-size:18px; font-weight: 400; color: #111111; margin: 0;'>Have any questions for us or need more information ? </h2>
                                  <p style='margin: 0;'><a href='mailto:admin.jpd.ams@vnsgu.ac.in' target='_blank' style='color: black;'><b>Just shoot us an email!<br> We are always here to help.</b></a><a style='color:#000000;font-size:16px;' ><br>admin.jpd.ams@vnsgu.ac.in</a></p>
                              </td>
                          </tr>
                      </table>
                  </td>
              </tr>
          </table>
      </body>
      
      </html>
                      
      ";
            

    // > EMAIL CODE SENT BELOW

    return(($this->sendEmail($username,"Reset password",$htmlContent))?1:-1);
    
    }

    private function update_user_token($username)
    {
        return (bin2Hex(random_bytes(4)).substr($username,6,5));
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
            $_SESSION["_resetUserId"] = $user['username'];
             
            return($this->sendOtpEmail());
        }
        else
        {
            return 0;
        }
    }

    public function RfidApi($uid,$rNo) 
    {
         $result = mysqli_query($this->db_connection,"select * from Rfid_uid_spid_map where uid='$uid';");

        if(mysqli_num_rows($result)===1)
        {
            $result = mysqli_fetch_assoc($result);
            
            $spid = $result['spid'];

            if(mysqli_query($this->db_connection,"insert into Ams_api(reader_no,spid) values($rNo,'$spid');"))
            {
                return 1;
            }
            else
            {
                return "Something went wrong!";
            }
           
        }
        else
        {
            return "Uid not found!";
        }
    }
    
    public function update_user($u,$p)
    {   
        $t =  $this->update_user_token($u);

        $sql = "update vw_users_auth set password='$p',user_token='$t' where username='$u';";

        if(mysqli_query($this->db_connection,$sql))
        {   
            if($this->sendResetEmail()===1)
            {
                unset($_SESSION['_resetUserId']);
                unset($_SESSION['_reset']);
                return true;
            }
            else
            {    
                return false;
            }
              
        }
        else
        {
            return false;
        }
    }
    public function validateOtp($code)
    { 
        if((isset($_SESSION['_userOtp']) && $_SESSION['_userOtp']==$code))
        {
            unset($_SESSION['_userOtp']);
            $_SESSION['_reset'] = "1";
            return 1;
        }
        else
        {
            return -1;
        }
       
    }

    public function checkResetPermission()
    {
        return ( (isset($_SESSION["_resetUserId"]) && isset($_SESSION["_reset"]) && ($_SESSION["_reset"]==="1")));
    }

    public function page_exp()
    {   
        unset($_SESSION['_reset']);
    }
        
    // FORGOT PASSWORD::END()


  //*--------------------------------------- PUBLIC END ---------------------------------------*/

  function __construct($userType)
    {   
        $this->set_server_configuration();
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






