<?php

require_once("../ams.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();

if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="2"))
{
 $JAMES->ams_redirect("../login.php");
}

$error = "";
$u = $_SESSION["_userId"];
$fid = "";
$result_str = "";
$btn = "";
$att_select_box = "";

$f_spid = "";
$att_id = "";
$class_id = "";
$f_date = date("Y-m-d");

    //fetch related classroom id's
    $sql= "select ASFM.fid,ASFM.ams_setup_id FROM Ams_setup_faculties_map ASFM,Faculties F where F.fid=ASFM.fid and F.email='$u'and ASFM.setup_status=TRUE;";//query
    $result = mysqli_query($JAMES->connection(),$sql);

    if(mysqli_num_rows($result)>0)
    {
        $classroom_codes = "<label class='mt-2'>Classroom Code</label><select name='_cid' id='classcode_selection' class='form-control' required><option value=''>Not Selected</option></option>";

        while($record = mysqli_fetch_assoc($result))
        {
        $classroom_codes.="<option value='".$record['ams_setup_id']."' >".$record['ams_setup_id']."</option>";
        $fid = $record['fid'];
        }

        $classroom_codes.="</select>";
    }
    else
    {
    $classroom_codes = "<label>Classroom Code</label><select name='_cid' id='classcode_selection' class='form-control' required><option value=''>Not Selected</option></option></select>";
    }

