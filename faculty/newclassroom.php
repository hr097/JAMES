<?php
require_once("../ams.php");
$JAMES = new AMS("Admin");
$JAMES->init_user_session();

if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="2"))
{
 $JAMES->ams_redirect("../login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
          <!-- including footer -->
          <?php
          include './common/header.php'
        ?>

        <!-- Page info -->
        <title>AMS | Create Classroom</title>

        <!-- css  -->
        <link rel="stylesheet" href="../css/faculty.css">
</head>

<body>
   <!-------------------------------------------------------Main Content------------------------------------------------------->
      <!--Subeject Setup Form Start-->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12  grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Create classroom</h4>
                  <form class="forms-sample">

                    <!--Course & Semster-->
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Course</label>
                          <select class="form-control">
                            <option>IT</option>
                            <option>ICT</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group col-md-6 ">
                        <label>Semester</label>
                        <select class="form-control">
                          <option>1</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>
                          <option>6</option>
                          <option>7</option>
                          <option>8</option>
                        </select>
                      </div>
                    </div>

                    <!-- Subject -->
                      <div class="form-group">
                        <label>Subject</label>
                        <select class="form-control">
                          <option>PHP</option>
                          <option>SAD</option>
                          <option>Account</option>
                        </select>
                      </div>

                    <!-- Division and Current Year -->
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Division</label>
                          <select class="form-control">
                            <option>A</option>
                            <option>B</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group col-md-6">
                        <div class="form-group">
                          <label>Current Year</label>
                          <input type="date" class="form-control" id="setupid" placeholder="Enter Setup ID">
                        </div>
                      </div>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2 mt-3">Create
                      Setup</button>
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

    <!-- including footer -->
    <?php
       include './common/footer.php'
    ?>

</body>

</html>