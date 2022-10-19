<!--
? -  Points to include in this page :
? - Total no. of Feedbacks received
? - Average feedback rating
? - Sort feedback by rating
? - Search feedback by usermail address
? - Search feedback by feedback ID 

* fb_id, email, description, givenAt, rating
-->
<?php

require_once("../ams.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();

// if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="1"))
// {
//  $JAMES->ams_redirect("../login.php");
// }

$u = $_SESSION["_userId"];

//@query
$sql = "select count(*) as total from ams_feedback;";
$result = mysqli_query($JAMES->connection(), $sql);
$result = mysqli_fetch_array($result);

$sql2 = "select cast(avg(rating) as decimal(2,1)) as avge from ams_feedback;";
$result2 = mysqli_query($JAMES->connection(), $sql2);
$result2 = mysqli_fetch_array($result2);

$sql3 = "select * from ams_feedback order by rating desc;";
$result3 = mysqli_query($JAMES->connection(), $sql3);
$sort = "<thead><tr><th>Feedback ID</th><th>Email ID</th><th>Description</th><th>Date Time Stamp</th><th>Rating</th></tr></thead><tbody id='tbody'>";
while ($row = mysqli_fetch_array($result3)) {
    $sort = $sort . "<tr><td>" . $row['fb_id'] . "</td><td>" . $row['email'] . "</td><td>" . $row['description'] . "</td><td>" . $row['givenAt'] . "</td><td>" . $row['rating'] . "</td><td></tr>";
}
$sort= $sort."</tbody>";

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

    <!-- css  -->
    <link rel="stylesheet" href="../css/student.css">
    <link rel="stylesheet" href="../css/modal.css">

    <!-- js  -->
    <script src="../js/student/feedback.js" type="text/javascript" defer=true></script>

    <!-- page information-->
    <title>AMS | Feedback Stats</title>

</head>

<!-- FEEDBACK STATS STARTS -->
<body>
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <h4 class="font-weight-bold">Feedback Statistics</h4>
            </div>

            <div class="col-md-12 grid-margin stretch-card">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">

                            <h6 class="info-title">Total No. of Feedbacks Received :</h6>
                            <h4 class="info-data"><?php echo $result['total']; ?></h4>

                            <h6 class="info-title">Average Feedback Rating : </h6>
                            <h4 class="info-data"><?php echo $result2['avge']; ?></h4>

                            <h6 class="info-title">Sort Feedbacks (by ratings): </h6>
                            <button type="submit" class="btn btn-primary mb-2" onclick="displayData()">Sort</button>

                            <div class="col-lg-12 grid-margin">

                                <div class="card">
                                    <div class="card-body">
                                        <div class="row" <div class="col-12">
                                            <div class="table">
                                                <table class="table" id="sdata">
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-inline">
                                <h6 class="info-title"> Search Feedback by : </h6>
                                <div class="dropdown show ml-2 mb-1 bg-blue" id="ui-basic">
                                    <a class="btn btn-secondary dropdown-toggle mb-1 bg-blue" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Select Criteria
                                    </a>

                                    <div class="dropdown-menu mb-1 bg-blue" aria-labelledby="dropdownMenuLink" aria-controls="ui-basic">
                                        <a class="dropdown-item" href="#">Email Address</a>
                                        <a class="dropdown-item" href="#">Feedback IDs</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h6 class="info-title">Enter Email Address</h6>
                        <div class="form-group">
                            <form class="form-inline">
                                <div class="form-group mb-2">
                                    <input type="text" id="staticEmail2" placeholder="email@example.com">
                                </div>
                                <button type="submit" class="btn btn-primary mb-2 ml-2">Search Data</button>
                            </form>

                        </div>

                        <h6 class="info-title">Enter Feedback ID </h6>
                        <div class="form-group">
                            <form class="form-inline">
                                <div class="form-group mb-2">
                                    <input type="text" id="staticEmail2" placeholder="XXXXXX">
                                </div>
                                <button type="submit" class="btn btn-primary mb-2  ml-2">Search Data</button>
                            </form>

                        </div>

                        <h4 class="info-data"></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>


    <?php
    require_once('./common/footer.php');
    ?>

</body>
<script>
    function displayData() {
        document.getElementById('sdata').innerHTML = "<?php echo $sort; ?>";
    }
</script>

</html>