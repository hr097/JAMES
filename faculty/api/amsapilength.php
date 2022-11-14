<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$api="ok".$_GET['cid'];
$data="Hello".$api."ok";


echo "data: {$data}\n\n";
flush();
?>