<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin:ams.vnsguit.org'); 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods,Authorization');

require_once("../../ams.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();

function findFaculty($email) 
{ 
    $sql= "select DATE_FORMAT(A.dob,'%d-%m-%Y')AS fdob,A.*,B.role_name from Faculties A,Faculty_roles B where A.role_id=B.role_id AND A.email='$email';";

    $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);
    
    if(mysqli_num_rows($result)==1)
    {
        $faculty = "";
        while($record = mysqli_fetch_assoc($result))
        {
            $faculty.=
            "
            <tr class='faculty'>
            <td>".$record['fid']."</td>
            <td>".$record['name']."</td>
            <td>".$record['email']."</td>
            <td>".$record['role_name']."</td>
            <td>".$record['gender']."</td>
            <td>".$record['fdob']."</td>
            
            <td>
            <button id='".$record['email']."' type='button' class='btn updatebtn rounded px-3 py-2 mr-2'><i
                    class='ti-pencil'></i></button>
            <button id='".$record['email']."' type='button' class='btn deletstudbtn btn-danger rounded px-3 py-2'><i
                    class='ti-trash'></i></button>
            </td>
            </tr>
            ";
        }
        return $faculty;
    }
    else
    {
        return "
        <tr>
        <td  colspan='7' style='font-size:1.2em;text-align:center;'>Faculty Not Found!</td>
        </tr>";
    }
}




if(isset($_POST['_em'])&&isset($_POST['_ct'])&&$_POST['_ct']==$_SESSION['_csrfToken']&&isset($_SESSION['_userId']))
{
        $email = $JAMES->sanitizeInput($_POST['_em']);
        echo(findFaculty($email));
}
else
{    
    $JAMES->ams_redirect("../../login.php"); // when outside request comes redirect to login
}



?>
