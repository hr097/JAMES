<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin:ams.vnsguit.org'); 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods,Authorization');

require_once("../../ams.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();

function findSubject($scode) 
{ 
    $sql= "select * from Subjects where subject_code=$scode;";

    $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);
    
    if(mysqli_num_rows($result)==1)
    {
        $subject = "";
        while($record = mysqli_fetch_assoc($result))
        {  
            //     <button id='".$record['subject_id']."' type='button' class='btn updatebtn rounded px-3 py-2 mr-2'><i
            //class='ti-pencil'></i></button>
            $subject.=
            "
            <tr class='subject'>
            <td>".$record['subject_id']."</td>
            <td>".$record['subject_name']."</td>
            <td>".$record['subject_code']."</td>
            <td>".$record['semester']."</td>
            <td>
            <button id='".$record['subject_id']."' type='button' class='btn deletstudbtn btn-danger rounded px-3 py-2'><i
                    class='ti-trash'></i></button>
            </td>
            </tr>
            ";
        }
        return $subject;
    }
    else
    {
        return "
        <tr>
        <td  colspan='5' style='font-size:1.2em;text-align:center;'>Subject Not Found!</td>
        </tr>";
    }
}




if(isset($_POST['_sc'])&&isset($_POST['_ct'])&&$_POST['_ct']==$_SESSION['_csrfToken']&&isset($_SESSION['_userId']))
{
        $subcode = $JAMES->sanitizeInput($_POST['_sc']);
        echo(findSubject($subcode));
}
else
{    
    $JAMES->ams_redirect("../../login.php"); // when outside request comes redirect to login
}



?>
