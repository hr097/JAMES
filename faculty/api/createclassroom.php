<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin:ams.vnsguit.org'); 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods,Authorization');

require_once("../../ams.php");
$JAMES = new AMS("Admin");
$JAMES->init_user_session();

function create_classroom($course_name,$subject_name,$division,$cur_year)
{
        //@query
        $sql = "select C.cs_id from Subjects A,Courses B,Course_subject_map C where A.subject_id=C.subject_id and B.course_id=C.course_id and B.course_name='$course_name' and A.subject_name='$subject_name';";

        $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);
    
        if(mysqli_num_rows($result)==1)
        {   
            $record = mysqli_fetch_array($result);

            $csid = $record['cs_id'];

            $sql = "select * from Ams_setup_course_subject_map where cs_id=$csid and year='$cur_year' and division='$division'";
            $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);

            if(mysqli_num_rows($result)<=0)
            {
                $sql = "insert into Ams_setup_course_subject_map(cs_id,year,division) values($csid,'$cur_year','$division')";
                if(mysqli_query($GLOBALS['JAMES']->connection(),$sql))
                {   

                    $sql = "select * from Ams_setup_course_subject_map where cs_id=$csid and year='$cur_year' and division='$division';";
                    $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);

                    if(mysqli_num_rows($result)==1)
                    {   
                        $record = mysqli_fetch_array($result);
                        $ams_setup_id = $record['ams_setup_id'];
                        $fid = $_SESSION["_fid"];

                        $sql = "insert into Ams_setup_faculties_map(ams_setup_id,fid) values($ams_setup_id,'$fid');";
                        if(mysqli_query($GLOBALS['JAMES']->connection(),$sql))
                        {
                            return 1;
                        }
                        else
                        {
                            return -1;
                        }

                    }
                    else
                    {
                        return 0;// newly created setup id not found
                    }

                    
                }
                else
                {
                    return -1;
                }
            }
            else
            {
                return 0;// classroom already exists
            }

        }
        else
        {
            return 0; // cs_id not found
        }


}

function checkRequestParameter()
{
    if(isset($_POST['_cn']))
    {
            if(isset($_POST['_sb']))
            {
                if(isset($_POST['_dv']))
                {
                    if(isset($_POST['_cy']))
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
        $course_name = $JAMES->sanitizeInput($_POST['_cn']);
        $subject_name = $JAMES->sanitizeInput($_POST['_sb']);
        $division = $JAMES->sanitizeInput($_POST['_dv']);
        $cur_year = $JAMES->sanitizeInput($_POST['_cy']);

        echo(create_classroom($course_name,$subject_name,$division,$cur_year)); 
        
}
else
{    
    $JAMES->ams_redirect("../../login.php"); // when outside request comes redirect to login
}




?>
