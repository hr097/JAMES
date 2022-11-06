<?php

require_once("../ams.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();

if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="2"))
{
 $JAMES->ams_redirect("../login.php");
}

$classroom_status="-";
$classroom_id="";

if(isset($_GET['course'])&&isset($_GET['year'])&&isset($_GET['subject'])&&isset($_GET['semester'])&&isset($_GET['division']))
{
    $fid = $_SESSION['_fid'];
    $sem = $_GET['semester'];
    $year = $_GET['year'];
    $div = $_GET['division'];
    $course = $_GET['course'];
    $subject = $_GET['subject'];

    //Archive and Unarchive
    
    //query
    $sql= "select ASCSM.ams_setup_id,ASFM.setup_status from Ams_setup_faculties_map ASFM,Ams_setup_course_subject_map ASCSM,Course_subject_map CSM,Subjects S,Courses C where ASCSM.cs_id=CSM.cs_id AND CSM.course_id=C.course_id AND CSM.subject_id=S.subject_id AND ASFM.ams_setup_id=ASCSM.ams_setup_id AND 
    ASFM.fid='$fid' AND
    S.semester=$sem AND
    ASCSM.year='$year' AND
    ASCSM.division='$div' AND
    C.course_name='$course' AND
    S.subject_name='$subject';";
    
    $result = mysqli_query($JAMES->connection(),$sql);
    
    if(mysqli_num_rows($result)==1)
    {
        $classroom = mysqli_fetch_assoc($result);

        if($classroom['setup_status']==true)
        {
            $classroom_status = "Archive";
        }
        else
        {
            $classroom_status = "Unarchive";
        }

        $classroom_id=$classroom['ams_setup_id'];

        //to fetch students who have enrolled in particular classroom
    
        //@query 
        $sql = "select S.email,S.spid,S.cur_roll_no,S.name,ASSM.spid,ASSM.p_days,a_days,(round(( (p_days) / (p_days + a_days)*100))) As att_percentage from Students S,Ams_setup_students_map ASSM where ASSM.spid=S.spid and ams_setup_id=$classroom_id;"; 
        $result = mysqli_query($JAMES->connection(),$sql);

        $student_list = "";

        if(mysqli_num_rows($result)>=1)
        {
            while($record = mysqli_fetch_assoc($result))
            {            

                if($record['att_percentage']>=80)
                {
                    $att_pr=" <td><button type='button' class='btn btn-success px-3 py-2'>".$record['att_percentage']."%</button></td>";
                }
                else if($record['att_percentage']>=50)
                {
                    $att_pr=" <td><button type='button' class='btn btn-warning px-3 py-2'>".$record['att_percentage']."%</button></td>";
                }   
                else
                {
                    $att_pr=" <td><button type='button' class='btn btn-danger px-3 py-2'>".$record['att_percentage']."%</button></td>";
                }

               
            $student_list.=
            "
            <tr>
            <td>".$record['cur_roll_no']."</td>
            <td>".$record['spid']."</td>
            <td>".$record['name']."</td>
            <td>".$record['p_days']."</td>
            <td>".$record['a_days']."</td>
            ".$att_pr."
            <td>
            <button type='button' id='".$record['email']."' class='btn btn-dark px-3 py-2 ti-announcement sendnotice'></button>
            </td>

            </tr>
            ";
            }
        }
        else
        {
            $student_list.="<tr><td  colspan='7' style='font-size:1.2em;text-align:center;'>No Student Attendance Enrollment Yet!</td></tr>";
        }
        
    }
    else
    {
        $JAMES->ams_redirect("../login.php");
    }
}
else
{
    $JAMES->ams_redirect("../login.php");
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- including footer -->
    <?php
          include './common/header.php'
          ?>

    <!-- Page info -->
    <title>AMS | Classroom</title>

    <!-- css  -->
    <link rel="stylesheet" href="../css/faculty.css">
    <link rel="stylesheet" href="../css/modal.css">

    <!-- js  -->
    <script src="../js/faculty/classroom.js" type="text/javascript" defer=true></script>

</head>

<body>
    <!-------------------------------------------------------Main Content------------------------------------------------------->
    <div class="main-panel">

        <div class="content-wrapper">


            <div class="row">

                <!-------------------------------------------------------Table Start------------------------------------------------------->
                <div class="col-lg-12 grid-margin">

                    <button type='button' onclick="window.location.href='./dashboard.php'"
                        style="verticle-align:middle;padding:9px;width:90px;height:40px;margin:auto;float:left;position:relative;bottom:10px;display:inline;border-radius:12px;"
                        class='btn form-control btn-primary btn-icon-text'>

                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                        </svg>
                        Back
                    </button>

                    <h4 class="card-title classroom-title  mb-4 ml-5" style="text-align:right;">
                        <?php
                        echo $_GET['course']."-".$_GET['year']."   |   ".$_GET['subject']."   |   Sem ".$_GET['semester']."| Div-".$_GET['division'];
                    ?>
                    </h4>

                    <div class="container mt-5">
                        <div class="row">
                            <div class="col-md-2 ml-4 classroom-btns-div">
                                <button type="button" class="btn btn-primary btn-icon-text mb-1 classroom-btns" id="takeattendance">
                                    <i class="ti-check-box btn-icon-prepend"></i>
                                    Take Attendance
                                </button>
                            </div>

                            <div class="col-md-2 ml-4 classroom-btns-div">
                                <button type="button" class="btn btn-dark btn-icon-text mb-1 classroom-btns" id="modifyclass">
                                    <i class="ti-pencil btn-icon-prepend"></i>
                                    Edit Classroom
                                </button>
                            </div>

                            <div class="col-md-2 ml-4 classroom-btns-div">
                                <button type="button" class="btn btn-warning btn-icon-text mb-1 classroom-btns" id="addfaculty">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                        <path fill-rule="evenodd"
                                            d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                                    </svg>
                                    Add Faculty
                                </button>
                            </div>

                            <div class="col-md-2 ml-4 classroom-btns-div">
                                <input type="hidden" id="csrfToken" name="_csrfToken"
                                    value="<?php echo $JAMES->generateCsrfToken();?>">
                                <input type="hidden" id="classroomid" name="classroomid"
                                    value='<?php echo $GLOBALS['classroom_id'];?>'>
                                <button type="button" class="btn btn-success btn-icon-text mb-1 classroom-btns archive-btn" id="classmode">
                                    <i class="ti-archive btn-icon-prepend"></i>

                                    <?php
                                        echo $GLOBALS['classroom_status'];
                                    ?>
                                </button>
                            </div>

                            
                            <div class="col-md-2 ml-4 classroom-btns-div">
                                <button type="button" class="btn btn-danger btn-icon-text mb-1 classroom-btns" id="deleteclass">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                </svg>
                                    Delete Classroom
                                </button>
                            </div>


                        </div>
                    </div>

                    <div class="card mt-4">
                        <div class="card-body">
                            <h4 class="card-title">Students Attendance</h4>
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table id="order-listing" class="table" id="tbl">
                                            <thead>
                                                <tr>
                                                    <th>Roll Number</th>
                                                    <th>SPID</th>
                                                    <th>Full Name</th>
                                                    <th>Present</th>
                                                    <th>Absent</th>
                                                    <th>Percentage</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="enrolledstudentlist">
                                                <?php
                                                echo $student_list;
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--Table End-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <!-- modal -->
    <div id="modal" class="modal">
    <!-- modal content -->
    <div class="modal-content" style="width:360px;">
            <span class="close">&times;</span>
            <p class="msg unselectable" id="modalmsg"></p>
            <div class="row" style="margin:auto;margin-bottom:30px;">
            <button id="yes-button" class="modal-btn">Okay</button>
            <button id="no-button" class="modal-btn">Cancel</button>
    </div>
    </div>


    <!-- including footer -->
    <?php
    include './common/footer.php'
    ?>


</body>

</html>