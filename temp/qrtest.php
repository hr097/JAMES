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