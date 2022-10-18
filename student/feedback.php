<?php

require_once("../ams.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();

if (!($JAMES->checkSession()&&$_SESSION["_userType"]==="1")) {
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

    <!-- js  -->
    <script src="../js/student/feedback.js" type="text/javascript" defer=true></script>

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
                            <h4 class="card-title">AMS | Feedback</h4>
                            <form class="forms-sample" method="post" action="">

                                <div class="feedback-star-div">
                                    <ul class="rate-area">
                                        <input type="radio"  id="5-star" name="rating" value="5"/><label for="5-star"
                                            title="Outstanding" class="star_css">5 stars</label>
                                        <input type="radio" id="4-star" name="rating" value="4" checked/><label for="4-star"
                                            title="Excellent" class="star_css">4 stars</label>
                                        <input type="radio" id="3-star" name="rating" value="3" /><label for="3-star"
                                            title="Satisfactory" class="star_css">3 stars</label>
                                        <input type="radio" id="2-star" name="rating" value="2" /><label for="2-star"
                                            title="Good" class="star_css">2 stars</label>
                                        <input type="radio" id="1-star" name="rating" value="1" /><label for="1-star"
                                            title="Worst" class="star_css">1 star</label>
                                    </ul>
 
                                </div>
                                <input type="hidden" id="csrfToken" name="_csrfToken" value="<?php echo $JAMES->generateCsrfToken();?>"> 
                                
                                <!-- Subject -->
                                <div class="form-group">
                                    <textarea id="feedbacktxt" name="feedback" oninput="countWord()" class="form-control feedback-textarea"
                                        placeholder="Give your valuable feedback to us" rows="10" maxlength="999" required></textarea>
                                        <div id="counter" class="print_count d-flex justify-content-end">0/999</div>
                                </div>

                                <button type="button" id="submitfeedback" class="btn btn-primary mr-2 mt-3">Submit</button>
                                <button class="btn btn-light mt-3">Clear</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!--Faculty Form End-->
            </div>
        </div>

    </div>

    <!-- modal -->
    <div id="modal" class="modal">
    <!-- modal content -->
    <div class="modal-content" style="width:360px;">
            <span class="close" id="close-btn">&times;</span>
            <p class="msg unselectable" id="modalmsg"></p>
            <div class="row" style="margin:auto;margin-bottom:30px;">
            <button id="yes-button" class="modal-btn"></button>
    </div>
    </div>

    <!-------------------------------------------------------Main Content End------------------------------------------------------->


    <!-- including footer -->
    <?php
require_once('./common/footer.php');
?>



</body>

</html>