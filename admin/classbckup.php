<?php

require_once("../ams.php");
$JAMES = new AMS("Admin");
$JAMES->init_user_session();

// if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="3"))
// {
//  $JAMES->ams_redirect("../login.php");
// }

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
    <title>AMS | Class Backup</title>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12  col-md-12  col-lg-12  grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Student Search</h4>
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

                                <!-- Total Semester-->
                                <div class="form-group">
                                    <label for="division">Div</label>
                                    <select id="division" class="form-control">
                                            <option>Select Division</option>
                                            <option>A</option>
                                            <option>B</option>
                                            <option>C</option>
                                            <option>D</option>
                                            <option>E</option>
                                            <option>F</option>
                                            <option>G</option>
                                            <option>H</option>
                                            <option>I</option>
                                        </select>
                                </div>
                    

                                <button type="button" id="" class="btn btn-primary mr-2 mt-3">Search</button>
                                <button class="btn btn-light mt-3">Clear</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!--Course Registration Form End-->

                <div class="col-sm-12  col-md-12  col-lg-12  grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Backup Student</h4>
                            <form class="forms-sample">

                                <!-- FID and Role -->
                                <div class="row">
                                    <div class="form-group col-md-10">
                                        <label>Search SPID</label>
                                        <input type="text" class="form-control" placeholder="Enter Student SPID">
                                    </div>

                                    <div class="form-group col-md-2 ">
                                        <button type="button" id=""
                                            class="btn btn-primary searchbtn mt-4">Search</button>
                                    </div>
                                </div>

                            </form>

                            <div class="table-responsive mt-4">
                                <table id="" class="table">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" class="mr-3">Select All</th>
                                            <th>SPID</th>
                                            <th>Student Name</th>
                                            <th>Student Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="checkbox" class="mr-3"></td>
                                            <td>202003456</td>
                                            <td>Archit Ghevariya</td>
                                            <td>archit@gmail.com</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button type="button" id=""class="btn btn-primary mr-2 mt-3">Backup Students</button>
                            <button type="reset" class="btn btn-light mt-3">Clear</button>
                        </div>
                    </div>
                </div>

                <!-- Course Updation End -->

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