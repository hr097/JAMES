<?php

require_once("../ams.php");
$JAMES = new AMS("Admin");
$JAMES->init_user_session();
if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="3"))
{
 $JAMES->ams_redirect("../login.php");
}
$error = "";
$course_html = "";
$stud_data = "";
$sql= "select * from Courses;";//query
$result = mysqli_query($JAMES->connection(),$sql);
if(mysqli_num_rows($result)>0)
{
    $course_html = "<option value=''>Not Selected</option>";
    //course
    while($record = mysqli_fetch_assoc($result))
    { 
        $course_html.="<option value='".$record['course_id']."' data-count='".$record['total_semester']."'>".$record['course_name']."</option>";
    }
}
else
{
    $course_html = 
    "
    <select name='course_Selection' class='form-control' required>
        <option value=''>Not Selected</option>
    </select>
    ";
}
if(isset($_POST['backup']))
{
    $cid = $_POST['course_selection'];
    $sem = $_POST['sem_selection'];
    $sql = "select email from students where course_id = $cid and cur_semester = $sem";
    $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);
    $record = mysqli_fetch_all($result,MYSQLI_ASSOC);
    $record = array_column($record,'email');
    $emails = "'".implode("','",array_values($record))."'";

    $sql= "delete from users where username in($emails)";//query
    if(mysqli_query($GLOBALS['JAMES']->connection(),$sql) && mysqli_affected_rows($GLOBALS['JAMES']->connection()) > 0)
    {
        $error = "<span id='response_msg' style='color:green;float:right;'>Students have been backed up</span>";
    }
    else
    {
        $error = "<span id='response_msg' style='color:red;float:right;'>Students couldn't be backed up!</span>".mysqli_error($GLOBALS['JAMES']->connection()); 
    }
    $error.="<script>setTimeout(function(){ $('#response_msg').html('');},3000);</script>";


     

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- including header -->
    <?php
    require_once('./common/header.php');
?>

    <!-- js  -->
    <script src="../js/admin/feedbackstats.js" type="text/javascript" defer=true></script>
    <script src="../js/admin/classbckup.js" type="text/javascript" defer=true></script>
    <!-- page information-->
    <title>AMS | Class Backup</title>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
            <button type='button' onclick="window.history.back()"
                        style="vertical-align:middle;padding:9px;width:90px;height:40px;float:left;position:relative;bottom:10px;display:inline;border-radius:12px;"
                        class='btn form-control btn-primary btn-icon-text ml-3 mb-2'>

                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                        </svg>
                        Back
                </button>
                <div class="col-sm-12  col-md-12  col-lg-12  grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Backup Students<?php echo $error;?></h4>
                            <form method="post" class="forms-sample">

                                <input type="hidden" id="csrfToken" name="_csrfToken" value="<?php echo $JAMES->generateCsrfToken();?>" >

                                <div class="form-group">
                                        <label for="course_selection">Course Name</label>
                                        <select id="course_selection" data-count=""  name='course_selection' required class="form-control">
                                        <?php echo $course_html;?>
                                        </select>
                                </div>
                                <div class="form-group">
                                        <label for="semester">Semester</label>
                                        <label for="sem_selection">Semester</label>
                                        <select id="sem_selection" name='sem_selection'  required  class="form-control">
                                        <option value='' selected >Not Selected</option>
                                        </select>
                                </div>

                                <!-- Total Semester-->
                    

                                <button name="backup" class="btn btn-primary mr-2 mt-3">Backup Students</button>
                                <!-- <button type="reset" class="btn btn-light mt-3">Clear</button> -->
                            </form>
                        </div>
                    </div>
                </div>
                <!--Course Registration Form End-->

                <div class="col-sm-12  col-md-12  col-lg-12  grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Student list</h4>
                            <div class="table-responsive mt-4">
                                <table id="backup_stud_data" class="table">
                                    <thead>
                                        <tr>
                                            <th>SPID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Division</th>
                                        </tr>
                                    </thead>
                                    <tbody id="backupstudent">
                                        
                                    </tbody>
                                </table>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>

                <!-- Course Updation End -->

            </div>
        </div>
    </div>


</head>

<body>

    <!-- including footer -->
    <?php
require_once('./common/footer.php');
?>

</body>

</html>