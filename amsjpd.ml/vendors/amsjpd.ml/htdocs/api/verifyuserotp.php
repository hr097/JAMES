<?php

require_once("../amslib.php");
$JAMES = new AMS(0);
$JAMES->init_user_session();

if(isset($_POST['_c'])&&isset($_POST['_ct'])&&$_POST['_ct']==$_SESSION['_csrfToken']&&isset($_SESSION['_resetUserId'])&&isset($_SESSION['_userOtp']))
{
        $otp = $JAMES->sanitizeInput($_POST['_c']);
        echo ($JAMES->validateOtp($otp));
}
else
{    
    $JAMES->ams_redirect("../index.php");
}
?>