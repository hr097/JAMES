<?php


if(isset($_GET['classroomid']))
{
    echo "CLASSROOM ID: ".$_GET['classroomid'];
    echo "<br><br>Your attendance has been marked successfully as present.";
}
else
{
    echo "Invalid Request;";
}

?>

<!DOCTYPE html>

<html lang="en">

    <head>

        <title></title>

        <link rel="icon" href="" type="image/icon type">

        <style type="text/css">

        </style>

        <!-- favicon -->
        <link rel="shortcut icon" href="../assets/logos/favicon.ico">

    </head>

    <body>

    <img src="../assets/other/att_success2.gif" style="margin:auto;max-width:100%lwidth:100%;margin-top:40%;" alt="Attendance marked">

    </body>

    <script type="text/javascript"></script>

    <noscript>Sorry, Your browser does not support JavaScript !!!</noscript>

</html>

