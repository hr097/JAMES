<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin:ams.vnsguit.org'); 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods,Authorization');

require_once("../../ams.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();

function getClassrooms($year) 
{ 
    $sql= "select A.*,C.course_name,S.semester,S.subject_code,F.email from Ams_setup_course_subject_map A,
    Courses C,
    Subjects S,
    Course_subject_map CSM,
    Ams_setup_faculties_map ASFM,
    Faculties F 
    where
    A.ams_setup_id = ASFM.ams_setup_id and
    ASFM.fid = F.fid and
    A.cs_id=CSM.cs_id and
    C.course_id = CSM.course_id and
    S.subject_id = CSM.subject_id and
    A.year=$year;";

    $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);
    
    if(mysqli_num_rows($result)>=1)
    {
        $ams_setup = "";
        while($record = mysqli_fetch_assoc($result))
        {  


            $ams_setup.=
            "
            <tr class='ams_setup'>
            <td>".$record['ams_setup_id']."</td>
            <td>".$record['course_name']."</td>
            <td>".$record['subject_code']."</td>
            <td>".$record['division']."</td>
            <td>".$record['semester']."</td>
            <td>".$record['year']."</td>
            <td>".$record['email']."</td>
            </tr>
            ";
        }
        return $ams_setup;
    }
    else
    {
        return "
        <tr><td  colspan='5' style='font-size:1.2em;text-align:center;'>No Classrooms Data Found!</td></tr>";
    }
}




if(isset($_POST['_yr'])&&isset($_POST['_ct'])&&$_POST['_ct']==$_SESSION['_csrfToken']&&isset($_SESSION['_userId']))
{
        $year = $JAMES->sanitizeInput($_POST['_yr']);
        echo(getClassrooms($year));
}
else
{    
    $JAMES->ams_redirect("../../login.php"); // when outside request comes redirect to login
}



?>
