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
    <title>AMS | Reader Regisration</title>

</head>

<body>
    <!-------------------------------------------------------Main Content------------------------------------------------------->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12  col-md-12  col-lg-12  grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">AMS Reader Regisration</h4>
                            <form class="forms-sample">

                                <!-- <input type="hidden" id="csrfToken" name="_csrfToken" value="<?php echo $JAMES->generateCsrfToken();?>" > -->

                                <!-- FID and Role -->
                                <div class="row">
                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>Reader ID</label>
                                        <input type="text" class="form-control" placeholder="Enter Reader Id">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Reader No</label>
                                        <input type="number" class="form-control" placeholder="Enter Reader No">
                                    </div>
                                </div>


                                <button type="button" id="" class="btn btn-primary mr-2 mt-3">Add Reader</button>
                                <button class="btn btn-light mt-3">Clear</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!--Reader Registration Form End-->

                <div class="col-sm-12  col-md-12  col-lg-12  grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Reader</h4>
                            <form class="forms-sample">

                                <!-- FID and Role -->
                                <div class="row">
                                    <div class="form-group col-md-10">
                                        <label>Search Reader</label>
                                        <input type="text" class="form-control" placeholder="Enter Reader Id">
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
                                            <th>Reader ID</th>
                                            <th>Reader No</th>
                                            <th>Update & Delete</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>No data</td>
                                            <td>No data</td>
                                            <td>
                                                <button type='button' class='btn updatebtn rounded px-3 py-2 mr-2'><i
                                                        class="ti-pencil"></i></button>
                                                <button type='button' class='btn btn-danger rounded px-3 py-2'><i
                                                        class="ti-trash"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Reader Updation End -->

            </div>
        </div>
    </div>


    <!-- including footer -->
    <?php
require_once('./common/footer.php');
?>

</body>

</html>