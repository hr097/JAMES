<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin:ams.vnsguit.org'); 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods,Authorization');

require_once("../../ams.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();

function findStudent($fid,$classroomid) 
{   
    $sql= "select vw_faculties.*,DATE_FORMAT(vw_faculties.dob,'%d-%m-%Y')AS dob from vw_faculties where (fid like '$fid%' OR  fid email '$fid%') and fid NOT IN(select fid from Ams_setup_faculties_map where ams_setup_id=$classroomid);";

    $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);
    
    if(mysqli_num_rows($result)>=1)
    {
        $faculty = "";
        while($record = mysqli_fetch_assoc($result))
        {
            $faculty.=
            "
            <tr class='faculty'>
            <td><input type='checkbox' class='edit_checkbox' name='select_stud' id='".$record['fid']."'></td>
            <td>".$record['fid']."</td>
            <td>".$record['name']."</td>
            <td>".$record['email']."</td>
            <td>".$record['gender']."</td>
            <td>".$record['dob']."</td>
            </tr>
            ";
        }
        return $faculty;
    }
    else
    {
        return "
        <tr>
        <td  colspan='6' style='font-size:1.2em;text-align:center;'>FID Not Found!</td>
        </tr>";
    }
}


if(isset($_POST['_fid'])&&isset($_POST['_cid'])&&isset($_POST['_ct'])&&$_POST['_ct']==$_SESSION['_csrfToken']&&isset($_SESSION['_userId']))
{
        $fid = $JAMES->sanitizeInput($_POST['_fid']);
        $cid = $JAMES->sanitizeInput($_POST['_cid']);
        echo(findStudent($fid,$cid)); 
}
else
{    
    $JAMES->ams_redirect("../../login.php"); // when outside request comes redirect to login
}



?>
