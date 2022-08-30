<?php

require_once("./php/amslib.php");
require_once("./php/commonlib.php");
init_user_session();

// echo isset($_POST["login"]);

$JAMES = new AMS(0);

// if(isset($_COOKIE["__u9RmdkJ6"]))
// {   
//     $JAMES->verify_user_token(customDecrypt($_COOKIE["__u9RmdkJ6"]));
// }
if(isset($_POST["login"]) && isset($_POST['_username']) && isset($_POST['_password']) && isset($_POST['_csrfToken']) && $_POST['_csrfToken'] == $_SESSION['_csrfToken'] )
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