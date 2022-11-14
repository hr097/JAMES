<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

require_once("../../ams.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();


function getAmsApi($classroomid) 
{   
    $sql= "select Students.cur_semester,Students.spid,Students.name,Students.gender,DATE_FORMAT(Ams_api.reading_date_time,'%d/%m/%Y %h:%i:%s') AS rdt,Students.cur_semester FROM Students,Ams_api,Courses WHERE Ams_api.spid=Students.spid and Courses.course_id=Students.course_id and Ams_api.reader_no=$classroomid AND Ams_api.reading_no=(select MAX(Ams_api.reading_no) FROM Ams_api);";

    $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);
    
    if(mysqli_num_rows($result)==1)
    {
        $student  = array();
        $record = mysqli_fetch_assoc($result);

        // $faculty.=
        // "
        // <tr class='student'>
        // <td>".$record['spid']."</td>
        // <td>".$record['name']."</td>
        // <td>".$record['gender']."</td>
        // <td>".$record['rdt']."</td>
        // <td>".$record['cur_semester']."</td>
        // </tr>
        // ";

        $student['spid'] = $record['spid'];
        $student['name'] = $record['name'];
        $student['gender'] = $record['gender'];
        $student['rdt'] = $record['rdt'];
        $student['cur_semester'] = $record['cur_semester'];

        return json_endcode($student);
    }
    else
    {
        return 0;
    }
}

$_GET['cid'];
$data=getAmsApi($_GET['cid']);
echo "data: {$data}\n\n";
flush();
?>