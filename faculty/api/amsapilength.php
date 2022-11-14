<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$data="Helllo worldalsdhjbnbnbnbnbnbnbnbnbnbnbnbnbnbnbnbnbnbnbnbnbnbnbnbnbnbnbnbnbnbnbnbnbnbnbnbnbnadssssssssssssssssssssssssssssssssssssssssssssssssssssssssss";


echo "data: {$data}\n\n";
flush();
?>