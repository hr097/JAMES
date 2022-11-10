<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin:ams.vnsguit.org'); 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods,Authorization');

require_once("../../ams.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();


function sendEmailNotice($student,$email) 
{
    $GLOBALS['JAMES']->todayTime =  date("h:i:s A",  time()); // fetch latest time 
    
    //@email template    

    $st_att = $student['att_percentage']??0;

    $htmlContent = "

    Your name is ".$student['name']."    
    <br>
    Your attendance is ".$st_att."%";
          
    return(($GLOBALS['JAMES']->sendEmail($email,"Attendance Notice",$htmlContent))?1:-1);

}

function sendNotice($cid,$email) 
{        
    //@query
    $sql = "
    SELECT S.name,S.cur_roll_no,S.cur_semester,C.course_name,SB.subject_name,SB.subject_code,F.name As fname,ASCSM.year,ASCSM.division,ASSM.p_days,ASSM.a_days,(round(( (ASSM.p_days) / (ASSM.p_days + ASSM.a_days)*100))) As att_percentage FROM Students S,Faculties F,Subjects SB,Courses C,Course_subject_map CSM,Ams_setup_students_map ASSM,Ams_setup_faculties_map ASFM,Ams_setup_course_subject_map ASCSM WHERE
    S.course_id=C.course_id AND
    CSM.course_id=C.course_id AND
    CSM.subject_id=SB.subject_id AND
    F.fid=ASFM.fid AND
    S.spid=ASSM.spid AND
    ASCSM.cs_id=CSM.cs_id AND
    ASCSM.ams_setup_id=ASSM.ams_setup_id AND
    ASCSM.ams_setup_id = ASFM.ams_setup_id AND
    ASSM.ams_setup_id=ASFM.ams_setup_id AND
    S.email='$email' and ASCSM.ams_setup_id=$cid;
    ";

    $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);

    if(mysqli_num_rows($result)>0)
    {   
        $student = mysqli_fetch_assoc($result);

        echo(sendEmailNotice($student,$email));
    }
    else
    {
        return 0;
    }
}


    if(isset($_POST['_cid'])&&isset($_POST['_eid'])&&isset($_POST['_ct'])&&$_POST['_ct']==$_SESSION['_csrfToken']&&isset($_SESSION['_userId']))
    {
            $classroomid = $JAMES->sanitizeInput($_POST['_cid']);
            $email = $JAMES->sanitizeInput($_POST['_eid']);

            echo(sendNotice($classroomid,$email)); 
            
    }
    else
    {    
        $JAMES->ams_redirect("../../login.php"); // when outside request comes redirect to login
    }




?>