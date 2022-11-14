<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin:ams.vnsguit.org'); 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods,Authorization');


require_once("../../ams.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();

function getAmsApi($classroomid) 
{   
    $sql= "select count(Ams_api.reading_no) As record_len FROM Ams_api where Ams_api.reader_no=$classroomid;";

    $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);
    
    if(mysqli_num_rows($result)==1)
    {
        
        $record = mysqli_fetch_assoc($result);

        $record_len = $record['record_len'];

        return $record_len;
    }
    else
    {
        return -1;

    }
}

if(isset($_POST['_cid'])&&isset($_POST['_ct'])&&$_POST['_ct']==$_SESSION['_csrfToken']&&isset($_SESSION['_userId']))
{
        $cid = $JAMES->sanitizeInput($_POST['_cid']);
        echo getAmsApi($cid);
}
else
{    
    $JAMES->ams_redirect("../../login.php"); // when outside request comes redirect to login
}

?>
