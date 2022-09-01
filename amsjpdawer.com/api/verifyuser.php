<?php

require_once("../amslib.php");
$JAMES = new AMS(0);
$JAMES->init_user_session();

if(isset($_POST['_un'])&&isset($_POST['_ct'])&&$_POST['_ct']==$_SESSION['_csrfToken'])
{
        $u = $JAMES->sanitizeInput($_POST['_un']);
       
        $response = $JAMES->user_exists($u);
        
        sleep(1); //! need to remove

        echo $response;
}
else
{    
    $JAMES->ams_redirect("../index.php");
}
?>