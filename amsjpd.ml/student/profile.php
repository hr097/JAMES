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
 

  <!-- Google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&display=swap" rel="stylesheet">

  <!-- plugins:css -->
  <link rel="stylesheet" href="../vendors/feather/feather.css">
  <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../vendors/datatables.net/dataTables.bootstrap4.css">
  <!-- endinject -->

  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="../vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="../vendors/datatables.net/select.dataTables.min.css">
  <!-- End plugin css for this page -->

  <!-- css  -->
  <link rel="stylesheet" href="../css/template.css">
  <link rel="stylesheet" href="../css/student.css">


  <!-- page information and favicon-->
  <title>AMS | Profile</title>
  <link rel="shortcut icon" href="../assets/logos/favicon.ico">
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

        <a class="navbar-brand brand-logo mr-3" href="./dashboard.php"><img src="../assets/logos/logo.svg" alt="logo"  /></a>
        <a class="navbar-brand brand-logo-mini" href="./dashboard.php"><img src="../assets/logos/logo-mini.svg" alt="logo"
            width="34px" /></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">

        <!-------------------------------------------------------Profile Start------------------------------------------------------->
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <p class="ac_type">Student Dashboard</p>
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="../assets/profiles/student-profile.jpg" alt="profile" />
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
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


    </nav>

    <!-------------------------------------------------------Side Nav-Bar Start------------------------------------------------------->
    <div class="container-fluid page-body-wrapper">
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="./dashboard.php">
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
              <span class="menu-title">About</span>
            </a>
          </li>
          <!-- <li class="devpage">
            <a class="nav-link" href="./developers.php" aria-expanded="false" aria-controls="ui-basic">
              <span>Developers</span>
            </a>
          </li> -->
      </nav>
      <!-------------------------------------------------------Side Nav-Bar End------------------------------------------------------->

      <!-------------------------------------------------------Main Content Start------------------------------------------------------->

      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">

            <!-------------------------------------------------------Student Card Start------------------------------------------------------->
            <div class="container my-3" align="center" style="padding-bottom: 3%;">
              <div class="flip-card" id="stud_card">
                <div class="flip-card-inner">
                  <div class="flip-card-front" style="border-radius: 10px;">
                    <img src="../assets/profiles/student-profile.jpg" class="my-4" alt="Student profile"
                      style="width:130px;height:130px; border-radius: 49%;">
                    <h3 style="color: white; margin-top: -15px;">Archit Ghevariya</h3>
                  </div>
                  <div class="flip-card-back py-4 pl-4" align="left">
                    <p style="font-weight: 700;"> Student id : 2020049819</p>
                    <p><strong> Enrollment no :</strong> E20110018000610015</p>
                    <p><strong> DOB :</strong> 7/6/2020</p>
                    <p><strong> Email id :</strong> archit@vnsgu.ac.in</p>
                    <p><strong> Course name :</strong> E20110018000610015</p>
                  </div>
                  <!-------------------------------------------------------Studnet Card End------------------------------------------------------->
                </div>
              </div>
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
                  <h6 class="info-title">First Name</h6>
                  <h4 class="info-data">ARCHIT</h4>

                  <h6 class="info-title"> Last Name</h6>
                  <h4 class="info-data">GHEVARIYA</h4>

                  <h6 class="info-title">Birth Date </h6>
                  <h4 class="info-data">08-03-2003</h4>

                  <h6 class="info-title">Gender</h6>
                  <input type="radio" checked> Male
                  <input type="radio" class="info-data"> Female

                  <h6 class="info-title">Semester</h6>
                  <h4 class="info-data">4th</h4>

                  <h6 class="info-title"> Student Id</h6>
                  <h4 class="info-data">2020049819</h4>

                  <h6 class="info-title">Enrollment / Registration Id </h6>
                  <h4 class="info-data">E20110018000610015</h4>

                  <h6 class="info-title">Course Name</h6>
                  <h4 class="info-data">B. SC. (I. T.) ( M. SC. (I. T.) 5 YEAR INTEGRATED COURSE ) ( M.SC. (I.T.)
                    2020-25 )</h4>
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
                  <h6 class="info-title">Email</h6>
                  <h4 class="info-data">archit@vnsgu.ac.in</h4>

                  <h6 class="info-title">Mobile No.</h6>
                  <h4 class="info-data">9813245125</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-------------------------------------------------------Main Content End------------------------------------------------------->
  
  <script>
    $(document).ready(() => {
      $('#stud_card').click(function () {
        $('#stud_card').flip({ trigger: "manual" });
      });
    });
  </script>

  <!-- plugins:js -->
  <script src="../vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->

  <!-- Plugin js for this page -->
  <script src="../vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="../vendors/datatables.net/dataTables.bootstrap4.js"></script>
  <script src="../vendors/datatables.net/dataTables.select.min.js"></script>
  <!-- End plugin js for this page -->

  <!-- inject:js -->
  <script src="../vendors/js/off-canvas.js"></script>
  <script src="../vendors/js/hoverable-collapse.js"></script>
  <script src="/js/template.js"></script>
  <!-- endinject -->

  <!-- Custom js for this page-->
  <script src="../vendors/js/dashboard.js"></script>
  <script src="../vendors/datatables.net/data-table.js"></script>


  
</body>

</html>