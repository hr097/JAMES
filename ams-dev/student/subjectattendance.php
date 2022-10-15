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
  $sql = "select DATE_FORMAT(DATE(AAM.att_date_time),'%d/%m/%Y') AS att_date,AAM.att_status,ASSM.p_days,ASSM.a_days from Ams_attendance_master AAM,
  Ams_setup_students_map ASSM,
  Ams_setup_course_subject_map ASCSM,
  Course_subject_map CSM,
  Subjects S,
  Faculties F where
  AAM.ams_setup_id=ASCSM.ams_setup_id
  and AAM.ams_setup_id=ASSM.ams_setup_id
  and ASCSM.ams_setup_id=ASSM.ams_setup_id 
  and ASCSM.cs_id=CSM.cs_id
  and CSM.subject_id=S.subject_id 
  and AAM.fid=F.fid
  and ASSM.spid=AAM.spid 
  and AAM.spid='$spid'and S.subject_name='$subject_name'and F.name='$subject_fac' order by DATE(AAM.att_date_time) DESC;"; 
  
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
          
          $p_days = $record['p_days'];
          $a_days = $record['a_days'];

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
      
      
      $ttl_pr = round(( ($p_days) / ($p_days + $a_days)*100));


      $att_stat = "
      <br>
      <div class='card bg-light text-dark'  style='display:block;margin-left:0px;padding:20px;border:2px solid black;'>
      <div class='pie animate' style='--p:".$p_days.";--c:green;margin-left:48px;margin-top:20px;'> ".$p_days." days</div>
      <div class='pie' style='--p:".$a_days.";margin-left:48px;margin-top:20px;'> ".$a_days." days</div>
      <div class='pie animate' style='--p:".$ttl_pr.";--c:orange;margin-left:48px;margin-top:20px;'> ".$ttl_pr."%</div>
      </div>
      <br>
      ";
  }
  else
  {
      $attendance_html.="
      <tr>
      <td></td>
      <td></td>
      <td>
      No Attendance Data Available
      </td>
      </tr>";
      
      $att_stat = "
      <br>
      <div class='card bg-light text-dark'  style='display:block;margin-left:0px;padding:20px;border:2px solid black;'>
      <div class='pie animate' style='--p:0;--c:green;margin-left:48px;margin-top:20px;'> 0 days</div>
      <div class='pie' style='--p:0;margin-left:48px;margin-top:20px;'> 0 days</div>
      <div class='pie animate' style='--p:0;--c:orange;margin-left:48px;margin-top:20px;'> 0%</div>
      </div>
      <br>
      ";
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
    
    <style type="text/css">
        
        @property --p{
          syntax: "<number>";
          inherits: true;
          initial-value: 0;
        }

         .pie {
          --p:20;
          --b:22px;
          --c:darkred;
          --w:150px;
          
          width:var(--w);
          aspect-ratio:1;
          position:relative;
          display:inline-grid;
          margin:5px;
          place-content:center;
          font-size:25px;
          font-weight:bold;
          font-family:sans-serif;
        }
        .pie:before,
        .pie:after {
          content:"";
          position:absolute;
          border-radius:50%;
        }
        .pie:before {
          inset:0;
          background:
            radial-gradient(farthest-side,var(--c) 98%,#0000) top/var(--b) var(--b) no-repeat,
            conic-gradient(var(--c) calc(var(--p)*1%),#0000 0);
          -webkit-mask:radial-gradient(farthest-side,#0000 calc(99% - var(--b)),#000 calc(100% - var(--b)));
                  mask:radial-gradient(farthest-side,#0000 calc(99% - var(--b)),#000 calc(100% - var(--b)));
        }
        .pie:after {
          inset:calc(50% - var(--b)/2);
          background:var(--c);
          transform:rotate(calc(var(--p)*3.6deg)) translateY(calc(50% - var(--w)/2));
        }
        .animate {
          animation:p 1s .5s both;
        }
        .no-round:before {
          background-size:0 0,auto;
        }
        .no-round:after {
          content:none;
        }

        @keyframes p {
          from{--p:0}
        }

    </style>

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
                      
                    <button type='button' onclick="window.location.href='./dashboard.php'" style="verticle-align:middle;padding:9px;width:90px;height:40px;margin:auto;float:left;position:relative;bottom:10px;display:inline;border-radius:12px;" class='btn form-control btn-primary btn-icon-text'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                    </svg>
                    Back
                    </button>
                    <h4 class="card-title" style="float:right;"><?php echo $subject_name; ?></h4>
                    <br>
                    <?php
                      echo $att_stat;
                    ?>

                    
                    <div class="row" style="display:block;float:none;">
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