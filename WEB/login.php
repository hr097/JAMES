<?php

/*if(isset($_COOKIE['_dirsu'])&&isset($_COOKIE['_emanu'])&&isset($_COOKIE['_drowsp']))
{
    header('Location:controller.php');
}

*/

?>


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


    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">

    <!--bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    
    <!-- bootstrap icon-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
   
    <!-- css  -->
    <link rel="stylesheet" href="./css/template.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/login.css">

    <!--javaScript-->
    <script src="./js/script.js" type="text/javascript" defer=true></script>
    <script src="./js/authentication/login.js" type="text/javascript" defer=true></script>
    <noscript>Your browser does not support Javascript!</noscript>

    <!--jQuery file-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- page information and icon-->
    <title>AMS | Login</title>
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
                            <h2 class="font-weight-bolder text-center unselectable">Login</h2>

                            <form class="pt-3" id="userlogin" method="POST" action="controller.php">

                                    <div class="alert alert-danger" id="error-message">
                                        <ul id="message" style="list-style-type:none;"></ul>
                                    </div>

                                    <div class="form-group psd-icon">
                                        <input type="text" class="form-control form-control-lg fieldstyle" name="username" id="username" style="" placeholder="Enter your email"><br>
                                        <input type="password" class="form-control form-control-lg fieldstyle" name="password" id="password" placeholder="Enter your password">
                                        <i class="bi bi-eye-slash eye-icon" id="togglePassword"></i>  
                                        <input type="hidden" id="usertype" name="user" value="0">
                                    </div>

                                    

                                     <div class="my-2 d-flex justify-content-between align-items-center">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-info ml-1 mt-1" name="remember-user" id="remember-me">
                                            <label for="remember-me" class="rememberme-txt unselectable mt-0" >Remember me</label>
                                        </div>
                                        <a class="auth-link text-black" style="margin-top:-6px;" id="forgotpassword">Forgot password?</a>
                                     </div>

                                    <div class="mt-2 text-center">
                                        <a class="btn btn-primary btn-icon-text" id="login" style="width:150px;">Login</a>
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