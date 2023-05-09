<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin:ams.vnsguit.org'); 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods,Authorization');

require_once("../../ams.php");
$JAMES = new AMS("Admin");
$JAMES->init_user_session();

function add_present($fid,$classroom_id,$pr_student_list)
{
        //@query
        $sql = "insert into Ams_attendance_master(spid,ams_setup_id,fid,att_status) values";

        //loop through students_list

        $list_len =  count($pr_student_list);
        $itr=0;

        while($itr<$list_len)
        {   
            $spid = $pr_student_list[$itr];
            $sql.="('$spid',$classroom_id,'$fid',TRUE),";
            $itr++;
        }

        $sql[strlen($sql)-1] = ';';

        if(mysqli_query($GLOBALS['JAMES']->connection(),$sql)==1)
        { 
            return 1;
        }
        else
        {
            return 0; 
        }


}

function add_absent($fid,$classroom_id,$ab_student_list)
{
        //@query
        $sql = "insert into Ams_attendance_master(spid,ams_setup_id,fid,att_status) values";

        //loop through students_list

        $list_len =  count($ab_student_list);
        $itr=0;

        while($itr<$list_len)
        {   
            $spid = $ab_student_list[$itr];
            $sql.="('$spid',$classroom_id,'$fid',FALSE),";
            $itr++;
        }

        $sql[strlen($sql)-1] = ';';

        if(mysqli_query($GLOBALS['JAMES']->connection(),$sql)==1)
        { 
            return 1;
        }
        else
        {
            return 0; 
        }


}


function checkRequestParameter()
{
    if(isset($_POST['_cid']))
    {       
        if(isset($_POST['_fid']))
        {
            if(isset($_POST['_prstudls']))
            {
                if(isset($_POST['_abstudls']))
                {
                return true;
                }
            }
        }
    }

    return false;
}


if(checkRequestParameter()&&isset($_POST['_ct'])&&$_POST['_ct']==$_SESSION['_csrfToken']&&isset($_SESSION['_userId']))
{
        $class_id = $JAMES->sanitizeInput($_POST['_cid']);
        $fid = $JAMES->sanitizeInput($_POST['_fid']);
        $PR_student_list = $_POST['_prstudls'];
        $AB_student_list = $_POST['_abstudls'];

        if(count($PR_student_list)>0&&$PR_student_list[0]!=" ")
        {
            $p = add_present($fid,$class_id,$PR_student_list);
            echo $p;
        }
        
        if(count($AB_student_list)>0&&$AB_student_list[0]!=" ")
        {
            $a =  add_absent($fid,$class_id,$AB_student_list);
            echo $a;
        }

        
}
else
{    
    $JAMES->ams_redirect("../../login.php"); // when outside request comes redirect to login
}




?>
