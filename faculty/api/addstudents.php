<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin:ams.vnsguit.org'); 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods,Authorization');

require_once("../../ams.php");
$JAMES = new AMS("Admin");
$JAMES->init_user_session();

function add_students($classroom_id,$student_list)
{
        //@query
        $sql = "insert into Ams_setup_students_map(ams_setup_id,spid) ";

        //loop through students_list

        $list_len =  count($student_list);
        $itr=0;

        while($itr<$list_len)
        {
            $sql.=" values($classroom_id,'$student_list[$itr]'),";
            $itr++;
        }

        $sql[strlen($sql)-1] = ';';

        if(mysqli_query($GLOBALS['JAMES']->connection(),$sql)==1)
        { 
            return 1;
        }
        else
        {
            return $sql; 
        }


}

function checkRequestParameter()
{
    if(isset($_POST['_cid']))
    {
            if(isset($_POST['_studls']))
            {
                return true;
            }
    }

    return false;
}


if(checkRequestParameter()&&isset($_POST['_ct'])&&$_POST['_ct']==$_SESSION['_csrfToken']&&isset($_SESSION['_userId']))
{
        $class_id = $JAMES->sanitizeInput($_POST['_cid']);
        $student_list = $JAMES->sanitizeInput($_POST['_studls']);
        echo(add_students($class_id,$student_list)); 
        
}
else
{    
    $JAMES->ams_redirect("../../login.php"); // when outside request comes redirect to login
}




?>
