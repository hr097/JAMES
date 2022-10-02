<?php

 require_once("../ams.php");
 $JAMES = new AMS("User");
 $JAMES->init_user_session();


 if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="1"))
 {
  $JAMES->ams_redirect("../login.php");
 }
 
 $u = $_SESSION["_userId"];

//@query
$sql = "select spid,SUBSTRING(name,INSTR(name,' '),( (LOCATE(' ',name,INSTR(name,' ')+1)) - INSTR(name,' ') )) AS fname from vw_students where email='$u';"; 
$result = mysqli_query($JAMES->connection(),$sql);

if(mysqli_num_rows($result)===1)
{
    $user = mysqli_fetch_assoc($result);
}
else
{
    $JAMES->ams_redirect("../login.php");
}

// daily attendance fetch

$spid = $user['spid'];

$_SESSION['_spid'] = $spid; // to access this in other pages

$attendance_html = "";

//@query
$sql = "select S.subject_name,AAM.att_status from Ams_attendance_master AAM,Ams_setup_course_subject_map ASCSM,Course_subject_map CSM,Subjects S where AAM.ams_setup_id=ASCSM.ams_setup_id and ASCSM.cs_id=CSM.cs_id and CSM.subject_id=S.subject_id and spid='$spid'and DATE_FORMAT(DATE(AAM.att_date_time),'%d/%m/%y') = DATE_FORMAT(CURRENT_DATE,'%d/%m/%y') ORDER BY TIME_FORMAT(TIME(AAM.att_date_time),'%h:%i:%s') DESC;"; 
$result = mysqli_query($JAMES->connection(),$sql);

if(mysqli_num_rows($result)>=1)
{
    while($record = mysqli_fetch_assoc($result))
    {
         
        if($record["att_status"]==1)
        {
            $att_status="class='btn btn-success attbtn'>Present";
        }
        else
        {
            $att_status="class='btn btn-danger attbtn'>Absent";
        }

        $attendance_html.="
            <tr>
            <td>".$record["subject_name"]."</td>
            <td>
                <button type='button'".$att_status."</button>
            </td>
            </tr>";
    }
}
else
{
    $attendance_html.="
    <tr>
    <td colspan='1'></td>
    <td>
    No Attendance Data for Today
    </td>
    </tr>";
}

// classroom fetch

//@query 
$sql = "select distinctrow S.subject_code,S.subject_name,F.name AS fac_name from Ams_setup_students_map ASM,Ams_setup_course_subject_map ASCSM,Course_subject_map CSM,Subjects S,Faculties F,ams_setup_faculties_map ASFM where ASM.ams_setup_id=ASCSM.ams_setup_id and ASCSM.cs_id=CSM.cs_id and CSM.subject_id=S.subject_id and ASFM.fid=F.fid and ASCSM.ams_setup_id=ASFM.ams_setup_id and spid='$spid' order by S.subject_code"; 
$result = mysqli_query($JAMES->connection(),$sql);

//@change colors
$color_palate = array("card card-dark-blue","card card-tale","card card-light-danger","card bg-warning text-white","card bg-secondary text-white","card bg-success text-white","card bg-dark text-white","card bg-info text-white","card bg-light text-dark border");
$subjects_html = "";

$itr=0;

if(mysqli_num_rows($result)>=1)
{
    while($record = mysqli_fetch_assoc($result))
    {
         
        $subjects_html.="
        <div id='".$record['subject_name']."'class='col-md-3 mb-2 stretch-card transparent handpointer subjects'>
        <div class='".$color_palate[$itr]."'>
            <div class='card-body'>
                <p class='mb-4 subfont'>".$record['subject_code']."<br>".$record['subject_name']."</p>
                <p>".$record['fac_name']."</p>
            </div>
        </div>
        </div>";
        $itr++;
        if($itr == count($color_palate))
        {
            $itr=0;
        }
    }
}
else
{
    $subjects_html.="<p style='font-size:1.5em;margin:auto;'>No Classroom enrolled yet</p>";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- including header -->
    <?php
    include './common/header.php'
    ?>

    <!-- css  -->
    <link rel="stylesheet" href="../css/student.css">
     
    <!-- js  -->
    <script src="../js/student/dashboard.js" type="text/javascript" defer=true></script>

    <!-- page information-->
    <title>AMS | Student dashboard</title>
</head>

<body>

            <!-------------------------------------------------------Main Content------------------------------------------------------->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-50">
                            <h3 class="font-weight-bold">Welcome <?php echo $user['fname']; ?>,</h3>
                            <h6 id="daymode" class="font-weight-normal mb-10"> Good Morning, </h6>
                        </div>

                        <!-------------------------------------------------------Subjects------------------------------------------------------->
                        <div class="col-md-12 grid-margin transparent">
                            <div class="row">
                            <?php echo $subjects_html;?>
                            </div>
                        </div>
                        <!-------------------------------------------------------Table Started------------------------------------------------------->
                        <div class="col-lg-12 grid-margin">

                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Daily Attendance</h4>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table id="order-listing" class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Subject</th>
                                                            <th>Attendance Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    <?php echo $attendance_html;?>
                                                       
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- including footer -->
    <?php
    include './common/footer.php'
    ?>

</body>

</html>