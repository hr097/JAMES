<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin:ams.vnsguit.org'); 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods,Authorization');

require_once("../../ams.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();

function findStudent($spid) 
{ 
    $sql= "select DATE_FORMAT(A.dob,'%d-%m-%Y')AS fdob,A.*,B.course_name from Students A,Courses B where A.course_id=B.course_id AND A.spid='$spid';";

    $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);
    
    if(mysqli_num_rows($result)==1)
    {
        $student = "";
        while($record = mysqli_fetch_assoc($result))
        {
            $student.=
            "
            <tr class='student'>
            <td>".$record['spid']."</td>
            <td>".$record['name']."</td>
            <td>".$record['gender']."</td>
            <td>".$record['fdob']."</td>
            <td>".$record['course_name']."</td>
            <td>
            <button id='".$record['spid']."' type='button' class='btn updatebtn rounded px-3 py-2 mr-2'><i
                    class='ti-pencil'></i></button>
            <button id='".$record['email']."' type='button' class='btn deletstudbtn btn-danger rounded px-3 py-2'><i
                    class='ti-trash'></i></button>
            </td>
            </tr>
            ";
        }
        return $student;
    }
    else
    {
        return "
        <tr>
        <td  colspan='6' style='font-size:1.2em;text-align:center;'>SPID Not Found!</td>
        </tr>";
    }
}




if(isset($_POST['_spid'])&&isset($_POST['_ct'])&&$_POST['_ct']==$_SESSION['_csrfToken']&&isset($_SESSION['_userId']))
{
        $spid = $JAMES->sanitizeInput($_POST['_spid']);
        echo(findStudent($spid));
}
else
{    
    $JAMES->ams_redirect("../../login.php"); // when outside request comes redirect to login
}



?>
