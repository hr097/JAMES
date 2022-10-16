<!DOCTYPE html>
<html lang="en">

<head>

    <!-- including header -->
    <?php
    include './common/header.php'
    ?>

    <!-- css  -->
    <link rel="stylesheet" href="../css/faculty.css">

    <!-- Page information -->
    <title>AMS | Faculty Dashboard</title>


</head>

<body>
       <!-------------------------------------------------------Main Content------------------------------------------------------->
       <div class="main-panel">
        <div class="content-wrapper">
        <div class="row">
             <div class="col-12 col-xl-8 mb-4 mb-xl-50">
                 <h3 class="font-weight-bold">Welcome Sir,</h3>
                 <h6 class="font-weight-normal mb-10">Good Morning, </h6>
             </div>
            
          <!-------------------------------------------------------States------------------------------------------------------->
          <div class="col-md-12 grid-margin transparent">
            <div class="row">
              <div class="col-md-3 mb-2 stretch-card transparent lblmargin handpointer" onclick="subopen()">
                <div class="card card-dark-blue ">
                  <div class="card-body">
                    <p class="mb-2 subfont">IT-2022</p>
                    <p class="mb-4 subfont">Web Development</p>
                    <p>Semester :  4th</p>
                    <p>Division :  A</p>
                  </div>
                </div>
              </div>

              <div class="col-md-3 mb-2 stretch-card transparent handpointer" onclick="subopen()">
                <div class="card card-tale">
                  <div class="card-body">
                  <p class="mb-2 subfont">IT-2022</p>
                    <p class="mb-4 subfont">RDBMS</p>
                    <p>Semester :  4th</p>
                    <p>Division :  A</p>
                  </div>
                </div>
              </div>
              <div class="col-md-3 mb-2 stretch-card transparent handpointer" onclick="subopen()">
                <div class="card card-light-danger">
                  <div class="card-body">
                  <p class="mb-2 subfont">IT-2022</p>
                    <p class="mb-4 subfont">IOT</p>
                    <p>Semester :  4th</p>
                    <p>Division :  A</p>
                  </div>
                </div>
              </div>
              <div class="col-md-3 mb-2 stretch-card transparent handpointer" onclick="subopen()">
                <div class="card card-dark-blue bg-warning">
                  <div class="card-body">
                  <p class="mb-2 subfont">IT-2022</p>
                    <p class="mb-4 subfont">Enviromental Science</p>
                    <p>Semester :  4th</p>
                    <p>Division :  A</p>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

          <!----------------------------------------------Report Generate End---------------------------------------------->
          <!--Subject Page Open Start-->
          <script>
            function subopen() {
              window.location = "./stud.php";
            }
          </script>
          <!--Subject Page Open End-->

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