<?php


// this page will decide which dashboard will appear on browser based on user type sent in
//form given by user 1 2 3 4 ..

echo $_POST['username'];
echo "<br>";
echo $_POST['password'];
echo "<br>";
echo $_POST['user'];
echo "<br>";

if(isset($_POST['remember-user']))
{
    echo "true set cookie";
}


?>