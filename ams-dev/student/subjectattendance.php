<?php

require_once("../ams.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();

if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="1"))
{
 $JAMES->ams_redirect("../login.php");
}

if(isset($_REQUEST["subject"])&&isset($_REQUEST["faculty"]))
{ 

  $subject_name = $_REQUEST["subject"];
  $subject_fac = $_REQUEST["faculty"];
  
  // subject attendance fetch

  $spid = $_SESSION["_spid"];
  $attendance_html = "";

  //@query
  $sql = "select DATE_FORMAT(DATE(AAM.att_date_time),'%d/%m/%Y') AS att_date,AAM.att_status from Ams_attendance_master AAM,Ams_setup_course_subject_map ASCSM,Course_subject_map CSM,Subjects S,Faculties F where AAM.ams_setup_id=ASCSM.ams_setup_id and ASCSM.cs_id=CSM.cs_id and CSM.subject_id=S.subject_id and AAM.fid=F.fid and spid='$spid'and S.subject_name='$subject_name'and F.name='$subject_fac' order by DATE(AAM.att_date_time) DESC;"; 
  $result = mysqli_query($JAMES->connection(),$sql);

  if(mysqli_num_rows($result)>=1)
  {  $r=1;
      while($record = mysqli_fetch_assoc($result))
      {
          
          if($record["att_status"]==1)
          {
              $att_status="class='btn btn-success attbtn'>Present";
          }
          else
          {
              $att_status="class='btn btn-danger attbtn'>Absent";
          }

          $attendance_html.="
              <tr>
              <td>".$r."</td>
              <td>".$record["att_date"]."</td>
              <td>
                  <button type='button'".$att_status."</button>
              </td>
              </tr>";
              $r++;
      }
  }
  else
  {
      $attendance_html.="
      <tr>
      <td></td>
      <td></td>
      <td>
      No Attendance Data for ".$subject_name."
      </td>
      </tr>";
  }
  
}
else
{
  $JAMES->ams_redirect("./dashboard.php");
}


?>


<!DOCTYPE html>
<html lang="en">

  <head>
    <!-- including headr -->
    <?php
    include './common/header.php'
    ?>

    <!-- css  -->
    <link rel="stylesheet" href="../css/student.css">

    <!-- page information and favicon-->
    <title>AMS | Subject Attendance</title>

</head>

<body>
      <!-------------------------------------------------------Main Content------------------------------------------------------->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <!-------------------------------------------------------Table Start------------------------------------------------------->
            <div class="col-lg-12 grid-margin">

                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title" style="float:left;"><?php echo $subject_name; ?> Attendance</h4>
                    
                    <button type='button' onclick="window.location.href='./dashboard.php'" style="verticle-align:middle;padding:9px;width:90px;margin:auto;margin-left:60%;position:relative;bottom:10px;display:inline;" class='btn btn-primary btn-icon-text'>
                    Back
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                    </svg>
                    </button>
                    <div class="row" style="display:block;">
                      <div class="col-12">
                        <div class="table-responsive">
                          <table id="order-listing" class="table" id="tbl">
                            <thead>
                              <tr>
                                <th>No.</th>
                                <th>Date</th>
                                <th>Attendance Status</th>
                              </tr>
                            </thead>
                            <tbody>

                            <?php echo $attendance_html;?>

                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                  <!--Table End-->
        </div>
      </div>





    <!-- including footer -->
    <?php
    include './common/footer.php'
    ?>

</body>

</html>