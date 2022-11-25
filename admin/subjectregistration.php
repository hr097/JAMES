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
    <title>AMS | Subject Registration</title>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12  col-md-12  col-lg-12  grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Subject Registration</h4>
                            <form class="forms-sample">

                                <!-- <input type="hidden" id="csrfToken" name="_csrfToken" value="<?php echo $JAMES->generateCsrfToken();?>" > -->

                                <div class="form-group">
                                        <label for="course_name">Course Name</label>
                                        <select id="course_name" class="form-control">
                                            <option>Select Course Name</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                        <label for="course_name">Semester</label>
                                        <select id="course_name" class="form-control">
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
                                    <label for="sub_code">Subject Code</label>
                                    <input  class="form-control" type="text" id="sub_code" placeholder="Subject Name">
                                </div>
                                <div class="form-group">
                                    <label for="sub_name">Subject Name</label>
                                    <input class="form-control" type="text" id="sub_name" placeholder="Subject Name">
                                </div>

                                <button type="button" id="" class="btn btn-primary mr-2 mt-3">Add Subject</button>
                                <button class="btn btn-light mt-3">Clear</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!--Course Registration Form End-->

                <div class="col-sm-12  col-md-12  col-lg-12  grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Subject</h4>
                            <form class="forms-sample">

                                <!-- FID and Role -->
                                <div class="row">
                                    <div class="form-group col-md-10">
                                        <label>Search Subject</label>
                                        <input type="text" class="form-control" placeholder="Enter Subject Code">
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
                                            <th>Subject Code</th>
                                            <th>Subject Name</th>
                                            <th>Semester</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="4" style="text-align:center;font-size:1.2em;">No data</td>
                                            <!-- <td>
                                                <button type='button' class='btn updatebtn rounded px-3 py-2 mr-2'><i
                                                        class="ti-pencil"></i></button>
                                                <button type='button' class='btn btn-danger rounded px-3 py-2'><i
                                                        class="ti-trash"></i></button>
                                            </td> -->
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

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