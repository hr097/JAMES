<?php

require_once("../ams.php");
$JAMES = new AMS("Admin");
$JAMES->init_user_session();

if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="3"))
{
 $JAMES->ams_redirect("../login.php");
}


if(isset($_GET["spid"]))
{
 echo "<script>alert('stud');</script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- including header -->
    <?php
    require_once('./common/header.php');
?>

    <!-- css -->
    <link rel="stylesheet" href="../css/alert.css">
    
    <link rel="stylesheet" href="../css/modal.css">

    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css'>


    <!-- js  -->
    <script src="../js/admin/studentregistration.js" type="text/javascript" defer=true></script>


    <!-- page information-->
    <title>AMS | Student Registration</title>

</head>

<body>
    <!-------------------------------------------------------Main Content------------------------------------------------------->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12  col-md-12  col-lg-12  grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Student Regisration</h4>
                            <form class="forms-sample" >

                                <input type="hidden" id="csrfToken" name="_csrfToken" value="<?php echo $JAMES->generateCsrfToken();?>" >

                                <!-- SPID and Email -->
                                <div class="row">
                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>SPID</label>
                                        <input type="text" class="form-control" placeholder="XXXXXXXXXX" required>
                                    </div>

                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>Email</label>
                                        <input type="email" class="form-control" placeholder="example@vnsgu.ac.in">
                                    </div>
                                </div>

                                <!-- Name-->
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Student Name">
                                </div>


                                <!-- Gender and DOB -->
                                <div class="row">
                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>Gender</label>
                                        <select class="form-control">
                                            <option>Not Selected</option>
                                            <option>Male</option>
                                            <option>Female</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>DOB</label>
                                        <input type="date" class="form-control" id="" value="">
                                    </div>
                                </div>

                                <!-- Joining year and Contact no -->
                                <div class="row">
                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>Contact No</label>
                                        <input type="number" class="form-control" id="" value=""
                                            placeholder="+91 XXXXXXXXXX">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Joining Year</label>
                                        <input type="date" class="form-control" id="" value="">
                                    </div>
                                </div>

                                <!-- Status-->
                                <div class="form-group mb-5 ">
                                <label>Status</label>
                                    <select class="form-control">
                                            <option>Active</option>
                                            <option>InActive</option>
                                    </select>
                                </div>


                                <!-- Course Details -->
                                <h4 class="card-title mt-4">Course Details</h4>

                                <div class="row">
                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>Course Name</label>
                                        <select class="form-control">
                                            <option>Not Selected</option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>Current Roll No</label>
                                        <input type="number" class="form-control" id="" value=""
                                            placeholder="Enter Roll No">
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>Current Semester </label>
                                        <select class="form-control">
                                            <option>Not Selected</option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>Current Division</label>
                                        <select class="form-control">
                                            <option>Not Selected</option>
                                            <option>A</option>
                                            <option>B</option>
                                            <option>c</option>
                                            <option>D</option>
                                        </select>
                                    </div>
                                </div>


                                <!-- Parent Details -->
                                <h4 class="card-title mt-4">Parent Details</h4>

                                <div class="form-group">
                                    <label>Father's Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Father's Name">
                                </div>


                                <div class="row">
                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>Father's Email</label>
                                        <input type="text" class="form-control" id="" value=""
                                            placeholder="example@gmail.com">
                                    </div>

                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>Father's Contact</label>
                                        <input type="number" class="form-control" id="" value=""
                                            placeholder="+91 XXXXXXXXXX">`
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Mother's Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Mother's Name">
                                </div>


                                <div class="row">
                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>Mother's Email</label>
                                        <input type="text" class="form-control" id="" value=""
                                            placeholder="example@vnsgu.ac.in">
                                    </div>

                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>Mother's Contact</label>
                                        <input type="number" class="form-control" id="" value=""
                                            placeholder="+91 XXXXXXXXXX">
                                    </div>




                                </div>

                                <button type="submit" id="" class="btn btn-primary mr-2 mt-3">Add Student</button>
                                <button class="btn btn-light mt-3">Clear</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!--Student Registration Form End-->

                <div class="col-sm-12  col-md-12  col-lg-12  grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Student</h4>
                            <form class="forms-sample">

                                <!-- FID and Role -->
                                <div class="row">
                                    <div class="form-group col-md-10">
                                        <label>Search Student</label>
                                        <input type="text" id="Stud_spid" minlength="10" maxlength="10" class="form-control" placeholder="Enter Student SPID">
                                    </div>

                                    <div class="form-group col-md-2 ">
                                        <button type="button" id="searchstudentbtn"
                                            class="btn btn-primary searchbtn mt-4">Search</button>
                                    </div>
                                </div>

                            </form>

                            <div class="table-responsive mt-4">
                                <table id="" class="table">
                                    <thead>
                                        <tr>
                                            <th>SPID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Gender</th>
                                            <th>Birthdate</th>
                                            <th>Course</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="searchstudent">
                                        <tr>
                                            <td  colspan='7' style='font-size:1.2em;text-align:center;'>No Data Found</td>
                                           
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


    
    <!-- modal -->
    <div id="modal" class="modal">
    <!-- modal content -->
    <div class="modal-content" style="width:360px;">
            <span class="close">&times;</span>
            <p class="msg unselectable" id="modalmsg"></p>
            <div class="row" style="margin:auto;margin-bottom:30px;">
            <button id="yes-button" class="modal-btn">Okay</button>
            <button id="no-button" class="modal-btn">Cancel</button>
    </div>
    </div>



    <!-- including footer -->
    <?php
require_once('./common/footer.php');
?>
    <script src="../js/admin/alert.js" type="text/javascript" defer=true></script>
</body>


</html>