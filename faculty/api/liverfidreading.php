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
    $sql= "select Students.cur_semester,Students.spid,Students.name,Students.gender,DATE_FORMAT(Ams_api.reading_date_time,'%d/%m/%Y %h:%i:%s') AS rdt,Students.cur_semester FROM Students,Ams_api,Courses WHERE Ams_api.spid=Students.spid and Courses.course_id=Students.course_id and Ams_api.reader_no=$classroomid AND Ams_api.reading_no=(select MAX(Ams_api.reading_no) FROM Ams_api);";

    $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);
    
    if(mysqli_num_rows($result)==1)
    {
        $faculty = "";
        $record = mysqli_fetch_assoc($result);

        $faculty.=
        "
        <tr class='student'>
        <td>".$record['spid']."</td>
        <td>".$record['name']."</td>
        <td>".$record['gender']."</td>
        <td>".$record['rdt']."</td>
        <td>".$record['cur_semester']."</td>
        </tr>
        ";

        return $faculty;
    }
    else
    {
        return "
        <tr>
        <td  colspan='5' style='font-size:1.2em;text-align:center;'>No Latest Data Available</td>
        </tr>";

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
