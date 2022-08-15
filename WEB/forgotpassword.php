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

                            <!-- Request otp page -->
                            <div id="requestotp"> 
                                <p class="text-center forgot-page-title unselectable">Enter your registered email</p>
                                <form class="pt-3">

                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-lg fieldstyle" id="txtemail"
                                            placeholder="Enter your email">
                                    </div>

                                    <!-- Error code div here -->

                                    <div class="mt-2 text-center">
                                        <button type="button" class="btn btn-primary btn-icon-text"
                                            style="width: 150px;" onclick="validate()" id="requestotpbtn">Request OTP</button>
                                    </div>

                                </form>
                            </div>

                            <!-- Enter otp page -->
                            <div id="enterotp">
                                <p class="text-center forgot-page-title unselectable" style="font-size: 25px;">Enter OTP</p>
                                <p class="otpmsg unselectable">A 6-digit OTP has been sent to your email address</p>
                                <form class="pt-3">

                                    <div class="form-group">
                                        <input type="number" class="form-control form-control-lg fieldstyle" placeholder="Enter 6-digit OTP">
                                    </div>

                                    <!-- Error code div here -->

                                    <div class="mt-2 text-center">
                                        <button type="button" class="btn btn-primary btn-icon-text"
                                            style="width: 150px;" onclick="validate()">Submit</button>
                                    </div>
                                    
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>


<script type="text/javascript">
    /*--jquery */
   
    // Request OTP and enter otp page toggle
    $(document).ready(function () {
        $("#enterotp").hide();
        $("#requestotpbtn").click(function () {
            $("#requestotp").hide();
            $("#enterotp").show();
        });
    });


    /* Javascript */

</script>

</html>