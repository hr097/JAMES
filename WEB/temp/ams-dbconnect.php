<?php

function ams_connect_db($usertype=null) // connect to the database with specified user type
{

$servername = "localhost";
$database = "JAMES";

if($usertype=0) // ams-authenticator user
{
    $username = "ams-authenticator";
    $password = "auth@000";
}
else if($usertype==1) // ams-student user
{
    $username = "ams-student";
    $password = "student@111";
}
else if($usertype==2) // ams faculty user
{
    $username = "ams-faculty";
    $password = "faculty@222";
}
else if($usertype==3) // ams management user
{
    $username = "ams-management";
    $password = "management@333";
}
else if($usertype==4) // ams-admin user
{
    $username = "ams-admin";
    $password = "admin@444";
}

try
{
  $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   // set the PDO error mode to exception
}
catch(PDOException $e) // catch the Exception
{ 
  echo "Something went wrong !!! <br> Please try again later.";
  header('location:./login.php'); // redirect to login page if connection is failed
}

}

?>