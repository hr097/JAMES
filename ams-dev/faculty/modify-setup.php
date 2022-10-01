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
            <div class="col-md-12  grid-margin stretch-card">


              <!-- Add Student Start -->

              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add Student</h4>
                  <form class="forms-sample">

                    <!-- Student Spid & Search Button-->
                    <div class="row">
                      <div class="col-md-10">

                        <div class="form-group">
                          <label>Student SPID</label>
                          <input type="text" class="form-control" id="Stud_spid" placeholder="Enter student SPID">
                        </div>

                      </div>
                      <div class="form-group col-md-2 " style="margin-top:14px;">
                        <button type="button" id="search" class="btn btn-primary mr-2 mt-3" onclick="Search()">Search
                        </button>
                      </div>
                    </div>
                    <hr>

                    <!-- Student Add data Start -->
                    <div class="card" id="add_stud_tbl">
                      <div class="card-body">
                        <h4 class="card-title">Student Details</h4>
                        <div class="row">
                          <div class="col-12">
                            <div class="table-responsive">
                              <table id="order-listing1" class="table">
                                <thead>
                                  <tr>
                                    <th>Select</th>
                                    <th>SPID</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last name</th>
                                    <th>Email Address</th>
                                    <th>Gender</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td><input type="checkbox" id="edit_chkbox" autocomplete="off"></td>
                                    <td>2019008990</td>
                                    <td>Ghevariya</td>
                                    <td>Archit</td>
                                    <td>Nareshbhai</td>
                                    <td>ghevariyaarchit3@gmail.com</td>
                                    <td>Male</td>
                                  </tr>

                                  <tr>
                                    <td><input type="checkbox" id="edit_chkbox" autocomplete="off"></td>
                                    <td>2019008991</td>
                                    <td>Ramani</td>
                                    <td>Harshil</td>
                                    <td>Shaileshbhai</td>
                                    <td>harshilramani9777@gmail.com</td>
                                    <td>Male</td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--Student Add Data End-->

                    <button type="submit" class="btn btn-primary mr-2 mt-3">Add Student </button>
                    <button class="btn btn-light mt-3">Clear</button>
                  </form>
                </div>
              </div>
            </div>

          </div>

          <!-- Add Student End -->

          <!--Student Modify Data Start-->
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Student Data</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                          <th>SPID</th>
                          <th>First Name</th>
                          <th>Middle Name</th>
                          <th>Last name</th>
                          <th>Email Address</th>
                          <th>Gender</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>2019008990</td>
                          <td>Ghevariya</td>
                          <td>Archit</td>
                          <td>Nareshbhai</td>
                          <td>ghevariyaarchit3@gmail.com</td>
                          <td>Male</td>
                          <td>
                            <button type="button" class="btn btn-danger ti-trash" onclick="DeleteRow()"></button>
                          </td>
                        </tr>
                        <tr>
                          <td>2019008991</td>
                          <td>Ramani</td>
                          <td>Harshil</td>
                          <td>Shaileshbhai</td>
                          <td>harshilramani9777@gmail.com</td>
                          <td>Male</td>
                          <td>
                            <button type="button" class="btn btn-danger ti-trash" onclick="DeleteRow()"></button>
                          </td>
                        </tr>
                        <tr>
                          <td>2019008992</td>
                          <td>Ghevariya</td>
                          <td>Archit</td>
                          <td>Nareshbhai</td>
                          <td>ghevariyaarchit3@gmail.com</td>
                          <td>Male</td>
                          <td>
                            <button type="button" class="btn btn-danger ti-trash" onclick="DeleteRow()"></button>
                          </td>
                        </tr>
                        <tr>
                          <td>2019008993</td>
                          <td>Ghevariya</td>
                          <td>Archit</td>
                          <td>Nareshbhai</td>
                          <td>ghevariyaarchit3@gmail.com</td>
                          <td>Male</td>
                          <td>
                            <button type="button" class="btn btn-danger ti-trash" onclick="DeleteRow()"></button>
                          </td>
                        </tr>
                        <tr>
                          <td>2019008994</td>
                          <td>Ghevariya</td>
                          <td>Archit</td>
                          <td>Nareshbhai</td>
                          <td>ghevariyaarchit3@gmail.com</td>
                          <td>Male</td>
                          <td>
                            <button type="button" class="btn btn-danger ti-trash" onclick="DeleteRow()"></button>
                          </td>
                        </tr>
                        <tr>
                          <td>2019008995</td>
                          <td>Ghevariya</td>
                          <td>Archit</td>
                          <td>Nareshbhai</td>
                          <td>ghevariyaarchit3@gmail.com</td>
                          <td>Male</td>
                          <td>
                            <button type="button" class="btn btn-danger ti-trash" onclick="DeleteRow()"></button>
                          </td>
                        </tr>
                        <tr>
                          <td>2019008996</td>
                          <td>Ghevariya</td>
                          <td>Archit</td>
                          <td>Nareshbhai</td>
                          <td>ghevariyaarchit3@gmail.com</td>
                          <td>Male</td>
                          <td>
                            <button type="button" class="btn btn-danger ti-trash" onclick="DeleteRow()"></button>
                          </td>
                        </tr>
                        <tr>
                          <td>2019008997</td>
                          <td>Ghevariya</td>
                          <td>Archit</td>
                          <td>Nareshbhai</td>
                          <td>ghevariyaarchit3@gmail.com</td>
                          <td>Male</td>
                          <td>
                            <button type="button" class="btn btn-danger ti-trash" onclick="DeleteRow()"></button>
                          </td>
                        </tr>
                        <tr>
                          <td>2019008998</td>
                          <td>Ghevariya</td>
                          <td>Archit</td>
                          <td>Nareshbhai</td>
                          <td>ghevariyaarchit3@gmail.com</td>
                          <td>Male</td>
                          <td>
                            <button type="button" class="btn btn-danger ti-trash" onclick="DeleteRow()"></button>
                          </td>
                        </tr>
                        <tr>
                          <td>2019008999</td>
                          <td>Ghevariya</td>
                          <td>Archit</td>
                          <td>Nareshbhai</td>
                          <td>ghevariyaarchit3@gmail.com</td>
                          <td>Male</td>
                          <td>
                            <button type="button" class="btn btn-danger ti-trash" onclick="DeleteRow()"></button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--Student Modify Data End-->
        </div>
      </div>
    </div>
  </div>

  <script>

    // Delete Table Row
    function DeleteRow(o) {
      var td = event.target.parentNode;
      var tr = td.parentNode; // the row to be removed
      tr.parentNode.removeChild(tr);
    }

    // document.getElementById('add_stud_tbl').style.display = "none";
    // Search Student
    function Search() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("Stud_spid");
      filter = input.value.toUpperCase();
      table = document.getElementById("order-listing1");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }
  </script>

   <!-- including footer -->
   <?php
    include './common/footer.php'
    ?>
</body>

</html>