<?php
require_once("../ams.php");
$JAMES = new AMS("Admin");
$JAMES->init_user_session();

if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="2"))
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

        <!-- Page info -->
        <title>AMS | Archived Classrooms</title>

        <!-- css  -->
        <link rel="stylesheet" href="../css/faculty.css">
</head>

<body>
            <!-------------------------------------------------------Main Content------------------------------------------------------->
        
            <!--Subeject Setup Form Start-->
             <div class="main-panel">
                <div class="content-wrapper">
                    <div class="col-md-12 mb-4">

                    <h4 class="font-weight-bold mb-3">Archived Classrooms</h4>

                    <!-- Classroom sorting --> 
                    <div class="row">

                    <div class="form-group col-md-3">
                            <label>Year</label>
                            <select class="form-control">
                                <option>2022</option>
                                <option>2021</option>
                            </select>
                        </div>

                    <div class="form-group col-md-3 ">
                        <label>Course</label>
                        <select class="form-control">
                            <option>IT</option>
                            <option>ICT</option>
                        </select>
                    </div>

                    <div class="form-group col-md-3 ">
                        <label>Semester</label>
                        <select class="form-control">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                        </select>
                    </div>

                    <div class="form-group col-md-3 ">
                        <label>Division</label>
                        <select class="form-control">
                            <option>A</option>
                            <option>B</option>
                            <option>C</option>
                            <option>D</option>
                        </select>
                    </div>

                    </div>
                    <div class="col-md-12 grid-margin transparent">
                        <div class="row">
                          <div class="col-md-3 mb-2 stretch-card transparent lblmargin handpointer" onclick="subopen()">
                            <div class="card card-dark-blue ">
                              <div class="card-body">
                                <p class="mb-4 subfont">Web Development</p>
                                <p>Semester :-  4th</p>
                                <p>Division :-  A</p>
                              </div>
                            </div>
                          </div>
            
                          <div class="col-md-3 mb-2 stretch-card transparent handpointer" onclick="subopen()">
                            <div class="card card-tale">
                              <div class="card-body">
                                <p class="mb-4 subfont">RDBMS</p>
                                <p>Semester :-  4th</p>
                                <p>Division :-  B</p>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-3 mb-2 stretch-card transparent handpointer" onclick="subopen()">
                            <div class="card card-light-danger">
                              <div class="card-body">
                                <p class="mb-4 subfont">IOT</p>
                                <p>Semester :-  4th</p>
                                <p>Division :-  A</p>
                              </div>
                            </div>
                          </div>
                          
                          <div class="col-md-3 mb-2 stretch-card transparent handpointer" onclick="subopen()">
                            <div class="card card-dark-blue bg-warning">
                              <div class="card-body">
                                <p class="mb-4 subfont">Environmental Science</p>
                                <p>Semester :-  5th</p>
                                <p>Division :-  A</p>
                              </div>
                            </div>
                          </div>
            
                        </div>
                      </div>
                    </div>
                  </div>
                        <!--Faculty Form End-->
                    </div>
                </div>
<!--Subject Page Open Start-->
<script>
    function subopen() {
      window.location = "./modify-setup.php";
    }
  </script>
  <!--Subject Page Open End-->



    <!-- including footer -->
    <?php
    include './common/footer.php'
    ?>
</body>

</html>