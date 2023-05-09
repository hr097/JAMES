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
    $sql= "select Ams_api.reading_no,Students.cur_semester,Students.spid,Students.name,Students.gender,DATE_FORMAT(Ams_api.reading_date_time,'%d/%m/%Y %h:%i:%s') AS rdt,Students.cur_semester FROM Students,Ams_api,Courses WHERE Ams_api.spid=Students.spid and Courses.course_id=Students.course_id AND Ams_api.reading_no=(select MAX(Ams_api.reading_no) FROM Ams_api where Ams_api.reader_no=$classroomid);";

    $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);
    
    if(mysqli_num_rows($result)==1)
    {
        $record = mysqli_fetch_assoc($result);

        $student.=
        "
        <tr class='student'>
        <td>".$record['spid']."</td>
        <td>".$record['name']."</td>
        <td>".$record['gender']."</td>
        <td>".$record['rdt']."</td>
        <td>".$record['cur_semester']."</td>
        </tr>
        ";


        if(!isset($_SESSION["_liverfidreq"])) {
            // No token present, generate a new one
            $_SESSION["_liverfidreq"] = $student;
            return $student;
        } else {
            // Reuse the token

            if($_SESSION["_liverfidreq"]==$student)
            {
                return -1;
            }
            else
            {
                return $student;
            }
        }

        

        
    }
    else
    {
        return 0;
    }
}

if(isset($_POST['_cid'])&&isset($_POST['_ct'])&&$_POST['_ct']==$_SESSION['_csrfToken']&&isset($_SESSION['_userId']))
{
        $cid = $JAMES->sanitizeInput($_POST['_cid']);
        $data = getAmsApi($cid);
        echo $data;
}
else
{    
   $JAMES->ams_redirect("../../login.php"); // when outside request comes redirect to login
}

?>
