<?php

require_once("../ams.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();

if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="1"))
{
 $JAMES->ams_redirect("../login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- including header -->
    <?php
    require_once('./common/header.php');
  ?>

    <!-- css  -->
    <link rel="stylesheet" href="../css/student.css">

    <!-- page information-->
    <title>AMS | About</title>

</head>

<body>

    <!-------------------------------------------------------Main Content------------------------------------------------------->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="container" style="display: inline-block;">
                <!-- <h2 class="underline">About VNSGU AMS</h2> -->

                <h5 class="small_titles"> About VNSGU</h5>
                <p>Veer Narmad South Gujarat University offers different programmes through well designed curricular,
                    co-curricular and extra-curricular activities; undertakes research and reaches out to society at
                    large with various extension activities, in order to empower its stakeholders for the world class
                    skills in terms of : research and enquiry, creativity and innovation, capacity to use high
                    technology and value-based ethical leadership.</p><br>

                <h5 class="small_titles">About ICT Department</h5>
                <p>The institute was started in year 2000 and comes under the Veer Narmad South Gujarat University,
                    Surat. The Courses offered here are a mixed blend of Computer Engineering, Computer Science,
                    Business systems, Management, Electronics and Communication Engineering, computer Application etc.
                    The goal of M.Sc(IT)/ICT Programs is to prepare students with intellectual and professional skills
                    with breadth and depth of knowledge, to enable them to fetch challenging career opportunities in an
                    ever-changing world of Information and communication technology. </p><br>

                <h5 class="small_titles">About JPD-AMS</h5>
                <p>This is a fully functional RFID based attendance management system. Enables the faculties to record
                    students' attendance in a fuss-free manner.
                    It is basically a fusion of software, hardware and web-based application. The system is directly
                    connected to the database without any intermediary.

                    </br></br>Extremely fast, secure and reliable system for the department to maintain the daily
                    attendance of students without any hassle. A major benefit of the system is its automation and quick
                    response charateristic.
                </p><br>

                <h5 class="small_titles">Contact Us</h5>
                <p>Phone : 9512358030, 9512358031,
                    <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0261 - 225 8030,
                    2258031
                    <br />Email: &nbsp;&nbsp;&nbsp;itoffice@vnsgu.ac.in
                </p><br>

                <h5 class="small_titles"><i>Address</i></h5>
                <p><i>J.P. Dawer Institute of Information Science & Technology,
                        <br />Department of Information and Communication Technology,
                        <br />Veer Narmad South Gujarat University
                        <br />Opp. VNSGU Convention Hall, Near V. C. Bungalow
                        <br />Udhana Magdalla Road, Surat - 395 007
                        <br />Gujarat- India</i></p>

            </div>
        </div>
    </div>

    <!-- including footer -->
    <?php
    require_once('./common/footer.php');
  ?>

</html>