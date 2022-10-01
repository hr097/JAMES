<!DOCTYPE html>
<html lang="en">

<head>
          <!-- including footer -->
          <?php
          include './common/header.php'
        ?>

        <!-- Page info -->
        <title>AMS | Student</title>

        <!-- css  -->
        <link rel="stylesheet" href="../css/faculty.css">
</head>

<body>
      <!-------------------------------------------------------Main Content------------------------------------------------------->
      <div class="main-panel">
        
        <div class="content-wrapper">
          

          <div class="row">
            
            <!-------------------------------------------------------Table Start------------------------------------------------------->
            <div class="col-lg-12 grid-margin">
              <button type="button" class="btn btn-primary btn-icon-text mb-3" id="selectclass">
                <i class="ti-pencil btn-icon-prepend"></i>
                Take Attendance
              </button>
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Student Attendance</h4>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="order-listing" class="table" id="tbl">
                          <thead>
                            <tr>
                              <th>SPID</th>
                              <th>Full Name</th>
                              <th>Present</th>
                              <th>Absent</th>
                              <th>Percentage</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>2020049846</td>
                              <td>Naruto</td>
                              <td>10</td>
                              <td>5</td>
                              <td>80%</td>
                            </tr>
                            <tr>
                              <td>2020049846</td>
                              <td>Naruto</td>
                              <td>10</td>
                              <td>5</td>
                              <td>80%</td>
                            </tr>
                            <tr>
                              <td>2020049846</td>
                              <td>Naruto</td>
                              <td>10</td>
                              <td>5</td>
                              <td>80%</td>
                            </tr>
                            <tr>
                              <td>2020049846</td>
                              <td>Naruto</td>
                              <td>10</td>
                              <td>5</td>
                              <td>80%</td>
                            </tr>
                            <tr>
                              <td>2020049846</td>
                              <td>Naruto</td>
                              <td>10</td>
                              <td>5</td>
                              <td>80%</td>
                            </tr>
                            <tr>
                              <td>2020049846</td>
                              <td>Naruto</td>
                              <td>10</td>
                              <td>5</td>
                              <td>80%</td>
                            </tr>
                            <tr>
                              <td>2020049846</td>
                              <td>Naruto</td>
                              <td>10</td>
                              <td>5</td>
                              <td>80%</td>
                            </tr>
                            <tr>
                              <td>2020049846</td>
                              <td>Naruto</td>
                              <td>10</td>
                              <td>5</td>
                              <td>80%</td>
                            </tr>
                            <tr>
                              <td>2020049846</td>
                              <td>Naruto</td>
                              <td>10</td>
                              <td>5</td>
                              <td>80%</td>
                            </tr>
                            <tr>
                              <td>2020049846</td>
                              <td>Naruto</td>
                              <td>10</td>
                              <td>5</td>
                              <td>80%</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <!--Table End-->
        </div>
      </div>
    </div>
</div>
</div>
</div>
</div>
</div>

  <script>
    $(document).ready(function(){
    $("#selectclass").click(function(){
        window.location.href = "./select_class.php";
      });
  });
</script>

  <!-- including footer -->
    <?php
    include './common/footer.php'
    ?>
  
  
</body>

</html>