<?php

require_once("../ams.php");
$JAMES = new AMS("Admin");
$JAMES->init_user_session();

// if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="3"))
// {
//  $JAMES->ams_redirect("../login.php");
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- including header -->
    <?php
    require_once('./common/header.php');
?>

    <!-- js  -->
    <script src="../js/admin/feedbackstats.js" type="text/javascript" defer=true></script>

    <!-- page information-->
    <title>AMS | Faculty Regisration</title>

</head>

<body>
    <!-------------------------------------------------------Main Content------------------------------------------------------->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12  col-md-12  col-lg-12  grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Faculty Regisration</h4>
                  <form class="forms-sample">
                   
                      <!-- <input type="hidden" id="csrfToken" name="_csrfToken" value="<?php echo $JAMES->generateCsrfToken();?>" > -->

                    <!-- FID and Role -->
                    <div class="row">
                      <div class="form-group col-sm-6 col-md-6 col-lg-6">
                          <label>FID</label>
                          <input type="text" class="form-control" placeholder="Enter Faculty Id">
                        </div>

                      <div class="form-group col-md-6">
                          <label>Role Name</label>
                          <select class="form-control">
                            <option>Not Selected</option>
                            <option>Assistant Professor</option>
                            <option>Associate Professor</option>
                            <option>Lab Assistant</option>
                            <option>Teaching Assistant</option>
                          </select>
                        </div>
                      </div>
                   
                    <!-- Name-->
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" placeholder="Enter Faculty Name">
                    </div>


                    <!-- Gender and DOB -->
                    <div class="row">
                      <div class="form-group col-sm-6 col-md-6 col-lg-6">
                          <label>Gender</label>
                          <select class="form-control">
                            <option>Not Selected</option>
                            <option>Male</option>
                            <option>Female</option>
                          </select>
                        </div>

                      <div class="form-group col-md-6">
                          <label>DOB</label>
                          <input type="date" class="form-control" id="" value="">
                        </div>
                      </div>

                      <!-- Joining year and Contact no -->
                    <div class="row">
                      <div class="form-group col-sm-6 col-md-6 col-lg-6">
                          <label>Contact No</label>
                          <input type="number" class="form-control" id="" value="" placeholder="Enter Contact No">
                        </div>

                      <div class="form-group col-md-6">
                          <label>Joining Year</label>
                          <input type="date" class="form-control" id="" value="">
                        </div>
                      </div>


                    <!-- Email & Password -->
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Enter Email">
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Enter Password">
                    </div>

                    <button type="button" id="" class="btn btn-primary mr-2 mt-3">Add Faculty</button>
                    <button class="btn btn-light mt-3">Clear</button>
                  </form>
                </div>
              </div>
            </div>
            <!--Faculty Form End-->
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
                    <button id="yes-button" class="modal-btn"></button>
            </div>
    </div>

    <!-- including footer -->
    <?php
require_once('./common/footer.php');
?>

</body>

</html>