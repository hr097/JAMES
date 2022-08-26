<?php

if(isset($_POST['auth'])&&$_POST['auth']==true)
{
    require_once("../Other/customlib.php");
    $connection= dbconnect();
    $result = mysqli_query($connection,"select * from orders;");
    mysqli_close($connection);

    if(mysqli_num_rows($result)>0)
    {
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr name='data' ><td>". $row["o_id"]."</td><td>". $row["username"]."</td><td>".$row["p_name"]."</td><td>".$row['quantity']."</td><td>". $row["address"]."</td><td>".$row["d_status"]."</td></tr>";
          }
    }
    else
    {
        echo "<tr><td colspan='6'>No pending orders are there for the moment </td></tr>";
    }

}
else
{
    header("Location:manageorders.php");
}

?>