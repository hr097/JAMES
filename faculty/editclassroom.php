<?php

require_once("../ams.php");
$JAMES = new AMS("Admin");
$JAMES->init_user_session();

if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="2"))
{
 $JAMES->ams_redirect("../login.php");
}

$classroomid = $_GET['classroomid'];
//@query 
$sql = "select S.* from Students S,Ams_setup_students_map ASSM where ASSM.spid=S.spid and ams_setup_id=$classroomid;"; 
$result = mysqli_query($JAMES->connection(),$sql);

//@change colors
   
    $student_list = "";

    if(mysqli_num_rows($result)>=1)
    {
        while($record = mysqli_fetch_assoc($result))
        {            
          $student_list.=
          "
          <tr id='".$record['spid']."'>
            <td>".$record["spid"]."</td>
            <td>".$record["name"]."</td>
            <td>".$record["email"]."</td>
            <td>".$record["gender"]."</td>
            <td>".$record["dob"]."</td>
            <td>
              <button type='button' id='".$record['spid']."' class='btn btn-danger ti-trash removestudent'></button>
            </td>
          </tr>
          ";
        }
    }
    else
    {
        $student_list.="<tr><td  colspan='6' style='font-size:1.2em;text-align:center;'>No Student Enrollment!</td></tr>";
    }


?>

<!DOCTYPE html>
<html lang="en">

<head>
          <!-- including footer -->
          <?php
          include './common/header.php'
        ?>

        <!-- Page info -->
        <title>AMS | Edit Classroom</title>

        <!-- css  -->
        <link rel="stylesheet" href="../css/faculty.css">

        <!-- js  -->
        <script src="../js/faculty/editclassroom.js" type="text/javascript" defer=true></script>
</head>

<body>
      <!-------------------------------------------------------Main Content------------------------------------------------------->

      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
          <button type='button' onclick="window.history.back()" style="verticle-align:middle;padding:9px;width:90px;height:40px;float:left;position:relative;bottom:10px;display:inline;border-radius:12px;" class='btn form-control btn-primary btn-icon-text ml-3 mb-3'>
                                                            
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg>
            Back
         </button>
         
            <div class="col-md-12  grid-margin stretch-card">

              <!-- Add Student Start -->

              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add Student</h4>
                  <form class="forms-sample">

                    <!-- Student Spid & Search Button-->
                    <div class="row">
                      <div class="col-lg-7 col-md-7 col-sm-12">

                        <div class="form-group">
                          <label>Student SPID</label>
                          <input type="text" class="form-control" id="Stud_spid" placeholder="Enter student SPID">
                        </div>

                      </div>
                      <div class="form-group search_fetch_btn col-lg-5 col-md-5 col-sm-12">
                        <button type="button" id="search" class="btn btn-primary mr-2 mt-3">Search
                        </button>
                        <button type="button" id="fetchall" class="btn btn-primary mr-2 mt-3">Fetch All
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
                                <tbody id="searchstudent">
                                  <!--
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
                                  </tr> -->

                                   <tr>
                                   <td  colspan="7" style='font-size:1.2em;text-align:center;'>No Student Data</td>
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
                          <th>Name</th>
                          <th>Email Address</th>
                          <th>Gender</th>
                          <th>Birthdate</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody id="listofstudents">
                        <?php echo $student_list; ?>
                        <!-- <tr>
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
                        </tr> -->

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

 
  </script>

   <!-- including footer -->
   <?php
    include './common/footer.php'
    ?>
</body>

</html>