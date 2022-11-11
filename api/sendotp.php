<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin:ams.vnsguit.org');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods,Authorization');

require_once("../ams.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();

function sendOtpEmail()
{   
        $otp = $GLOBALS['JAMES']->generateOtp(6);
        while(strlen($otp)!==6)
        {
            $otp = $GLOBALS['JAMES']->generateOtp(6);
        }
         
        $_SESSION['_userOtp'] = $otp; 
        $username = $_SESSION['_resetUserId'];

        
        //@email template

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
                *{
                    font-family: 'Poppins',Arial;
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
                                  <h2 style='font-size:18px; font-weight: 400; color: #ffffff; margin: 0;'>Have any questions for us or need more information ? 
                                  <p style='margin: 0;'><a href='mailto:ams.jpd@gmail.com' target='_blank' style='color: rgb(255, 255, 255);'><b>Just shoot us an email!<br> We are always here to help.</b></a><a style='color:#ffffff;font-size:16px;'><br>admin.jpd.ams@gmail.com</a></p>
                              </td>
                          </tr>
                      </table>
                  </td>
              </tr>
            </table>
        </body>
        
        </html>
                    
        ";
    
        return(($GLOBALS['JAMES']->sendEmail($username,"OTP Verfication Code",$htmlContent))?1:-1);

}

function checkUserExists($u) 
{        
    //@query
    $sql = "select username,user_type from vw_users_auth where username='$u';";

    $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);

    if(mysqli_num_rows($result)===1)
    {
        $user = mysqli_fetch_assoc($result);
        $_SESSION["_resetUserId"] = $user['username'];
            
        return(sendOtpEmail());
    }
    else
    {
        return 0;
    }
}

if(isset($_POST['_un'])&&isset($_POST['_ct'])&&$_POST['_ct']==$_SESSION['_csrfToken'])
{
        $u = $JAMES->sanitizeInput($_POST['_un']);
       
        $response = checkUserExists($u);

        echo $response;
}
else
{    
    $JAMES->ams_redirect("../login.php"); // when outside request comes redirect to login
}
?>