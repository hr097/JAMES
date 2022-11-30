<?php

require_once("../ams.php");
$JAMES = new AMS("Admin");
$JAMES->init_user_session();

if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="3"))
{
 $JAMES->ams_redirect("../login.php");
}


$error = "";
$faculty = array("fid"=>"","name"=>"","gender"=>"","dob"=>"","email"=>"","contact_no"=>"","joining_year"=>"","fac_status"=>"","role_name"=>"");
$button = "";
$update_email = "";

$genderBox= "";
$statusBox = "";
$roles_html = "";

function sendLoginInvitation($fac_name,$faculty_email,$password)
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
                                <p style='margin: 0; '><span style='font-size: 20px;'><b>Welcome ,<br>Sir/Madam</b></span>,<br><br>This is to notify that you're successfully registered as a <b>faculty</b> on digital attendance platform of <b>Department of ICT,VNSGU</b>.<br>                               
                                </p>
                                <p style='margin-top:25px;font-size:18px;'><b>Your credentials are given below: </b></p>
                                <p style='margin-top:40px;'> <b>Username:    </b>  <em>".$faculty_email."</em> </p>
                                <p> <b>Password:    </b>   <em> ".$password." </em> </p>
                                <p> <b>Dashboard:   </b>   <a href='http://ams.vnsguit.org/login.php'> Login Here </a></p>
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
    
    return(($GLOBALS['JAMES']->sendEmail($faculty_email,"Login Invitation",$htmlContent))?1:-1);
}

//update faculty
if(isset($_POST['updatefaculty']))
{
    
    //PERSONAL
    $fac_fid = $_POST['facfid'];
    $fac_email = $_POST['facemail'];
    $fac_name = $JAMES->sanitizeInput($_POST['facname']);
    $fac_gender = $_POST['facgender'];
    $fac_dob = $_POST['facdob'];
    $fac_contact = $JAMES->sanitizeInput($_POST['faccontact']);
    $fac_joinyear = $JAMES->sanitizeInput($_POST['facjoiningyear']);
    $fac_status = $_POST['facstatus'];
    $fac_roleid = $JAMES->sanitizeInput($_POST['role_selection']);

    
    $sql= "
    update Faculties set
    
    name='$fac_name',
    gender='$fac_gender',
    dob='$fac_dob',
    contact_no='$fac_contact',
    joining_year=$fac_joinyear,
    fac_status=$fac_status,
    role_id='$fac_roleid'
    where fid='$fac_fid' and email='$fac_email';";


    if(mysqli_query($GLOBALS['JAMES']->connection(),$sql))
    {    

            $error="<span id='response_msg' style='color:green;float:right;'>Faculty Details Updated!</span>";
            $error.="<script>setTimeout(function(){ $('#response_msg').html(''); },3000);</script>";
 
    }
    else
    {
        $error="<span id='response_msg' style='color:red;float:right;'>Failed to Update!</span>";
        $error.="<script>setTimeout(function(){ $('#response_msg').html(''); },3000);</script>";
    }
}

