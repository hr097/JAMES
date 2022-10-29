<?php
require_once("../ams.php");
$JAMES = new AMS("Admin");
$JAMES->init_user_session();

if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="2"))
{
 $JAMES->ams_redirect("../login.php");
}

$sql= "select * from Courses;";//query
$result = mysqli_query($JAMES->connection(),$sql);

if(mysqli_num_rows($result)>0)
{
    $course_html = "<div class='row'><div class='col-md-6'><div class='form-group'><label>Course</label><select name='course_selection' id='course_selection' class='form-control'><option value=''>Not Selected</option></option>";

    while($record = mysqli_fetch_assoc($result))
    {
      $course_html.="<option value='".$record['total_semester']."_".$record['course_name']."' >".$record['course_name']."</option>";
    }

    $course_html.="</select></div></div>";
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
        <title>AMS | New Classroom</title>

        <!-- css  -->
        <link rel="stylesheet" href="../css/faculty.css">
        <link rel="stylesheet" href="../css/modal.css">

        <!-- js  -->
        <script src="../js/faculty/newclassroom.js" type="text/javascript" defer=true></script>

</head>

<body>
   <!-------------------------------------------------------Main Content------------------------------------------------------->
      <!--Subeject Setup Form Start-->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12  grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Create Classroom</h4>
                  <form class="forms-sample">

                    <!--Course -->

                      <?php echo $course_html;?>

                      <!--Semester -->
                      <div class="form-group col-md-6 ">
                        <label>Semester</label>
                        <select id="sem_selection" class="form-control">
                          <option value=''>Not Selected</option>
                        </select>
                      </div>
                    </div>

                    <!-- Subject -->
                      <div class="form-group">
                        <label>Subject</label>
                        <select  id="sub_selection" class="form-control">
                        <option value=''>Not Selected</option>
                        </select>
                      </div>
                      <input type="hidden" id="csrfToken" name="_csrfToken" value="<?php echo $JAMES->generateCsrfToken();?>" >

                    <!-- Division and Current Year -->
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Division</label>
                          <select id="div_selection" class="form-control">
                            <option>Not Selected</option>
                            <option>A</option>
                            <option>B</option>
                            <option>C</option>
                            <option>D</option>
                            <option>E</option>
                            <option>F</option>
                            <option>G</option>
                            <option>H</option>
                            <option>I</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group col-md-6">
                        <div class="form-group">
                          <label>Current Year</label>
                          <input type="month" class="form-control" id="curryear" value="" placeholder="Select Year" >
                        </div>
                      </div>
                    </div>

                    <button type="button" id="createclass" class="btn btn-primary mr-2 mt-3">Create
                      Classroom</button>
                    <button class="btn btn-light mt-3">Clear</button>
                  </form>
                </div>
              </div>
            </div>
            <!--Faculty Form End-->
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
                    <button id="yes-button" class="modal-btn"></button>
            </div>
    </div>
    <!-- including footer -->
    <?php
       include './common/footer.php'
    ?>

</body>

</html>