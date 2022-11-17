<?php


if(isset($_GET['classroomid']))
{
    $html = $_GET['classroomid'];
}
else
{
    echo "Invalid Request;";
}

?>

<!DOCTYPE html>

<html lang="en">

    <head>

        <title>AMS | e-Attendance </title>

        <style type="text/css">

        </style>

        <!-- favicon -->
        <link rel="shortcut icon" href="../assets/logos/favicon.ico">

    </head>

    <body>

    <center><p style="font-size:5em;margin-top:200px;font-family:Poppins,'Arial';"><?php echo "Classroom code: ".$html; ?></p>
    <p style="font-size:5em;font-family:Poppins,'Arial';color:green;">Attendance marked successfully</p></center>
    <img src="../assets/other/att_success2.gif" style="height:980px;width:100%;margin-top:100px;" alt="Attendance marked">
    

    </body>

    <script type="text/javascript"></script>

    <noscript>Sorry, Your browser does not support JavaScript !!!</noscript>

</html>

