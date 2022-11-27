<?php

require_once("../ams.php");
$JAMES = new AMS("Admin");
$JAMES->init_user_session();

if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="3"))
{
 $JAMES->ams_redirect("../login.php");
}

$error = "";
$button = "<button type='submit' id='addcourse' name='addcourse' class='btn btn-primary mr-2 mt-3'>Add Course</button>";
$course_id = "";
$course_name = "";
$ts = "";




if(isset($_POST["addcourse"])) //add course
{
    $cname = $JAMES->sanitizeInput($_POST["course_name"]);
    $totalsem = $JAMES->sanitizeInput($_POST["totalsem"]);

    $sql= "insert into Courses(course_name,total_semester) values('$cname',$totalsem);";
        
    if(mysqli_query($GLOBALS['JAMES']->connection(),$sql))
    {
        $error = "<span id='response_msg' style='color:green;float:right;'>Course added successfully !</span>";
    }
    else
    {
        $error = "<span id='response_msg' style='color:red;float:right;'>Course couldn't be added!</span>"; 
    }

    $error.="<script>setTimeout(function(){ $('#response_msg').html(''); },3000);</script>";
    
}
else if(isset($_POST["updatecourse"])) // course update
{
    $cid = $JAMES->sanitizeInput($_POST["course_id"]);
    $cname = $JAMES->sanitizeInput($_POST["course_name"]);
    $totalsem = $JAMES->sanitizeInput($_POST["totalsem"]);

    $sql= "update Courses set course_name='$cname',total_semester=$totalsem where course_id=$cid;";
        
    if(mysqli_query($GLOBALS['JAMES']->connection(),$sql))
    {
        $error = "<span id='response_msg' style='color:green;float:right;'>Course Updated successfully !</span>";
    }
    else
    {
        $error = "<span id='response_msg' style='color:red;float:right;'>Course couldn't be Updated!</span>"; 
    }
    
    $error.="<script>setTimeout(function(){ $('#response_msg').html(''); },3000);</script>";
}

if(isset($_GET["opt"])&&$_GET["course_id"]&&$_GET["opt"]=="updt") // for getting information about course
{
    $cid = $JAMES->sanitizeInput($_GET["course_id"]);
    $sql= "select * from Courses where course_id=$cid;";//query
    $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);

    if(mysqli_num_rows($result)>0)
    {
        $course = mysqli_fetch_assoc($result);
        $course_id = $course['course_id'];
        $course_name = $course['course_name'];
        $ts = $course['total_semester'];
        $button = "<button type='submit' id='updatecourse' name='updatecourse' class='btn btn-primary mr-2 mt-3'>Update Course</button>";
    }
    else
    {
        $error="<span id='response_msg' style='color:red;float:right;'>Course Not Found!</span>";
        $error.="<script>setTimeout(function(){ $('#response_msg').html(''); },3000);</script>";
    }

    
}
else if(isset($_GET["opt"])&&$_GET["course_id"]&&$_GET["opt"]=="dlt") // delete course
{  
    $cid = $JAMES->sanitizeInput($_GET["course_id"]);

    $sql= "delete from Courses where course_id=$cid;";
    
    if(mysqli_query($GLOBALS['JAMES']->connection(),$sql))
    {
            $error="<span id='response_msg' style='color:green;float:right;'>Course Deleted!</span>";          
    }
    else
    {
        $error="<span id='response_msg' style='color:red;float:right;'>Failed to Delete!</span>";
    }
    $error.="<script>setTimeout(function(){ $('#response_msg').html(''); },3000);</script>";
}

//courses fetch for dropdown
$sql= "select * from Courses;";//query
$result = mysqli_query($JAMES->connection(),$sql);

if(mysqli_num_rows($result)>0)
{
    $coursetable = "";

    //course
    while($record = mysqli_fetch_assoc($result))
    { 
      
        $coursetable.=
        "
              <tr>
              <td>".$record['course_id']."</td>
              <td>".$record['course_name']."</td>
              <td>".$record['total_semester']."</td>
              <td>
              <button id='".$record['course_id']."' type='button' class='btn updatebtn updatecourse rounded px-3 py-2 mr-2'><i
              class='ti-pencil'></i></button>
                  <button id='".$record['course_id']."' type='button' class='btn btn-danger rounded px-3 py-2 deletecourse'><i
                          class='ti-trash'></i></button>
              </td>
              </tr>
        ";
    }

}
else
{
    $coursetable = "<tr><td  colspan='4' style='font-size:1.2em;text-align:center;'>No Course Registered Yet!</td></tr>";
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
    <script src="../js/admin/courseregistration.js" type="text/javascript" defer=true></script>

    <!-- page information-->
    <title>AMS | Course Registration</title>

</head>

<body>
    <!-------------------------------------------------------Main Content------------------------------------------------------->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12  col-md-12  col-lg-12  grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Course Regisration<?php echo $error;?></h4>
                            <form class="forms-sample" action="courseregistration.php" method="POST">

                                <input type="hidden" id="csrfToken" name="_csrfToken" value="<?php echo $JAMES->generateCsrfToken();?>" >

                                <input type="hidden" name="course_id" id="course_id" value="<?php echo $course_id;?>">

                                <div class="form-group">
                                        <label>Course Name</label>
                                        <input type="text" name="course_name" class="form-control" placeholder="Enter Course Name" value="<?php echo $course_name;?>" required>
                                    </div>

                                <!-- Total Semester-->
                                <div class="form-group">
                                    <label>Total Semester</label>
                                    <input type="number" name="totalsem" maxlength="2" minlength="1" class="form-control" placeholder="Enter Total Semester" value="<?php echo $ts;?>" required>
                                </div>

                                <?php echo $button; ?>
                                <button type="reset" class="btn btn-light mt-3">Clear</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!--Course Registration Form End-->

                <div class="col-sm-12  col-md-12  col-lg-12  grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Course Deatils</h4>
                            <form class="forms-sample">

                                <!-- FID and Role -->
                                <!-- <div class="row">
                                    <div class="form-group col-md-10">
                                        <label>Search Course</label>
                                        <input type="text" class="form-control" placeholder="Enter Course Name">
                                    </div>

                                    <div class="form-group col-md-2 ">
                                        <button type="button" id="searchcourse"
                                            class="btn btn-primary searchbtn mt-4">Search</button>
                                    </div>
                                </div> -->

                            </form>

                            <div class="table-responsive mt-4">
                                <table  class="table">
                                    <thead>
                                        <tr>
                                            <th>Course ID</th>
                                            <th>Course Name</th>
                                            <th>Total Semester</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="coursetable" >
                                        <?php

                                        echo $coursetable;

                                        ?>
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


    <!-- including footer -->
    <?php
require_once('./common/footer.php');
?>

</body>

</html>