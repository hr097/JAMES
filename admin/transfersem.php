<?php

require_once("../ams.php");
$JAMES = new AMS("Admin");
$JAMES->init_user_session();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- including header -->
    <?php
    require_once('./common/header.php');
?>

    <!-- js  -->
    <script src="../js/admin/feedbackstats.js" type="text/javascript" defer=true></script>

    <!-- page information-->
    <title>AMS | Transfer Student</title>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12  col-md-12  col-lg-12  grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Select Classroom</h4>
                            <form class="forms-sample">

                                <!-- <input type="hidden" id="csrfToken" name="_csrfToken" value="<?php echo $JAMES->generateCsrfToken();?>" > -->

                                <div class="form-group">
                                        <label for="course_name">Course Name</label>
                                        <select id="course_name" class="form-control">
                                            <option>Select Course Name</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                        <label for="semester">Semester</label>
                                        <select id="semester" class="form-control">
                                            <option>Select Semester</option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                            <option>6</option>
                                            <option>7</option>
                                            <option>8</option>
                                            <option>9</option>
                                            <option>10</option>
                                        </select>
                                    </div>

                                <button type="button" id="" class="btn btn-primary mr-2 mt-3">Transfer</button>
                                <button class="btn btn-light mt-3">Clear</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!--Course Registration Form End-->

            
            </div>
        </div>
    </div>


</head>

<body>

    <!-- including footer -->
    <?php
require_once('./common/footer.php');
?>

</body>

</html>