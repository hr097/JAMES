<?php

require_once("../ams.php");
$JAMES = new AMS("Admin");
$JAMES->init_user_session();

if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="3"))
{
 $JAMES->ams_redirect("../login.php");
}

$error = "";
$student = array("spid"=>"","name"=>"","gender"=>"","dob"=>"","email"=>"","contact_no"=>"","course_name"=>"","joining_year"=>"","cur_semester"=>"","cur_division"=>"","cur_roll_no"=>"","stud_status"=>"","fathers_name"=>"","fathers_email"=>"","fathers_contact"=>"","mothers_name"=>"","mothers_email"=>"","mothers_contact"=>"","uid"=>"");
$div_array = array("A","B","C","D","E","F","G","H","I");
$arr_length = count($div_array);
$button = "";
$update_email = "";


function sendLoginInvitation($stud_name,$student_email,$password)
{
    
    $htmlContent = "

   
    <!DOCTYPE html>
    <html>
    <head>
        <title></title>
        <meta http-equiv='Content-Type' content='text/html, charset=utf-8' />
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge' />
        <style type='text/css'>
           
            body,
            table,
            td,
            a {
                -webkit-text-size-adjust: 100%;
                -ms-text-size-adjust: 100%;
            }
    
            table,
            /* td {
                mso-table-lspace: 0pt;
                mso-table-rspace: 0pt;
            } */
    
            img {
                -ms-interpolation-mode: bicubic;
            }
    
            
            img {
                border: 0;
                height: auto;
                line-height: 100%;
                outline: none;
                text-decoration: none;
            }
    
            table {
                border-collapse: collapse !important;
            }
    
            body {
                height: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
                width: 100% !important;
            }
    
          
            a[x-apple-data-detectors] {
                color: inherit !important;
                text-decoration: none !important;
                font-size: inherit !important;
                font-family: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
            }
            .AttendanceTable{
              margin-top:20px;
            }
            
            .AttendanceTable,.AttendanceTable tr td{
              border: 2px solid black;
              padding: 5px 25px 5px 15px;
              font-family: poppins;
              font-size: 14px;

            }
            @media screen and (max-width:600px) {
                h1 {
                    font-size: 32px !important;
                    line-height: 32px !important;
                }
            }
    
           
            div[style*='margin: 16px 0;'] {
                margin: 0 !important;
            }
        </style>
    </head>
    
    <body style='background-color: #ffffff;margin: 0 !important; padding: 0 !important;'>
        
    
        <table border='0' cellpadding='0' cellspacing='0' width='100%'>
           
            <tr>
                <td align='center' style ='background: #5755a5'>
                    <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                        <tr>
                            <td align='center' valign='top' style='padding: 40px 10px 40px 10px;'> </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td  align='center' style='padding: 0px 10px 0px 10px;background : #5755a5'>
                    <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                        <tr>
                            <td bgcolor='#ffffff' align='center' valign='top' style='padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #4b49ac; font-family: poppins; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;'>
                                <h1 style='font-size: 35px; font-weight: 500; margin: 2;'><b>Registration Successful</b></h1> <img src='https://live.staticflickr.com/65535/52097859173_5b6d3573df_n.jpg' width='250' height='120' style='display: block; border: 0px;' />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr>
                <td  align='center' style='padding: 0px 10px 0px 10px; background-color: #f4f4f4;'>
                    <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                        <tr>
                            <td bgcolor='#ffffff' align='center' style='padding: 20px 30px 20px 30px; color: #000000; font-family: poppins; font-size: 14px; font-weight: 400; line-height: 30px;'>
                                <p style='margin: 0; '><span style='font-size: 20px;'>Welcome ,<br><b>Mr./Ms. ".$stud_name."</b></span><br><br>This is to notify that you're successfully registered as a <b>student</b> on digital attendance platform of <b>Department of ICT,VNSGU</b>.<br>                               
                                </p>
                                <p style='margin-top:25px;font-size:18px;'><b>Your credentials are given below: </b></p>
                                <p style='margin-top:40px;'> <b>Username:    </b>  <em>".$student_email."</em> </p>
                                <p> <b>Password:    </b>   <em> ".$password." </em> </p>
                                <p> <b>Dashboard:   </b>   <a href='http://ams.vnsguit.org/login.php'> login here  </a></p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
          
            </tr>
            
            <tr>
              <td  align='center' style='padding: 0px 10px 0px 10px; background-color: #f4f4f4;'>
                  <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                      <tr>
                          <td bgcolor='#ffffff' align='center' style='padding: 0px 30px 40px 30px; color: #000000; font-family: poppins; font-size: 14px; font-weight: 400; line-height: 30px;'>
                              <p style='margin: 0;margin-top:20px; '><b style='text-decoration:underline;'>NOTE: You are requested to login into dashboard and change your password as soon as you receive an invitation email. </b>
                              </p><br/>

                              <!-- <em>Please be noted that in your upcoming academic years, your lecture and lab attendances will be taken digitally and reflected into your dedicated account given by institution on its portal.
                                  Best wishes for your academic journey!</em> -->

                              <p style='margin:0;text-align: center;'><br><b><a style='color:black;' href='mailto:ams.jpd@gmail.com' >JPD AMS Admin</a>,</b><br>Department of Information, Communication & Technology,<br>Veer Narmad South Gujarat University,<br>Surat-395007<br></p>
                          </td>
                      </tr>
                  </table>
              </td>
           </tr>

          <tr>
                <td bgcolor='#f4f4f4' align='center' style='padding: 30px 10px 40px 10px;'>
                    <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                        <tr>
                            <td align='center' style='color: white!important;background-color:#5755a5;padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: poppins; font-size: 18px; font-weight: 400; line-height: 30px;'>
                                <h2 style='font-size:18px; font-weight: 400; color: white!important; margin: 0;'>Have any questions for us or need more information ? </h2>
                                <p style='margin: 0;'><a href='mailto:ams.jpd@gmail.com' target='_blank' style='color: white !important;text-decoration:underline;'><b>Just shoot us an email!<br> We are always here to help.</b></a><a style='color:white;font-size:16px;' ><br>ams.jpd@gmail.com</a></p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
    
    </html>
                    
     
    ";
    
    return(($GLOBALS['JAMES']->sendEmail($student_email,"Login Invitation",$htmlContent))?1:-1);
}

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

