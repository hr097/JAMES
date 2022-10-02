<?php

require_once("../ams.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();

if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="1"))
{
 $JAMES->ams_redirect("../login.php");
}

if(isset($_GET["subject"]))
{ 

  $subject_name = $_GET["subject"];
  //query the subject
  

}
else
{
  $JAMES->ams_redirect("./dashboard.php");
}


?>


<!DOCTYPE html>
<html lang="en">

  <head>
    <!-- including headr -->
    <?php
    include './common/header.php'
    ?>

    <!-- css  -->
    <link rel="stylesheet" href="../css/student.css">

    <!-- page information and favicon-->
    <title>AMS | Subject Attendance</title>

</head>

<body>
      <!-------------------------------------------------------Main Content------------------------------------------------------->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <!-------------------------------------------------------Table Start------------------------------------------------------->
            <div class="col-lg-12 grid-margin">

                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title"><?php echo $subject_name; ?> Attendance</h4>
                    <div class="row">
                      <div class="col-12">
                        <div class="table-responsive">
                          <table id="order-listing" class="table" id="tbl">
                            <thead>
                              <tr>
                                <th>No.</th>
                                <th>Date</th>
                                <th>Attendance Status</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>1</td>
                                <td>05/06/2022</td>
                                <td>
                                  <button type="button" class="btn btn-success attbtn">Present</button>
                                </td>
                              </tr>
                              <tr>
                                <td>2</td>
                                <td>05/06/2022</td>
                                <td>
                                  <button type="button" class="btn btn-success attbtn">Present</button>
                                </td>
                              </tr>
                              <tr>
                                <td>3</td>
                                <td>05/06/2022</td>
                                <td>
                                  <button type="button" class="btn btn-danger attbtn">Absent </button>
                                </td>
                              </tr>
                              <tr>
                                <td>4</td>
                                <td>06/06/2022</td>
                                <td>
                                  <button type="button" class="btn btn-success attbtn">Present</button>
                                </td>
                              </tr>
                              <tr>
                                <td>5</td>
                                <td>06/06/2022</td>
                                <td>
                                  <button type="button" class="btn btn-danger attbtn">Absent </button>
                                </td>
                              </tr>
                              <tr>
                                <td>6</td>
                                <td>06/06/2022</td>
                                <td>
                                  <button type="button" class="btn btn-success attbtn">Present</button>
                                </td>
                              </tr>
                              <tr>
                                <td>7</td>
                                <td>07/06/2022</td>
                                <td>
                                  <button type="button" class="btn btn-danger attbtn">Absent </button>
                                </td>
                              </tr>
                              <tr>
                                <td>8</td>
                                <td>07/06/2022</td>
                                <td>
                                  <button type="button" class="btn btn-danger attbtn">Absent </button>
                                </td>
                              </tr>
                              <tr>
                                <td>9</td>
                                <td>07/06/2022</td>
                                <td>
                                  <button type="button" class="btn btn-danger attbtn">Absent </button>
                                </td>
                              </tr>
                              <tr>
                                <td>10</td>
                                <td>07/06/2022</td>
                                <td>
                                  <button type="button" class="btn btn-success attbtn">Present</button>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                  <!--Table End-->
        </div>
      </div>





    <!-- including footer -->
    <?php
    include './common/footer.php'
    ?>

</body>

</html>