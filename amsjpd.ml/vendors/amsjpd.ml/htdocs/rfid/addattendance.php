<?php
require_once("../amslib.php");
$JAMES = new AMS(0);

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization');

$data = json_decode(file_get_contents("php://input"), true);

if(count($data)===0)
{
    echo json_encode(array('response' => 'Empty Request!'));
}
else if(isset($data['_uid'])==false||isset($data['_r_no'])==false||isset($data['_api_token'])==false) 
{
    echo json_encode(array('response' => 'Insufficient Request!'));
}
else if($data['_api_token']!=="1008kbno9qessgzah1k5rjsnnwtr9yco2vlfgzw9nu5261")
{
    echo json_encode(array('response' => 'Unauthorized Request!'));
}
else if($data['_api_token']===""||$data['_r_no']==="")
{
    echo json_encode(array('response' => 'Incomplete Request!'));
}
else
{
    $uid =  $JAMES->sanitizeInput($data['_uid']);
    $readerNo = $JAMES->sanitizeInput($data['_r_no']);

    $message =  $JAMES->RfidApi($uid,$readerNo);

    echo json_encode(array('response' => $message));
}

?>