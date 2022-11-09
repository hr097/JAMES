<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin:ams.vnsguit.org'); 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods,Authorization');

require_once("../../ams.php");
$JAMES = new AMS("Admin");
$JAMES->init_user_session();

function add_faculties($classroom_id,$faculty_list)
{
        //@query
        $sql = "insert into Ams_setup_faculties_map(ams_setup_id,fid) values";

        //loop through facultys_list

        $list_len =  count($faculty_list);
        $itr=0;

        while($itr<$list_len)
        {   
            $fid = $faculty_list[$itr];
            $sql.="($classroom_id,'$fid'),";
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
            if(isset($_POST['_facls']))
            {
                return true;
            }
    }

    return false;
}


if(checkRequestParameter()&&isset($_POST['_ct'])&&$_POST['_ct']==$_SESSION['_csrfToken']&&isset($_SESSION['_userId']))
{
        $class_id = $JAMES->sanitizeInput($_POST['_cid']);
        $faculty_list = $_POST['_facls'];
        echo(add_faculties($class_id,$faculty_list)); 
        
}
else
{    
    $JAMES->ams_redirect("../../login.php"); // when outside request comes redirect to login
}




?>
