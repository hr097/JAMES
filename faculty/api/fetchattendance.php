<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin:ams.vnsguit.org'); 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods,Authorization');

require_once("../../ams.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();

function fetchAttendanceFromAmsApi($reader_no,$date,$time1,$time2) 
{   
    //
    $sql= "select Ams_api.spid FROM Ams_api where reader_no=$reader_no AND DATE_FORMAT(DATE(reading_date_time),'%Y-%m-%d')='$date' AND DATE_FORMAT(TIME(reading_date_time),'%H:%i')>'$time1' AND DATE_FORMAT(TIME(reading_date_time),'%H:%i')<'$time2';";

    $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);
    
    if(mysqli_num_rows($result)>0)
    {
        $student = array();
        while($record = mysqli_fetch_assoc($result))
        {
            array_push($student,$record['spid']);
         
        }
        return $student;
    }
    else
    {
        return $sql;
    }
}

if(isset($_POST['_r_no'])&&isset($_POST['_dt'])&&isset($_POST['_toti'])&&isset($_POST['_froti'])&&isset($_POST['_ct'])&&$_POST['_ct']==$_SESSION['_csrfToken']&&isset($_SESSION['_userId']))
{
        $reader = $JAMES->sanitizeInput($_POST['_r_no']);
        $d =$JAMES->sanitizeInput($_POST['_dt']);
        $t1 = $JAMES->sanitizeInput($_POST['_toti']);
        $t2 = $JAMES->sanitizeInput($_POST['_froti']);

        $message=fetchAttendanceFromAmsApi($reader,$d,$t1,$t2);
        echo(json_encode(array('response' => $message)));

         
}
else
{    
    $JAMES->ams_redirect("../../login.php"); // when outside request comes redirect to login
}



?>
