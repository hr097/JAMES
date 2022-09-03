<?php


require_once("../amslib.php");
$JAMES = new AMS(0);
$JAMES->init_user_session();

if(isset($_POST['_ps'])&&isset($_POST['_ct'])&&$_POST['_ct']==$_SESSION['_csrfToken'])
{
        $pswd = $JAMES->sanitizeInput($_POST['_ps']);

        $pswd = crypt($pswd,'$2a$10$1qAz2wSx3eDc4rFv5tGb5t');
        
        //sleep(1); //! need to remove this

        if($JAMES->update_user($_SESSION['_resetUserId'],$pswd))
        {
            echo 1;
        }
        else
        {   
            echo 0;
        }
        
}
else
{    
    $JAMES->ams_redirect("../index.php");
}


?>