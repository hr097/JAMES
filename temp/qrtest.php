<?php


if(isset($_GET['ip'])&&isset($_GET['classroomid']))
{
    echo "IP ADDRESS: ".$_GET['ip']."<br>";
    echo "CLASSROOM ID: ".$_GET['classroomid'];
}
else
{
    echo "Invalid Request;";
}

?>