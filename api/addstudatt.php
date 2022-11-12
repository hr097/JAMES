<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin:*'); //* IT IS OPEN Becuase ESP has no DOMAIN
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization');

require_once("../ams.php");
$JAMES = new AMS("Admin");


    function insertStudAttendance($uid,$rNo) 
    {   
        //@query 
        //$sql = "select rf.spid as spid,s.cur_semester as sem from Rfid_uid_spid_map rf,vw_students s where s.spid=rf.spid and rf.uid='$uid';";
        $sql = "select * from Rfid_uid_spid_map where uid='$uid';";
        
        $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);

        if(mysqli_num_rows($result)===1)
        {
            $result = mysqli_fetch_assoc($result);
            
            $spid = $result['spid'];
           // $sem = $result['sem'];

           // $cur_time = date("h:i:s A",time());
            //$cur_date = date("Y-m-d");
            

            //reader maintenance query here if control is given on web (admin side)

            //@query
            //$sql = "insert into Ams_api(reader_no,reading_date,reading_time,spid,semester) values($rNo,'$cur_date','$cur_time','$spid',$sem);";
            $sql = "insert into Ams_api(reader_no,spid) values($rNo,'$spid');";

            if(mysqli_query($GLOBALS['JAMES']->connection(),$sql))
            {
                return 1;
            }
            else
            {
                return 503;// something went wrong!
            }
           
        }
        else
        {
            return -1; //UID not found
        }
    }

    $data = json_decode(file_get_contents("php://input"), true);

    if($data===null)
    {
       $JAMES->ams_redirect("../login.php"); // when outside request comes redirect to login
    }
    else if(count($data)===0)
    {
        echo json_encode(array('response' => 'Empty Request!'));
    }
    else if(isset($data['_uid'])==false||isset($data['_r_no'])==false||isset($data['_api_token'])==false) 
    {
        echo json_encode(array('response' => 'Insufficient Request!'));
    }
    else if($data['_api_token']!=="1008kbno9qessgzah1k5rjsnnwtr9yco2vlfgzw9nu5261") //@token
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
        echo $message;
    }

?>