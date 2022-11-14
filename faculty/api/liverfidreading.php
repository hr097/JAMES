<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
header('Access-Control-Allow-Origin:ams.vnsguit.org'); 
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods,Authorization');


require_once("../../ams.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();

function getAmsApi($classroomid) 
{   
    $sql= "select Students.cur_semester,Students.spid,Students.name,Students.gender,DATE_FORMAT(Ams_api.reading_date_time,'%d/%m/%Y %h:%i:%s') AS rdt,Students.cur_semester FROM Students,Ams_api,Courses WHERE Ams_api.spid=Students.spid and Courses.course_id=Students.course_id and Ams_api.reader_no=$classroomid AND Ams_api.reading_no=(select MAX(Ams_api.reading_no) FROM Ams_api);";

    $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);
    
    if(mysqli_num_rows($result)==1)
    {
        $record = mysqli_fetch_assoc($result);
        $student.= $record['spid']."|".$record['name']."|".$record['gender']."|".$record['rdt']."|".$record['cur_semester'];
        return $student;
    }
    else
    {
        return 0;
    }
}

if(isset($_GET['cid'])&&isset($_SESSION['_userId']))
{
        $cid = $JAMES->sanitizeInput($_GET['cid']);
        $data = getAmsApi($cid);
        echo "data: {$data}\n";
        flush();
}
else
{    
   $JAMES->ams_redirect("../../login.php"); // when outside request comes redirect to login
}

?>
