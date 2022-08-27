<?php

require_once("../php/other/amslib.php");

if(isset($_POST['_un']))
{
    //* further code for pdo select query

    echo "1";

    //*
}
else
{
    ams_redirect("../index.php");
}

?>