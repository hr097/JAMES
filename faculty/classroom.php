<?php

require_once("../ams.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();

if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="2"))
{
 $JAMES->ams_redirect("../login.php");
}

if(!isset($_GET['division']))
{
    $JAMES->ams_redirect("dashboard.php");
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
    <title>AMS | Classroom</title>

    <!-- css  -->
    <link rel="stylesheet" href="../css/faculty.css">
</head>

<body>
    <!-------------------------------------------------------Main Content------------------------------------------------------->
    <div class="main-panel">

        <div class="content-wrapper">


            <div class="row">

                <!-------------------------------------------------------Table Start------------------------------------------------------->
                <div class="col-lg-12 grid-margin">

                <button type='button' onclick="window.location.href='./dashboard.php'" style="verticle-align:middle;padding:9px;width:90px;height:40px;margin:auto;float:left;position:relative;bottom:10px;display:inline;border-radius:12px;" class='btn form-control btn-primary btn-icon-text'>
                                                            
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                </svg>
                Back
                </button>

                <h4 class="card-title coursefont font-weight-bold mb-4 ml-5" style="text-align:right;">
                    <?php
                        if(isset($_GET['course'])&&isset($_GET['year'])&&isset($_GET['subject'])&&isset($_GET['semester'])&&isset($_GET['division']))
                        {
                            echo $_GET['course']."-".$_GET['year']."   |   ".$_GET['subject']."   |   Sem ".$_GET['semester']."| Div-".$_GET['division'];
                        }
                        else
                        {
                            $JAMES->ams_redirect("../login.php");
                        }
                    ?>
                </h4>



                    <div class="row">
                      <div class="d-flex">
                          <div class="col-1-md-1">

                            <div class="ml-2 p-2" style="float:left;">
                                <button type="button" class="btn btn-primary btn-icon-text mb-1" id="selectclass">
                                    <i class="ti-check-box btn-icon-prepend"></i>
                                    Take Attendance
                                </button>
                            </div>

                            <div class="ml-2 p-2" style="float:left;" >
                                <button type="button" class="btn btn-secondary btn-icon-text mb-1" id="selectclass">
                                    <i class="ti-pencil btn-icon-prepend"></i>
                                    Modify Classroom
                                </button>
                            </div>
                            
                            <div class="ml-2 p-2" style="float:left;">
                                <button type="button" class="btn btn-danger btn-icon-text mb-1" id="selectclass">
                                    <i class="ti-archive btn-icon-prepend"></i>
                                    Archive Classroom
                                </button>
                            </div>

                            </div>
                        </div>
                    </div>

                    <div class="card mt-2">
                        <div class="card-body">
                            <h4 class="card-title">Student Attendance</h4>
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table id="order-listing" class="table" id="tbl">
                                            <thead>
                                                <tr>
                                                    <th>SPID</th>
                                                    <th>Full Name</th>
                                                    <th>Present</th>
                                                    <th>Absent</th>
                                                    <th>Percentage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>2020049846</td>
                                                    <td>Naruto</td>
                                                    <td>10</td>
                                                    <td>5</td>
                                                    <td>80%</td>
                                                </tr>
                                                <tr>
                                                    <td>2020049846</td>
                                                    <td>Naruto</td>
                                                    <td>10</td>
                                                    <td>5</td>
                                                    <td>80%</td>
                                                </tr>
                                                <tr>
                                                    <td>2020049846</td>
                                                    <td>Naruto</td>
                                                    <td>10</td>
                                                    <td>5</td>
                                                    <td>80%</td>
                                                </tr>
                                                <tr>
                                                    <td>2020049846</td>
                                                    <td>Naruto</td>
                                                    <td>10</td>
                                                    <td>5</td>
                                                    <td>80%</td>
                                                </tr>
                                                <tr>
                                                    <td>2020049846</td>
                                                    <td>Naruto</td>
                                                    <td>10</td>
                                                    <td>5</td>
                                                    <td>80%</td>
                                                </tr>
                                                <tr>
                                                    <td>2020049846</td>
                                                    <td>Naruto</td>
                                                    <td>10</td>
                                                    <td>5</td>
                                                    <td>80%</td>
                                                </tr>
                                                <tr>
                                                    <td>2020049846</td>
                                                    <td>Naruto</td>
                                                    <td>10</td>
                                                    <td>5</td>
                                                    <td>80%</td>
                                                </tr>
                                                <tr>
                                                    <td>2020049846</td>
                                                    <td>Naruto</td>
                                                    <td>10</td>
                                                    <td>5</td>
                                                    <td>80%</td>
                                                </tr>
                                                <tr>
                                                    <td>2020049846</td>
                                                    <td>Naruto</td>
                                                    <td>10</td>
                                                    <td>5</td>
                                                    <td>80%</td>
                                                </tr>
                                                <tr>
                                                    <td>2020049846</td>
                                                    <td>Naruto</td>
                                                    <td>10</td>
                                                    <td>5</td>
                                                    <td>80%</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--Table End-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <script>
    $(document).ready(function() {
        $("#selectclass").click(function() {
            window.location.href = "./select_class.php";
        });
    });
    </script>

    <!-- including footer -->
    <?php
    include './common/footer.php'
    ?>


</body>

</html>