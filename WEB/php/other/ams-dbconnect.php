<?php
$servername = "localhost";
$username = "ams"; 
$password = "";
$database = "JAMES";
try {
  $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   // set the PDO error mode to exception
} catch(PDOException $e) {
  echo "Something went wrong !!! <br> Please try again later.";
  header('location:./login.php');
}
?>