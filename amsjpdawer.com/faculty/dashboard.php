<?php

 require_once("../php/commonlib.php");
 init_user_session();

 echo "This is faculty dashboard";

 echo "<br>";

 if(isset($_SESSION["_userId"]) && isset($_SESSION["_userType"])&&$_SESSION["_userType"]==="2")
 {
    echo "<br>".$_SESSION["_userId"];
    echo "<br>".$_SESSION["_userType"];
 }
 else
 {
  redirect("../index.php");
 }


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <link rel="icon" href="" type="image/icon type">
        <style type="text/css">
        </style>
    </head>
    <body>
      <form action="../php/logout.php" method="post">
      <input type="submit" name="logout" value="logout">
      </form>
    </body>
    <script type="text/javascript"></script>
    <noscript>Sorry, Your browser does not support JavaScript !!!</noscript>
</html>