//update student
if(isset($_POST['updatestudent']))
{

    $course = $_POST['course_selection'];
    $course = substr($course,strpos($course,"_")+1);
    
    //PERSONAL
    $stud_spid = $_POST['studspid'];
    $stud_email = $_POST['studemail'];
    $stud_name = $JAMES->sanitizeInput($_POST['studname']);
    $stud_gender = $_POST['studgender'];
    $stud_dob = $_POST['studdob'];
    $stud_contact = $JAMES->sanitizeInput($_POST['studcontact']);
    $stud_joinyear = $JAMES->sanitizeInput($_POST['studjoiningyear']);
    $stud_status = $_POST['studstatus'];
    $stud_rfidno = $JAMES->sanitizeInput($_POST['studrfidno']);

    //ACADEMIC
    $course; 
    $stud_sem = $_POST['sem_selection'];
    $stud_div = $_POST['division_selection'];
    $stud_rollno = $JAMES->sanitizeInput($_POST['rollno_selection']);

    //PARENTAL
    $stud_fname = $JAMES->sanitizeInput($_POST['fname']);
    $stud_femail = $JAMES->sanitizeInput($_POST['femail']);
    $stud_fcontact = $JAMES->sanitizeInput($_POST['fcontact']);
    $stud_mname = $JAMES->sanitizeInput($_POST['mname']);
    $stud_memail = $JAMES->sanitizeInput($_POST['memail']);
    $stud_mcontact = $JAMES->sanitizeInput($_POST['mcontact']);


    $cid = findcourseId($course);

    $sql= "
    update Students set
    
    name='$stud_name',
    gender='$stud_gender',
    dob='$stud_dob',
    contact_no='$stud_contact',
    joining_year=$stud_joinyear,
    course_id=$cid,
    cur_semester=$stud_sem,
    cur_division='$stud_div',
    cur_roll_no=$stud_rollno,
    stud_status=$stud_status,
    fathers_name='$stud_fname',
    fathers_email='$stud_femail',
    fathers_contact='$stud_fcontact',
    mothers_name='$stud_mname',
    mothers_email='$stud_memail',
    mothers_contact='$stud_mcontact'
    where spid='$stud_spid' and email='$stud_email';";

   
    
    if(mysqli_query($GLOBALS['JAMES']->connection(),$sql))
    {    

        $sql="update Rfid_uid_spid_map set uid='$stud_rfidno' where spid='$stud_spid';";
        if(mysqli_query($GLOBALS['JAMES']->connection(),$sql))
        {   
            $error="<span id='response_msg' style='color:green;float:right;'>Student Details Updated!</span>";
            $error.="<script>setTimeout(function(){ $('#response_msg').html(''); },3000);</script>";
        }
        else
        { 
            $error="<span id='response_msg' style='color:red;float:right;'>Failed to Update!</span>";
            $error.="<script>setTimeout(function(){ $('#response_msg').html(''); },3000);</script>";
        }
    }
    else
    {
        $error="<span id='response_msg' style='color:red;float:right;'>Failed to Update!</span>";
        $error.="<script>setTimeout(function(){ $('#response_msg').html(''); },3000);</script>";
    }
}

