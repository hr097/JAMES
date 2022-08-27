<?php

require_once("../php/other/amslib.php");


if( isset($_POST['_username']) && isset($_POST['_password']) )
{
    //* further code for pdo select query

    echo "request came from authenticated user";

    //*
}
else if( isset($_GET['_authToken']) )
{
    // cookies based login here
}
else
{
    ams_redirect("../index.php");
}


if(isset($_POST['rememberMe']))
{
    //set cookies as a token only
}

?>