<?php

require_once("./php/amslib.php");
require_once("./php/commonlib.php");

$JAMES = new AMS(0);

if(isset($_COOKIE["__u9RmdkJ6"]))
{   
    $JAMES->verify_user_token(customDecrypt($_COOKIE["__u9RmdkJ6"]));
}
else if(isset($_POST["login"]) && isset($_POST['_username']) && isset($_POST['_password']))
{
    $uname =  sanitizeInput($_POST["_username"]);
    $pswd  =  sanitizeInput($_POST["_password"]);

    if(isset($_POST['_rememberMe']) && $_POST['_rememberMe']==="on")
    {
        $JAMES->startSession($uname,$pswd,true);
    }
    else
    {
        $JAMES->startSession($uname,$pswd,false);
    }
    
}
else
{   
    $JAMES->ams_redirect("index.php");
}


?>