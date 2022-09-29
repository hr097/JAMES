<!DOCTYPE html>
<html lang="en">

<head>
          <!-- including footer -->
          <?php
          include './common/header.php'
        ?>

        <!-- Page info -->
        <title>AMS | Student Attendance</title>

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

              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Subject Attendance</h4>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="order-listing" class="table" id="tbl">
                          <thead>
                            <tr>
                              <th>Mark</th>
                              <th>SPID</th>
                              <th>Full Name</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><input type="checkbox" id="edit_chkbox" autocomplete="off"></td>
                              <td>2020049846</td>
                              <td>Naruto</td>
                            </tr>
                            <tr>
                              <td><input type="checkbox" id="edit_chkbox" autocomplete="off"></td>
                              <td>2020049846</td>
                              <td>Sasuke</td>
                            <tr>
                              <td><input type="checkbox" id="edit_chkbox" autocomplete="off"></td>
                              <td>2020049846</td>
                              <td>Lee</td>
                            </tr>
                            <tr>
                              <td><input type="checkbox" id="edit_chkbox" autocomplete="off"></td>
                              <td>2020049846</td>
                              <td>Neji</td>
                            </tr>
                            <tr>
                              <td><input type="checkbox" id="edit_chkbox" autocomplete="off"></td>
                              <td>2020049846</td>
                              <td>Sakura</td>
                            </tr>
                            <tr>
                              <td><input type="checkbox" id="edit_chkbox" autocomplete="off"></td>
                              <td>2020049846</td>
                              <td>Shikamaru</td>          
                            </tr>
                            <tr>
                              <td><input type="checkbox" id="edit_chkbox" autocomplete="off"></td>
                              <td>2020049846</td>
                              <td>Choji</td>
                            </tr>
                            <tr>
                              <td><input type="checkbox" id="edit_chkbox" autocomplete="off"></td>
                              <td>2020049846</td>
                              <td>Kakashi</td>
                            </tr>
                            <tr>
                              <td><input type="checkbox" id="edit_chkbox" autocomplete="off"></td>
                              <td>2020049846</td>
                              <td>Guy</td>
                            </tr>
                            <tr>
                              <td><input type="checkbox" id="edit_chkbox" autocomplete="off"></td>
                              <td>2020049846</td>
                              <td>Tenten</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <!--Table End-->
                
        </div>
      </div>
      
    </div>
    <div class="d-flex justify-content-end">
    <button type="button" class="btn btn-primary btn-icon-text mb-3" id="attendancesubmit">
      Submit Attendance
    </button>
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