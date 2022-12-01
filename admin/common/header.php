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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;700&display=swap" rel="stylesheet">

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
    <link rel="stylesheet" href="../css/admin.css">

    <!--jQuery file-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- favicon -->
    <link rel="shortcut icon" href="../assets/logos/favicon.ico">

    <!-------------------------------------------------------Nav-Bar Start------------------------------------------------------->
    <div class="container-scroller" style="background-color: #F5F7FF;">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center">


                <button class="navbar-toggler navbar-toggler-right  align-self-center ml-3" type="button"
                    data-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>

                <a class="navbar-brand brand-logo mr-3" href="./dashboard.php"><img src="../assets/logos/logo.svg"
                        alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="./dashboard.php"><img src="../assets/logos/logo-mini.svg"
                        alt="logo" width="34px" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">

                <!-- -----------------------------------------------------Profile Start ----------------------------------------------------- -->
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <p class="ac_type" style="margin-right:10px;">Admin Dashboard</p>
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                        <img src='../assets/profiles/admin-profile.png' alt='profile-img' />
 

                        </a>

                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                            aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href='../php/logout.php'>
                                <i class="ti-power-off text-primary"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>

                <!-------------------------------------------------------Profile End----------------------------------------------------- -->

            </div>
        </nav>
        <!-- -----------------------------------------------------Nav Bar End----------------------------------------------------- -->

        <!-- -----------------------------------------------------Side Nav Bar Start----------------------------------------------------- -->
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
                        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                            aria-controls="ui-basic">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                    <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                            </svg>
                            <span class="menu-title ml-3">Registration</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="./amsreaderregistration.php">AMS Reader</a></li>
                                <li class="nav-item"> <a class="nav-link" href="./facrolesregistration.php">Faculty Role</a></li>
                                <li class="nav-item"> <a class="nav-link" href="./facultyregistration.php">Faculty</a></li>
                                <li class="nav-item"> <a class="nav-link" href="./studentregistration.php">Student</a></li>
                                <li class="nav-item"> <a class="nav-link" href="./courseregistration.php">Course</a></li>
                                <li class="nav-item"> <a class="nav-link" href="./subjectregistration.php">Subject</a></li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="./searchstudent.php" aria-expanded="false" aria-controls="ui-basic">
                            <i class="icon-head menu-icon ti-search"></i>
                            <span class="menu-title">Search</span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="./transfersem.php" aria-expanded="false" aria-controls="ui-basic">
                            <i class="icon-head menu-icon ti-stats-up"></i>
                            <span class="menu-title">Transfer Students</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="./classbckup.php" aria-expanded="false" aria-controls="ui-basic">
                            <i class="icon-head menu-icon ti-cloud-down"></i>
                            <span class="menu-title">Backup</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./archivesearch.php" aria-expanded="false" aria-controls="ui-basic">
                            <i class="icon-head menu-icon ti-zoom-in"></i>
                            <span class="menu-title">Archive Search</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./feedbackstats.php" aria-expanded="false" aria-controls="ui-basic">
                            <i class="icon-head menu-icon ti-comment-alt"></i>
                            <span class="menu-title">Feedback Stats</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="./about.php" aria-expanded="false" aria-controls="ui-basic">
                            <i class="icon-head menu-icon ti-book"></i>
                            <span class="menu-title">About</span>
                        </a>
                    </li>
            </nav>

            <input type="hidden" id="csrfToken" name="_csrfToken" value="<?php echo $JAMES->generateCsrfToken();?>" >

            <!-------------------------------------------------------Side Nav-Bar End------------------------------------------------------->
