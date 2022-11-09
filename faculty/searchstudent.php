<?php

require_once("../ams.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();

if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="2"))
{
 $JAMES->ams_redirect("../login.php");
}

$student_card = "";

if(isset($_POST['_spid'])&&isset($_POST['_csrfToken'])&&$_POST['_csrfToken']==$_SESSION['_csrfToken']&&isset($_SESSION['_userId']))
{
    $spid = $JAMES->sanitizeInput($_POST['_spid']);

    //@query
    $sql = "select Courses.course_name,Students.*,DATE_FORMAT(dob,'%d-%m-%Y')AS dob from Students,Courses where Courses.course_id=Students.course_id and spid='$spid';"; 
    $result = mysqli_query($JAMES->connection(),$sql);
    
    if(mysqli_num_rows($result)===1)
    {
        $user = mysqli_fetch_assoc($result);


        if($user['gender']=='Male')
        {
            $profile = "<img src='../assets/profiles/student-profile-male.jpg' class='profile_img my-4' style='width:130px;height:130px;border-radius:49%;' alt='Student profile'>";
        }
        else
        {
            $profile =  "<img src='../assets/profiles/student-profile-female.png' class='profile_img my-4' style='width:130px;height:130px;border-radius:49%;' alt='Student profile'>";
        }   


        if($user['cur_semester']==1)
        {
            $sem = $user['cur_semester']."<sup>st</sup>";
        }
        else if($user['cur_semester']==2)
        {
            $sem = $user['cur_semester']."<sup>nd</sup>";    
        }
        else if($user['cur_semester']==3)
        {
            $sem = $user['cur_semester']."<sup>rd</sup>";   
        }
        else
        {
            $sem = $user['cur_semester']."<sup>th</sup>";   
        }

        $user_status = '';

        if($user['stud_status']==true)
        {
          $user_status = "Active";
        }
        else
        {
          $user_status = "In-Active";
        }

        $student_card = "

             <div class='container my-3' align='center' style='padding-bottom: 3%;'>

              <div class='scene'>
                <div class='flip-card' >
                  <div class='card__face card__face--front' style='border-radius: 10px;'>

                  ".$profile."
                    <h4  class='profile_name' style='color:white;margin-top:-12px;' >".$user['name']."</h4>
                  </div>

                  <div  class='card__face card__face--back py-4 pl-4' style='font-weight:500;font-size: 15px;' align='left'>
                    <p class='mt-3'>
                    <span  class='card_back_title mr-4'> SPID :&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>
                    <span class='card_back_data' style='font-weight:normal;'>".$user['spid']."</span>
                    </p>

                    <p>
                    <span  class='card_back_title mr-4'> Course :</span>
                    <span lass='card_back_data' style='font-weight:normal;' >".$user['course_name']."</span>
                    </p>

                    <p>
                    <span  class='card_back_title mr-1'> Semester :</span>
                    <span lass='card_back_data' style='font-weight:normal;' >".$sem."</span>
                    </p>

                    <p>
                    <span  class='card_back_title mr-3'> Division :</span>
                    <span lass='card_back_data' style='font-weight:normal;' >".$user['cur_division']."</span>
                    </p>

                    <p>
                    <span  class='card_back_title mr-4'> Roll No :</span>
                    <span lass='card_back_data' style='font-weight:normal;' >".$user['cur_roll_no']."</span>
                    </p>

                  </div>

                </div>
              </div>
              <!-------------------------------------------------------Student Card End------------------------------------------------------->
            </div>
          </div>
          <!--Personal Info-->
          <div class='row'>
            <div class='col-md-12 mb-2'>
              <h4 class='font-weight-bold'>Personal Information</h4>
            </div>
          </div>
          <div class='row'>
            <div class='col-md-12 grid-margin stretch-card'>
              <div class='card'>
                <div class='card-body'>

                  <h6 class='info-title'>Birth Date</h6>
                    <h4 class='info-data'>".$user['dob']."</h4>

                  <h6 class='info-title'>Gender</h6>
                   <h4 class='info-data'>".$user['gender']."</h4>

                   <h6 class='info-title'>Course Name</h6>
                   <h4 class='info-data'>".$user['course_name']."</h4>

                  <h6 class='info-title'>Course Joining Year</h6>
                   <h4 class='info-data'>".$user['joining_year']."</h4>

                   
                  <h6 class='info-title'>Semester</h6>
                  <h4 class='info-data'>".$user['cur_semester']."</h4>

                 <h6 class='info-title'>Division</h6>
                  <h4 class='info-data'>".$user['cur_division']."</h4>

                 <h6 class='info-title'>Roll Number</h6>
                  <h4 class='info-data'>".$user['cur_roll_no']."</h4>

                 <h6 class='info-title'>Student Status</h6>
                  <h4 class='info-data'>".$user_status."</h4>
                  
                </div>
              </div>
            </div>
          </div>

          <!--Contact Info-->
          <div class='row'>
            <div class='col-md-12 mb-2'>
              <h4 class='font-weight-bold'>Contact Information</h4>
            </div>
          </div>
          <div class='row'>
            <div class='col-md-12 grid-margin stretch-card'>
              <div class='card'>
                <div class='card-body'>
                
                <h6 class='info-title'>Email</h6>
                 <!-- <span id='mode'>
                    <i class='ti-pencil email_edit_icon d-flex justify-content-end' style='position:relative;bottom:10px;' id='edit_icon'></i>
                </span> --> 
                 <h4 id='para_email' class='email_edit_para info-data'>".$user['email']."</h4> 
                 <input type='hidden' id='csrfToken' name='_csrfToken' value='".$JAMES->generateCsrfToken()."'> 
                <h6 class='info-title'>Contact No.</h6>
                 <h4 class='info-data'>".$user['contact_no']."</h4>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    ";

    }
    else
    {
        $student_card = "<p style='font-size:1.5em;margin:auto;margin-top:100px;'>Sorry, No Student Found with that SPID!</p>";
    }



}
else
{

    $student_card = "<p style='font-size:1.5em;margin:auto;margin-top:100px;'>No Student Data</p>";
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <!-- including header -->
    <?php
    include './common/header.php'
    ?>

    <!-- css  -->
    <link rel="stylesheet" href="../css/student.css">

    <!-- js  -->
    <script src="../js/faculty/searchstudent.js" type="text/javascript" defer=true></script>

    <!-- page information-->
    <title>AMS | Search Student</title>

</head>

<body>


    <!-------------------------------------------------------Main Content Start------------------------------------------------------->

    <div class="main-panel">
        
        <div class="content-wrapper">
            <div class="row">
                <!-- Search Student -->
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Search Student</h4>
                            <form class="forms-sample" action="searchstudent.php" method="post" autocomplete="off">

                                <!-- Student Spid & Search Button-->
                                <div class="row">
                                <div class="col-lg-10 col-md-9 col-sm-12">

                                    <div class="form-group">
                                    <label>Student SPID</label>
                                    <input type="text" maxlength="10" minlength="10" name="_spid" class="form-control" id="Stud_spid" placeholder="Enter student SPID" required>
                                    <input type="hidden" id="csrfToken" name="_csrfToken" value="<?php echo $JAMES->generateCsrfToken();?>" >  
                                  </div>

                                </div>
                                <div class="form-group search_fetch_btn col-lg-2 mt-3 col-sm-12">
                                    <button type="submit" id="search" class="btn btn-primary mr-2 mt-3">Search
                                    </button>
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            <!-------------------------------------------------------Student Card Start------------------------------------------------------->
            <?php echo $student_card; ?>
            
    <!-------------------------------------------------------Main Content End------------------------------------------------------->

    <!-- including footer -->
    <?php
    include './common/footer.php'
    ?>

</body>

</html>

