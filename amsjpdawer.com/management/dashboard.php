<?php
require_once("../php/amslib.php");
init_user_session();


echo "This is management dashboard";

echo "<br>";

if(isset($_SESSION["_userId"]) && isset($_SESSION["_userType"])&&$_SESSION["_userType"]==="3")
{
   echo "<br>".$_SESSION["_userId"];
   echo "<br>".$_SESSION["_userType"];
}
?>