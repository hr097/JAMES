<?php

require_once("../ams.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();

if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="2"))
{
 $JAMES->ams_redirect("../login.php");
}

if(isset($_GET['course']))
{
    echo $_GET['course']."<br>";
    echo $_GET['year']."<br>";
    echo $_GET['subject']."<br>";
    echo $_GET['semester']."<br>";
    echo $_GET['division']."<br>";
}

?>