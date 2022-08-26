<?php
    session_start();
    session_regenerate_id(true);

    if(!(isset($_SESSION["_csrfToken"])&&isset($_SESSION["_userId"]) && isset($_SESSION["_userType"])&&$_SESSION["_userType"]==="1"))
    {
        header("Location:../index.php");
        exit();
    }
    else if(isset($_POST["logout"]))
    {   
        session_unset();
        session_destroy();
        if(count($_COOKIE) > 0 && isset($_COOKIE["__u9RmdkJ6"]))
        {
        setcookie("__u9RmdkJ6","", time() - 3600, "/");
        }
        header("Location:../index.php");
        exit();
    }

?>

<!DOCTYPE html>

<html>

<head>

    <title>Shopping cart | Dashboard </title>
    <link rel="icon" type="image/x-icon" href="./Assets/favicon.png">
    <style type="text/css">
    li
    {
        margin:20px;
    }
    </style>
</head>

<body>

<fieldset style="width:200px;max-width:300px;height:auto;max-height:600px;">
    <legend> Admin panel options </legend>
    <ol type="number">
        <li><a href="manageuser.php">Manage Users</a></li>
        <li><a href="managecategories.php">Manage Categories</a></li>
        <li><a href="manageproducts.php">Manage Products</a></li>
        <li><a href="manageorders.php">Manage Orders</a></li>
    </ol>
</fieldset>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
 <input  style="margin:20px;" type="submit" name="logout" value="logout">
</form>

</body>

</html>