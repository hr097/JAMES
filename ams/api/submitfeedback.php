<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin:ams.vnsguit.org'); 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods,Authorization');

require_once("../ams.php");
$JAMES = new AMS("Admin");
$JAMES->init_user_session();
    
    function submit_feedback($feedback,$rating)
    {   
        $u = $_SESSION["_userId"];
        //@query
        $sql = "insert into Ams_feedback(email,description,rating) values('$u','$feedback',$rating)";

        if(mysqli_query($GLOBALS['JAMES']->connection(),$sql))
        {   
            return 1;
        }
        else
        {
            return 0;
        }
    }


    if(isset($_POST['_fb'])&&isset($_POST['_rt'])&&isset($_POST['_ct'])&&$_POST['_ct']==$_SESSION['_csrfToken']&&isset($_SESSION['_userId']))
    {
            $fb = $JAMES->sanitizeInput($_POST['_fb']);
            $rt = $JAMES->sanitizeInput($_POST['_rt']);

            echo(submit_feedback($fb,$rt));          
    }
    else
    {    
        $JAMES->ams_redirect("../login.php"); // when outside request comes redirect to login
    }


?>