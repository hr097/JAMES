<?php

if(isset($_POST["logout"]))
{
    require_once("../php/commonlib.php");
    session_unset();
    session_destroy();

    if(count($_COOKIE) > 0 && isset($_COOKIE["__u9RmdkJ6"]))
    {
    setcookie("__u9RmdkJ6","", time() - 3600, "/");
    }
    redirect("../index.php");
    exit();
}
else
{
    redirect("../index.php");
    exit();
}
?>