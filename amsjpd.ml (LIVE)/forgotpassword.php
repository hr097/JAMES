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

?>

<!DOCTYPE html>
<html lang="en-IN">

<head>

    <!-- Meta data about page -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Search Engine use -->  
    <meta name="author" content="Team JPD-AMS"/>
    <meta name="description" content="An efficient and relible Attendance Management System for J.P. Dower Institute of Information Science and Technology"/>
    <meta name="key words" content="JPD AMS,Attendance Management System,J.P. Dower Institute of Information Science and Technology"/>

    <!--bootstrap-->
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
    <link rel="stylesheet" href="./css/loader.css">
    <link rel="stylesheet" href="./css/style.css">

    <!--javaScript-->
    <script src="./js/togglepassword.js" type="text/javascript" defer=true></script>
    <script src="./js/authentication/forgotpassword.js" type="text/javascript" defer=true></script>
    <noscript>Your browser does not support Javascript!</noscript>

    <!--jquery file-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- page information and favicon-->
    <title>AMS | Forgot password</title>
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
                                <h2 class="mt-3 title unselectable form-header">J.P.Dawer | AMS</h2>
                            </div>

                            <!-- Request otp page : Start -->
                            <div id="requestotp"> 
                                <p class="text-center page-title unselectable form-header">6 digit OTP code will be sent for verification</p>
                            
                                <form class="pt-3" autocomplete="on" action="#">
                                    <div class="form-group">
                                    <!-- Error message -->
                                    <div class="alert alert-danger error-message" id="error-message">
                                                <ul class="message" id="message" style="list-style-type:none;"></ul>
                                    </div>

                                        <input type="text" autofocus="true" class="form-control form-control-lg fieldstyle" id="txtemail"
                                            placeholder="Enter your registered email">
                                            <input type="hidden" id="csrfToken" name="_csrfToken" value="<?php echo $JAMES->generateCsrfToken();?>"> 
                                    </div>


                                    <!-- Error code div here -->

                                    <div class="mt-2 text-center">
                                        <button type="button" class="btn btn-primary btn-icon-text"
                                            style="width: 150px;" id="requestotpbtn">Request OTP</button>
                                           <br><br>
                                           <a href="./logout.php"  class="page-title unselectable" style="color:#4815a8;text-decoration:underline;text-align:center;" target="_self">Back to login</a>
                                    </div>
                                </form>
                                <br>
                                <!-- <details>
                                <summary class="unselectable" style="font-size:0.8em;">Need help to find registered email?</summary> -->
                                    <p class ="unselectable" style="text-align:center;text-decoration:underline;color:black;margin-top:10px;font-size:0.7em;"><span style="font-weight:bold;">NOTE:</span> registered email is the same as username.</p>
                                <!-- </details> -->
                            </div>
                            <!-- Request otp page : End -->

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

                            <!-- Enter otp page : Start -->

                            <div id="enterotp">
                                <p class="text-center page-title unselectable form-header" style="font-size: 22px;">OTP Verification</p>
                                <p class="otpmsg unselectable" style="text-align:center;font-size:0.9em;"> 6 digit code has been sent to your registered email account</p>
                                
                                <form class="pt-3 text-center" style="margin-top:10px;">
                                
                                    <!-- Error message -->
                                    <div class="alert alert-danger error-message" id="error-message">
                                    <ul class="message" id="message" style="list-style-type:none;"></ul>
                                    </div>

                                    <div class="form-group psd-icon">
                                        <i class="bi bi-eye-slash fa-lg eye-icon" id="togglePassword"></i>
                                        <input autofocus="true" type="password" id="password" minlength=6 maxlength="6" class="form-control form-control-lg fieldstyle" placeholder="Enter code here">
                                        <br>
                                        <a id="resendotplink" class="page-title unselectable" style="color:black;text-decoration:none;text-align:center;font-size:0.9em;"></a>
                                    </div>
                                
                                    <!-- Error code div here -->
 
                                    <div class="mt-2 text-center">
                                        <input type="button" id="submitotpbtn" class="btn btn-primary btn-icon-text"
                                            style="width: 150px;" value="Submit">
                                    </div>
                                </form>
                            </div>

                            <!-- Enter otp page : End -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>