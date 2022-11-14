<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

echo "data: The server time is: hello\n\n";
flush();
?>