<!DOCTYPE html>
<html lang="en-IN">

<head>
     <!-- Meta data about page -->

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Search Engine use --->
    
    <meta name="author" content="Team JPD-AMS"/>
    <meta name="description" content="An efficient & relible Attendance Management System for J.P. Dower Institute of Information Science and Technology"/>
    <meta name="key words" content="JPD AMS,Attendance Management System,J.P. Dower Institute of Information Science and Technology"/>
    <meta http-equiv="refresh" content="120">


    <!--bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">

    <!-- End plugin css for this page -->
    <link rel="stylesheet" href="./css/template.css">
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/style.css">

    <!--jquery file-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- page information-->
    <title>Forgot password | JPD AMS</title>
    <link rel="shortcut icon" href="./assets/logos/favicon.ico">
</head>

<body>

    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5 loginbox">
                            <div class="brand-logo text-center">
                                <img src="./assets/logos/login-logo.png" alt="logo">
                                <h2 class="mt-3 title unselectable">J.P.Dawer | AMS</h2>

                            </div>
                            <h2 class="text-center forgot-page-title unselectable">Reset password</h2>
                            <form class="pt-3">
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg fieldstyle"
                                        placeholder="Enter new password">
                                </div>

                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg fieldstyle"
                                        placeholder="Confirm password">
                                </div>

                                <!-- Error code div here -->

                                <div class="mt-2 text-center">
                                    <button type="button" class="btn btn-primary btn-icon-text" style="width: 165px;"
                                        onclick="validate()">Reset password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>