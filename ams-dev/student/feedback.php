<?php

require_once("../ams.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();

if (!($JAMES->checkSession()&&$_SESSION["_userType"]==="1")) {
    $JAMES->ams_redirect("../login.php");
}

$u = $_SESSION["_userId"];

//@query
$sql = "select *,DATE_FORMAT(dob,'%d-%m-%Y')AS dob from vw_students where email='$u';";
$result = mysqli_query($JAMES->connection(), $sql);

if (mysqli_num_rows($result)===1) {
    $user = mysqli_fetch_assoc($result);
} else {
    $JAMES->ams_redirect("../login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- including header -->
    <?php
    require_once('./common/header.php');
?>

    <!-- css  -->
    <link rel="stylesheet" href="../css/student.css">
    <link rel="stylesheet" href="../css/modal.css">


    <!-- page information-->
    <title>AMS | Feedback</title>

</head>

<body>


    <!-------------------------------------------------------Main Content Start------------------------------------------------------->

    <div class="main-panel">
        <div class="content-wrapper">


            <!--Personal Info-->
            <div class="row">
                <div class="col-md-12 mb-2">
                    <h4 class="font-weight-bold">Feedback</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                        <div class="col-md-12">
                            <input type="textarea" class="feedback-textarea" placeholder="Enter your feedback">
                            <div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-------------------------------------------------------Main Content End------------------------------------------------------->


    <!-- including footer -->
    <?php
require_once('./common/footer.php');
?>



</body>

</html>