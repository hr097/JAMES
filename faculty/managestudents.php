<?php

require_once("../ams.php");
$JAMES = new AMS("Admin");
$JAMES->init_user_session();

    if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="2"))
    {
    $JAMES->ams_redirect("../login.php");
    }

    if(isset($_GET['classroomid']))
    {

    //to fetch students who have enrolled in particular classroom
    $classroomid = $_GET['classroomid'];

    //@query 
    $sql = "select S.*,DATE_FORMAT(S.dob,'%d-%m-%Y')AS dob from Students S,Ams_setup_students_map ASSM where ASSM.spid=S.spid and ams_setup_id=$classroomid;"; 
    $result = mysqli_query($JAMES->connection(),$sql);
   
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
              <button type='button' id='".$record['spid']."' class='btn btn-danger ti-trash removestudent px-3 py-2 rounded'></button>
            </td>
          </tr>
          ";
        }
    }
    else
    {
        $student_list.="<tr><td  colspan='6' style='font-size:1.2em;text-align:center;'>No Student Enrollment!</td></tr>";
    }

  }
  else
  {
    $JAMES->ams_redirect("dashboard.php");
  }

 // course fetch
 
  $sql= "select * from Courses;";//query
  $result = mysqli_query($JAMES->connection(),$sql);

  if(mysqli_num_rows($result)>0)
  {
      $course_html = "<div class='form-group col-md-14'><label>Course</label><select name='course_selection' id='course_selection' class='form-control'><option value='Not Selected'>Not Selected</option></option>";

      while($record = mysqli_fetch_assoc($result))
      {
        $course_html.="<option value='".$record['total_semester']."_".$record['course_name']."' >".$record['course_name']."</option>";
      }

      $course_html.="</select></div>";
  }
  else
  {
      $JAMES->ams_redirect("../login.php");
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
        <title>AMS | Manage Students</title>

        <!-- css  -->
        <link rel="stylesheet" href="../css/faculty.css">
        <link rel="stylesheet" href="../css/modal.css">

        <!-- js  -->
        <script src="../js/faculty/managestudents.js" type="text/javascript" defer=true></script>
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
                  <form class="forms-sample" action="editclassroom.php" method="post">

                    <!-- Student Spid & Search Button-->
                    <div class="row" >
                      <div class="col-lg-12 col-md-12 col-sm-12">

                        <div class="form-group">
                          <label>Student SPID</label>
                          <input name="_spid" type="text" class="form-control"  id="Stud_spid" placeholder="Enter student SPID" autocomplete="off">
                        </div>

                      </div>
                      
                      <div class="form-group search_fetch_btn">
                        <!-- <button type="button" id="search" class="btn btn-primary mr-2 mt-3">Search
                        </button> --> 
                        <input type="hidden" id="classroomid" name="_classroomid" value="<?php echo $GLOBALS['classroomid'];?>" >
                        <input type="hidden" id="csrfToken" name="_csrfToken" value="<?php echo $JAMES->generateCsrfToken();?>" >
                      </div>
                    </div>

                    <!-- <hr style="margin-bottom:30px;" class="addStudentHr"> -->
                    <div class="separator">OR</div>

                    
                      <!--Course -->
                    
                      <div class="row">
                          <div class="col-lg-3 col-md-3 col-sm-12">
                            
                          <?php echo $course_html;?>
                          </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <div class="form-group">
                              <label>Current Semester</label>
                              <select id="sem_selection" class="form-control">
                                <option value='0'>Not Selected</option>
                              </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <div class="form-group">
                              <label class="select-text">Division</label>
                              <select id='div_selection' class="form-control">
                                  <option value="Not Selected">Not Selected</option>
                                  <option value="A">A</option>
                                  <option value="B">B</option>
                                  <option value="C">C</option>
                                  <option value="D">D</option>
                                  <option value="E">E</option>
                                  <option value="F">F</option>
                                  <option value="G">G</option>
                                  <option value="H">H</option>
                                  <option value="I">I</option>
                              </select>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-md-3 col-sm-12" style="margin:auto;">
                          <button type="button"  name="_fetchall" id="fetchall" class="btn btn-primary">Fetch All</button>
                        </div>
                      </div>
                      <!--Semester -->
                      
                    <hr class="">

                    <!-- Student Add data Start -->
                    <div class="card" id="add_stud_tbl">
                      <div class="card-body">
                        <h4 class="card-title">Student Details</h4>
                        <div class="row">
                          <div class="col-12">
                            <div class="table-responsive">
                              <table id="order-listing" class="table">
                                <thead>
                                   <tr>
                                    <th><label for="selectall"><input class='m-0' type="checkbox" name="selectall" id="selectall" onclick="toggleSelect(this)"/>&nbsp&nbsp&nbsp Select All</label></th>
                                    <th>SPID</th>
                                    <th>Name</th>
                                    <th>Email Address</th>
                                    <th>Gender</th>
                                    <th>Birthdate</th>
                                  </tr>
                                </thead>
                                <tbody id="searchstudent">
                                   <tr>
                                   <td  colspan="6" style='font-size:1.2em;text-align:center;'>No Student Data</td>
                                   </tr>
                                </tbody>
                              </table>
                            </div>
                            
                          </div>
                        </div>
                      </div>
                    </div>
                    <button type="button" id="addstudents"class="btn btn-primary mr-2 mt-3">Add Students</button>
                    <button type="reset" class="btn btn-light mt-3">Clear</button>
                  </form>
                  <!--Student Add Data End-->
                </div>
              </div>
            </div>
          </div>


          <!-- Add Student End -->

          <!--Student Modify Data Start-->

          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Student Enrollment</h4>
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
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody id="listofstudents">
                        <?php echo $student_list; ?>
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



    <!-- modal -->
    <div id="modal" class="modal">
    <!-- modal content -->
    <div class="modal-content" style="width:360px;">
            <span class="close">&times;</span>
            <p class="msg unselectable" id="modalmsg"></p>
            <div class="row" style="margin:auto;margin-bottom:30px;">
            <button id="yes-button" class="modal-btn"></button>
            <button id="no-button" class="modal-btn">Cancel</button>
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