<?php
require_once("../ams.php");

$JAMES = new AMS();
$JAMES->init_user_session();


if(isset($_SESSION["_resetUserId"])||isset($_SESSION["_csrfToken"]))
{
    $JAMES->delete_user_session();
    $JAMES->ams_redirect("../login.php");
    exit();
}   
else
{
    $JAMES->ams_redirect("../index.php");
    exit();
}

?>