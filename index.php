<?php

require_once("./ams.php");
$JAMES = new AMS();
$JAMES->init_user_session();

if($JAMES->checkSession()===true)
{
    $type = (int) $_SESSION['_userType'];
    $JAMES->redirect_ams_user($type);
}
else
{
 $JAMES->ams_redirect("./login.php");
}

/*
EMAIL WE HAVE DESIGNED...

1 SEND OTP
2 RESET PASSWORD
3 USERNAME UPDATED
4) SEND NOTICE
5) FACULTY REGISTRATION
6) STUDENT REGISTRATION

*/

?>