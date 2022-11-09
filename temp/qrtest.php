<?php


if(isset($_GET['spid'])&&isset($_GET['classroomid']))
{
    echo "STUDENT ID: ".$GET['spid']."<br>";
    echo "CLASSROOM ID: ".$GET['classroomid'];
}
else
{
    echo "Invalid Request;";
}

?>