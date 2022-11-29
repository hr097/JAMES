<?php

 require_once("../ams.php");
 $JAMES = new AMS("Admin");
 $JAMES->init_user_session();


 if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="3"))
 {
  $JAMES->ams_redirect("../login.php");
 }
 
 ?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <!-- including header -->
        <?php
        include './common/header.php'
        ?>

        <!-- css  -->
        <link rel="stylesheet" href="../css/admin.css">
        
        <!-- js  -->
        <script src="../js/admin/dashboard.js" type="text/javascript" defer=true></script>

        <!-- page information-->
        <title>AMS | Admin Dashboard</title>
        
    </head>

    <body>

                <!-------------------------------------------------------Main Content------------------------------------------------------->
                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="row">
                            <div class="col-12 col-xl-8 mb-4 mb-xl-50">
                                <h3 class="font-weight-bold greet">Welcome AMS Admin,</h3>
                                <h6 id="daymode" class="font-weight-normal mb-10"></h6>
                            </div>
                            <div class="col-sm-12  col-md-12  col-lg-12  grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Search Student</h4>
                                        <form class="forms-sample">

                                            <!-- <input type="hidden" id="csrfToken" name="_csrfToken" value="<?php echo $JAMES->generateCsrfToken();?>" > -->

                                            <div class="form-group">
                                                    <label for="spid">SPID</label>
                                                    <input type="text" autocomplete="off" name="studspid" pattern="[0-9]{10}" minlength="10"  maxlength="10" class="form-control" id="studspid" placeholder="XXXXXXXXXX" value=""  required>
                                                </div>

                                            <button type="button" id="" class="btn btn-primary mr-2 mt-3">Search</button>
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12  col-md-12  col-lg-12  grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Student Details</h4>
                                        <div class="table-responsive mt-4">
                                            <table id="order-listing" class="table">
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
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

        <!-- including footer -->
        <?php
        include './common/footer.php'
        ?>

    </body>


</html>

