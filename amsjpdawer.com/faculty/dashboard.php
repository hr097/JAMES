<?php


 require_once("../amslib.php");
 $JAMES = new AMS(0);
 $JAMES->init_user_session();

 echo "This is Faculty dashboard";

 echo "<br>";

 if($JAMES->checkSession()&&$_SESSION["_userType"]==="2")
 {
    echo "<br>".$_SESSION["_userId"];
    echo "<br>".$_SESSION["_userType"];
    echo "<br>".$_SESSION["_csrfToken"];
 }
 else
 {
  $JAMES->ams_redirect("../index.php");
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


