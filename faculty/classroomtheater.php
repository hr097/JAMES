 <?php

 require_once("../ams.php");
$JAMES = new AMS("Admin");
$JAMES->init_user_session();

if (!($JAMES->checkSession()&&$_SESSION["_userType"]==="2")) {
    $JAMES->ams_redirect("../login.php");
}

$u = $_SESSION["_userId"];

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
       <div class="col-md-12">
            <p class="class_title">Classroom</p>
        </div>

        <div class="row students_list">
            <div class="col-md-6 student_list_col">
            <input type="button" class="student_btn_present" id="attendance_btn" value="1" onclick="setColor()">
            <input type="button" class="student_btn_present" id="attendance_btn" value="2" onclick="setColor()">
            <input type="button" class="student_btn_present" id="attendance_btn" value="3" onclick="setColor()">
            <input type="button" class="student_btn_present" id="attendance_btn" value="4" onclick="setColor()">
            <input type="button" class="student_btn_present" id="attendance_btn" value="5" onclick="setColor()">
            <input type="button" class="student_btn_present" id="attendance_btn" value="6" onclick="setColor()">
            <input type="button" class="student_btn_present" id="attendance_btn" value="7" onclick="setColor()">
            <input type="button" class="student_btn_present" id="attendance_btn" value="8" onclick="setColor()">
            <input type="button" class="student_btn_present" id="attendance_btn" value="9" onclick="setColor()">
            <input type="button" class="student_btn_present" id="attendance_btn" value="10" onclick="setColor()">
            <input type="button" class="student_btn_present" id="attendance_btn" value="11" onclick="setColor()">
            <input type="button" class="student_btn_present" id="attendance_btn" value="12" onclick="setColor()">
            <input type="button" class="student_btn_present" id="attendance_btn" value="13" onclick="setColor()">
            <input type="button" class="student_btn_present" id="attendance_btn" value="14" onclick="setColor()">
            <input type="button" class="student_btn_present" id="attendance_btn" value="15" onclick="setColor()">
            <input type="button" class="student_btn_present" id="attendance_btn" value="16" onclick="setColor()">
            <input type="button" class="student_btn_present" id="attendance_btn" value="17" onclick="setColor()">
            <input type="button" class="student_btn_present" id="attendance_btn" value="18" onclick="setColor()">
            <input type="button" class="student_btn_present" id="attendance_btn" value="19" onclick="setColor()">
            <input type="button" class="student_btn_present" id="attendance_btn" value="20" onclick="setColor()">
            <input type="button" class="student_btn_present" id="attendance_btn" value="21" onclick="setColor()">
            <input type="button" class="student_btn_present" id="attendance_btn" value="22" onclick="setColor()">
            <input type="button" class="student_btn_present" id="attendance_btn" value="23" onclick="setColor()">
            <input type="button" class="student_btn_present" id="attendance_btn" value="24" onclick="setColor()">
            <input type="button" class="student_btn_present" id="attendance_btn" value="25" onclick="setColor()">
            <input type="button" class="student_btn_present" id="attendance_btn" value="26" onclick="setColor()">
            <input type="button" class="student_btn_present" id="attendance_btn" value="27" onclick="setColor()">
            <input type="button" class="student_btn_present" id="attendance_btn" value="28" onclick="setColor()">
            <input type="button" class="student_btn_present" id="attendance_btn" value="29" onclick="setColor()">
            <input type="button" class="student_btn_present" id="attendance_btn" value="30" onclick="setColor()">
            <input type="button" class="student_btn_present" id="attendance_btn" value="20" onclick="setColor()">





            </div>
            <div class="col-md-6 student_list_col">
            <input type="button" class="student_btn_present" value="1">
            <input type="button" class="student_btn_present" value="1">
            <input type="button" class="student_btn_present" value="1">
            <input type="button" class="student_btn_present" value="1">
            <input type="button" class="student_btn_present" value="1">
            <input type="button" class="student_btn_present" value="1">
            <input type="button" class="student_btn_present" value="1">
            <input type="button" class="student_btn_present" value="1">
            <input type="button" class="student_btn_present" value="1">
            <input type="button" class="student_btn_present" value="1">
            <input type="button" class="student_btn_present" value="1">
            <input type="button" class="student_btn_present" value="1">
            <input type="button" class="student_btn_present" value="1">
            <input type="button" class="student_btn_present" value="1">
            </div>
        </div>

      </div>
    </div>



    <!-- including footer -->
    <?php
include './common/footer.php'
?>

<script>
    var count = 1;
    function setColor() {
        var property = document.getElementById("attendance_btn");
        if (count == 0) {
            property.style.backgroundColor = "#5eba7d"
            count = 1;        
        }
        else {
            property.style.backgroundColor = "#d9534f"
            count = 0;  
        }
    }
//     $(document).ready(function() {
// 	     	$("attendance_btn").click(function() {
//     $("#attendance_btn").css({'color': '#6600FF', 'background-color' : '#CC3333'});
//     });
//   });
   
</script>

</body>

</html>