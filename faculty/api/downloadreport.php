<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin:ams.vnsguit.org'); 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods,Authorization');

require_once("../../ams.php");
$JAMES = new AMS("Admin");
$JAMES->init_user_session();

    function generateReport()
    {   /* Nupur write your excel generation code <here></here>*/
        /* Apart from that when you need data from database just inform me I will write query */
        
       return "https://ams.vnsguit.org/reportgeneration/test.xlsx"; //! remove it
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

