<?php

// require_once("../ams.php");
// $JAMES = new AMS("User");
// $JAMES->init_user_session();

// if (!($JAMES->checkSession()&&$_SESSION["_userType"]==="1")) {
//     $JAMES->ams_redirect("../login.php");
// }

// $u = $_SESSION["_userId"];

// //@query
// $sql = "select *,DATE_FORMAT(dob,'%d-%m-%Y')AS dob from vw_students where email='$u';";
// $result = mysqli_query($JAMES->connection(), $sql);

// if (mysqli_num_rows($result)===1) {
//     $user = mysqli_fetch_assoc($result);
// } else {
//     $JAMES->ams_redirect("../login.php");
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- including header -->
    <?php
    require_once('./common/header.php');
?>

    <!-- css  -->
    <link rel="stylesheet" href="../css/faculty.css">

    <!-- page information-->
    <title>AMS | Feedback</title>

</head>

<body>


    <!-------------------------------------------------------Main Content Start------------------------------------------------------->

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12  grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Feedback</h4>
                            <form class="forms-sample">

                                <div class="feedback-star-div">
                                    <ul class="rate-area">
                                        <input type="radio" id="5-star" name="rating" value="5" /><label for="5-star"
                                            title="Amazing">5 stars</label>
                                        <input type="radio" id="4-star" name="rating" value="4" /><label for="4-star"
                                            title="Good">4 stars</label>
                                        <input type="radio" id="3-star" name="rating" value="3" /><label for="3-star"
                                            title="Average">3 stars</label>
                                        <input type="radio" id="2-star" name="rating" value="2" /><label for="2-star"
                                            title="Not Good">2 stars</label>
                                        <input type="radio" id="1-star" name="rating" value="1" /><label for="1-star"
                                            title="Bad">1 star</label>
                                    </ul>

                                </div>
                                <!-- Subject -->
                                <div class="form-group">
                                    <input type="textarea" class="form-control feedback-textarea"
                                        placeholder="Enter your feedback">
                                </div>

                                <button type="submit" class="btn btn-primary mr-2 mt-3">Submit</button>
                                <button class="btn btn-light mt-3">Clear</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!--Faculty Form End-->
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