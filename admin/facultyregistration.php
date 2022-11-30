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
                                        <input type="text" autocomplete="off" name="facfid" pattern="[FID]{3}[0-9]{5,7}" minlength="10"  maxlength="10" class="form-control" id="fid" placeholder="FIDXXXXX" value="<?php echo $faculty['fid'];?>" <?php echo $update_email;?> required>
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