//ADD student
if(isset($_POST['addstudent']))
{

    $course = $_POST['course_selection'];
    $course = substr($course,strpos($course,"_")+1);
    
    //PERSONAL
    $stud_spid = $JAMES->sanitizeInput($_POST['studspid']);
    $stud_email = $JAMES->sanitizeInput($_POST['studemail']);
    $stud_name = $JAMES->sanitizeInput($_POST['studname']);
    $stud_gender = $_POST['studgender'];
    $stud_dob = $_POST['studdob'];
    $stud_contact = $JAMES->sanitizeInput($_POST['studcontact']);
    $stud_joinyear = $JAMES->sanitizeInput($_POST['studjoiningyear']);
    $stud_status = $_POST['studstatus'];
    $stud_rfidno = $JAMES->sanitizeInput($_POST['studrfidno']);

    //ACADEMIC
    $course; 
    $stud_sem = $_POST['sem_selection'];
    $stud_div = $_POST['division_selection'];
    $stud_rollno = $JAMES->sanitizeInput($_POST['rollno_selection']);

    //PARENTAL
    $stud_fname = $JAMES->sanitizeInput($_POST['fname']);
    $stud_femail = $JAMES->sanitizeInput($_POST['femail']);
    $stud_fcontact = $JAMES->sanitizeInput($_POST['fcontact']);
    $stud_mname = $JAMES->sanitizeInput($_POST['mname']);
    $stud_memail = $JAMES->sanitizeInput($_POST['memail']);
    $stud_mcontact = $JAMES->sanitizeInput($_POST['mcontact']);

    $sql = "select DISTINCT A.*,B.uid from Students A,Rfid_uid_spid_map B where A.spid=B.spid and (B.uid='$stud_rfidno' OR A.spid='$stud_spid' OR A.email='$stud_email');";
    $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);

    if(mysqli_num_rows($result)==1)
    {    
        $error="<span id='response_msg' style='color:red;float:right;'>RFID UID/SPID/Email Already Registered!</span>";
        $error.="<script>setTimeout(function(){ $('#response_msg').html(''); },3000);</script>";
    }
    else
    {    
        $password = $GLOBALS['JAMES']->generatePassword();
        $password_enc = crypt($password,'$2a$10$1qAz2wSx3eDc4rFv5tGb5t');

        $sql = "insert into Users (username,password,user_type) values('$stud_email','$password_enc',1);";

        if(mysqli_query($GLOBALS['JAMES']->connection(),$sql))
        {    

                $cid = findcourseId($course);

                $sql= "
                insert into Students 
                (spid,name,gender,dob,email,contact_no,course_id,joining_year,cur_semester,cur_division,cur_roll_no,stud_status,
                fathers_name,fathers_email,fathers_contact,mothers_name,mothers_email,mothers_contact)
                values(
                '$stud_spid',
                '$stud_name',
                '$stud_gender',
                '$stud_dob',
                '$stud_email',
                '$stud_contact',
                $cid,
                $stud_joinyear,
                $stud_sem,
                '$stud_div',
                $stud_rollno,
                $stud_status,
                '$stud_fname',
                '$stud_femail',
                '$stud_fcontact',
                '$stud_mname',
                '$stud_memail',
                '$stud_mcontact');";

            
                if(mysqli_query($GLOBALS['JAMES']->connection(),$sql))
                {    

                    $sql="insert into Rfid_uid_spid_map (uid,spid) values('$stud_rfidno','$stud_spid');";
                    if(mysqli_query($GLOBALS['JAMES']->connection(),$sql))
                    {   
                        if(sendLoginInvitation($stud_name,$stud_email,$password))
                        {
                            $error="<span id='response_msg' style='color:green;float:right;'>Student Added Successfully!</span>";
                            $error.="<script>setTimeout(function(){ $('#response_msg').html(''); },3000);</script>";
                        }
                        else
                        {
                            $error="<span id='response_msg' style='color:red;float:right;'>Failed to Send an Invitation!</span>";
                            $error.="<script>setTimeout(function(){ $('#response_msg').html(''); },3000);</script>";
                        }
                    }
                    else
                    { 
                        $error="<span id='response_msg' style='color:red;float:right;'>Failed to Map Rfid!</span>";
                        $error.="<script>setTimeout(function(){ $('#response_msg').html(''); },3000);</script>";
                    }
                }
                else
                {
                    $error="<span id='response_msg' style='color:red;float:right;'>Failed to Add Students!</span>";
                    $error.="<script>setTimeout(function(){ $('#response_msg').html(''); },3000);</script>";
                }

        }
        else
        {
            $error="<span id='response_msg' style='color:red;float:right;'>Failed to Add Users!</span>";
            $error.="<script>setTimeout(function(){ $('#response_msg').html(''); },3000);</script>";
        }
       
    }

}

