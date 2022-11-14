<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$data="<tr class='student'>
         <td>.record['spid'].</td>
         <td>.record['name'].</td>
        <td>.record['gender'].</td>
        <td>.record['rdt'].</td>
        <td>.record['cur_semester'].</td>
         </tr>";


echo "data: ".$data."\n\n";
flush();
?>