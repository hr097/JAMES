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
      <div class='container'>

      <div class='row'>
      <div class='col-lg-4 col-md-4 col-sm-12' style='display:flex;justify-content: center;'>
      <div class='subcard'>
      <div class='percent' style='--clr:#57B657;--num:".$p_days.";'>
          <div class='dot'></div>
          <svg>
              <circle cx='70' cy='70' r='70'></circle>
              <circle cx='70' cy='70' r='70'></circle>
          </svg>
          <div class='number'>
              <h2>".$p_days."<span></span></h2>
              <p>Days</p>
          </div>
      </div>
  </div>
      </div>
      <div class='col-lg-4 col-md-4 col-sm-12' style='display:flex;justify-content: center;'>
      <div class='subcard'>
      <div class='percent' style='--clr:#FF9494;--num:".$a_days.";'>
          <div class='dot'></div>
          <svg>
              <circle cx='70' cy='70' r='70'></circle>
              <circle cx='70' cy='70' r='70'></circle>
          </svg>
          <div class='number'>
              <h2>".$a_days."<span></span></h2>
              <p>Days</p>
          </div>
      </div>
  </div>
      </div>
      <div class='col-lg-4 col-md-4 col-sm-12' style='display:flex;justify-content: center;'>
      <div class='subcard'>
      <div class='percent' style='--clr:#FFC100;--num:".$ttl_pr.";'>
          <div class='dot'></div>
          <svg>
              <circle cx='70' cy='70' r='70'></circle>
              <circle cx='70' cy='70' r='70'></circle>
          </svg>
          <div class='number'>
              <h2>".$ttl_pr."<span>%</span></h2>
              <p>Average</p>
          </div>
      </div>
  </div>
      </div>
      </div>
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
      <div class='container'>

      <div class='row'>
      <div class='col-lg-4 col-md-4 col-sm-12' style='display:flex;justify-content: center;'>
      <div class='subcard'>
      <div class='percent' style='--clr:#57B657;--num:0;'>
          <div class='dot'></div>
          <svg>
              <circle cx='70' cy='70' r='70'></circle>
              <circle cx='70' cy='70' r='70'></circle>
          </svg>
          <div class='number'>
              <h2>0<span></span></h2>
              <p>Days</p>
          </div>
      </div>
  </div>
      </div>
      <div class='col-lg-4 col-md-4 col-sm-12' style='display:flex;justify-content: center;'>
      <div class='subcard'>
      <div class='percent' style='--clr:#FF9494;--num:0;'>
          <div class='dot'></div>
          <svg>
              <circle cx='70' cy='70' r='70'></circle>
              <circle cx='70' cy='70' r='70'></circle>
          </svg>
          <div class='number'>
              <h2>0<span></span></h2>
              <p>Days</p>
          </div>
      </div>
  </div>
      </div>
      <div class='col-lg-4 col-md-4 col-sm-12' style='display:flex;justify-content: center;'>
      <div class='subcard'>
      <div class='percent' style='--clr:#FFC100;--num:0;'>
          <div class='dot'></div>
          <svg>
              <circle cx='70' cy='70' r='70'></circle>
              <circle cx='70' cy='70' r='70'></circle>
          </svg>
          <div class='number'>
              <h2>0<span>%</span></h2>
              <p>Average</p>
          </div>
      </div>
  </div>
      </div>
      </div>
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
        
        .subcard 
{
	position: relative;
	width: 220px;
	height: 250px;
	background: #ffffff;
	display: flex;
	justify-content: center;
	align-items: center;
}
.subcard .percent 
{
	position: relative;
	width: 150px;
	height: 150px;
}
.subcard .percent svg 
{
	position: relative;
	width: 150px;
	height: 150px;
	transform: rotate(270deg);
}
.subcard .percent svg circle 
{
	width: 100%;
	height: 100%;
	fill: transparent;
	stroke-width: 4;
	stroke: #ffffff;
	transform: translate(5px,5px);
}
.subcard .percent svg circle:nth-child(2)
{
	stroke: var(--clr);
	stroke-dasharray: 440;
	stroke-dashoffset: calc(440 - (440 * var(--num)) / 100);
	opacity:0;
	animation: fadeIn 1s linear forwards;
    animation-delay: 1.5s ;
}
@keyframes fadeIn 
{
	0% 
	{
		opacity: 0;
	}
	100% 
	{
        opacity: 1;
		
	}
}
.dot 
{
	position: absolute;
	inset: 5px;
	z-index: 10;
	/* 360deg / 100 = 3.6 */
	animation: animateDot 2s linear forwards;
    animation-delay: 1s ;                      
}
@keyframes animateDot 
{
	0% 
	{
		transform: rotate(0deg);
	}
	100% 
	{
		transform: rotate(calc(3.6deg * var(--num)));
	}
}
.dot::before 
{
	content: '';
	position: absolute;
	top: -5px;
	left: 50%;
	transform: translateX(-50%);
	width: 10px;
	height: 10px;
	border-radius: 50%;
	background: var(--clr);
	box-shadow: 0 0 10px var(--clr) 0 0 30px var(--clr);
}
.number 
{
	position: absolute;
	inset: 0;
	display: flex;
	justify-content: center;
	align-items: center;
	flex-direction: column;
	opacity: 0;
	animation: fadeIn 1s linear forwards;
}
.number h2 
{
	display: flex;
	justify-content: center;
	align-items: center;
	color: rgb(0, 0, 0);
	font-weight: 700;
	font-size: 2.5em;
}
.number h2 span 
{
	font-weight: 300;
	color: rgb(0, 0, 0);
	font-size: 0.5em;
}
.number p 
{
	font-weight: 300;
	font-size: 0.75em;
	letter-spacing: 2px;
	text-transform: uppercase;
	color: rgba(0, 0, 0);
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
                      
                    <!--<button type='button' onclick="window.location.href='./dashboard.php'" style="verticle-align:middle;padding:9px;width:90px;margin:auto;float:left;position:relative;bottom:10px;display:inline;" class='btn btn-primary btn-icon-text'>-->
                    
                    <button type='button' onclick="window.location.href='./dashboard.php'" style="verticle-align:middle;padding:9px;width:90px;height:40px;margin:auto;float:left;position:relative;bottom:10px;display:inline;border-radius:12px;" class='btn form-control btn-primary btn-icon-text'>
                                        
                                        
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                    </svg>
                    Back
                    </button>
                    
                   
                    <h4 class="card-title" style="text-align:right;"><?php echo $subject_name; ?></h4>
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
