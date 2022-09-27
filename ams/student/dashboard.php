<?php

//  require_once("../ams.php");
//  $JAMES = new AMS(2);
//  $JAMES->init_user_session();

//  if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="1"))
//  {
//   $JAMES->ams_redirect("../login.php");
//  }
 
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- including header -->
    <?php
    include './common/header.php'
    ?>

    <!-- css  -->
    <link rel="stylesheet" href="../css/student.css">
     
    <!-- js  -->
    <script src="../js/student/studdashboard.js" type="text/javascript" defer=true></script>

    <!-- page information-->
    <title>AMS | Student dashboard</title>
</head>

<body>

            <!-------------------------------------------------------Main Content------------------------------------------------------->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-50">
                            <h3 class="font-weight-bold">Welcome Archit,</h3>
                            <h6 class="font-weight-normal mb-10">Good Morning, </h6>
                        </div>

                        <!-------------------------------------------------------States------------------------------------------------------->
                        <div class="col-md-12 grid-margin transparent">
                            <div class="row">
                                <div class="col-md-3 mb-2 stretch-card transparent lblmargin handpointer"
                                    onclick="subopen()">
                                    <div class="card card-dark-blue ">
                                        <div class="card-body">
                                            <p class="mb-4 subfont">Web Development</p>
                                            <p>Payal Mam</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-2 stretch-card transparent handpointer" onclick="subopen()">
                                    <div class="card card-tale">
                                        <div class="card-body">
                                            <p class="mb-4 subfont">RDBMS</p>
                                            <p>Tejas Shah</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-2 stretch-card transparent handpointer" onclick="subopen()">
                                    <div class="card card-light-danger">
                                        <div class="card-body">
                                            <p class="mb-4 subfont">IOT</p>
                                            <p>Hitesh Lad</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-2 stretch-card transparent handpointer" onclick="subopen()">
                                    <div class="card card-dark-blue bg-warning">
                                        <div class="card-body">
                                            <p class="mb-4 subfont">Environmental Science</p>
                                            <p>Dilbar Mehta</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-------------------------------------------------------Table Started------------------------------------------------------->
                        <div class="col-lg-12 grid-margin">

                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Daily Attendance</h4>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table id="order-listing" class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>NO.</th>
                                                            <th>Date</th>
                                                            <th>Subject</th>
                                                            <th>Attendance Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>05/06/2022</td>
                                                            <td>IOT</td>
                                                            <td>
                                                                <button type="button"
                                                                    class="btn btn-success attbtn">Present</button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>2</td>
                                                            <td>05/06/2022</td>
                                                            <td>Web Development</td>
                                                            <td>
                                                                <button type="button"
                                                                    class="btn btn-danger attbtn">Absent </button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>3</td>
                                                            <td>06/06/2022</td>
                                                            <td>RDBMS</td>
                                                            <td>
                                                                <button type="button"
                                                                    class="btn btn-success attbtn">Present</button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>4</td>
                                                            <td>07/06/2022</td>
                                                            <td>Environmental Science</td>
                                                            <td>
                                                                <button type="button"
                                                                    class="btn btn-success attbtn">Present</button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>5</td>
                                                            <td>07/06/2022</td>
                                                            <td>RDBMS</td>
                                                            <td>
                                                                <button type="button"
                                                                    class="btn btn-success attbtn">Present</button>
                                                            </td>
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

                    <!--Subject Page Open Start-->
                    <script>
                    function subopen() {
                        window.location = "./subject.php";
                    }
                    </script>
                    <!--Subject Page Open End-->

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