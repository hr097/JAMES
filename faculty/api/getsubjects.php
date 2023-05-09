<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin:ams.vnsguit.org'); 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods,Authorization');

require_once("../../ams.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();


function get_sub_list($cn,$s) 
{        
    //@query
    $sql = "select A.subject_name from Subjects A,Courses B,Course_subject_map C where A.subject_id=C.subject_id and B.course_id=C.course_id and B.course_name='$cn' and A.semester=$s;";

    $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);

    if(mysqli_num_rows($result)>0)
    {   
        $subject_list = "<option value=''>Not Selected</option>";
        while($record = mysqli_fetch_assoc($result))
        {
            $subject_list.="<option value='".$record['subject_name']."'>".$record['subject_name']."</option>";
        }
        return $subject_list;
    }
    else
    {
        return "<option>No Subjects</option>";
    }
}


    if(isset($_POST['_cn'])&&isset($_POST['_sm'])&&isset($_POST['_ct'])&&$_POST['_ct']==$_SESSION['_csrfToken']&&isset($_SESSION['_userId']))
    {
            $course_name = $JAMES->sanitizeInput($_POST['_cn']);
            $sem = $JAMES->sanitizeInput($_POST['_sm']);

            echo(get_sub_list($course_name,$sem)); 
            
    }
    else
    {    
        $JAMES->ams_redirect("../../login.php"); // when outside request comes redirect to login
    }




?>