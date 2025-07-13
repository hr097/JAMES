<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin:ams.vnsguit.org'); 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods,Authorization');

require_once("../../ams.php");
$JAMES = new AMS("Admin");
$JAMES->init_user_session();

function removeFacultyAccess($ams_setup_id,$fid_) 
{   
   
    $sql= "delete from Ams_setup_faculties_map where ams_setup_id=$ams_setup_id and fid='$fid_';";
    
    if(mysqli_query($GLOBALS['JAMES']->connection(),$sql))
    {
        return 1;
    }
    else
    {
        return 0;
    }
}

if(isset($_POST['_cid'])&&isset($_POST['_fid'])&&isset($_POST['_ct'])&&$_POST['_ct']==$_SESSION['_csrfToken']&&isset($_SESSION['_userId']))
{
        $ams_setup_id = $JAMES->sanitizeInput($_POST['_cid']);
        $fid = $JAMES->sanitizeInput($_POST['_fid']);
        echo(removeFacultyAccess($ams_setup_id,$fid)); 
}
else
{    
    $JAMES->ams_redirect("../../login.php"); // when outside request comes redirect to login
}



?>
