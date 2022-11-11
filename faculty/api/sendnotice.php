<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin:ams.vnsguit.org'); 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods,Authorization');

require_once("../../ams.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();


function sendEmailNotice($student,$email) 
{
    $GLOBALS['JAMES']->todayTime =  date("h:i:s A",  time()); // fetch latest time 
    
    //@email template    

    $st_att = $student['att_percentage']??0;

    $htmlContent = "

    <!DOCTYPE html>
      <html>
      <head>
          <title></title>
          <meta http-equiv='Content-Type' content='text/html, charset=utf-8' />
          <meta name='viewport' content='width=device-width, initial-scale=1'>
          <meta http-equiv='X-UA-Compatible' content='IE=edge' />
          <link href='https://fonts.googleapis.com/css2?family=Poppins&display=swap' rel='stylesheet'>
          <style type='text/css'>
             
              body,
              table,
              td,
              a {
                  -webkit-text-size-adjust: 100%;
                  -ms-text-size-adjust: 100%;
              }
              *{
                font-family: 'Poppins',Arial;
              }
              table,
              /* td {
                  mso-table-lspace: 0pt;
                  mso-table-rspace: 0pt;
              } */
      
              img {
                  -ms-interpolation-mode: bicubic;
              }
      
              
              img {
                  border: 0;
                  height: auto;
                  line-height: 100%;
                  outline: none;
                  text-decoration: none;
              }
      
              table {
                  border-collapse: collapse !important;
              }
      
              body {
                  height: 100% !important;
                  margin: 0 !important;
                  padding: 0 !important;
                  width: 100% !important;
              }
      
            
              a[x-apple-data-detectors] {
                  color: inherit !important;
                  text-decoration: none !important;
                  font-size: inherit !important;
                  font-family: inherit !important;
                  font-weight: inherit !important;
                  line-height: inherit !important;
              }
              .AttendanceTable{
                margin-top:20px;
              }
              
              .AttendanceTable,.AttendanceTable tr td{
                border: 2px solid black;
                padding: 5px 25px 5px 15px;
                font-family: poppins;
                font-size: 14px;

              }
              @media screen and (max-width:600px) {
                  h1 {
                      font-size: 32px !important;
                      line-height: 32px !important;
                  }
              }
      
             
              div[style*='margin: 16px 0;'] {
                  margin: 0 !important;
              }
          </style>
      </head>
      
      <body style='background-color: #ffffff;margin: 0 !important; padding: 0 !important;'>
          
      
          <table border='0' cellpadding='0' cellspacing='0' width='100%'>
             
              <tr>
                  <td align='center' style ='background: #5755a5'>
                      <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                          <tr>
                              <td align='center' valign='top' style='padding: 40px 10px 40px 10px;'> </td>
                          </tr>
                      </table>
                  </td>
              </tr>
              <tr>
                  <td  align='center' style='padding: 0px 10px 0px 10px;background : #5755a5'>
                      <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                          <tr>
                              <td bgcolor='#ffffff' align='center' valign='top' style='padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #4b49ac; font-family: poppins; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;'>
                                  <h1 style='font-size: 35px; font-weight: 500; margin: 2;'><b>Attendance Notice</b></h1> <img src='https://live.staticflickr.com/65535/52097859173_5b6d3573df_n.jpg' width='250' height='120' style='display: block; border: 0px;' />
                              </td>
                          </tr>
                      </table>
                  </td>
              </tr>
              
              <tr>
                  <td  align='center' style='padding: 0px 10px 0px 10px; background-color: #f4f4f4;'>
                      <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                          <tr>
                              <td bgcolor='#ffffff' align='center' style='padding: 20px 30px 20px 30px; color: #000000; font-family: Poppins; font-size: 14px; font-weight: 400; line-height: 30px;'>
                                  <p style='margin: 0; '><span style='font-size: 18px;font-weight:500;' >Dear,<br><b>".$student['name']."</b></span>,<br><br><br>Your total attendance performance calculated till date in below mentioned subject is depicted below. In order to maintain healthy attendance score<span style='color:green;' >(80% and above)</span>,you must attend the upcoming lectures conducted by respective subject faculties.
                                    </p>
                              </td>
                          </tr>
                      </table>
                  </td>
              </tr>
              <tr>
                <td bgcolor='#f4f4f4' align='center' style='padding: 0px 10px 0px 10px;'>
                    <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                      <tr>
                        <td bgcolor='#ffffff' align='left'>
                            <table width='100%' border='0' cellspacing='0' cellpadding='0'>
                                <tr>
                                    <td bgcolor='#ffffff' align='center' style='padding: 20px 30px 30px 30px;'>
                                        <table border='0' cellspacing='0' cellpadding='0'>
                                            <tr>
                                                <td align='center' style='border-radius: 3px; color: #000000; font-family: Poppins; font-size: 20px; font-weight: 700; line-height: 30px;' >Attendance Summary Report</td>
                                            </tr>
                                        </table>
                                        <table class = 'AttendanceTable' style='border:2px solid black'>
                                            <tr>
                                                <td>SPID</td>
                                                <td>".$student['spid']."</td>
                                            </tr>

                                            <tr>
                                                <td>Roll No.</td>
                                                <td>".$student['cur_roll_no']."</td>
                                            </tr>
                                            <tr>
                                                <td>Course Name</td>
                                                <td>".$student['course_name']."</td>
                                            </tr>
                                            <tr>
                                                <td>Semester</td>
                                                <td>".$student['cur_semester']."</td>
                                            </tr>
                                            <tr>
                                                <td>Division</td>
                                                <td>".$student['cur_division']."</td>
                                            </tr>
                                            <tr>
                                                <td>Subject Name</td>
                                                <td><b>".$student['subject_name']."</b></td>
                                            </tr>
                                            <tr>
                                                <td>Present Count</td>
                                                <td ><span style='padding:0px 12px;color:white;font-size:14px;background-color: #57B657;border-radius: 8px;'>".$student['p_days']." Days</span></td>
                                            </tr>
                                            <tr>
                                                <td>Absent Count</td>
                                                <td ><span style='padding:0px 12px;color:white;font-size:14px;background-color: #FF4747;border-radius: 8px;'>".$student['a_days']." Days</span></td>
                                            </tr>
                                            <tr>
                                                <td>Average Present</td>
                                                <td ><span style='padding:0px 12px;color:white;font-size:14px;background-color: #FFC100;border-radius: 8px;'>".$st_att."%</span></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr> 
                    </table>
                </td>
              </tr>
              
              <tr>
                <td  align='center' style='padding: 0px 10px 0px 10px; background-color: #f4f4f4;'>
                    <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                        <tr>
                            <td bgcolor='#ffffff' align='center' style='padding: 0px 30px 40px 30px; color: #000000; font-family: poppins; font-size: 14px; font-weight: 400; line-height: 30px;'>
                                <p style='margin: 0; '> <span style='font-weight:700;' >NOTE: </span> <em><span style='color:red;'>If your total subject attendance will be less than 60% then you may not be eligible to sit in examination held by department/university.</span>Additionally, 
                                    department reserves right to decide candidate's examination eligibility right based on his/her attendance in that particular subject.</em>
                                    </p>
                                <p style='margin:0;text-align: center;'><br><b style='font-size: 16px;'>".$student['fname'].",</b><br><b>(".$student['role_name'].")</b><br><a href='https://vnsguit.org'>Department of Information & Communication Technology</a>,<br><a href='https://www.vnsgu.ac.in/'>Veer Narmad South Gujarat University</a>,<br>Surat-395007.<br></p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

              <tr>
                  <td bgcolor='#f4f4f4' align='center' style='padding: 30px 10px 40px 10px;'>
                      <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                          <tr>
                              <td align='center' style='background : #5755a5;padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: poppins; font-size: 18px; font-weight: 400; line-height: 30px;'>
                                  <h2 style='font-size:18px; font-weight: 400; color: #ffffff; margin: 0;'>Have any questions for us or need more information ? 
                                  <p style='margin: 0;'><a href='mailto:ams.jpd@gmail.com' target='_blank' style='color: rgb(255, 255, 255);'><b>Just shoot us an email!<br> We are always here to help.</b></a><a style='color:#ffffff;font-size:16px;'><br>admin.jpd.ams@gmail.com</a></p>
                              </td>
                          </tr>
                      </table>
                  </td>
              </tr>
          </table>
      </body>
      
      </html>
     
    ";
    
          
    return(($GLOBALS['JAMES']->sendEmail($email,"Attendance Notice",$htmlContent))?1:-1);

}

function sendNotice($cid,$email) 
{        
    //@query
    $sql = "
    SELECT S.name,S.cur_roll_no,S.cur_semester,S.cur_division,C.course_name,SB.subject_name,SB.subject_code,F.name As fname,FR.role_name,S.spid,ASCSM.year,ASCSM.division,ASSM.p_days,ASSM.a_days,(round(( (ASSM.p_days) / (ASSM.p_days + ASSM.a_days)*100))) As att_percentage FROM Students S,Faculties F,Subjects SB,Courses C,Course_subject_map CSM,Ams_setup_students_map ASSM,Ams_setup_faculties_map ASFM,Ams_setup_course_subject_map ASCSM,Faculty_roles FR WHERE
    S.course_id=C.course_id AND
    CSM.course_id=C.course_id AND
    CSM.subject_id=SB.subject_id AND
    F.fid=ASFM.fid AND
    F.role_id=FR.role_id AND
    S.spid=ASSM.spid AND
    ASCSM.cs_id=CSM.cs_id AND
    ASCSM.ams_setup_id=ASSM.ams_setup_id AND
    ASCSM.ams_setup_id = ASFM.ams_setup_id AND
    ASSM.ams_setup_id=ASFM.ams_setup_id AND
    S.email='$email' and ASCSM.ams_setup_id=$cid;
    ";

    $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);

    if(mysqli_num_rows($result)>0)
    {   
        $student = mysqli_fetch_assoc($result);

        echo(sendEmailNotice($student,$email));
    }
    else
    {
        return 0;
    }
}


    if(isset($_POST['_cid'])&&isset($_POST['_eid'])&&isset($_POST['_ct'])&&$_POST['_ct']==$_SESSION['_csrfToken']&&isset($_SESSION['_userId']))
    {
            $classroomid = $JAMES->sanitizeInput($_POST['_cid']);
            $email = $JAMES->sanitizeInput($_POST['_eid']);

            echo(sendNotice($classroomid,$email)); 
            
    }
    else
    {    
        $JAMES->ams_redirect("../../login.php"); // when outside request comes redirect to login
    }




?>