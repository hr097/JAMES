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
    $sql= "select Students.*,DATE_FORMAT(Students.dob,'%d-%m-%Y')AS dob from Students where spid like '$spid%' and NOT IN(select spid from Ams_setup_students_map where spid='$spid' and ams_setup_id=$cid);";

    $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);
    
    if(mysqli_num_rows($result)>=1)
    {
        $student = "";
        while($record = mysqli_fetch_assoc($result))
        {
            $student.=
            "
            <tr class='student' id='".$record['spid']."' >
            <td><input type='checkbox' id='edit_chkbox'></td>
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
        <td  colspan='7' style='font-size:1.0em;text-align:center;'>SPID Not Found!</td>
        </tr>";
    }
}

if(isset($_POST['_spid'])&&isset($_POST['_cid'])&&isset($_POST['_ct'])&&$_POST['_ct']==$_SESSION['_csrfToken']&&isset($_SESSION['_userId']))
{
        $spid = $JAMES->sanitizeInput($_POST['_spid']);
        $cid = $JAMES->sanitizeInput($_POST['_cid']);
        echo(findStudent($spid,$cid)); 
}
else
{    
    $JAMES->ams_redirect("../../login.php"); // when outside request comes redirect to login
}



?>
