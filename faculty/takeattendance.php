<?php

require_once("../ams.php");
$JAMES = new AMS("Admin");
$JAMES->init_user_session();

if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="2"))
{
 $JAMES->ams_redirect("../login.php");
}
$classroomid="";

if(isset($_GET['classroomid']))
{   
     //to fetch students who have enrolled in particular classroom
     $classroomid = $_GET['classroomid'];
     $fid = $_SESSION['_fid'];

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
           <tr class='student'>
           <td><input type='checkbox' class='edit_checkbox' name='select_stud' id='".$record['spid']."'><span style='visibility:hidden;'>0</span></td>
           <td>".$record['cur_roll_no']."</td>
           <td>".$record['spid']."</td>
           <td>".$record['name']."</td>
           <td>".$record['gender']."</td>
           <td>".$record['dob']."</td>
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


//fetch courses
$sql= "select * from Ams_readers;";//query
$result = mysqli_query($JAMES->connection(),$sql);

if(mysqli_num_rows($result)>0)
{
    $reader = "<div class='row'><div class='col-md-6'><div class='form-group'><label>Select Classroom</label><select name='reader_selection' id='reader_selection' class='form-control'><option value='0'>Not Selected</option></option>";

    while($record = mysqli_fetch_assoc($result))
    {
      $reader.="<option value='".$record['reader_no']."' >".$record['reader_no']."</option>";
    }

    $reader.="</select></div></div>";
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
        <title>AMS | Take Attendance</title>

        <!-- css  -->
        <link rel="stylesheet" href="../css/faculty.css">
        <link rel="stylesheet" href="../css/modal.css">

        <!-- js  -->
        <script src="../js/faculty/takeattendance.js" type="text/javascript" defer=true></script>

</head>

<body>
            <!-------------------------------------------------------Main Content------------------------------------------------------->

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">

                    
                        <button type='button' onclick="window.history.back()"
                             style="padding:9px;width:90px;height:40px;float:left;bottom:10px;display:inline;border-radius:12px;"
                             class='btn form-control btn-primary btn-icon-text ml-3 mb-4'>

                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                            </svg>
                            Back
                        </button>

                        <!--Form Start-->
                        <div class="col-md-12  grid-margin stretch-card">

                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Take Attendance</h4>
                                    <form class="forms-sample" action="takeattendance.php" method="post">

                                        
                                        <!--Classroom -->

                                         <?php echo $reader;?>
                                         
                                         <!--Date-->
                                         
                                            <div class="form-group col-md-6 ">
                                                <label>Date</label>
                                                <input type="date" name="currdate" class="form-control" value="<?php echo date("Y-m-d");?>">
                                            </div>
                                        </div>
                                        <div style="font-size: 17px;font-weight:700;" class="mb-3">Pick a time</div>
                                        
                                        <!--Time Picker-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                
                                                <div class="form-group">
                                                <label>From</label>
                                                <input type="time" name="fromtime" class="form-control" id="appt" required>
                                                    
                                            </div>
                                            </div>
                                            <div class="form-group col-md-6 ">
                                                
                                                <div class="form-group">
                                                <label>To</label>
                                                <input type="time"  class="form-control" id="appt" name="totime" required>
                                                    
                                                </div>
                                            </div>
                                       </div>


                                        <div class="row" style="margin-top:-30px;">
                                            <div class="col-md-6">
                                                <input type="hidden" id="csrfToken" name="_csrfToken" value="<?php echo $JAMES->generateCsrfToken();?>">
                                                <input type="hidden" id="classroomid" name="classroomid" value='<?php echo $GLOBALS['classroomid'];?>'>
                                                <input type="hidden" id="fid" name="fid" value='<?php echo $GLOBALS['fid'];?>'>
                                                <button type="submit" class="btn btn-primary mr-2 mt-3" id="TakeattButton">Fetch Attendance</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        </div>

                        <!--Form End-->
  
                        <div class="card mt-4">
                        <div class="card-body">
                            <h4 class="card-title">Enrolled Students Attendance</h4>
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table id="order-listing" class="table" >
                                            <thead>
                                                <tr>
                                                <th><label for="selectall"><input class='m-0' type="checkbox" name="selectall" id="selectall" onclick="toggleSelect(this)"/>&nbsp&nbsp&nbsp Select All</label></th>
                                                <th>Roll Number</th>
                                                <th>SPID</th>
                                                <th>Name</th>
                                                <th>Gender</th>
                                                <th>Birthdate</th>
                                                </tr>
                                            </thead>
                                            <tbody id="enrolledstudentlist">
                                                <?php
                                                echo $student_list;
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <button type="button" id="submitattendance"class="btn btn-primary mr-2 mt-3">Submit Attendance</button>
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
                <button id="yes-button" class="modal-btn">Okay</button>
                <button id="no-button" class="modal-btn">Cancel</button>
        </div>
        </div>

 <!-- including footer -->
 <?php
    include './common/footer.php'
    ?>
</body>

</html>


