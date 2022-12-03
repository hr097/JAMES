<?php

require_once("../ams.php");
$JAMES = new AMS("Admin");
$JAMES->init_user_session();
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
            $sql= "select * from students where course_id =  $cid and cur_semester = $sem+1";
            $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);
            $stud_data = "";
            if(mysqli_num_rows($result)>0)
            {
                
                while($record = mysqli_fetch_assoc($result))
                $stud_data.=
                    "
                    <tr>
                    <td>".$record['spid']."</td>
                    <td>".$record['name']."</td>
                    <td>".$record['email']."</td>
                    <td>".$record['cur_semester']."</td>
                    <td>".$record['cur_division']."</td>
                    </tr>
                    ";
            }
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
    <script src="../js/admin/transfersem.js" type="text/javascript" defer=true></script>
    <script src="../js/admin/feedbackstats.js" type="text/javascript" defer=true></script>

    <!-- page information-->
    <title>AMS | Transfer Student</title>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12  col-md-12  col-lg-12  grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Select Classroom    <?php echo $error;?></h4>
                            <form method="post" class="forms-sample">

                                <input type="hidden" id="csrfToken" name="_csrfToken" value="<?php echo $JAMES->generateCsrfToken();?>" >

                                <div class="form-group">
                                        <label for="course_selection">Course Name</label>
                                        <select id="course_selection" data-count=""  name='course_selection' required class="form-control">
                                        <?php echo $course_html;?>
                                        </select>
                                </div>
                                <div class="form-group">
                                        <label for="sem_selection">Semester</label>
                                        <select id="sem_selection" name='sem_selection'  required  class="form-control">
                                        <option value='' >Not Selected</option>
                                        </select>
                                    </div>

                                <button name="transfer" class="btn btn-primary mr-2 mt-3">Transfer</button>
                                <button type="reset" class="btn btn-light mt-3">Clear</button>
                            </form>
                        </div>
                    </div>
                    
                </div>

                <div class="col-sm-12  col-md-12  col-lg-12  grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">

                            <div class="table-responsive mt-4">
                                <table id="transfered_stud_data" class="table">
                                    <thead>
                                        <tr>
                                            <th>SPID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Semester</th>
                                            <th>Division</th>
                                        </tr>
                                    </thead>
                                    <tbody id="transferstudent">
                                        <?php echo $stud_data?>
                                        <!-- <tr>
                                            <td  colspan='6' style='font-size:1.2em;text-align:center;'>No Data</td>
                                        </tr> -->
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                
                <!--Course Registration Form End-->

            
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