<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin:ams.vnsguit.org'); //* IT IS OPEN Becuase ESP has no DOMAIN
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization');

require_once("../ams.php");
$JAMES = new AMS("Admin");

    function insertStudAttendance($uid,$rNo) 
    {   
        //@query 
        $sql = "select * from Rfid_uid_spid_map where uid='$uid';";
        
        $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);

        if(mysqli_num_rows($result)===1)
        {
            $result = mysqli_fetch_assoc($result);
            
            $spid = $result['spid'];
          
            $sql = "insert into Ams_api(reader_no,spid) values($rNo,'$spid');";

            if(mysqli_query($GLOBALS['JAMES']->connection(),$sql))
            {
                return 1;// attendance successful
            }
            else
            {
                return -1;// something went wrong!
            }
           
        }
        else
        {
            return 0; //UID not found
        }
    }

    $data = json_decode(file_get_contents("php://input"), true);

    if($data===null)
    {
       $JAMES->ams_redirect("../login.php"); // when outside request comes redirect to login
    }
    else if(count($data)===0)
    {
        echo -2; //'Empty Request!';
    }
    else if(isset($data['_uid'])==false||isset($data['_r_no'])==false||isset($data['_api_token'])==false) 
    {
        echo -3;//'Insufficient Request!'
    }
    else if($data['_api_token']!=="1008kbno9qessgzah1k5rjsnnwtr9yco2vlfgzw9nu5261") //@token
    {
        echo -4;//'Unauthorized Request!'
    }
    else if($data['_api_token']===""||$data['_r_no']==="")
    {
        echo -5;//'Incomplete Request!'
    }
    else
    {
        $uid =  $JAMES->sanitizeInput($data['_uid']);
        $readerNo = $JAMES->sanitizeInput($data['_r_no']);
        $message = insertStudAttendance($uid,$readerNo);
        echo $message;
    }

?>