<?php     
// $to_email = 'harshilramani9777@gmail.com';
// $subject = 'Testing PHP Mail';
// $message = 'This mail is sent using the PHP mail function';
// $headers = 'From: ams.jpd@gmail.com';
// echo mail($to_email,$subject,$message,$headers);


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "../vendor/autoload.php";

// $mail = new PHPMailer(true);

// //Enable SMTP debugging.
// $mail->SMTPDebug = 3;                               
// //Set PHPMailer to use SMTP.
// $mail->isSMTP();            
// //Set SMTP host name                          
// $mail->Host = "smtp.gmail.com";
// //Set this to true if SMTP host requires authentication to send email
// $mail->SMTPAuth = true;                          
// //Provide username and password     
// $mail->Username = "ams.jpd@gmail.com";                 
// $mail->Password = "wlvbwdxvlbkotlik";                           
// //If SMTP requires TLS encryption then set it
// $mail->SMTPSecure = "tls";                           
// //Set TCP port to connect to
// $mail->Port = 587;                                   

// $mail->From = "ams.jpd@gmail.com";
// $mail->FromName = "JPD AMS";

// $mail->addAddress("harshilramani9777@gmail.com");

// $mail->isHTML(true);

// $mail->Subject = "";
// $mail->Body = file_get_contents("../templates/otpemail.html");


// $mail->AltBody = "This is the plain text version of the email content";

// try {
//     $mail->send();
//     echo "Message has been sent successfully";
// } catch (Exception $e) {
//     echo "Mailer Error: " . $mail->ErrorInfo;
// }

$username="harshilramani.mscit20@vnsgu.ac.in";
$otp = 1234565;


function sendEmail($recipientAddress,$subject,$mailtemplate)
{
        $mail = new PHPMailer(true);
        //Enable SMTP debugging.
        $mail->SMTPDebug = 3;                               
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
        // $mail->Body = file_get_contents("../templates/otpemail.html");;

        $mail->AltBody = "No email body!";

        try {
            $mail->send();
            return (true);
        } catch (Exception $e) {
            // echo "Mailer Error: " . $mail->ErrorInfo;
            return (false);
        }

}

$htmlContent = `


<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html, charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <style type="text/css">
       
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

       
        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }
    </style>
</head>

<body style="background-color: #ffffff;margin: 0 !important; padding: 0 !important;">
    

    <table border="0" cellpadding="0" cellspacing="0" width="100%">
       
        <tr>
            <td align="center" style ="background: #5755a5">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td  align="center" style="padding: 0px 10px 0px 10px;background : #5755a5">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #4b49ac; font-family: poppins; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">
                            <h1 style="font-size: 35px; font-weight: 500; margin: 2;"><b>OTP Verification</b></h1> <img src="https://live.staticflickr.com/65535/52097859173_5b6d3573df_n.jpg" width="250" height="120" style="display: block; border: 0px;" />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        
        <tr>
            <td  align="center" style="padding: 0px 10px 0px 10px; background-color: #f4f4f4;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 20px 30px; color: #000000; font-family: poppins; font-size: 18px; font-weight: 400; line-height: 30px;">
                            <p style="margin: 0; ">Hello,<br>`.$username.`<br> Your <b>verification code</b> to reset your password is as follows </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
          <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
              <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <tr>
                  <td bgcolor="#ffffff" align="left">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                              <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 30px 30px;">
                                  <table border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                          <td align="center" style="border-radius: 3px;background : #5755a5" ><a href="#" target="_blank" style="font-size: 20px; font-family: poppins; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 6px; border: 1px solid #87C7E8; display: inline-block;">`.$otp.`</a></td>
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
          <td  align="center" style="padding: 0px 10px 0px 10px; background-color: #f4f4f4;">
              <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                  <tr>
                      <td bgcolor="#ffffff" align="center" style="padding: 0px 30px 40px 30px; color: #000000; font-family: poppins; font-size: 18px; font-weight: 400; line-height: 30px;">
                          <p style="margin: 0; "> Please do not share this verification code as <br> it is <b>confidential</b> to user.</p>
                          <p style="margin:0;text-align: center;"><br>Regards,<br><b><a href = "#" style = "color:black">JPD AMS.</a></b></p>
                      </td>
                  </tr>
              </table>
          </td>
      </tr>

        <tr>
            <td bgcolor="#f4f4f4" align="center" style="padding: 30px 10px 40px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td align="center" style="background : #5755a5;padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: poppins; font-size: 18px; font-weight: 400; line-height: 30px;">
                            <h2 style="font-size:18px; font-weight: 400; color: #111111; margin: 0;">Have any questions for us or need more information ? 
                            <p style="margin: 0;"><a href="mailto:admin.jpd.ams@vnsgu.ac.in" target="_blank" style="color: black;"><b>Just shoot us an email!<br> We are always here to help.</b></a><a style="color:#000000;font-size:16px;"><br>admin.jpd.ams@vnsgu.ac.in</a></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
              
              
`;

echo sendEmail($username,"OTP Verification Code",$htmlContent);

?>