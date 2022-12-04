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
if(isset($_POST['transfer']))
{
    $cid = $_POST['course_selection'];
    $sem = $_POST['sem_selection'];
    $sql = "select total_semester from courses where course_id = $cid";
    $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);
    $record = mysqli_fetch_assoc($result);
    $tsem = $record['total_semester'];
    if($sem < $tsem)
    {
        $sql= "update students set cur_semester = cur_semester + 1 where course_id =  $cid and cur_semester = $sem ";//query
        if(mysqli_query($GLOBALS['JAMES']->connection(),$sql) && mysqli_affected_rows($GLOBALS['JAMES']->connection()) > 0)
        {
            $error = "<span id='response_msg' style='color:green;float:right;'>Students have been transferred successfully to the next semester</span>";
        }
        else
        {
            $error = "<span id='response_msg' style='color:red;float:right;'>Students couldn't be transferred!</span>"; 
        }
    }
    else
    {
        $error = "<span id='response_msg' style='color:red;float:right;'>Students couldn't be transferred!</span>"; 
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
                <div class="col-sm-12  col-md-12  col-lg-12  grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Student Search</h4>
                            <form class="forms-sample">

                                <!-- <input type="hidden" id="csrfToken" name="_csrfToken" value="<?php echo $JAMES->generateCsrfToken();?>" > -->

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
                                <div class="form-group">
                                    <label for="division">Div</label>
                                    <select id="division" class="form-control">
                                            <option>Select Division</option>
                                            <option>A</option>
                                            <option>B</option>
                                            <option>C</option>
                                            <option>D</option>
                                            <option>E</option>
                                            <option>F</option>
                                            <option>G</option>
                                            <option>H</option>
                                            <option>I</option>
                                        </select>
                                </div>
                    

                                <button type="button" id="" class="btn btn-primary mr-2 mt-3">Search</button>
                                <button class="btn btn-light mt-3">Clear</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!--Course Registration Form End-->

                <div class="col-sm-12  col-md-12  col-lg-12  grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Backup Student</h4>
                            <div class="table-responsive mt-4">
                                <table id="order-listing" class="table">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" class="mr-3">Select All</th>
                                            <th>SPID</th>
                                            <th>Student Name</th>
                                            <th>Student Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="checkbox" class="mr-3"></td>
                                            <td>202003456</td>
                                            <td>Archit Ghevariya</td>
                                            <td>archit@gmail.com</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button type="button" id=""class="btn btn-primary mr-2 mt-3">Backup Students</button>
                            <button type="reset" class="btn btn-light mt-3">Clear</button>
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