//findstudent details
if(isset($_GET["spid"]))
{   

    $update_email = "readonly='true'";
    $spid = $JAMES->sanitizeInput($_GET["spid"]);

    $sql= "select A.*,B.*,C.uid from Students A,Courses B,Rfid_uid_spid_map C where A.spid=C.spid and A.course_id=B.course_id AND A.spid='$spid';";

    $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);
    
    if(mysqli_num_rows($result)==1)
    {
        $student = mysqli_fetch_assoc($result);
        $button = "<button type='submit' id='updatestudent' name='updatestudent' class='btn btn-primary mr-2 mt-3'>Update Student</button>";
    }
    else
    {
       $error="<span id='response_msg' style='color:red;float:right;'>SPID Not Found!</span>";
       $error.="<script>setTimeout(function(){ $('#response_msg').html(''); },3000);</script>";
    }

}
else
{
    $button = " <button type='submit' id='addstudent' name='addstudent' class='btn btn-primary mr-2 mt-3'>Add Student</button>";
}


$genderBox= "";
$statusBox = "";
$courseBox = "";
$ts=0;

//courses fetch for dropdown
$sql= "select * from Courses;";//query
$result = mysqli_query($JAMES->connection(),$sql);

if(mysqli_num_rows($result)>0)
{
    $course_html = "<select name='course_selection' id='course_selection' class='form-control' required><option value=''>Not Selected</option></option>";

    //course
    while($record = mysqli_fetch_assoc($result))
    { 
      $select="";
      if($student['course_name']==$record['course_name'])
      {
        $select="selected";

        //semester
        $ts = $student['total_semester'];

      }

      $course_html.="<option value='".$record['total_semester']."_".$record['course_name']."'  ".$select.">".$record['course_name']."</option>";
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



if($student['stud_status']==1)
{

    $statusBox = "
    <select name='studstatus' class='form-control'required>
        <option value='true' selected>Active</option>
        <option value='false' >InActive</option>
    </select>
    ";

}
else if($student['stud_status']==0&&$student['stud_status']!="")
{

    $statusBox = "
    <select name='studstatus' class='form-control'required>
        <option value='true' >Active</option>
        <option value='false' selected>InActive</option>
    </select>
    ";

}
else
{
    $statusBox = "
    <select name='studstatus' class='form-control' required>
            <option value='true' selected>Active</option>
            <option value='false'>InActive</option>
    </select>
    ";
}

if($student['gender']=='Male')
{

    $genderBox= "
    <div class='form-group col-sm-6 col-md-6 col-lg-6'>
        <label>Gender</label>
        <select name='studgender' class='form-control' required>
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
        <select name='studgender' class='form-control' required>
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
            <select name='studgender' class='form-control' required>
                <option value=''>Not Selected</option>
                <option value='Male'>Male</option>
                <option value='Female'>Female</option>
            </select>
        </div>
        ";

}


$sem_html = "<select id='sem_selection'  name='sem_selection' class='form-control' required><option value='' >Not Selected</option>";

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

$division_html = "<select name='division_selection' class='form-control' required><option value=''>Not Selected</option>";


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
    <!-- <link rel="stylesheet" href="../css/alert.css"> -->
    
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
                        <input type="hidden" id="csrfToken" name="_csrfToken" value="<?php echo $JAMES->generateCsrfToken();?>" >
                            <h4 class="card-title">Student Regisration <?php echo $error;?></h4>
                            <form autocomplete="off" class="forms-sample" name="addstudents" action='studentregistration.php' method="POST" enctype="multipart/form-data">

                              

                                <!-- SPID and Email -->
                                <div class="row">
                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>SPID</label>
                                        <input type="text" autocomplete="off" name="studspid" pattern="[0-9]{10}" minlength="10"  maxlength="10" class="form-control" id="studspid" placeholder="XXXXXXXXXX" value="<?php echo $student['spid'];?>" <?php echo $update_email;?> required>
                                    </div>

                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>Email</label>
                                        <input type="email" autocomplete="off" name="studemail" minlength="13"  maxlength="256" class="form-control" id="studemail" placeholder="example@vnsgu.ac.in" value="<?php echo $student['email'];?>" <?php echo $update_email;?> required>
                                    </div>
                                </div>

                                <!-- Name-->
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" autocomplete="off" name="studname" minlength="10"  maxlength="256" class="form-control" id="studname" placeholder="Enter Student's Full Name" value="<?php echo $student['name'];?>" required>
                                </div>


                                <!-- Gender and DOB -->
                                <div class="row">
                                    <?php echo $genderBox;?>

                                    <div class="form-group col-md-6">
                                        <label>Birthdate</label>
                                        <input type="date" name="studdob" class="form-control" id="studdob" value="<?php echo $student['dob'];?>" required>
                                    </div>
                                </div>

                                <!-- Joining year and Contact no -->
                                <div class="row">
                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>Contact No</label>
                                        <input type="text" autocomplete="off"  name="studcontact" minlength="14"  maxlength="14" class="form-control" id="studcontact" value="<?php echo $student['contact_no'];?>" placeholder="+91 XXXXXXXXXX" required>
                                            
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Joining Year</label>
                                        <input type="number" autocomplete="off" pattern="[0-9]{4}" name="studjoiningyear" minlength="4"  maxlength="4" class="form-control" id="studjoinyear" value="<?php echo $student['joining_year'];?>" placeholder="XXXX" required>
                                    </div>
                                </div>

                                <div class="row">
                                <!-- Status-->
                                <div class="form-group mb-5 col-sm-6 col-md-6 col-lg-6">
                                    <label>Student Status</label>
                                    <?php echo $statusBox; ?>
                                </div>

                                <div class="form-group mb-5 col-sm-6 col-md-6 col-lg-6">
                                    <label>RFID Tag Number</label>
                                    <input type="text" autocomplete="off" name="studrfidno" minlength="11" pattern="[A-Za-z0-9]{2}[ ]{1}[A-Za-z0-9]{2}[ ]{1}[A-Za-z0-9]{2}[ ]{1}[A-Za-z0-9]{2}"  maxlength="11" class="form-control" id="studrfid" value="<?php echo $student['uid'];?>" <?php echo $update_email;?> placeholder="XX XX XX XX" required>
                                </div>

                                </div>


                                <!-- Course Details -->
                                <h4 class="card-title mt-4">Course Details</h4>

                                <div class="row">
                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>Course Name</label>
                                        <?php echo $course_html;?>
                                    </div>

                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>Current Roll No</label>
                                        <input type="number" autocomplete="off" name="rollno_selection" minlength="1"  maxlength="4" name="studrollno" class="form-control" id="studrollno" value="<?php echo $student['cur_roll_no'];?>" placeholder="Enter Roll No" required> 
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
                                    <input type="text" autocomplete="off" name="fname" minlength="10"  maxlength="256" class="form-control dash"   value="<?php echo $student['fathers_name'];?>" placeholder="Enter Father's Name">
                                </div>


                                <div class="row">
                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>Father's Email</label>
                                        <input type="email"  autocomplete="off" name="femail" minlength="13"  maxlength="256" class="form-control dash" id="femail"  value="<?php echo $student['fathers_email'];?>"  placeholder="example@gmail.com">
                                           
                                    </div>

                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>Father's Contact</label>
                                        <input type="text" autocomplete="off" name="fcontact" minlength="14"  maxlength="14" class="form-control dash" id="fcontact"  value="<?php echo $student['fathers_contact'];?>" placeholder="+91 XXXXXXXXXX">
                                            
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Mother's Name</label>
                                    <input type="text" autocomplete="off" name="mname" minlength="10"  maxlength="256" class="form-control dash" id="mname" placeholder="Enter Mother's Name"  value="<?php echo $student['mothers_name'];?>">
                                </div>


                                <div class="row">
                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>Mother's Email</label>
                                        <input type="email" autocomplete="off" name="memail" minlength="13"  maxlength="256" class="form-control dash" id="memail"  value="<?php echo $student['mothers_email'];?>" placeholder="example@vnsgu.ac.in">
                                            
                                    </div>

                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>Mother's Contact</label>
                                        <input type="text" autocomplete="off"  name="mcontact" class="form-control dash" minlength="14"  maxlength="14" id="mcontact"  value="<?php echo $student['mothers_contact'];?>" placeholder="+91 XXXXXXXXXX">
                                            
                                    </div>

                                </div>

                                <?php echo $button; ?>
                                <button type="reset" class="btn btn-light mt-3">Clear</button>
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
                                        <input type="text" name="spidsearch" pattern="[0-9]{10}" autocomplete="off" id="Stud_spid" minlength="10" maxlength="10" class="form-control" placeholder="Enter Student SPID">
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
                                            <td  colspan='6' style='font-size:1.2em;text-align:center;'>No Data</td>
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
    <!-- <script src="../js/admin/alert.js" type="text/javascript" defer=true></script> -->
</body>


</html>