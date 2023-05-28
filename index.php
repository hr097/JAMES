<?php

require_once("./ams.php");
$JAMES = new AMS();
$JAMES->init_user_session();

/*if($JAMES->checkSession()===true)
{
    $type = (int) $_SESSION['_userType'];
    $JAMES->redirect_ams_user($type);
}
else
{
}*/

 $JAMES->ams_redirect("./login.php");


?>