<?php

require_once("../ams.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();

if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="3"))
{
 $JAMES->ams_redirect("../login.php");
}

    $sql = "select count(*) As TotalFeedbacks,FORMAT(avg(rating),2) as avg_rating from Ams_feedback;";

    $ttlfeedbacks = 0;
    $avg_rating = 0.0;

   $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);
    
    if(mysqli_num_rows($result)>0)  
    {
        $record = mysqli_fetch_assoc($result);

        $ttlfeedbacks = $record['TotalFeedbacks'];
        $avg_rating = $record['avg_rating'];
        
    }

    $feedback_rcd =  "
    <tr>
    <td  colspan='5' style='font-size:1.2em;text-align:center;'>No Feedbacks Yet!</td>
    </tr>";

    $sql = "select * from Ams_feedback;";

    $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);
    
    if(mysqli_num_rows($result)>=1)  
    {    $feedbacks_rcd = ""; // do not remove
        while($record = mysqli_fetch_assoc($result))
        {   
            $feedbacks_rcd.=
            "
            <tr class='feedback'>
            <td>".$record['fb_id']."</td>
            <td>".$record['email']."</td>
            <td>".$record['description']."</td>
            <td>".$record['givenAt']."</td>
            <td>".$record['rating']."</td>
            </tr>
            ";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- including header -->
    <?php
    require_once('./common/header.php');
?>

    <!-- js  -->
    <!-- <script src="../js/admin/feedbackstats.js" type="text/javascript" defer=true></script> -->

    <!-- page information-->
    <title>AMS | Feedback Stats</title>

    <style type="text/css">
    .subcard {
        position: relative;
        width: 220px;
        height: 250px;
        background: #ffffff;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .subcard .percent {
        position: relative;
        width: 150px;
        height: 150px;
    }

    .subcard .percent svg {
        position: relative;
        width: 150px;
        height: 150px;
        transform: rotate(270deg);
    }

    .subcard .percent svg circle {
        width: 100%;
        height: 100%;
        fill: transparent;
        stroke-width: 4;
        stroke: #ffffff;
        transform: translate(5px, 5px);
    }

    .subcard .percent svg circle:nth-child(2) {
        stroke: var(--clr);
        stroke-dasharray: 440;
        stroke-dashoffset: calc(440 - (440 * var(--num)) / 100);
        opacity: 0;
        animation: fadeIn 1s linear forwards;
        animation-delay: 1.5s;
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;

        }
    }

    .dot {
        position: absolute;
        inset: 5px;
        z-index: 10;
        /* 360deg / 100 = 3.6 */
        animation: animateDot 2s linear forwards;
        animation-delay: 1s;
    }

    @keyframes animateDot {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(calc(3.6deg * var(--num)));
        }
    }

    .dot::before {
        content: '';
        position: absolute;
        top: -5px;
        left: 50%;
        transform: translateX(-50%);
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: var(--clr);
        box-shadow: 0 0 10px var(--clr) 0 0 30px var(--clr);
    }

    .number {
        position: absolute;
        inset: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        opacity: 0;
        animation: fadeIn 1s linear forwards;
    }

    .number h2 {
        display: flex;
        justify-content: center;
        align-items: center;
        color: rgb(0, 0, 0);
        font-weight: 700;
        font-size: 2.5em;
    }

    .number h2 span {
        font-weight: 300;
        color: rgb(0, 0, 0);
        font-size: 0.5em;
    }

    .number p {
        font-weight: 300;
        font-size: 0.75em;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: rgba(0, 0, 0);
    }
    </style>

</head>

<body>

    <!-------------------------------------------------------Main Content------------------------------------------------------->
    <!--Subject Setup Form Start-->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <button type='button' onclick="window.history.back()"
                        style="vertical-align:middle;padding:9px;width:90px;height:40px;float:left;position:relative;bottom:10px;display:inline;border-radius:12px;"
                        class='btn form-control btn-primary btn-icon-text ml-3 mb-2'>

                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                        </svg>
                        Back
                </button>

                <div class="col-sm-12 col-md-12 col-lg-12  grid-margin stretch-card">


                        
                    <div class="card">

                        <div class="card-body">
                            <h4 class="card-title mb-5">Feedback Statistics</h4>
    
                            <div class='container'>

                                <div class='row'>
                                    <div class='col-lg-6 col-md-6 col-sm-12' style='display:flex;justify-content: center;'>
                                        <div class='subcard'>
                                            <div class='percent' style='--clr:#57B657;--num:<?php echo $GLOBALS['ttlfeedbacks'];?>;'>
                                                <div class='dot'></div>
                                                <svg>
                                                    <circle cx='70' cy='70' r='70'></circle>
                                                    <circle cx='70' cy='70' r='70'></circle>
                                                </svg>
                                                <div class='number'>
                                                    <h2><?php echo $GLOBALS['ttlfeedbacks'];?><span></span></h2>
                                                    <p>Feedbacks</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='col-lg-6 col-md-6 col-sm-12' style='display:flex;justify-content: center;'>
                                        <div class='subcard'>
                                            <div class='percent' style='--clr:#FF9494;--num:<?php echo (100*$GLOBALS['avg_rating'])/5;?>;'>
                                                <div class='dot'></div>
                                                <svg>
                                                    <circle cx='70' cy='70' r='70'></circle>
                                                    <circle cx='70' cy='70' r='70'></circle>
                                                </svg>
                                                <div class='number'>
                                                    <h2><?php echo $GLOBALS['avg_rating'];?><span></span></h2>
                                                    <p>AVG. Rating</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Faculty Form End-->
            </div>



            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Feedbacks</h4>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="order-listing" class="table">
                                    <thead>
                                        <tr>
                                            <th>Feedback ID</th>
                                            <th>Email ID</th>
                                            <th>Description</th>
                                            <th>Date Time Stamp</th>
                                            <th>Rating</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php echo $feedbacks_rcd;?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
    </div>





    <!-- including footer -->
    <?php
require_once('./common/footer.php');
?>

</body>

</html>