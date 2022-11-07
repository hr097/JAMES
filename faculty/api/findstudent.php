<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin:ams.vnsguit.org'); 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods,Authorization');

require_once("../../ams.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();

function findStudent($spid,$classroomid) 
{ 
    $sql= "select Students.*,DATE_FORMAT(Students.dob,'%d-%m-%Y')AS dob from Students where spid like '$spid%' and spid NOT IN(select spid from Ams_setup_students_map where ams_setup_id=$classroomid);";

    $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);
    
    if(mysqli_num_rows($result)>=1)
    {
        $student = "";
        while($record = mysqli_fetch_assoc($result))
        {
            $student.=
            "
            <tr class='student'>
            <label for='q".$record['spid']."'>
            <td><input type='checkbox' class='edit_checkbox' name='select_stud' id='q".$record['spid']."'></td>
            <td>".$record['spid']."</td>
            <td>".$record['name']."</td>
            <td>".$record['email']."</td>
            <td>".$record['gender']."</td>
            <td>".$record['dob']."</td>
            </label>
            </tr>
            ";
        }
        return $student;
    }
    else
    {
        return "
        <tr>
        <td  colspan='7' style='font-size:1.2em;text-align:center;'>SPID Not Found!</td>
        </tr>";
    }
}


function findAllStudent($course,$cur_sem,$div,$classroomid) 
{ 
    $sql= "select vw_students.*,DATE_FORMAT(vw_students.dob,'%d-%m-%Y')AS dob from vw_students where course_name='$course' and cur_semester=$cur_sem and cur_division='$div' and vw_students.spid NOT IN(select spid from Ams_setup_students_map where ams_setup_id=$classroomid);";

    $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);
    
    if(mysqli_num_rows($result)>=1)  
    {
        $student = "";
        while($record = mysqli_fetch_assoc($result))
        {
            $student.=
            "
            <tr class='student' id='".$record['spid']."' >
            <td><input type='checkbox' name='select_stud' id='edit_chkbox'></td>
            <td>".$record['spid']."</td>
            <td>".$record['name']."</td>
            <td>".$record['email']."</td>
            <td>".$record['gender']."</td>
            <td>".$record['dob']."</td>
            </tr>
            ";
        }
        return $student;
    }
    else
    {
        return "
        <tr>
        <td  colspan='7' style='font-size:1.2em;text-align:center;'>No Data Found!</td>
        </tr>";
    }
}

if(isset($_POST['_spid'])&&isset($_POST['_md'])&&isset($_POST['_dv'])&&isset($_POST['_cid'])&&isset($_POST['_cs'])&&isset($_POST['_sm'])&&isset($_POST['_ct'])&&$_POST['_ct']==$_SESSION['_csrfToken']&&isset($_SESSION['_userId']))
{
        $spid = $JAMES->sanitizeInput($_POST['_spid']);
        $cid = $JAMES->sanitizeInput($_POST['_cid']);
        $mode = $JAMES->sanitizeInput($_POST['_md']);
        $course_name = $JAMES->sanitizeInput($_POST['_cs']);
        $div = $JAMES->sanitizeInput($_POST['_dv']);
        $semester = $JAMES->sanitizeInput($_POST['_sm']);

        if($mode==1) // single fetch
        {
            echo(findStudent($spid,$cid));
        }
        elseif($mode==2) // multi fetch
        {
            echo(findAllStudent($course_name,$semester,$div,$cid));
        }
         
}
else
{    
    $JAMES->ams_redirect("../../login.php"); // when outside request comes redirect to login
}



?>
