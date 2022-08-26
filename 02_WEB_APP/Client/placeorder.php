<?php
 require_once('../Other/customlib.php'); 

if(isset($_GET['productName'])&&isset($_GET['quantity'])&&isset($_GET['uname'])&&isset($_GET['addr']))
{   
    
    $a1 = $_GET['uname'];
    $a2 = $_GET['productName'];
    $a3 = $_GET['quantity'];
    $a4 = $_GET['addr'];

    $sql = "insert into orders(username,p_name,quantity,address) values('$a1','$a2',$a3,'$a4');";
    
    $connection = dbconnect();

    if(mysqli_query($connection,$sql))
    {
        echo "order place successfully";
    }
    else
    {
        echo "order failed ";
    }
    mysqli_close($connection);
    
}
else
{
    echo "no order details";
}
?>