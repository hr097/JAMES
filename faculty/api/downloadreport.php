<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin:ams.vnsguit.org'); 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods,Authorization');

require_once("../../ams.php");
$JAMES = new AMS("Admin");
$JAMES->init_user_session();

    function generateReport()
    {   
        // logic for excel creattion and query for database data fetching
        return 0; //! remove it
    }

    if(isset($_POST['_cid'])&&isset($_POST['_ct'])&&$_POST['_ct']==$_SESSION['_csrfToken']&&isset($_SESSION['_userId']))
    {
            $classroomid = $JAMES->sanitizeInput($_POST['_cid']);
            echo(generateReport($classroomid)); 
            
    }
    else
    {    
        $JAMES->ams_redirect("../../login.php"); // when outside request comes redirect to login
    }



?>

