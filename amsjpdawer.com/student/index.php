<?php

// header("Location:../index.php");
// exit();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta data about page -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Search Engine use --->
    <meta name="author" content="Team JPD-AMS" />
    <meta name="description"
        content="An efficient & relible Attendance Management System for J.P. Dower Institute of Information Science and Technology" />
    <meta name="key words"
        content="JPD AMS,Attendance Management System,J.P. Dower Institute of Information Science and Technology" />
    <meta http-equiv="refresh" content="120">

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&display=swap" rel="stylesheet">

    <!-- plugins:css -->
    <link rel="stylesheet" href="/vendors/feather/feather.css">
    <link rel="stylesheet" href="/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/vendors/datatables.net/dataTables.bootstrap4.css">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="/vendors/datatables.net/select.dataTables.min.css">
    <!-- End plugin css for this page -->

    <!-- css  -->
    <link rel="stylesheet" href="/css/template.css">
    <link rel="stylesheet" href="/css/student.css">


    <!-- page information and favicon-->
    <title>AMS | Student dashboard</title>
    <link rel="shortcut icon" href="/assets/logos/favicon.ico">
</head>

<body>

    <!-------------------------------------------------------Nav-Bar Start------------------------------------------------------->
    <div class="container-scroller" style="background-color: #F5F7FF;">
        <!-- partial:partials/_navbar.php -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center">


                <button class="navbar-toggler navbar-toggler-right  align-self-center ml-3" type="button"
                    data-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>

                <a class="navbar-brand brand-logo mr-3" ><img src="/assets/logos/logo.svg"
                        alt="logo"/></a>
                <a class="navbar-brand brand-logo-mini" href="./index.php"><img src="/assets/logos/logo-mini.svg" alt="logo"
                        width="50px" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">

                <!-------------------------------------------------------Profile Start------------------------------------------------------->
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <p class="ac_type">Student Dashboard</p>
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                            <img src="/assets/profiles/student-profile.jpg" alt="profile" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                            aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="./profile.php">
                                <i class="icon-head menu-icon"></i>
                                Profile
                            </a>
                            <a class="dropdown-item">
                                <i class="ti-power-off text-primary"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>

                <!-------------------------------------------------------Profile End------------------------------------------------------->

            </div>
        </nav>
        <!-------------------------------------------------------Nav-Bar End------------------------------------------------------->

        <!-------------------------------------------------------Side Nav-Bar Start------------------------------------------------------->
        <div class="container-fluid page-body-wrapper">
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="./index.php">
                            <i class="icon-grid menu-icon"></i>
                            <span class="menu-title">Home</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="./profile.php" aria-expanded="false" aria-controls="ui-basic">
                            <i class="icon-head menu-icon ti-id-badge"></i>
                            <span class="menu-title">Profile</span>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="./about.php" aria-expanded="false" aria-controls="ui-basic">
                            <i class="icon-head menu-icon ti-book"></i>
                            <span class="menu-title">About Us</span>
                        </a>
                    </li>

                    <!-- <li class="devpage">
                        <a class="nav-link" href="./html/developers.php" aria-expanded="false"
                            aria-controls="ui-basic">
                            <span>Developers</span>
                        </a>
                    </li> -->
            </nav>
            <!-------------------------------------------------------Side Nav-Bar End------------------------------------------------------->

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

                                                        <tr>
                                                            <td>6</td>
                                                            <td>07/06/2022</td>
                                                            <td>Environmental Science</td>
                                                            <td>
                                                                <button type="button"
                                                                    class="btn btn-success attbtn">Present</button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>7</td>
                                                            <td>08/06/2022</td>
                                                            <td>Web Development</td>
                                                            <td>
                                                                <button type="button"
                                                                    class="btn btn-success attbtn">Present</button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>8</td>
                                                            <td>08/06/2022</td>
                                                            <td>IOT</td>
                                                            <td>
                                                                <button type="button"
                                                                    class="btn btn-danger attbtn">Absent </button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>9</td>
                                                            <td>09/06/2022</td>
                                                            <td>Web Development</td>
                                                            <td>
                                                                <button type="button"
                                                                    class="btn btn-success attbtn">Present</button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>10</td>
                                                            <td>09/06/2022</td>
                                                            <td>IOT</td>
                                                            <td>
                                                                <button type="button"
                                                                    class="btn btn-danger attbtn">Absent </button>
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

    <!-- plugins:js -->
    <script src="/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <script src="/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="/vendors/datatables.net/dataTables.bootstrap4.js"></script>
    <script src="/vendors/datatables.net/dataTables.select.min.js"></script>
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="/vendors/js/off-canvas.js"></script>
    <script src="/vendors/js/hoverable-collapse.js"></script>
    <script src="/js/template.js"></script>
    <!-- endinject -->

    <!-- Custom js for this page-->
    <script src="/vendors/js/dashboard.js"></script>
    <script src="/vendors/datatables.net/data-table.js"></script>
</body>

</html>