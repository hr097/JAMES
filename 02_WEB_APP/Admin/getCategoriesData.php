<?php

if(isset($_POST['auth'])&&$_POST['auth']==true)
{
    require_once("../Other/customlib.php");
    $connection= dbconnect();
    $result = mysqli_query($connection,"select * from categories;");
    mysqli_close($connection);

    if(mysqli_num_rows($result)>0)
    {   

        $html = '{"categories":[';

        while($row = mysqli_fetch_assoc($result))
        {
           $html.='{"c_name":"'.$row['c_name'].'","status":"'.$row['status'].'" },';
        }

        $html[strlen($html)-1] = " ";

        $html.=']}';

        echo $html;
    }
    else
    {
        echo "NO CATEGORIES ARE REGISTERED.";
    }

}
else
{
    header("Location:managecategories.php");
}

?>