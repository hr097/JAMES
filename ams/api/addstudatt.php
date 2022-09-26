<?php

require_once("../ams.php");
$JAMES = new AMS(1);

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); //? Reader system will send request so its open
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization');

    function insertStudAttendance($uid,$rNo) 
    {    
        $sql = "select * from Rfid_uid_spid_map where uid='$uid';";
        $result = mysqli_query($this->db_connection,$sql);

        if(mysqli_num_rows($result)===1)
        {
            $result = mysqli_fetch_assoc($result);
            
            $spid = $result['spid'];

            $sql = "insert into Ams_api(reader_no,spid) values($rNo,'$spid');";

            if(mysqli_query($this->db_connection,$sql))
            {
                return 1;
            }
            else
            {
                return "Something went wrong!";
            }
           
        }
        else
        {
            return "Uid not found!";
        }
    }

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

    $message = insertStudAttendance($uid,$readerNo);

    echo json_encode(array('response' => $message));
}

?>