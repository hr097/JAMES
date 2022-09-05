<?php

//!unsecured API

require_once("../amslib.php");
$JAMES = new AMS(0);
$JAMES->init_user_session();


if(isset($_POST['_un'])&&isset($_POST['_ps'])&&isset($_POST['_ct'])&&$_POST['_ct']==$_SESSION['_csrfToken'])
{
        $u = $JAMES->sanitizeInput($_POST['_un']);
        $p = $JAMES->sanitizeInput($_POST['_ps']);
       
        $response = $JAMES->verify_user($u,$p);

        if($response!==-1&&$response!==0)
        {    
            if(isset($_POST['_rm']) && $_POST['_rm']==="1")
            {   
                $JAMES->startSession($u,$p,true);// true means cookies are being set here
            }
            else
            {
                $JAMES->startSession($u,$p,false);
            }
        }

        echo $response;
}
else
{    
    $JAMES->ams_redirect("../index.php");
}

?>