<?php

require_once("../ams.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();

if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="2"))
{
 $JAMES->ams_redirect("../login.php");
}

if(isset($_GET['classroomid']))
    {

    //to fetch faculty who have enrolled in particular classroom
    $classroomid = $_GET['classroomid'];
    $fid = $_SESSION['_fid'];

    //@query 
    $sql = "select F.*,DATE_FORMAT(F.dob,'%d-%m-%Y')AS dob from Faculties F,Ams_setup_faculties_map ASFM WHERE ASFM.fid=F.fid AND ams_setup_id=$classroomid AND NOT ASFM.fid ='$fid';"; 
    $result = mysqli_query($JAMES->connection(),$sql);
   
    $faculty_list = "";

    if(mysqli_num_rows($result)>=1)
    {
        while($record = mysqli_fetch_assoc($result))
        {            
          $faculty_list.=
          "
          <tr id='".$record['fid']."'>
            <td>".$record["fid"]."</td>
            <td>".$record["name"]."</td>
            <td>".$record["email"]."</td>
            <td>".$record["gender"]."</td>
            <td>".$record["dob"]."</td>
            <td>
              <button type='button' id='".$record['fid']."' class='btn btn-danger ti-trash removefaculty rounded px-3 py-2'></button>
            </td>
          </tr>
          ";
        }
    }
    else
    {
        $faculty_list.="<tr><td  colspan='6' style='font-size:1.2em;text-align:center;'>No other faculty has access to this classroom.</td></tr>";
    }

  }
  else
  {
    $JAMES->ams_redirect("./classroom.php");
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
        <title>AMS | Add Faculty</title>

        <!-- css  -->
        <link rel="stylesheet" href="../css/faculty.css">
        <link rel="stylesheet" href="../css/modal.css">

        <!-- js  -->
        <script src="../js/faculty/managefaculty.js" type="text/javascript" defer=true></script>
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

              <!-- Add Faculty Start -->

              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add Faculty</h4>
                  <form class="forms-sample">

                    <!-- Faculty Spid & Search Button-->
                    <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">

                        <div class="form-group">
                          <label>Faculty FID</label>
                          <input type="text" minlength="7" maxlength="10" class="form-control" id="Fac_fid" placeholder="Enter FID">
                        </div>

                      </div>
                      <div class="form-group search_fetch_btn col-lg-5 col-md-5 col-sm-12">
                        <!-- <button type="button" id="search" class="btn btn-primary mr-2 mt-3">Search
                        </button>
                        <button type="button" id="fetchall" class="btn btn-primary mr-2 mt-3">Fetch All
                        </button> -->

                        <input type="hidden" id="classroomid" name="_classroomid" value="<?php echo $GLOBALS['classroomid'];?>" >
                        <input type="hidden" id="csrfToken" name="_csrfToken" value="<?php echo $JAMES->generateCsrfToken();?>" >
                      </div>
                    </div>

                    <hr style='margin-top:-30px;'>

                    <!-- Faculty Add data Start -->
                    <div class="card" id="add_stud_tbl">
                      <div class="card-body">
                        <h4 class="card-title">Faculty Details</h4>
                        <div class="row">
                          <div class="col-12">
                            <div class="table-responsive">
                              <table id="order-listing" class="table">
                                <thead>
                                  <tr>
                                  <th><label for="selectall"><input class='m-0' type="checkbox" name="selectall" id="selectall" onclick="toggleSelect(this)"/>&nbsp&nbsp&nbsp Select All</label></th>
                                    <th>FID</th>
                                    <th>Name</th>
                                    <th>Email Address</th>
                                    <th>Gender</th>
                                    <th>Birthdate</th>
                                  </tr>
                                </thead>
                                <tbody id="searchfaculty">
                                  <tr>
                                    <td  colspan="6" style='font-size:1.2em;text-align:center;'>No Faculty Data</td>
                                  </tr>

                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--Faculty Add Data End-->

                    <button type="button"id="addfaculty" class="btn btn-primary mr-2 mt-3">Add Faculty </button>
                    <button type="reset" class="btn btn-light mt-3">Clear</button>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <!-- Add Faculty End -->

          <!--Faculty Modify Data Start-->

          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Faculty Access</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                          <th>FID</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Gender</th>
                          <th>Birthdate</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody id="listoffaculty">
                        <?php echo $faculty_list; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--Faculty Modify Data End-->

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
            <button id="yes-button" class="modal-btn"></button>
            <button id="no-button" class="modal-btn">Cancel</button>
    </div>
    </div>

   <!-- including footer -->
   <?php
    include './common/footer.php'
    ?>
</body>

</html>