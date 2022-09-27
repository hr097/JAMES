<?php
$db_connection = mysqli_connect('localhost','root','','james');

if(!$db_connection)
{
    echo "not working";
}
else
{
    echo "working";
}

?>