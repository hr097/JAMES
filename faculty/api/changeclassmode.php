<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin:ams.vnsguit.org'); 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods,Authorization');

require_once("../../ams.php");
$JAMES = new AMS("Admin");
$JAMES->init_user_session();

function updateMode($ams_setup_id) 
{ 
    $fid = $_SESSION['_fid'];

    $sql= "select ASFM.setup_status from Ams_setup_faculties_map ASFM  where ASFM.fid='$fid' AND ASFM.ams_setup_id=$ams_setup_id;";
    
    $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);
    
    if(mysqli_num_rows($result)==1)
    {
        $classroom = mysqli_fetch_assoc($result);

        if($classroom['setup_status']==true)
        {
           //update and set to unarchive
            $sql= "update Ams_setup_faculties_map set setup_status=false where ams_setup_id=$ams_setup_id and fid='$fid';";
            $responseType=1;
        }
        else
        {
            //update and set to unarchive
            $sql= "update Ams_setup_faculties_map set setup_status=true where ams_setup_id=$ams_setup_id and fid='$fid';";
            $responseType=2;
        }

        if(mysqli_query($GLOBALS['JAMES']->connection(),$sql))
        {
            return $responseType;
        }
        else
        {
            return 0;
        }

    }
    else
    {
        $JAMES->ams_redirect("../login.php");
    }
}

if(isset($_POST['_cid'])&&isset($_POST['_ct'])&&$_POST['_ct']==$_SESSION['_csrfToken']&&isset($_SESSION['_userId']))
{
        $ams_setup_id = $JAMES->sanitizeInput($_POST['_cid']);
        echo(updateMode($ams_setup_id)); 
}
else
{    
    $JAMES->ams_redirect("../../login.php"); // when outside request comes redirect to login
}



?>
