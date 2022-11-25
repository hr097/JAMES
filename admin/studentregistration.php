<?php

require_once("../ams.php");
$JAMES = new AMS("Admin");
$JAMES->init_user_session();

if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="3"))
{
 $JAMES->ams_redirect("../login.php");
}

$error = "";
$student = array("spid"=>"","name"=>"","gender"=>"","dob"=>"","email"=>"","contact_no"=>"","course_name"=>"","joining_year"=>"","cur_semester"=>"","cur_division"=>"","cur_roll_no"=>"","stud_status"=>"","fathers_name"=>"","fathers_email"=>"","fathers_contact"=>"","mothers_name"=>"","mothers_email"=>"","mothers_contact"=>"");
$div_array = array("A","B","C","D","E","F","G","H","I");
$arr_length = count($div_array);
$button = "";

if(isset($_GET["spid"]))
{   
    $spid = $_GET["spid"];

    $sql= "select A.*,B.* from Students A,Courses B where A.course_id=B.course_id AND A.spid='$spid';";

    $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);
    
    if(mysqli_num_rows($result)==1)
    {
        $student = mysqli_fetch_assoc($result);
        $button = "<button type='submit' id='updtstud' name='updtstud' class='btn btn-primary mr-2 mt-3'>Update Student</button>";
    }
    else
    {
       $error="<span style='color:red;float:right;'>SPID Not Found!</span>";
       $error.="<script>setTimeout(function(){window.location.href='studentregistration.php';},3000);</script>";
    }

}
else
{
    $button = " <button type='submit' id='addstud' name='addstud' class='btn btn-primary mr-2 mt-3'>Add Student</button>";
}


$genderBox= "";
$statusBox = "";
$courseBox = "";


//courses fetch for dropdown
$sql= "select * from Courses;";//query
$result = mysqli_query($JAMES->connection(),$sql);

