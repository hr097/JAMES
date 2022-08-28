<?php

require_once("../php/amslib.php");
require_once("./php/commanlib.php");

$JAMES = new AMS(0);

if(isset($_POST['_un'])&&isset($_POST['_ps']))
{
        $u = sanitizeInput($_POST['_un']);
        $p = sanitizeInput($_POST['_ps']);
        echo $JAMES->verify_user($u,$p);
}
else
{
    $JAMES->ams_redirect("../index.php");
}

?>