if(isset($_POST['updtatt'])&&isset($_POST['_att_status'])&&isset($_POST['_att_no'])&&isset($_POST['_csrfToken'])&&$_POST['_csrfToken']==$_SESSION['_csrfToken']&&isset($_SESSION['_userId']))
{
    $attno = $JAMES->sanitizeInput($_POST["_att_no"]);
    $attstatus = $JAMES->sanitizeInput($_POST["_att_status"]);


    $sql= "update Ams_attendance_master set att_status=$attstatus where att_no=$attno;";
        
    if(mysqli_query($GLOBALS['JAMES']->connection(),$sql))
    {
        $error = "<span id='response_msg' style='color:green;float:right;'>Attendance Updated successfully !</span>";
    }
    else
    {
        $error = "<span id='response_msg' style='color:red;float:right;'>Attendance couldn't be Updated!</span>"; 
    }
    
    $btn = "<button type='submit' name='findatt' id='search' class='btn btn-primary mr-2 mt-3'>Search</button>";
    $error.="<script>setTimeout(function(){ window.location.href='updateattendance.php'; },3000);</script>";
}
else if(isset($_POST['findatt'])&&isset($_POST['_spid'])&&isset($_POST['_cid'])&&isset($_POST['_dt'])&&isset($_POST['_csrfToken'])&&$_POST['_csrfToken']==$_SESSION['_csrfToken']&&isset($_SESSION['_userId']))
{
    $spid = $JAMES->sanitizeInput($_POST['_spid']);
    $cid = $JAMES->sanitizeInput($_POST['_cid']);
    $dt = $JAMES->sanitizeInput($_POST['_dt']);

    //@query
    $sql = "select Ams_attendance_master.*,DATE_FORMAT(DATE(Ams_attendance_master.att_date_time),'%Y-%m-%d') as att_date from Ams_attendance_master where ams_setup_id=$cid and spid='$spid' and att_date_time like '$dt %';"; 
    $result = mysqli_query($JAMES->connection(),$sql);
    
    if(mysqli_num_rows($result)===1)
    {
        $record = mysqli_fetch_assoc($result);

        $f_spid = $record['spid'];
        $att_id = "<input type='hidden' name='_att_no' value='".$record['att_no']."'>";
        $att_status = $record['att_status'];
        $class_id = $record['ams_setup_id'];
        $f_date = $record['att_date'];
        $statusBox = "";

        if($att_status==1)
        {

            $statusBox = "
            <select name='_att_status' class='form-control'required>
                <option value='true' selected>Present</option>
                <option value='false' >Absent</option>
            </select>
            ";

        }
        else
        {
            $statusBox = "
            <select name='_att_status' class='form-control' required>
                    <option value='true'>Present</option>
                    <option value='false'selected>Absent</option>
            </select>
            ";
        }

        $att_select_box = "
        <label class='mt-2'>Attendance Status</label>
        ".$statusBox;

        
        //fetch related classroom id's and checked classcode
        $sql= "select ASFM.fid,ASFM.ams_setup_id FROM Ams_setup_faculties_map ASFM,Faculties F where F.fid=ASFM.fid and F.email='$u'and ASFM.setup_status=TRUE;";//query
        $result = mysqli_query($JAMES->connection(),$sql);
        if(mysqli_num_rows($result)>0)
        {
            $classroom_codes = "<label class='mt-2'>Classroom Code</label><select name='_cid' id='classcode_selection' class='form-control' required><option value=''>Not Selected</option></option>";
            $str = "";

            while($rc = mysqli_fetch_assoc($result))
            {
            if($rc['ams_setup_id']==$class_id)
            {
                $str = "selected"; 
            }
            else
            {
                $str = ""; 
            }
            $classroom_codes.="<option value='".$rc['ams_setup_id']."' ".$str." >".$rc['ams_setup_id']."</option>";
            $fid = $rc['fid'];
            }
    
            $classroom_codes.="</select>";
        }
        else
        {
        $classroom_codes = "<label>Classroom Code</label><select name='_cid' id='classcode_selection' class='form-control' required><option value=''>Not Selected</option></option></select>";
        }
            
        $btn = "<button type='submit' name='updtatt' id='search' class='btn btn-primary mr-2 mt-3'>Update</button>";
    }
    else
    {    
        $btn = "<button type='submit' name='findatt' id='search' class='btn btn-primary mr-2 mt-3'>Search</button>";
        $result_str = "<p style='font-size:1.5em;margin:auto;margin-top:30px;'>Attendance Not Found !</p>";
    }
}
else
{   
    $result_str = "<p style='font-size:1.5em;margin:auto;margin-top:30px;'>No Attendance Details!</p>";
    $btn = "<button type='submit' name='findatt' id='search' class='btn btn-primary mr-2 mt-3'>Search</button>";
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
    
    <!-- Bi Icons  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <!-- js  -->
    <script src="../js/faculty/updateattendance.js" type="text/javascript" defer=true></script>

    <!-- page information-->
    <title>AMS | Update Attendance</title>


</head>

<body>


    <!-------------------------------------------------------Main Content Start------------------------------------------------------->

    <div class="main-panel">
        
        <div class="content-wrapper">
            <div class="row">

            <button type='button' onclick="window.history.back()" style="verticle-align:middle;padding:9px;width:90px;height:40px;float:left;position:relative;bottom:10px;display:inline;border-radius:12px;" class='btn form-control btn-primary btn-icon-text ml-3 mb-3'>
                                                            
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
              </svg>
              Back
            </button>
                <!-- Search Student -->
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Search Attendance <?php echo $error;?></h4>
                            <form class="forms-sample" action="updateattendance.php" method="post" autocomplete="off">

                                <!-- Student Spid & Search Button-->
                                <div class="row">
                                <div class="col-lg-10 col-md-9 col-sm-12">

                                    <div class="form-group">
                                    <label>Student SPID</label>
                                    <input type="text" maxlength="10" minlength="10" name="_spid" class="form-control" id="Stud_spid" placeholder="Enter student SPID" value="<?php echo $f_spid; ?>" required>
                                    

                                    <!-- <div class="form-group col-md-6 "> -->
                                    
                                    <?php echo $classroom_codes;?>

                                    <!-- </div> -->

                                    <!-- <div class="form-group col-md-6 "> -->
                                                <label class="mt-2">Date</label>
                                                <input type="date" id="currdate" name="_dt" class="form-control" value="<?php echo $f_date;?>" required> 
                                    <!-- </div> -->

                                    <?php echo $att_select_box?> 

                                    <input type="hidden" id="fid" name="_fid" value="<?php echo $fid?>" >  
                                    <input type="hidden" id="csrfToken" name="_csrfToken" value="<?php echo $JAMES->generateCsrfToken();?>" >  
                                    <?php echo $att_id;?>
                                    </div>
                                    <!-- set below button at good position -->
                                    <div class="form-group search_fetch_btn col-lg-2 mt-3 col-sm-12">
                                        <?php  echo $btn;?>
                                    </div>
                                </div>
                               
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            <!-------------------------------------------------------Student Card Start------------------------------------------------------->
            <?php echo $result_str; ?>
            
    <!-------------------------------------------------------Main Content End------------------------------------------------------->

    <!-- including footer -->
    <?php
    include './common/footer.php'
    ?>

</body>

</html>