if(mysqli_num_rows($result)>0)
{
    $course_html = "<select name='course_Selection' id='course_selection' class='form-control' required><option value=''>Not Selected</option></option>";
    $sem_html = "<select  name='sem_Selection'class='form-control' required><option>Not Selected</option>";


    //course
    while($record = mysqli_fetch_assoc($result))
    { 
      $select="";
      if($student['course_name']==$record['course_name'])
      {
        $select="selected";

        //semester
        $ts = $student['total_semester'];

        $i = 1;


        while($i<=$ts)
        {    
            $s2="";
            if($student['cur_semester']==$i)
            {
                $s2="selected";

            }
            $sem_html.="<option value='".$i."' ".$s2.">".$i."</option>";
            $i++;
        }

        $sem_html.="</select>";

      }

      $course_html.="<option value='".$record['course_name']."' ".$select.">".$record['course_name']."</option>";
    }

    $course_html.="</select>";
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



if($student['stud_status']==0)
{

    $statusBox = "
    <label>Student Status</label>
    <select name='status' class='form-control'required>
        <option value='1'>Active</option>
        <option value='0' selected>InActive</option>
    </select>
    </div>
    ";

}
else
{
    $statusBox = "
    <label>Student Status</label>
    <select name='status' class='form-control' required>
            <option value='1' selected>Active</option>
            <option value='0'>InActive</option>
    </select>
    </div>
    ";
}

if($student['gender']=='Male')
{

    $genderBox= "
    <div class='form-group col-sm-6 col-md-6 col-lg-6'>
        <label>Gender</label>
        <select name='status' class='form-control' required>
            <option value=''>Not Selected</option>
            <option value='Male' selected>Male</option>
            <option value='Female'>Female</option>
        </select>
    </div>
    ";


}
else if($student['gender']=='Female')
{
    $genderBox= "
    <div class='form-group col-sm-6 col-md-6 col-lg-6'>
        <label>Gender</label>
        <select name='status' class='form-control' required>
            <option value=''>Not Selected</option>
            <option value='Male'>Male</option>
            <option value='Female'selected>Female</option>
        </select>
    </div>
    ";
}
else
{

    $genderBox= "
        <div class='form-group col-sm-6 col-md-6 col-lg-6'>
            <label>Gender</label>
            <select name='status' class='form-control' required>
                <option value=''>Not Selected</option>
                <option value='Male'>Male</option>
                <option value='Female'>Female</option>
            </select>
        </div>
        ";

}


$division_html = "<select name='division_Selection' class='form-control' required><option value=''>Not Selected</option>";


for($v=0;$v<$arr_length;$v++)
{       
    $s3 = "";
     
    if($student['cur_division']==$div_array[$v])
    {
        $s3="selected";
    }

    $division_html.= "<option value='".$div_array[$v]."' ".$s3.">".$div_array[$v]."</option>";
}

$division_html.= "</select>";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- including header -->
    <?php
    require_once('./common/header.php');
?>

    <!-- css -->
    <link rel="stylesheet" href="../css/alert.css">
    
    <link rel="stylesheet" href="../css/modal.css">

    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css'>


    <!-- js  -->
    <script src="../js/admin/studentregistration.js" type="text/javascript" defer=true></script>


    <!-- page information-->
    <title>AMS | Student Registration</title>

</head>

<body>
    <!-------------------------------------------------------Main Content------------------------------------------------------->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12  col-md-12  col-lg-12  grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Student Regisration <?php echo $error;?></h4>
                            <form autocomplete="off" class="forms-sample" name="addstudents" action='studentregistration.php' method="POST" enctype="multipart/form-data">

                                <input type="hidden" id="csrfToken" name="_csrfToken" value="<?php echo $JAMES->generateCsrfToken();?>" >

                                <!-- SPID and Email -->
                                <div class="row">
                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>SPID</label>
                                        <input type="text" class="form-control" id="studspid" placeholder="XXXXXXXXXX" value="<?php echo $student['spid'];?>" required>
                                    </div>

                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>Email</label>
                                        <input type="email" class="form-control" id="studemail" placeholder="example@vnsgu.ac.in" value="<?php echo $student['email'];?>" required>
                                    </div>
                                </div>

                                <!-- Name-->
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" id="studname" placeholder="Enter Student Name" value="<?php echo $student['name'];?>" required>
                                </div>


                                <!-- Gender and DOB -->
                                <div class="row">
                                    <?php echo $genderBox;?>

                                    <div class="form-group col-md-6">
                                        <label>Birthdate</label>
                                        <input type="date" class="form-control" id="studdob" value="<?php echo $student['dob'];?>" required>
                                    </div>
                                </div>

                                <!-- Joining year and Contact no -->
                                <div class="row">
                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>Contact No</label>
                                        <input type="text" class="form-control" id="studcontact" value="<?php echo $student['contact_no'];?>" placeholder="+91 XXXXXXXXXX" required>
                                            
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Joining Year</label>
                                        <input type="text" class="form-control" id="studjoinyear" value="<?php echo $student['joining_year'];?>" placeholder="XXXX" required>
                                    </div>
                                </div>

                                <!-- Status-->
                                <div class="form-group mb-5 ">
                                <?php echo $statusBox; ?>


                                <!-- Course Details -->
                                <h4 class="card-title mt-4">Course Details</h4>

                                <div class="row">
                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>Course Name</label>
                                        <?php echo $course_html;?>
                                    </div>

                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>Current Roll No</label>
                                        <input type="number" name="studrollno" class="form-control" id="studrollno" value="<?php echo $student['cur_roll_no'];?>" placeholder="Enter Roll No" required> 
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>Current Semester </label>
                                        <?php echo $sem_html; ?>
                                    </div>

                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>Current Division</label>
                                        <?php echo $division_html; ?>
                                    </div>
                                </div>


                                <!-- Parent Details -->
                                <h4 class="card-title mt-4">Parents Details</h4>

                                <div class="form-group">
                                    <label>Father's Name</label>
                                    <input type="text" name="fname" class="form-control"  value="<?php echo $student['fathers_name'];?>" placeholder="Enter Father's Name">
                                </div>


                                <div class="row">
                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>Father's Email</label>
                                        <input type="text" name="femail" class="form-control" id="femail"  value="<?php echo $student['fathers_email'];?>"  placeholder="example@gmail.com">
                                           
                                    </div>

                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>Father's Contact</label>
                                        <input type="text" name="fcontact" class="form-control" id="fcontact"  value="<?php echo $student['fathers_contact'];?>" placeholder="+91 XXXXXXXXXX">
                                            
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Mother's Name</label>
                                    <input type="text" name="mname" class="form-control" id="mname" placeholder="Enter Mother's Name"  value="<?php echo $student['mothers_name'];?>">
                                </div>


                                <div class="row">
                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>Mother's Email</label>
                                        <input type="text" name="memail" class="form-control" id="memail"  value="<?php echo $student['mothers_email'];?>" placeholder="example@vnsgu.ac.in">
                                            
                                    </div>

                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>Mother's Contact</label>
                                        <input type="text" class="form-control" id="mcontact"  value="<?php echo $student['mothers_contact'];?>" placeholder="+91 XXXXXXXXXX">
                                            
                                    </div>

                                </div>

                               <?php echo $button; ?>
                                <button class="btn btn-light mt-3">Clear</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!--Student Registration Form End-->

                <div class="col-sm-12  col-md-12  col-lg-12  grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Student</h4>
                            <form class="forms-sample">

                                <!-- FID and Role -->
                                <div class="row">
                                    <div class="form-group col-md-10">
                                        <label>Search Student</label>
                                        <input type="text" autocomplete="off" id="Stud_spid" minlength="10" maxlength="10" class="form-control" placeholder="Enter Student SPID">
                                    </div>

                                    <div class="form-group col-md-2 ">
                                        <button type="button" id="searchstudentbtn"
                                            class="btn btn-primary searchbtn mt-4">Search</button>
                                    </div>
                                </div>

                            </form>

                            <div class="table-responsive mt-4">
                                <table id="" class="table">
                                    <thead>
                                        <tr>
                                            <th>SPID</th>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Birthdate</th>
                                            <th>Course</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="searchstudent">
                                        <tr>
                                            <td  colspan='6' style='font-size:1.2em;text-align:center;'>No Data Found</td>
                                           
                                        </tr>
                                    </tbody>
                                </table>
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
require_once('./common/footer.php');
?>
    <script src="../js/admin/alert.js" type="text/javascript" defer=true></script>
</body>


</html>