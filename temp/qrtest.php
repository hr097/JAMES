<?php


if(isset($_GET['spid'])&&isset($_GET['classroomid']))
{
    echo "STUDENT ID: ".$_GET['spid']."<br>";
    echo "CLASSROOM ID: ".$_GET['classroomid'];
}
else
{
    echo "Invalid Request;";
}

?>