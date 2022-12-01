<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin:ams.vnsguit.org'); 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods,Authorization');

require_once("../../ams.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();

function findStudents($spid) 
{ 
    $sql= "select A.spid,A.*,B.*,C.*,E.*,F.*
    from students A, ams_setup_students_map B, ams_setup_course_subject_map C , course_subject_map D, subjects E, courses F
    where A.spid = B.spid AND B.ams_setup_id = C.ams_setup_id AND C.cs_id = D.cs_id AND D.subject_id = E.subject_id AND A.course_id = F.course_id AND
    A.spid = $spid;";

    $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);
    
    if(mysqli_num_rows($result)>0)
    {
        $student = "";
        while($record = mysqli_fetch_assoc($result))
        {
            $student.=
            "
            <tr>
            <td>".$record['spid']."</td>
            <td>".$record['name']."</td>
            <td>".$record['email']."</td>
            <td>".$record['course_name']."</td>
            <td>".$record['subject_code']."</td>
            <td>".$record['subject_name']."</td>
            <td>".$record['p_days']."</td>
            <td>".$record['a_days']."</td>
            </tr>
            ";
        }
        return $student;
    }
    else
    {
        return "
        <tr>
        <td  colspan='8' style='font-size:1.2em;text-align:center;'>SPID Not Found!</td>
        </tr>";
    }
}




if(isset($_POST['_spid'])&&isset($_POST['_ct'])&&$_POST['_ct']==$_SESSION['_csrfToken']&&isset($_SESSION['_userId']))
{
        $spid = $JAMES->sanitizeInput($_POST['_spid']);
        echo(findStudents($spid));
}
else
{    
    $JAMES->ams_redirect("../../login.php"); // when outside request comes redirect to login
}



?>
