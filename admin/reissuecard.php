<?php

require_once("../ams.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();

if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="3"))
{
 $JAMES->ams_redirect("../login.php");
}

$error = "";

if(isset($_POST['studrfidno'])&&isset($_POST['studspid'])&&isset($_POST['_csrfToken'])&&$_POST['_csrfToken']==$_SESSION['_csrfToken']&&isset($_SESSION['_userId']))
{
    $spid = $JAMES->sanitizeInput($_POST['studspid']);
    $uid = $JAMES->sanitizeInput($_POST['studrfidno']);

    //@query
    $sql = "select * from Rfid_uid_spid_map where spid='$spid';"; 
    $result = mysqli_query($JAMES->connection(),$sql);
    
    if(mysqli_num_rows($result)===1)
    {        
            
            
            //@query
            $sql = "update Rfid_uid_spid_map set uid='$uid' where spid='$spid';"; 

            if(mysqli_query($GLOBALS['JAMES']->connection(),$sql))
            {
              $error = "<span id='response_msg' style='color:green;float:right;'>Uid Updated Successfully !</span>";
            }
            else
            {
              $error = "<span id='response_msg' style='color:red;float:right;'>Unable to Update Try Again Later!</span>";
            }

            $error.="<script>setTimeout(function(){ $('#response_msg').html('');},3000);</script>";

    }
    else
    {    
        $error = "<span id='response_msg' style='color:red;float:right;'>Spid Not Found!</span>"; 
        $error.="<script>setTimeout(function(){ $('#response_msg').html('');},3000);</script>";
    }


}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <!-- including header -->
    <?php
    include './common/header.php'
    ?>

    <!-- css  -->
    <link rel="stylesheet" href="../css/student.css">
    
    <!-- Bi Icons  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <!-- js  -->
    <script src="../js/admin/reissuecard.js" type="text/javascript" defer=true></script>

    <!-- page information-->
    <title>AMS | Reissue Card</title>

  
</head>

<body>


    <!-------------------------------------------------------Main Content Start------------------------------------------------------->

    <div class="main-panel">
        
        <div class="content-wrapper">
            <div class="row">

            <button type='button' onclick="window.history.back()" style="verticle-align:middle;padding:9px;width:90px;height:40px;float:left;position:relative;bottom:10px;display:inline;border-radius:12px;" class='btn form-control btn-primary btn-icon-text ml-3 mb-3'>
                                                            
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
              </svg>
              Back
            </button>
                <!-- Reset Account -->
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Reissue Card <?php echo $error;?></h4>
                            <form class="forms-sample" action="reissuecard.php" method="post" autocomplete="off">

                                <!-- email & Search Button-->
                                
                                <div class="row">
                                <input type="hidden" id="csrfToken" name="_csrfToken" value="<?php echo $JAMES->generateCsrfToken();?>" >  

                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>SPID</label>
                                        <input type="text" autocomplete="off" name="studspid" pattern="[0-9]{10}" minlength="10"  maxlength="10" class="form-control" id="studspid" placeholder="XXXXXXXXXX" required>
                                    </div>

                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>UID</label>
                                        <input  type="text" autocomplete="off" name="studrfidno" minlength="11" pattern="[A-Za-z0-9]{2}[ ]{1}[A-Za-z0-9]{2}[ ]{1}[A-Za-z0-9]{2}[ ]{1}[A-Za-z0-9]{2}"  maxlength="11" class="form-control" id="studrfid" placeholder="XX XX XX XX" required>
                                    </div>
                            

                                <div class="form-group search_fetch_btn col-lg-2 mt-3 col-sm-12">
                                    <button type="submit" id="reissuecard" class="btn btn-primary mr-2 mt-1">Reissue
                                    </button>
                                </div>

                                <div  class="form-group search_fetch_btn col-lg-12 mt-12 col-sm-12">
                                <label><b>NOTE: </b> Additional charges are applicable (50 Rupees) for each reissuing card.</label>
                                </div>

                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            
    <!-------------------------------------------------------Main Content End------------------------------------------------------->

    <!-- including footer -->
    <?php
    include './common/footer.php'
    ?>

</body>

</html>

