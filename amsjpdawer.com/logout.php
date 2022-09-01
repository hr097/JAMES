<?php
require_once("./amslib.php");

$JAMES = new AMS(0);
$JAMES->init_user_session();

if(isset($_POST["logout"])&&isset($_SESSION["_csrfToken"]))
{
    if($JAMES->checkCookies("__u9RmdkJ6")===true)
    {
    setcookie("__u9RmdkJ6","", time() - 3600, "/");
    }
    
    $JAMES->delete_user_session();

    $JAMES->ams_redirect("./index.php");
    exit();
}
else if(isset($_SESSION["_resetUserId"])&&isset($_SESSION["_csrfToken"]))
{
    $JAMES->delete_user_session();
    $JAMES->ams_redirect("./index.php");
    exit();
}   
else
{
    $JAMES->ams_redirect("./index.php");
    exit();
}
?>