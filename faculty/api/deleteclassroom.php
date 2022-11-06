<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin:ams.vnsguit.org'); 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods,Authorization');

require_once("../../ams.php");
$JAMES = new AMS("Admin");
$JAMES->init_user_session();

function deleteClassroom($ams_setup_id) 
{ 
    $sql= "delete from Ams_setup_course_subject_map where ams_setup_id=$ams_setup_id";
    
    if(mysqli_query($GLOBALS['JAMES']->connection(),$sql))
    {
        return 1;
    }
    else
    {
        return 0;
    }
}

if(isset($_POST['_cid'])&&isset($_POST['_ct'])&&$_POST['_ct']==$_SESSION['_csrfToken']&&isset($_SESSION['_userId']))
{
        $ams_setup_id = $JAMES->sanitizeInput($_POST['_cid']);
        echo(deleteClassroom($ams_setup_id)); 
}
else
{    
    $JAMES->ams_redirect("../../login.php"); // when outside request comes redirect to login
}



?>
