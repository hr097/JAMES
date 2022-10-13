<?php

require_once("../ams.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();

if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="1"))
{
 $JAMES->ams_redirect("../login.php");
}

// $u = $_SESSION["_userId"];

// //@query
// $sql = "select * from vw_students where email='$u';"; 
// $result = mysqli_query($JAMES->connection(),$sql);

// if(mysqli_num_rows($result)===1)
// {
//     $user = mysqli_fetch_assoc($result);
// }
// else
// {
//     $JAMES->ams_redirect("../login.php");
// }

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
  <title>AMS | Notifications </title>

</head>

<body>


      <!-------------------------------------------------------Main Content Start------------------------------------------------------->

      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">

          </div>
          <!--Personal Info-->
          <div class="row">
            <div class="col-md-12 mb-2">
              <h4 class="font-weight-bold">Department Updates</h4>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    <ul class="list-unstyled">

                    <li>
                      <h6 class="info-title font-weight-bold" style="margin-bottom:15px;">Holidays</h6>
                      <h5 class="info-data" style="margin-left:5px;">No holidays are declared yet.</h5> 
                    </li>

                    <li>
                      <h6 class="info-title font-weight-bold" style="margin-bottom:15px;">Events</h6>
                      <h5 class="info-data" style="margin-left:5px;">No events announceed yet.</h5> 
                    </li>

                    <li>
                      <h6 class="info-title font-weight-bold" style="margin-bottom:15px;">Achievements</h6>
                      <h5 class="info-data" style="margin-left:5px;">Coming soon.</h5> 
                    </li>

                   </ul>
                </div>
              </div>
            </div>
          </div>



          <!--Contact Info-->
          <div class="row">
            <div class="col-md-12 mb-2">
              <h4 class="font-weight-bold">Semester Updates</h4>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                <ul class="list-unstyled">
                    <li>
                      <h6 class="info-title font-weight-bold" style="margin-bottom:15px;">Lectures schedule</h6>
                      <h5 class="info-data" style="margin-left:5px;">No changes in lecture schedule.</h5> 
                    </li>

                    <li>
                      <h6 class="info-title font-weight-bold" style="margin-bottom:15px;">Assignments</h6>
                      <h5 class="info-data" style="margin-left:5px;">Hurrey! No assignments to show</h5> 
                    </li>

                    <li>
                      <h6 class="info-title font-weight-bold" style="margin-bottom:15px;">Examination</h6>
                      <h5 class="info-data" style="margin-left:5px;">Coming soon.</h5> 
                    </li>
                    </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  <!-------------------------------------------------------Main Content End------------------------------------------------------->
  
  <script>
  
    <!-- including footer -->
    <?php
    require_once('./common/footer.php');
    ?>


  
</body>

</html>