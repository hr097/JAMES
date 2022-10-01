<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin:*'); //  @change * => ams.vnsguit.org
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods,Authorization');

require_once("../ams.php");
$JAMES = new AMS(); // no database connection needed
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


function checkApiReqBody()
{
    if(isset($_POST['_c']))
    {
        if(isset($_POST['_ct'])&&$_POST['_ct']==$_SESSION['_csrfToken'])
        {
            if(isset($_SESSION['_resetUserId'])&&isset($_SESSION['_userOtp']))
            {
                return true;
            }
        }
    }

    return false;
}


if(checkApiReqBody()===true)
{
    $otp = $JAMES->sanitizeInput($_POST['_c']);
    echo (validateOtp($otp));
}
else
{    
    $JAMES->ams_redirect("../login.php"); // when outside request comes redirect to login
}
?>