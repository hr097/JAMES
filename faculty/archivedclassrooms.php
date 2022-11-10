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
    $course_html = "<div class='form-group col-md-3'><label class='select-text'>Course</label><select id='course_selection' class='form-control'><option value=''>Not Selected</option></option>";

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

$fid = $_SESSION['_fid'];

//@query 
$sql = "select S.semester,ASCSM.year,ASCSM.division,C.course_name,S.subject_name from Ams_setup_faculties_map ASFM,Ams_setup_course_subject_map ASCSM,Course_subject_map CSM,Subjects S,Courses C where ASCSM.cs_id=CSM.cs_id AND CSM.course_id=C.course_id AND CSM.subject_id=S.subject_id AND ASFM.ams_setup_id=ASCSM.ams_setup_id AND ASFM.fid='$fid' and ASFM.setup_status=FALSE;"; 
$result = mysqli_query($JAMES->connection(),$sql);

//@change colors
    $color_palate = array("#0a6b57","#9F8772","#937DC2","#F0CA86","#59616E","#5050b2","#96b2fb","#FF9494","#ffc100");
    $classrooms_html = "";

    $itr=0;

    if(mysqli_num_rows($result)>=1)
    {
        while($record = mysqli_fetch_assoc($result))
        {            
            $classrooms_html.="
            <div id='".$record['course_name']."' class='col-md-3 mb-2 stretch-card transparent lblmargin handpointer classroom'>
            <div class='card' style='color:white;background-color:".$color_palate[$itr].";'>
                <div class='card-body'>
                  <p class='mb-2 coursefont'  id='".$record['year']."'>".$record['course_name']."-".$record['year']."</p>
                  <p class='mb-4 subfont' id='".$record['subject_name']."' >".$record['subject_name']."</p>
                  <p id='".$record['semester']."' >Semester :  ".$record['semester']."</p>
                  <p id='".$record['division']."' >Division :  ".$record['division']."</p>
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
        $classrooms_html.="<p style='font-size:1.3em;margin:auto;margin-top:100px;'>No Classroom archived yet</p>";
    }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- including header -->
    <?php
          include './common/header.php'
        ?>

    <!-- Page info -->
    <title>AMS | Archived Classrooms</title>

    <!-- css  -->
    <link rel="stylesheet" href="../css/faculty.css">

    <!-- js  -->
    <script src="../js/faculty/archivedclassrooms.js" type="text/javascript" defer=true></script>

</head>

<body>
    <!-------------------------------------------------------Main Content------------------------------------------------------->

    <!--Subeject Setup Form Start-->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-md-12 mb-4">

                <h3 class="font-weight-bold mb-3">Archived Classrooms</h3>

                <!-- Classroom sorting -->
                <div class="row">

                    <div class="form-group col-md-3">
                        <label class="select-text">Year</label>
                        <select id="curyear" class="form-control">
                        </select>
                    </div>

                    <!--Course -->
                    <?php echo $course_html;?>

                    <!--Semester -->
                    <div class="form-group col-md-3">
                        <label class="select-text">Semester</label>
                        <select id="sem_selection" class="form-control">
                            <option value=''>Not Selected</option>
                        </select>
                    </div>

                    <div class="form-group col-md-3 ">
                        <label class="select-text">Division</label>
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
            </div>
            <div class="col-md-12 grid-margin transparent">
                <div class="row" id="classroomlist">

                    <?php echo $classrooms_html;?>

                </div>
            </div>

        </div>
    </div>
    <!--Faculty Form End-->


    <!--Subject Page Open Start-->
    <script>
    function subopen() {
        window.location = "./modify-setup.php";
    }
    </script>
    <!--Subject Page Open End-->



    <!-- including footer -->
    <?php
    include './common/footer.php'
    ?>
</body>

</html>