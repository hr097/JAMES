<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin:ams.vnsguit.org'); 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods,Authorization');

require_once("../../ams.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();

function findStudents($course,$semester) 
{ 
    $sql= "select * from Students where course_id = $course and cur_semester = $semester";
    $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);
    $student = "";
    if(mysqli_num_rows($result)>0)
    {
        
        while($record = mysqli_fetch_assoc($result))
        $student.=
            "
            <tr>
            <td>".$record['spid']."</td>
            <td>".$record['name']."</td>
            <td>".$record['email']."</td>
            <td>".$record['cur_division']."</td>
            </tr>
            ";
    }
    return $student;
}




if(isset($_POST['_course'])&&isset($_POST['_semester'])&&isset($_POST['_ct'])&&$_POST['_ct']==$_SESSION['_csrfToken']&&isset($_SESSION['_userId']))
{
        $course = $JAMES->sanitizeInput($_POST['_course']);
        $semester = $JAMES->sanitizeInput($_POST['_semester']);
        echo(findStudents($course,$semester));
}
else
{    
    $JAMES->ams_redirect("../../login.php"); // when outside request comes redirect to login
}



?>
