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
    input[type="submit"]{
    background-color: black; /* Green */
    border: none;
    color: white;
    padding: 16px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    transition-duration: 0.4s;
    cursor: pointer;
    }
    input[type="submit"]:hover {
    background-color: white;
    color: black;
    border:1px solid black;
    box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
    }
    a
    {
        text-decoration: none;
    }
    </style>
</head>

<body>

<center style="position:relative;top:100px;font-size:1.2em;">
<legend style="font-weight:bold;font-size:40px;"> Admin Panel </legend>
<br>
<fieldset style="width:200px;max-width:300px;height:auto;max-height:600px;background-color:lightblue;color:black;">
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
</center>


</body>

</html>