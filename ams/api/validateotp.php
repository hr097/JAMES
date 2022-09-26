<?php


header('Content-Type: application/json');
header('Access-Control-Allow-Origin:*'); //  @change
// header('Access-Control-Allow-Origin:ams.vnsguit.org');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods,Authorization');

require_once("../ams.php");
$JAMES = new AMS();
$JAMES->init_user_session();

function validateOtp($code)
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

if(isset($_POST['_c'])&&isset($_POST['_ct'])&&$_POST['_ct']==$_SESSION['_csrfToken']&&isset($_SESSION['_resetUserId'])&&isset($_SESSION['_userOtp']))
{
        $otp = $JAMES->sanitizeInput($_POST['_c']);
        echo (validateOtp($otp));
}
else
{    
    $JAMES->ams_redirect("../index.php");
}
?>