<?php
require_once("../php/amslib.php");
init_user_session();

echo "This is admin dashboard";

echo "<br>";

if(isset($_SESSION["_userId"]) && isset($_SESSION["_userType"])&&$_SESSION["_userType"]==="4")
{
   echo "<br>".$_SESSION["_userId"];
   echo "<br>".$_SESSION["_userType"];
}
else
{
 redirect("../index.php");
}

?>