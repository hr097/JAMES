<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin:ams.vnsguit.org'); 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods,Authorization');


require_once("../../ams.php");
$JAMES = new AMS("User");
$JAMES->init_record_session();

function getAmsApi($classroomid) 
{   
    $sql= "select Students.cur_semester,Students.spid,Students.name,Students.gender,DATE_FORMAT(Students.dob,'%d/%m/%Y') AS dob,Students.cur_semester FROM Students,Ams_api WHERE Ams_api.spid=Students.spid and Ams_api.reader_no=$classroomid and reading_no=(SELECT MAX(Ams_api.reading_no) FROM Ams_api);";

    $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);
    
    if(mysqli_num_rows($result)==1)
    {
        $faculty = "";
        $record = mysqli_fetch_assoc($result);

            // $faculty.=
            // "
            // <tr class='student'>
            // <td>".$record['spid']."</td>
            // <td>".$record['name']."</td>
            // <td>".$record['gender']."</td>
            // <td>".$record['dob']."</td>
            // <td>".$record['cur_semester']."</td>
            // </tr>
            // ";

            if($record['gender']=='Male')
            {
                $profile = "<img src='../assets/profiles/student-profile-male.jpg' class='profile_img my-4' style='width:130px;height:130px;border-radius:49%;' alt='Student profile'>";
            }
            else
            {
                $profile =  "<img src='../assets/profiles/student-profile-female.png' class='profile_img my-4' style='width:130px;height:130px;border-radius:49%;' alt='Student profile'>";
            }   

            if($record['cur_semester']==1)
            {
                $sem = $record['cur_semester']."<sup>st</sup>";
            }
            else if($record['cur_semester']==2)
            {
                $sem = $record['cur_semester']."<sup>nd</sup>";    
            }
            else if($record['cur_semester']==3)
            {
                $sem = $record['cur_semester']."<sup>rd</sup>";   
            }
            else
            {
                $sem = $record['cur_semester']."<sup>th</sup>";   
            }
    
    

            $faculty.="<div class='container my-3' align='center' style='padding-bottom: 3%;'>

              <div class='scene'>
                <div class='flip-card' >
                  <div class='card__face card__face--front' style='border-radius: 10px;'>

                  ".$profile."
                    <h4  class='profile_name' style='color:white;margin-top:-12px;' >".$record['name']."</h4>
                  </div>

                  <div  class='card__face card__face--back py-4 pl-4' style='font-weight:500;font-size: 15px;' align='left'>
                    <p class='mt-3'>
                    <span  class='card_back_title mr-4'> SPID :&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>
                    <span class='card_back_data' style='font-weight:normal;'>".$record['spid']."</span>
                    </p>

                    
                    <p>
                    <span  class='card_back_title mr-4'> Roll No :</span>
                    <span lass='card_back_data' style='font-weight:normal;' >".$record['dob']."</span>
                    </p>

                    <p>
                    <span  class='card_back_title mr-4'> Course :</span>
                    <span lass='card_back_data' style='font-weight:normal;' >".$record['course_name']."</span>
                    </p>

                    <p>
                    <span  class='card_back_title mr-1'> Semester :</span>
                    <span lass='card_back_data' style='font-weight:normal;' >".$sem."</span>
                    </p>

                    <p>
                    <span  class='card_back_title mr-3'> Division :</span>
                    <span lass='card_back_data' style='font-weight:normal;' >".$record['cur_division']."</span>
                    </p>

                  </div>

                </div>
              </div>
              <!-------------------------------------------------------Student Card End------------------------------------------------------->
            </div>
          </div>";

        return $faculty;
    }
    else
    {
        // return "
        // <tr>
        // <td  colspan='6' style='font-size:1.2em;text-align:center;'>No Latest Data Available</td>
        // </tr>";

        return "<p style='font-size:1.3em;margin:auto;margin-top:100px;'>No Latest Data Available</p>";
    }
}

if(isset($_POST['_cid'])&&isset($_POST['_ct'])&&$_POST['_ct']==$_SESSION['_csrfToken']&&isset($_SESSION['_recordId']))
{
        $cid = $JAMES->sanitizeInput($_POST['_cid']);
        echo getAmsApi($cid);
}
else
{    
    $JAMES->ams_redirect("../../login.php"); // when outside request comes redirect to login
}

?>
