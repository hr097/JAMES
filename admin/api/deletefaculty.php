<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin:ams.vnsguit.org'); 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods,Authorization');

require_once("../../ams.php");
$JAMES = new AMS("Admin");
$JAMES->init_user_session();

function deleteFaculty($e) 
{   
   
    $sql= "delete from Users where username='$e';";
    
    if(mysqli_query($GLOBALS['JAMES']->connection(),$sql))
    {
        return 1;
    }
    else
    {
        return 0;
    }
}

if(isset($_POST['_em'])&&isset($_POST['_ct'])&&$_POST['_ct']==$_SESSION['_csrfToken']&&isset($_SESSION['_userId']))
{
        $em = $JAMES->sanitizeInput($_POST['_em']);
        echo(deleteFaculty($em)); 
}
else
{    
    $JAMES->ams_redirect("../../login.php"); // when outside request comes redirect to login
}

?>