//ADD faculty 
if(isset($_POST['addfaculty']))
{

    //PERSONAL
    $fac_fid = $_POST['facfid'];
    $fac_email = $_POST['facemail'];
    $fac_name = $JAMES->sanitizeInput($_POST['facname']);
    $fac_gender = $_POST['facgender'];
    $fac_dob = $_POST['facdob'];
    $fac_contact = $JAMES->sanitizeInput($_POST['faccontact']);
    $fac_joinyear = $JAMES->sanitizeInput($_POST['facjoiningyear']);
    $fac_status = $_POST['facstatus'];
    $fac_roleid = $JAMES->sanitizeInput($_POST['role_selection']);

    $sql = "select DISTINCT A.* from Faculties A where (A.fid='$fac_fid' OR A.email='$fac_email');";
    $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);

    if(mysqli_num_rows($result)==1)
    {    
        $error="<span id='response_msg' style='color:red;float:right;'>FID/Email Already Registered!</span>";
        $error.="<script>setTimeout(function(){ $('#response_msg').html(''); },3000);</script>";
    }
    else
    {    
        $password = $GLOBALS['JAMES']->generatePassword();
        $password_enc = crypt($password,'$2a$10$1qAz2wSx3eDc4rFv5tGb5t');

        $sql = "insert into Users (username,password,user_type) values('$fac_email','$password_enc',2);";

        if(mysqli_query($GLOBALS['JAMES']->connection(),$sql))
        {    
                $sql= "
                insert into Faculties
                (fid,name,gender,dob,email,contact_no,role_id,joining_year,fac_status)
                values(
                '$fac_fid',
                '$fac_name',
                '$fac_gender',
                '$fac_dob',
                '$fac_email',
                '$fac_contact',
                $fac_roleid,
                $fac_joinyear,
                $fac_status);";

            
                if(mysqli_query($GLOBALS['JAMES']->connection(),$sql))
                {    

                        if(sendLoginInvitation($fac_name,$fac_email,$password))
                        {
                            $error="<span id='response_msg' style='color:green;float:right;'>Faculty Added Successfully!</span>";
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
                    $error="<span id='response_msg' style='color:red;float:right;'>Failed to Add Faculties!</span>";
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
if(isset($_GET["email"]))
{   

    $update_email = "readonly='true'";
    $email = $JAMES->sanitizeInput($_GET["email"]);

    $sql= "Select A.*,B.* From Faculties A,Faculty_roles B where A.role_id=B.role_id and A.email='$email';";

    $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);
    
    if(mysqli_num_rows($result)==1)
    {
        $faculty = mysqli_fetch_assoc($result);
        $button = "<button type='submit' id='updatefaculty' name='updatefaculty' class='btn btn-primary mr-2 mt-3'>Update Faculty</button>";
    }
    else
    {
       $error="<span id='response_msg' style='color:red;float:right;'>Faculty Not Found!</span>";
       $error.="<script>setTimeout(function(){ $('#response_msg').html(''); },3000);</script>";
    }

}
else
{
    $button = " <button type='submit' id='addfaculty' name='addfaculty' class='btn btn-primary mr-2 mt-3'>Add Faculty</button>";
}


//courses fetch for dropdown
$sql= "select * from Faculty_roles;";//query
$result = mysqli_query($JAMES->connection(),$sql);

if(mysqli_num_rows($result)>0)
{
    $roles_html  = "<select name='role_selection' id='role_selection' class='form-control' required><option value=''>Not Selected</option></option>";

    //course
    while($record = mysqli_fetch_assoc($result))
    { 
      $select="";
      if($faculty['role_name']==$record['role_name'])
      {
        $select="selected";
      }

      $roles_html.="<option value='".$record['role_id']."'  ".$select.">".$record['role_name']."</option>";
    }

    $roles_html.="</select>";
}
else
{
  $roles_html = 
  "
  <select name='role_selection' class='form-control' required>
    <option value=''>Not Selected</option>
  </select>
  ";
}




if($faculty['gender']=='Male')
{

    $genderBox= "
    <div class='form-group col-sm-6 col-md-6 col-lg-6'>
        <label>Gender</label>
        <select name='facgender' class='form-control' required>
            <option value=''>Not Selected</option>
            <option value='Male' selected>Male</option>
            <option value='Female'>Female</option>
        </select>
    </div>
    ";


}
else if($faculty['gender']=='Female')
{
    $genderBox= "
    <div class='form-group col-sm-6 col-md-6 col-lg-6'>
        <label>Gender</label>
        <select name='facgender' class='form-control' required>
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
            <select name='facgender' class='form-control' required>
                <option value=''>Not Selected</option>
                <option value='Male'>Male</option>
                <option value='Female'>Female</option>
            </select>
        </div>
        ";

}



if($faculty['fac_status']==1)
{

    $statusBox = "
    <select name='facstatus' class='form-control'required>
        <option value='true' selected>Active</option>
        <option value='false' >InActive</option>
    </select>
    ";

}
else if($faculty['fac_status']==0&&$faculty['fac_status']!="")
{

    $statusBox = "
    <select name='facstatus' class='form-control'required>
        <option value='true' >Active</option>
        <option value='false' selected>InActive</option>
    </select>
    ";

}
else
{
    $statusBox = "
    <select name='facstatus' class='form-control' required>
            <option value='true' selected>Active</option>
            <option value='false'>InActive</option>
    </select>
    ";
}

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
    <script src="../js/admin/facultyregistration.js" type="text/javascript" defer=true></script>

    <!-- page information-->
    <title>AMS | Faculty Registration</title>

</head>

<body>
    <!-------------------------------------------------------Main Content------------------------------------------------------->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12  col-md-12  col-lg-12  grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                        
                            <h4 class="card-title">Faculty Registration<?php echo $error;?></h4>

                            <input type="hidden" id="csrfToken" name="_csrfToken" value="<?php echo $JAMES->generateCsrfToken();?>" >

                            <form class="forms-sample" name="facultyaddform" action="facultyregistration.php" method="POST" >


                                <!-- FID and Role -->
                                <div class="row">
                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>FID</label>
                                        <input type="text" autocomplete="off" name="facfid" pattern="[FID]{3}[0-9]{5,7}"  maxlength="10" minlength="7" class="form-control" id="fid" placeholder="FIDXXXXX" value="<?php echo $faculty['fid'];?>" <?php echo $update_email;?> required>
                                    </div>

                                    <div class="form-group col-md-6">
                                    <label>Email</label>
                                        <input type="email" autocomplete="off" name="facemail" minlength="13"  maxlength="256" class="form-control" id="facemail" placeholder="example@vnsgu.ac.in" value="<?php echo $faculty['email'];?>" <?php echo $update_email;?> required>
                                    </div>
                                </div>

                                <!-- Name-->
                                <div class="form-group">
                                <label>Name</label>
                                    <input type="text" autocomplete="off" name="facname" minlength="10"  maxlength="256" class="form-control" id="facname" placeholder="Enter Faculty Name" value="<?php echo $faculty['name'];?>" required>
                                </div>


                                <!-- Gender and DOB -->
                                <div class="row">
                                    <?php echo $genderBox;?>

                                    <div class="form-group col-md-6">
                                    <label>Birthdate</label>
                                        <input type="date" name="facdob" class="form-control" id="facdob" value="<?php echo $faculty['dob'];?>" required>
                                    </div>
                                </div>

                                <!-- Joining year and Contact no -->
                                <div class="row">
                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">

                                        <label>Contact No</label>
                                        <input type="text" autocomplete="off"  name="faccontact" minlength="14"  maxlength="14" class="form-control" id="faccontact" value="<?php echo $faculty['contact_no'];?>" placeholder="+91 XXXXXXXXXX" required>
                                            
                                    </div>

                                    <div class="form-group col-md-6">
                                    <label>Joining Year</label>
                                        <input type="number" autocomplete="off" pattern="[0-9]{4}" name="facjoiningyear" minlength="4"  maxlength="4" class="form-control" id="facjoinyear" value="<?php echo $faculty['joining_year'];?>" placeholder="XXXX" required>
                                    </div>
                                </div>


                                <!-- Email status -->
                                <div class="row">
                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                    <label>Designation</label>
                                        <?php echo $roles_html;?>
                                    </div>

                                    <div class="form-group col-md-6">
                                    <label>Status</label>
                                    <?php echo $statusBox; ?>
                                    </div>
                                </div>


                                <?php echo $button; ?>
                                <button type="reset" class="btn btn-light mt-3">Clear</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!--Faculty Registration Form End-->

                <div class="col-sm-12  col-md-12  col-lg-12  grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Faculty</h4>
                            <form class="forms-sample">

                                <!-- FID and Role -->
                                <div class="row">
                                    <div class="form-group col-md-10">
                                        <label>Search Faculty</label>
                                        <input type="text" autocomplete="off" id="facsearchemail" class="form-control" placeholder="Enter Faculty email">
                                    </div>

                                    <div class="form-group col-md-2 ">
                                        <button type="button" id="searchfacultybtn"
                                            class="btn btn-primary searchbtn mt-4">Search</button>
                                    </div>
                                </div>

                            </form>

                            <div class="table-responsive mt-4">
                                <table id="" class="table">
                                    <thead>
                                        <tr>
                                            <th>FID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Gender</th>
                                            <th>DOB</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody id="searchfaculty">
                                        <tr>
                                            <td  colspan='7' style='font-size:1.2em;text-align:center;'>No Data</td>
                                        </tr>            
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Faculty Updation End -->

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