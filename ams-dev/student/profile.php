<?php

require_once("../ams.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();

if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="1"))
{
 $JAMES->ams_redirect("../login.php");
}

$u = $_SESSION["_userId"];

//@query
<<<<<<< HEAD
$sql = "select *,DATE_FORMAT(dob,'%d-%m-%y')AS dob from vw_students where email='$u';"; 
=======
$sql = "select *,DATE_FORMAT(dob,'%d-%m-%Y')AS dob from vw_students where email='$u';"; 
>>>>>>> 44bf9a337587780637860288de4dbfbaf41683bf
$result = mysqli_query($JAMES->connection(),$sql);

if(mysqli_num_rows($result)===1)
{
    $user = mysqli_fetch_assoc($result);
}
else
{
    $JAMES->ams_redirect("../login.php");
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
  <link rel="stylesheet" href="../css/student.css">

  <!-- js  -->
  <script src="../js/student/profile.js" type="text/javascript" defer=true></script>

  <!-- page information-->
  <title>AMS | Profile</title>

</head>

<body>


      <!-------------------------------------------------------Main Content Start------------------------------------------------------->

      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">

            <!-------------------------------------------------------Student Card Start------------------------------------------------------->
            <div class="container my-3" align="center" style="padding-bottom: 3%;">

              <div class="scene">
                <div class="flip-card" >
                  <div class="card__face card__face--front" style="border-radius: 10px;">
                    <img src="../assets/profiles/student-profile.jpg" class="profile_img my-4" alt="Student profile">
                    <h4  class="profile_name"><?php echo $user['name']; ?></h4>
                  </div>

                  <div  class="card__face card__face--back py-4 pl-4" align="left">
                    <p class="mt-3">
                    <span  class="card_back_title mr-4"> SPID :&nbsp&nbsp&nbsp&nbsp&nbsp</span>
                    <span class="card_back_data"><?php echo $user['spid']; ?></span>
                    </p>

                    <p>
                    <span  class="card_back_title mr-4"> Course:</span>
                    <span><?php echo $user['course_name']; ?></span>
                    </p>

                    <p>
                    <span  class="card_back_title mr-1"> Semester:</span>
                    <span><?php echo $user['cur_semester']; ?>th</span>
                    </p>

                    <p>
                    <span  class="card_back_title mr-3"> Division:</span>
                    <span><?php echo $user['cur_division']; ?></span>
                    </p>

                    <p>
                    <span  class="card_back_title mr-4"> Roll No:</span>
                    <span><?php echo $user['cur_roll_no']; ?></span>
                    </p>
                  </div>

                </div>
              </div>
              <!-------------------------------------------------------Student Card End------------------------------------------------------->
            </div>
          </div>
          <!--Personal Info-->
          <div class="row">
            <div class="col-md-12 mb-2">
              <h4 class="font-weight-bold">Personal Information</h4>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">

                  <h6 class="info-title">Birth Date</h6>
                   <h4 class="info-data"><?php echo $user['dob']; ?></h4>

                  <h6 class="info-title">Gender</h6>
                   <h4 class="info-data"><?php echo $user['gender']; ?></h4>

                  <h6 class="info-title">Course Joining Year</h6>
                   <h4 class="info-data"><?php echo $user['joining_year']; ?></h4>
  
                </div>
              </div>
            </div>
          </div>



          <!--Contact Info-->
          <div class="row">
            <div class="col-md-12 mb-2">
              <h4 class="font-weight-bold">Contact Information</h4>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                <h6 class="info-title">Email<i class="ti-pencil email_edit_icon d-flex justify-content-end" id="edit_icon"></i></h6>
                 <h4 id="para_email" class="email_edit_para info-data"><?php echo $user['email']; ?> </h4>

                <h6 class="info-title">Contact No.</h6>
                 <h4 class="info-data"><?php echo $user['contact_no']; ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  <!-------------------------------------------------------Main Content End------------------------------------------------------->
  

    <!-- including footer -->
    <?php
    require_once('./common/footer.php');
    ?>


  
</body>

</html>