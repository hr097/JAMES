<?php

require_once("../ams.php");
$JAMES = new AMS("Admin");
$JAMES->init_user_session();

// if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="3"))
// {
//  $JAMES->ams_redirect("../login.php");
// }

$u = $_SESSION["_userId"];

//@query
$sql = "select count(*) as total from Ams_feedback;";
$result = mysqli_query($JAMES->connection(), $sql);
$result = mysqli_fetch_array($result);

$sql2 = "select cast(avg(rating) as decimal(2,1)) as avge from Ams_feedback;";
$result2 = mysqli_query($JAMES->connection(), $sql2);
$result2 = mysqli_fetch_array($result2);

$sql3 = "select * from Ams_feedback order by rating desc;";
$result3 = mysqli_query($JAMES->connection(), $sql3);
$sort="";
while ($row = mysqli_fetch_array($result3)) {
    $sort = $sort . "<tr><td>" . $row['fb_id'] . "</td><td>" . $row['email'] . "</td><td>" . $row['description'] . "</td><td>" . $row['givenAt'] . "</td><td>" . $row['rating'] . "</td></tr>";
}

// $emailTemp = "document.getElementById('email_input').innerHTML";
// $sql4 = "select * from Ams_feedback where email = $emailTemp;";
// $result4 = mysqli_query($JAMES->connection(), $sql4);
// $searchbymail = "<thead><tr><th>Feedback ID</th><th>Email ID</th><th>Description</th><th>Date Time Stamp</th><th>Rating</th></tr></thead><tbody id='tbody'>";
// while ($row2 = mysqli_fetch_array($result4)) {
//     $searchbymail = $searchbymail . "<tr><td>" . $row2['fb_id'] . "</td><td>" . $row2['email'] . "</td><td>" . $row2['description'] . "</td><td>" . $row2['givenAt'] . "</td><td>" . $row2['rating'] . "</td><td></tr>";
// }
// $searchbymail = $searchbymail . "</tbody>";

// $fidTemp = "document.getElementById('feedback_input')";
// $sql5 = "select * from Ams_feedback where fb_id = fidTemp;";
// $result5 = mysqli_query($JAMES->connection(), $sql5);
// $searchbyfid = "<thead><tr><th>Feedback ID</th><th>Email ID</th><th>Description</th><th>Date Time Stamp</th><th>Rating</th></tr></thead><tbody id='tbody'>";
// while ($row2 = mysqli_fetch_array($result5)) {
//     $searchbyfid = $searchbyfid . "<tr><td>" . $row2['fb_id'] . "</td><td>" . $row2['email'] . "</td><td>" . $row2['description'] . "</td><td>" . $row2['givenAt'] . "</td><td>" . $row2['rating'] . "</td><td></tr>";
// }
// $searchbyfid = $searchbyfid . "</tbody>";

// if(mysqli_num_rows($result)>=0)
// {
//     $tot = $result;
// }
// else
// {
//     $JAMES->ams_redirect("../login.php");
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- including header -->
    <?php
    require_once('./common/header.php');
    ?>

    <!-- js  -->
    <script src="../js/admin/feedbackstats.js" type="text/javascript" defer=true></script>

    <!-- page information-->
    <title>AMS | Feedback Stats</title>

</head>
<body>

<!-------------------------------------------------------Main Content------------------------------------------------------->
      <!--Subeject Setup Form Start-->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12  grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title mb-5">Feedback Statistics</h4>
                            <h6 class="info-title">Total No. of Feedbacks</h6>
                            <h4 class="info-data"><?php echo $result['total']; ?></h4>

                            <h6 class="info-title">Average Feedback Rating</h6>
                            <h4 class="info-data"><?php echo $result2['avge']; ?></h4>

                            <button type="submit" class="btn btn-primary mb-2" onclick="displayData()">Sort Feedbacks (by ratings)</button>
                </div>
              </div>
            </div>
            <!--Faculty Form End-->
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