<?php

require_once("../ams.php");
$JAMES = new AMS("Admin");
$JAMES->init_user_session();

if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="1"))
{
 $JAMES->ams_redirect("../login.php");
}

$u = $_SESSION["_userId"];

//@query
$sql = "select *,DATE_FORMAT(dob,'%d/%m/%y')AS dob from vw_students where email='$u';"; 
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
                    <img src="../assets/profiles/student-profile.jpg" class="my-4" alt="Student profile"
                      style="width:130px;height:130px; border-radius: 49%;">
                    <h4 style="color: white; margin-top: -15px;"><?php echo $user['name']; ?></h4>
                  </div>

                  <div style="font-weight:600;background-image:linear-gradient(to top,lightblue,indigo);" class="card__face card__face--back py-4 pl-4" align="left">
                    <h4 style="margin-top:20px;"> SPID : &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $user['spid']; ?> </h4>
                    <h4> Course:    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $user['course_name']; ?> </h4>
                    <h4> Semester: &nbsp <?php echo $user['cur_semester']; ?> </h4>
                    <h4> Division:  &nbsp&nbsp&nbsp&nbsp <?php echo $user['cur_division']; ?> </h4>
                    <h4> Roll No:   &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <?php echo $user['cur_roll_no']; ?> </h4>
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

                  <h6 class="info-title">Birth Date <h5 class="info-data"><?php echo $user['dob']; ?></h5> </h6>
                  <h6 class="info-title">Gender <h5 class="info-data"><?php echo $user['gender']; ?></h5> </h6>
                  <h6 class="info-title">Course Joining Year <h5 class="info-data"><?php echo $user['joining_year']; ?></h5> </h6>
  
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
                <h6 class="info-title">Email/Username <h5 class="info-data"><?php echo $user['email']; ?></h5> </h6>

                <h6 class="info-title">Contact No. <h5 class="info-data"><?php echo $user['contact_no']; ?></h5> </h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  <!-------------------------------------------------------Main Content End------------------------------------------------------->
  
  <script>
      // $(document).ready(() => {
      //   $('#stud_card').click(function () {
      //     $('#stud_card').flip({ trigger: "manual" });
      //   });
      // });
      var card = document.querySelector('.flip-card');
    card.addEventListener('click', function () {
        card.classList.toggle('is-flipped');
    });
  </script>

    <!-- including footer -->
    <?php
    require_once('./common/footer.php');
    ?>


  
</body>

</html>