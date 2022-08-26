<?php

if(isset($_POST['auth'])&&$_POST['auth']==true)
{
    require_once("../Other/customlib.php");
    $connection= dbconnect();
    $result = mysqli_query($connection,"select p_name,products.status As status,categories.c_name As category from products,categories where categories.c_id=products.c_id;");
    mysqli_close($connection);

    if(mysqli_num_rows($result)>0)
    {   

        $html = '{"products":[';

        while($row = mysqli_fetch_assoc($result))
        {
           $html.='{"p_name":"'.$row['p_name'].'","status":"'.$row['status'].'","category":"'.$row['category'].'" },';
        }

        $html[strlen($html)-1] = " ";

        $html.=']}';

        echo $html;
    }
    else
    {
        echo "NO PRODUCTS ARE REGISTERED.";
    }

}
else
{
    header("Location:manageproducts.php");
}

?>