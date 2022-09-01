<?php 
require_once("./amslib.php");
$JAMES = new AMS(0);
$JAMES->init_user_session();

if($JAMES->checkCookies("__u9RmdkJ6")===true)
{       
    $JAMES->verify_user_token($JAMES->customDecrypt($_COOKIE['__u9RmdkJ6']));
}
else if($JAMES->checkSession()===true)
{
    $type = (int) $_SESSION['_userType'];
    $JAMES->redirect_ams_user($type);
}
else if($JAMES->checkResetPermission()===true)
{
    $JAMES->page_exp();
}
else
{
    $JAMES->ams_redirect("./index.php");
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


    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    
    <!-- bootstrap icon-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&display=swap" rel="stylesheet">

    <!-- css -->
    <link rel="stylesheet" href="./css/template.css">
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/modal.css">
    <link rel="stylesheet" href="./css/loader.css">
    <link rel="stylesheet" href="./css/style.css">

    <!--javaScript-->
    <script src="./js/authentication/resetpassword.js" type="text/javascript" defer=true></script>
    
    <noscript>Your browser does not support Javascript!</noscript>

    <!--jquery file-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- page information-->
    <title>AMS | Reset password</title>
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

                           <div id ="resetpassword">

                                <p class ="unselectable" style="text-align:center;text-decoration:none;color:red;margin-top:10px;font-size:0.9em;"> Do not refresh/leave the page until you reset your password.</p>
                                
                                <h2 class="text-center page-title unselectable form-header" style="font-size: 22px;margin-top:15px;" >Reset password</h2>
                                <!-- Logo,Header and title : End-->

                                <!-- Form : Start -->
                                <form class="pt-3">
                                <!-- Error message :Start -->
                                    <div class="alert alert-danger error-message" id="error-message">
                                        <ul class="message" id="message" style="list-style-type:none;"></ul>
                                    </div>
                                <!-- Error message : End --> 

                                    <div class="form-group psd-icon">
                                        <i class="bi bi-eye-slash fa-lg eye-icon" id="togglePassword1"></i>
                                        <input type="password" autofocus="true" id="password1" minlength="8" maxlength="16" class="form-control form-control-lg fieldstyle password" placeholder="Enter new password">
                                    </div>

                                    <div class="form-group psd-icon">
                                        <i class="bi bi-eye-slash fa-lg eye-icon" id="togglePassword2"></i>
                                        <input type="password"  id="password2" onpaste="return false;" ondrop="return false;" autocomplete="off" minlength="8" maxlength="16" class="form-control form-control-lg fieldstyle password" placeholder="Confirm new password">
                                        <input type="hidden" id="csrfToken" onpaste="return false;" ondrop="return false;" autocomplete="off" name="_csrfToken" value="<?php echo $JAMES->generateCsrfToken();?>">
                                    </div>

                                    <div class="mt-2 text-center">
                                        <input type="button" id="resetpasswordbtn" class="btn btn-primary btn-icon-text" style="width:165px;" value="Reset"></input>
                                    </div>
                                </form>
                                <!-- Form : End -->

                            </div>
                            
                            <!-- Loading Screen : Start -->
                                                                
                            <div class="loader" id="loading">
                                <div class="duo duo1">
                                <div class="dot dot-a"></div>
                                <div class="dot dot-b"></div>
                                </div>
                                <div class="duo duo2">
                                <div class="dot dot-a"></div>
                                <div class="dot dot-b"></div>
                                </div>
                            </div>

                            <!-- Loading Screen : End -->
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <!-- modal -->
    <div id="modal" class="modal">
    <!-- modal content -->
    <div class="modal-content" style="width:360px;">
            <span class="close">&times;</span>
            <p class="msg unselectable">Your password has been successfully updated.</p>
            <div class="row" style="margin:auto;margin-bottom:30px;">
            <button id="yes-button" class="modal-btn">Login</button>
     </div>
    </div>
</div>
</body>
</html>