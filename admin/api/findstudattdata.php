<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin:ams.vnsguit.org'); 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods,Authorization');

require_once("../../ams.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();

function findStudents($spid) 
{ 
    $sql= "select DATE_FORMAT(A.dob,'%d-%m-%Y')AS fdob,(round(( (p_days) / (p_days + a_days)*100))) As att_percentage, A.spid,A.*,B.*,C.*,E.*,F.*
    from bckp_students A, bckp_ams_setup_students_map B, ams_setup_course_subject_map C , course_subject_map D, subjects E, courses F
    where A.spid = B.spid AND B.ams_setup_id = C.ams_setup_id AND C.cs_id = D.cs_id AND D.subject_id = E.subject_id AND A.course_id = F.course_id AND
    A.spid = $spid;";

    $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);
    $flag = true;
    if(mysqli_num_rows($result)>0)
    {
        $student = "";
        while($record = mysqli_fetch_assoc($result))
        {
            $spid = $record['spid'];
            $name = $record['name'];
            $email = $record['email'];
            $gender = $record['gender'];
            $division = $record['last_division'];
            $rollno = $record['last_roll_no'];
            $dob = $record['fdob'];
            $jyear = $record['joining_year'];
            $att_pr = $record['att_percentage'];
            $cnumber = $record['contact_no'];
            if($record['last_semester'] == 1)
            {
                $semester = "1<sup>st</sup>";
            }
            else if($record['last_semester'] == 2)
            {
                $semester = "2<sup>nd</sup>";
            }
            else if($record['last_semester'] == 3)
            {
                $semester = "3<sup>rd</sup>";
            }
            else
            {
                $semester = $record['last_semester']."<sup>th</sup>";
            }
            if ($record['att_percentage']>=80) {
                $att_pr=" <td><button type='button' class='btn btn-success rounded px-3 py-2'>".$record['att_percentage']."%</button></td>";
            } elseif ($record['att_percentage']>=50) {
                $att_pr=" <td><button type='button' class='btn btn-warning rounded px-3 py-2'>".$record['att_percentage']."%</button></td>";
            } else {
                $att_pr=" <td><button type='button' class='btn btn-danger rounded px-3 py-2'>0%</button></td>";
            }
            $gimage = "";
            if($flag == true)
            {
                $flag = false;
                if($gender == "Male")
                {
                    $gimage = "<img src='../assets/profiles/student-profile-male.jpg' class='profile_img my-4' style='width:130px;height:130px;border-radius:49%;' alt='Student profile'>";
                }
                else
                {
                    $gimage = "<img src='../assets/profiles/student-profile-female.png' class='profile_img my-4' style='width:130px;height:130px;border-radius:49%;' alt='Student profile'>";
                }
                $student = <<<EOL
                <div class="container my-3" align="center" style="padding-bottom: 3%;">
                    <div class="scene">
                        <div class="flip-card" >
                            <div class="card__face card__face--front" style="border-radius: 10px;">
                                $gimage
                                <h4  class="profile_name" style="color:white;margin-top:-12px;" >$name</h4>
                            </div>
                            <div  class="card__face card__face--back py-4 pl-4" style="font-weight:500;font-size: 15px;" align="left">
                                <p class="mt-3">
                                <span  class="card_back_title mr-4"> SPID :&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>
                                <span class="card_back_data" style="font-weight:normal;">$spid</span>
                                </p>

                                <p>
                                <span  class="card_back_title mr-4"> Course :</span>
                                <span lass="card_back_data" style="font-weight:normal;">$name</span>
                                </p>

                                <p>
                                <span  class="card_back_title mr-1"> Semester :</span>
                                <span lass="card_back_data" style="font-weight:normal;">$semester</span>
                                </p>

                                <p>
                                <span  class="card_back_title mr-3"> Division :</span>
                                <span lass="card_back_data" style="font-weight:normal;" >$division</span>
                                </p>

                                <p>
                                <span  class="card_back_title mr-4"> Roll No :</span>
                                <span lass="card_back_data" style="font-weight:normal;" >$rollno</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                var card = document.querySelector(".flip-card");
     
                    card.addEventListener("click", function () {
                        card.classList.toggle("is-flipped");
                    });
                </script>
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <h4 class="font-weight-bold">Personal Information</h4>
                    </div>
                </div>
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">

                        <h6 class="info-title">Birth Date</h6>
                        <h4 class="info-data">$dob</h4>

                        <h6 class="info-title">Gender</h6>
                        <h4 class="info-data">$gender</h4>
                        
                        <h6 class="info-title">Course Joining Year</h6>
                        <h4 class="info-data">$jyear</h4>

                        <h6 class="info-title">Email</h6>
                        <h4 class="info-data">$email</h4>

                        <h6 class="info-title">Contact No.</h6>
                        <h4 class="info-data">$cnumber</h4>

                        </div>
                    </div>
                </div>


                <div class="col-sm-12  col-md-12  col-lg-12  grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Attendance Details</h4>
                            <div class="table-responsive mt-4">
                                <table id="order-listing" class="table">
                                    <thead>
                                        <tr>
                                            <th>Subject Code</th>
                                            <th>Subject Name</th>
                                            <th>Present</th>
                                            <th>Absent</th>
                                            <th>Percentage</th>
                                        </tr>
                                    </thead>
                                    <tbody id="studattdata">
            EOL;
            }
            $student.=
            "
            <tr>
            <td>".$record['subject_code']."</td>
            <td>".$record['subject_name']."</td>
            <td>".$record['p_days']."</td>
            <td>".$record['a_days']."</td>
            $att_pr
            </tr>
            ";
        }
        $student .= <<<EOL
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        EOL;
        return $student;
    }
    else
    {
        return "
        <p style='font-size:1.5em;margin:auto;margin-top:100px;'>Sorry, No Student Found with that SPID!</p>
        
        ";
    }
}




if(isset($_POST['_spid'])&&isset($_POST['_ct'])&&$_POST['_ct']==$_SESSION['_csrfToken']&&isset($_SESSION['_userId']))
{
        $spid = $JAMES->sanitizeInput($_POST['_spid']);
        echo(findStudents($spid));
}
else
{    
    $JAMES->ams_redirect("../../login.php"); // when outside request comes redirect to login
}



?>
