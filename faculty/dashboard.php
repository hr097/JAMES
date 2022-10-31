<?php

 require_once("../ams.php");
 $JAMES = new AMS("Admin");
 $JAMES->init_user_session();

 if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="2"))
 {
  $JAMES->ams_redirect("../login.php");
 }
 
 $u = $_SESSION["_userId"];

 //@query
$sql = "select fid,SUBSTRING(name,INSTR(name,' '),( (LOCATE(' ',name,INSTR(name,' ')+1)) - INSTR(name,' ') )) AS fname,gender from vw_faculties where email='$u';"; 
$result = mysqli_query($JAMES->connection(),$sql);

if(mysqli_num_rows($result)==1)
{
    $user = mysqli_fetch_assoc($result);
}
else
{
    $JAMES->ams_redirect("../login.php");
}

$fid = $user['fid'];
$gender = $user['gender'];

$_SESSION['_fid'] = $fid; // to access this in other pages
$_SESSION['_gender'] = $gender; // to access this in other pages

//courses fetch for dropdown
$sql= "select * from Courses;";//query
$result = mysqli_query($JAMES->connection(),$sql);

if(mysqli_num_rows($result)>0)
{
    $course_html = "<div class='form-group col-md-3'><label>Course</label><select id='course_selection' class='form-control'><option value=''>Not Selected</option></option>";

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


// classroom fetch

//@query 
$sql = "select S.semester,ASCSM.year,ASCSM.division,C.course_name,S.subject_name from Ams_setup_faculties_map ASFM,Ams_setup_course_subject_map ASCSM,Course_subject_map CSM,Subjects S,Courses C where ASCSM.cs_id=CSM.cs_id AND CSM.course_id=C.course_id AND CSM.subject_id=S.subject_id AND ASFM.ams_setup_id=ASCSM.ams_setup_id AND ASFM.fid='$fid';"; 
$result = mysqli_query($JAMES->connection(),$sql);


//@change colors
    $color_palate = array("#5050b2","#96b2fb","#FF9494","#ffc100","#59616E","#9F8772","#0a6b57","#937DC2","#F0CA86");
    $classrooms_html = "";

    $itr=0;

    if(mysqli_num_rows($result)>=1)
    {
        while($record = mysqli_fetch_assoc($result))
        {            
            $classrooms_html.="
            <div class='col-md-3 mb-2 stretch-card transparent lblmargin handpointer' onclick='subopen()'>
                  <div class='card' style='color:white;background-color:".$color_palate[$itr].";'>
                      <div class='card-body'>
                        <p class='mb-2 coursefont'>".$record['course_name']."-".$record['year']."</p>
                        <p class='mb-4 subfont'>".$record['subject_name']."</p>
                        <p>Semester :  ".$record['semester']."</p>
                        <p>Division :  ".$record['division']."</p>
                      </div>
                  </div>
              </div>
            ";
            $itr++;
            if($itr == count($color_palate))
            {
                $itr=0;
            }
        }
    }
    else
    {
        $classrooms_html.="<p style='font-size:1.5em;margin:auto;'>No Classroom created yet</p>";
    }



?>



<!DOCTYPE html>
<html lang="en">

<head>

    <!-- including header -->
    <?php
    include './common/header.php';
    ?>

    <!-- css  -->
    <link rel="stylesheet" href="../css/faculty.css">

    <!-- js  -->
    <script src="../js/faculty/dashboard.js" type="text/javascript" defer=true></script>

    <!-- Page information -->
    <title>AMS | Faculty Dashboard</title>


</head>

<body>
    <!-- ----------------------------------------------------- Main Content ----------------------------------------------------- -->
    <div class="main-panel">
        <div class="content-wrapper">
        <div class="row">
             <div class="col-12 col-xl-8 mb-4 mb-xl-50">
                    <h3 class="font-weight-bold">Welcome 
                      <?php 
                      if($_SESSION['_gender']==="Male")
                      {
                        echo "Sir";
                      } 
                      else if($_SESSION['_gender']==="Female")
                      {
                        echo "Madam";
                      }
                      else
                      {
                        echo $user['fname'];
                      }

                      ?>,
                    </h3>
                    <h6 id="daymode" class="font-weight-normal mb-10"></h6>
             </div>
        </div>
              <!-- Classroom sorting --> 
              <div class="row">
                    <div class="form-group col-md-3">
                        <label>Year</label>
                        <select id="curyear" class="form-control">
                        </select>
                    </div>
                    <!-- Course -->
                    <?php echo $course_html;?>

                    <!-- Semester -->
                    <div class="form-group col-md-3">
                        <label>Semester</label>
                        <select id="sem_selection" class="form-control">
                          <option value=''>Not Selected</option>
                        </select>
                    </div>

                    <!-- Division -->
                    <div class="form-group col-md-3 ">
                        <label>Division</label>
                        <select id='div_selection' class="form-control">
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

          <!-- -----------------------------------------------------Classrooms----------------------------------------------------- -->
          
          <div class="col-md-12 grid-margin transparent">
            <div class="row" id="classroomlist">

            <?php echo $classrooms_html;?>

            </div>
          </div>

        </div>
      </div>
    </div>


    <!----------------------------------------------Report Generate End---------------------------------------------->
    <!--Subject Page Open Start-->

     <script>
    // function subopen() {
    //     window.location = "./stud.php";
    // }
    </script>

    <!--Subject Page Open End-->

    <!-- </div>
    </div>
    </div>
    </div>
    </div> -->

    <!-- including footer -->
    <?php
    include './common/footer.php'
    ?>
</body>

</html>