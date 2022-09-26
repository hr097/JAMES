<?php

require_once("./ams.php");
$JAMES = new AMS(2);
$JAMES->init_user_session();


# redirect code 

# cookie available then redirect to login page

# session active then dashboard

if($JAMES->checkSession()===true)
{
    $type = (int) $_SESSION['_userType'];
    $JAMES->redirect_ams_user($type);
}
else
{
 $JAMES->ams_redirect("./login.php");
}

?>