<?php

if(isset($_POST['auth'])&&$_POST['auth']==true)
{
    require_once("../Other/customlib.php");
    $connection= dbconnect();
    $result = mysqli_query($connection,"select * from users where type<>1;");
    mysqli_close($connection);

    if(mysqli_num_rows($result)>0)
    {
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>". $row["username"]."</td></tr>";
          }
    }
    else
    {
        echo "NO USERS ARE REGISTERED.";
    }

}
else
{
    header("Location:manageuser.php");
}

?>