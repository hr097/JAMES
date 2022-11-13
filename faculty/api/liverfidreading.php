<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
header('Access-Control-Allow-Origin:ams.vnsguit.org'); 
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods,Authorization');


require_once("../../ams.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();

function getAmsApi($classroomid) 
{   
    $sql= "select MAX(Ams_api.reading_no) As reading_no,Students.spid,Students.name,Students.gender,DATE_FORMAT(Students.dob,'%d/%m/%Y') AS dob,Students.cur_semester FROM Students,Ams_api WHERE Ams_api.spid=Students.spid and Ams_api.reader_no=$classroomid;";

    $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);
    
    if(mysqli_num_rows($result)>=1)
    {
        $faculty = "";
        while($record = mysqli_fetch_assoc($result))
        {
            $faculty.=
            "
            <tr class='student'>
            <td>".$record['spid']."</td>
            <td>".$record['name']."</td>
            <td>".$record['gender']."</td>
            <td>".$record['dob']."</td>
            <td>".$record['cur_semester']."</td>
            </tr>
            ";
        }
        return $faculty;
    }
    else
    {
        return "
        <tr>
        <td  colspan='6' style='font-size:1.2em;text-align:center;'>No Latest Data Available</td>
        </tr>";
    }
}

//&&isset($_GET['_ct'])&&$_GET['_ct']==$_SESSION['_csrfToken']

if(isset($_GET['cid'])&&isset($_SESSION['_userId']))
{
        $cid = $JAMES->sanitizeInput($_GET['cid']);
        $message=getAmsApi($cid);
        echo $message;
        flush();
}
else
{    
    $JAMES->ams_redirect("../../login.php"); // when outside request comes redirect to login
}

?>
