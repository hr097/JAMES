<?php

require_once("../ams.php");
$JAMES = new AMS("Admin");
$JAMES->init_user_session();

if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="3"))
{
 $JAMES->ams_redirect("../login.php");
}

$error = "";
$button = "<button type='submit' id='addsubject' name='addsubject' class='btn btn-primary mr-2 mt-3'>Add Subject</button>";
$ts=0;

function findcourseId($cname)
{
    $sql= "select * from Courses where course_name='$cname';";//query
    $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);

    if(mysqli_num_rows($result)>0)
    {
        $course = mysqli_fetch_assoc($result);
        return $course['course_id'];
    }
    else
    {
        return 0;
    }
} 

function getSubjectId($scode,$sname)
{
    $sql= "select * from Subjects where subject_name='$sname' and subject_code=$scode;";//query
    $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);

    if(mysqli_num_rows($result)>0)
    {
        $subject = mysqli_fetch_assoc($result);
        return $subject['subject_id'];
    }
    else
    {
        return 0;
    }
}


if(isset($_POST["addsubject"]))
{
    $course = $_POST['course_selection'];
    $course = substr($course,strpos($course,"_")+1);
    $cid = findcourseId($course);

    $semester = $JAMES->sanitizeInput($_POST["sem_selection"]);
    $sub_name= $JAMES->sanitizeInput($_POST["subject_name"]);
    $sub_code= $JAMES->sanitizeInput($_POST["subject_code"]);

    $sql= "insert into Subjects(subject_name,subject_code,semester) values('$sub_name',$sub_code,$semester);";
        
    if(mysqli_query($GLOBALS['JAMES']->connection(),$sql))
    {   
        $sub_id = getSubjectId($sub_code,$sub_name);

        $sql= "insert into Course_Subject_map(course_id,subject_id) values($cid,$sub_id);";
        
        if(mysqli_query($GLOBALS['JAMES']->connection(),$sql))
        { 
            $error = "<span id='response_msg' style='color:green;float:right;'>Subject added successfully !</span>";
        }
        else
        {
            $error = "<span id='response_msg' style='color:red;float:right;'>Subject couldn't be mapped!</span>"; 
        }
       
    }
    else
    {
        $error = "<span id='response_msg' style='color:red;float:right;'>Subject couldn't be added!</span>"; 
    }

    $error.="<script>setTimeout(function(){ $('#response_msg').html('');},3000);</script>";
     
    
}

if(isset($_GET["opt"])&&$_GET["subject_id"]&&$_GET["opt"]=="dlt") // delete subject
{  
    $sid = $JAMES->sanitizeInput($_GET["subject_id"]);

    $sql= "delete from Subjects where subject_id=$sid;";
    
    if(mysqli_query($GLOBALS['JAMES']->connection(),$sql))
    {
        $error="<span id='response_msg' style='color:green;float:right;'>Subject Deleted!</span>";          
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
    $course_html = "<select name='course_selection' id='course_selection' class='form-control'  required><option value=''>Not Selected</option></option>";
    
    //course
    while($record = mysqli_fetch_assoc($result))
    { 
      $course_html.="<option value='".$record['total_semester']."_".$record['course_name']."' >".$record['course_name']."</option>";
    }

    $course_html.="</select>";
}
else
{
  $course_html = 
  "
  <select name='course_selection' class='form-control' required>
    <option value=''>Not Selected</option>
  </select>
  ";
}

$sem_html = "<select id='sem_selection'  name='sem_selection' class='form-control' required><option value='' >Not Selected</option>";

$i = 1;
while($i<=$ts)
{    
    $s2="";
    if($sub_semester==$i)
    {
        $s2="selected";
    }
    $sem_html.="<option value='".$i."' ".$s2.">".$i."</option>";
    $i++;
}

$sem_html.="</select>";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- including header -->
    <?php
    require_once('./common/header.php');
?>
     
    <!-- css  -->
    <link rel="stylesheet" href="../css/modal.css">
    <!-- js  -->
    <script src="../js/admin/subjectregistration.js" type="text/javascript" defer=true></script>

    <!-- page information-->
    <title>AMS | Subject Registration</title>

    </head>
    <body>

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12  col-md-12  col-lg-12  grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Subject Registration<?php echo $error;?></h4>

                            <input type="hidden" id="csrfToken" name="_csrfToken" value="<?php echo $JAMES->generateCsrfToken();?>" >

                            <form class="forms-sample" method="POST" action="subjectregistration.php">

                                <div class="form-group">
                                        <label>Course </label>
                                        <?php echo $course_html;?>
                                </div>
                                <div class="form-group">
                                        <label>Semester </label>
                                        <?php echo $sem_html; ?>
                                </div>

                                <!-- Total Semester-->
                                <div class="form-group">
                                    <label for="sub_code">Subject Code</label>
                                    <input  class="form-control" name="subject_code" type="text" id="sub_code" placeholder="Subject Code" required>
                                </div>
                                <div class="form-group">
                                    <label for="sub_name">Subject Name</label>
                                    <input class="form-control" name="subject_name" type="text" id="sub_name" placeholder="Subject Name"  required>
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
                            <h4 class="card-title">Edit Subject</h4>
                            <form class="forms-sample">

                                <!-- FID and Role -->
                                <div class="row">
                                    <div class="form-group col-md-10">
                                        <label>Search Subject</label>
                                        <input type="number" id="subject_code" class="form-control" placeholder="Enter Subject Code">
                                    </div>

                                    <div class="form-group col-md-2 ">
                                        <button type="button" id="searchsubject"
                                            class="btn btn-primary searchbtn mt-4">Search</button>
                                    </div>
                                </div>

                            </form>

                            <div class="table-responsive mt-4">
                                <table id="" class="table">
                                    <thead>
                                        <tr>
                                            <th>Subject ID</th>
                                            <th>Subject Name</th>
                                            <th>Subject Code</th>
                                            <th>Semester</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody id="subjectstable">
                                        <tr>
                                            <td colspan="5" style="text-align:center;font-size:1.2em;">No Data</td>
                                            <!-- <td>
                                                <button type='button' class='btn updatebtn rounded px-3 py-2 mr-2'><i
                                                        class="ti-pencil"></i></button>
                                                <button type='button' class='btn btn-danger rounded px-3 py-2'><i
                                                        class="ti-trash"></i></button>
                                            </td> -->
                                        </tr>
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
    require_once('./common/footer.php');
    ?>

</body>

</html>