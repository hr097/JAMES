<!DOCTYPE html>
<html lang="en">

<head>
        <!-- including header -->
        <?php
          include './common/header.php'
        ?>

        <!-- Page info -->
        <title>AMS | Modify setup</title>

        <!-- css  -->
        <link rel="stylesheet" href="../css/faculty.css">
</head>

<body>
            <!-------------------------------------------------------Main Content------------------------------------------------------->
             <!--Subeject Setup Form Start-->
             <div class="main-panel">
                <div class="content-wrapper">
                    <div class="col-md-12 mb-4">
                        <h4 class="font-weight-bold">Modify Attendance</h4>
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