<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin:ams.vnsguit.org');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods,Authorization');

require_once("../ams.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();

function validate_user($u,$p) 
{    
    //@query
    $sql = "select username,password,user_type from vw_users_auth where username='$u';"; 
    $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);

    if(mysqli_num_rows($result)===1)
    {
        $user = mysqli_fetch_assoc($result);
        if(password_verify($p,$user["password"])!==true){ return -1; }
        else
        {   
            $GLOBALS['JAMES']->startSession($user['username'],$user['user_type']);
            return 1;
        }
    }
    else{ return 0; }
}

function checkApiReqBody()
{
    if(isset($_POST['_un']))
    {
        if(isset($_POST['_ps']))
        {
            if(isset($_POST['_ct'])&&$_POST['_ct']==$_SESSION['_csrfToken'])
            {
                return true;
            }
        }
    }

    return false;
}

if(checkApiReqBody()===true)
{
        $u = $JAMES->sanitizeInput($_POST['_un']);
        $p = $JAMES->sanitizeInput($_POST['_ps']);
       
        $response = validate_user($u,$p);

        if($response===1)
        {  
           $response = ((int)$_SESSION['_userType']);
        }
        echo $response;
}
else
{
    $JAMES->ams_redirect("../login.php"); // when outside request comes redirect to login
}

?>