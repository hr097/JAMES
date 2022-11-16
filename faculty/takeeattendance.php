<?php

require_once("../ams.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();

if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="2"))
{
 $JAMES->ams_redirect("../login.php");
}

$ip_address = $_SERVER['SERVER_NAME'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- including header -->
    <?php
    require_once('./common/header.php');
    ?>

  <!-- css  -->
  <link rel="stylesheet" href="../css/faculty.css">

  <!-- js  -->
  <script src="../js/faculty/takeeattendance.js" type="text/javascript" defer=true></script>

  <!-- QR CODE  -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js" integrity="sha512-CNgIRecGo7nphbeZ04Sc13ka07paqdeTu0WR1IM4kNcpmBAUSHSQX0FslNhTDadL4O5SAGapGt4FodqL8My0mA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


  <!-- page information-->
  <title>AMS | e-Attendance </title>

</head>

<body>


      <!-------------------------------------------------------Main Content Start------------------------------------------------------->

      <div class="main-panel">
        <div class="content-wrapper">

          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
               <div class="card">
                <div class="card-body">
                  <h4 class="card-title">e-Attendance</h4>
                    <div class="row" >
                      <div class="col-lg-9 col-md-8 col-sm-12">
                        <div class="form-group">
                          <label>Classroom ID</label>
                          <input type="hidden" id="ip" name="ip" value="<?php echo $ip_address; ?>">
                          <input type="text" placeholder="Enter classroom ID" class="form-control" name="input_text" id="input_text" autocomplete="off">
                        </div>
                      </div>
                      <div class="col-lg-3 col-md-4 col-sm-12 qr_btnSec">
                      <button class="btn btn-primary button mr-2" style="margin-top:30px;" id="btnSubmit" type="submit">Generate<i class="ti ti-reload ml-2" style="user-select: auto;"></i></button>
                      </div>
                    </div>
                    <div class="row mt-4 mb-4" style="justify-content:center">
                      <div>
                      <div class="qr-code-container">
                          <div class="qr-code mb-4"></div>
                          <div><h4 style="text-align:center;font-weight:700;">SCAN THIS CODE <br> FOR ATTENDANCE!</h4></div>
                      </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
            <p style='font-size:1.5em;margin:auto;' class='mt-5'>Coming Soon!</p>
          </div>

          

        <!-- <div class="user-input-section">
            <section class="heading">
            <div class="title">e-Attendance</div>
            <div class="sub-title">Enter classroom ID:</div>
            </section>
            <section class="user-input">
            <input type="hidden" id="spid" name="spid" value="<?php echo $_SESSION['_spid']; ?>">
            <input type="text" placeholder="Type something..." name="input_text" id="input_text" autocomplete="off">
            <button class="button" type="submit">Generate<i class="ti ti-reload" style="user-select: auto;"></i></button>
            </section>
        </div> -->

        <!-- BELOW TWO DIV IS FOR QR-->

       
        
       </div>
      </div>
  <!-------------------------------------------------------Main Content End------------------------------------------------------->

    <!-- including footer -->
    <?php
    require_once('./common/footer.php');
    ?>

  
</body>

</html>