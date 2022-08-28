<?php

require_once("./php/commonlib.php");

if( count($_COOKIE) > 0 && isset($_COOKIE["__u9RmdkJ6"]) )
{
    redirect("login.php");
    exit();
}

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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&display=swap" rel="stylesheet">

    <!--bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    
    <!-- bootstrap icon-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
   
    <!-- css  -->
    <link rel="stylesheet" href="./css/template.css">
    <link rel="stylesheet" href="./css/modal.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/login.css">

    <!--javaScript-->
    <script src="./js/togglepassword.js" type="text/javascript" defer=true></script>
    <script src="./js/modal.js" type="text/javascript" defer=true></script>
    <script src="./js/authentication/index.js" type="text/javascript" defer=true></script>
    <noscript>Your browser does not support Javascript!</noscript>

    <!--jQuery file-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- page information and favicon-->
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

                            <!-- Logo,Header and title : Start-->
                            <div class="brand-logo text-center">
                                <img src="./assets/logos/login-logo.png" alt="logo">
                                <h2 class="mt-3 title unselectable form-header">J.P.Dawer | AMS</h2>
                            </div>
                            <h2 class="font-weight-bolder text-center unselectable form-header">Login</h2>

                            <!-- Logo,Header and title : End-->

                            <!-- Form : Start -->
                            <form class="pt-3" id="userlogin" method="POST" autocomplete="on" action="login.php">

                                    <!-- Error message -->
                                    <div class="alert alert-danger" id="error-message">
                                        <ul id="message" style="list-style-type:none;"></ul>
                                    </div>

                                    <!-- Email and password : Start-->
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-lg fieldstyle" maxlength="256" name="_username" id="username" placeholder="Enter your username">
                                    </div>

                                    <div class="form-group psd-icon">
                                        <i class="bi bi-eye-slash fa-lg eye-icon" id="togglePassword"></i>
                                        <input type="password" class="form-control form-control-lg fieldstyle" minlength="8" maxlength="16" name="_password" id="password" placeholder="Enter your password">
                                        <!-- <input type="hidden" id="usertype" name="user" value="0"> FOR CSRF SECURITY --> 
                                    </div>
                                    <!-- Email and password : End-->


                                    <!-- Remember me , forgot password and  login button : Start -->
                                     <div class="my-2 d-flex justify-content-between align-items-center">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-info ml-1 mt-1" name="_rememberMe" id="remember-me">
                                            <label for="remember-me" class="rememberme-txt unselectable mt-0" >Remember me</label>
                                        </div>
                                        <a class="auth-link text-black" style="margin-top:-6px;" id="forgotpassword">Forgot password?</a>
                                     </div>

                                    <div class="mt-2 text-center">
                                        <input type="button" class="btn btn-primary btn-icon-text" name="login" id="login" style="width:150px;height:46px;" value="Login">
                                    </div>
                                    <!-- Remember me , forgot password and  login button : End -->
                            </form>
                            <!-- Form : End -->
                        </div>
                    </div>
               </div>
           </div>
        </div>
    </div>

        <!-- Open modal
        <button id="btn">Open Modal</button> -->
        <!-- modal -->
        <div id="modal" class="modal">
        <!-- modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <p class="msg unselectable">Are you sure you want to reset your password?</p>
            <button id="yes-button" class="modal-btn">Confirm</button>
            <button id="no-button" class="modal-btn">Cancel</button>
        </div>
        </div>
</body>
</html>