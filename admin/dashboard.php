<?php

 require_once("../ams.php");
 $JAMES = new AMS("Admin");
 $JAMES->init_user_session();


 if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="3"))
 {
  $JAMES->ams_redirect("../login.php");
 }

 $year = date("Y");
 $ams_setup = "";


 function getClassrooms($y) 
 { 
     $sql= "select A.*,C.course_name,S.semester,S.subject_code,F.email from Ams_setup_course_subject_map A,
     Courses C,
     Subjects S,
     Course_subject_map CSM,
     Ams_setup_faculties_map ASFM,
     Faculties F 
     where
     A.ams_setup_id = ASFM.ams_setup_id and
     ASFM.fid = F.fid and
     A.cs_id=CSM.cs_id and
     C.course_id = CSM.course_id and
     S.subject_id = CSM.subject_id and
     A.year=$y;";
 
     $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);
     
     if(mysqli_num_rows($result)>=1)
     {  
        $data = "";
         while($record = mysqli_fetch_assoc($result))
         {  
 
             $data.=
             "
             <tr class='ams_setup'>
             <td>".$record['ams_setup_id']."</td>
             <td>".$record['course_name']."</td>
             <td>".$record['subject_code']."</td>
             <td>".$record['semester']."</td>
             <td>".$record['division']."</td>
             <td>".$record['year']."</td>
             <td>".$record['email']."</td>
             </tr>
             ";
         }

         return $data;

     }
     else
     {
        return  "<tr><td  colspan='7' style='font-size:1.2em;text-align:center;'>No Classrooms Data Found!</td></tr>";
     }
 }


 $ams_setup = getClassrooms($year);

 ?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <!-- including header -->
        <?php
        include './common/header.php'
        ?>

        <!-- css  -->
        <link rel="stylesheet" href="../css/admin.css">
        
        <!-- js  -->
        <script src="../js/admin/dashboard.js" type="text/javascript" defer=true></script>

        <!-- page information-->
        <title>AMS | Admin Dashboard</title>
        
    </head>

    <body>

                <!-------------------------------------------------------Main Content------------------------------------------------------->
                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="row">
                            <div class="col-12 col-xl-8 mb-4 mb-xl-50">
                                <h3 class="font-weight-bold greet">Welcome AMS Admin,</h3>
                                <h6 id="daymode" class="font-weight-normal mb-10"></h6>
                            </div>
                            <div class="col-sm-12  col-md-12  col-lg-12  grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Search Classroom</h4>
                                        <form class="forms-sample">

                                            <input type="hidden" id="csrfToken" name="_csrfToken" value="<?php echo $JAMES->generateCsrfToken();?>" >

                                            <div class="form-group">
                                                    <label for="year">Year</label>
                                                    <input type="text" autocomplete="off" name="year" pattern="[0-9]{4}" minlength="4"  maxlength="4" class="form-control" id="year_selection" placeholder="XXXX" value="<?php echo $year;?>" >
                                                </div>

                                            <button type="button" id="searchclassroom" class="btn btn-primary mr-2 mt-3">Search</button>
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12  col-md-12  col-lg-12  grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Classroom Details</h4>
                                        <div class="table-responsive mt-4">
                                            <table id="order-listing" class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Class Code</th>
                                                        <th>Course</th>
                                                        <th>Subject Code</th>
                                                        <th>Semester</th>
                                                        <th>Division</th>
                                                        <th>Year</th>
                                                        <th>Faculty Access</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="classroomslist">
                                                    <?php

                                                    echo $ams_setup;

                                                    ?>
                                                    <!-- <tr><td  colspan='5' style='font-size:1.2em;text-align:center;'>No Data Available!</td></tr> -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
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
