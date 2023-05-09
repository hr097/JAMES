<?php

require_once("../ams.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();

if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="1"))
{
 $JAMES->ams_redirect("../login.php");
}

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

  <!-- js  -->
  <script src="../js/student/eattendance.js" type="text/javascript" defer=true></script>
  <script src="../js/student/qrcode-scanner.js"></script>


  <!-- QR CODE  -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js" integrity="sha512-CNgIRecGo7nphbeZ04Sc13ka07paqdeTu0WR1IM4kNcpmBAUSHSQX0FslNhTDadL4O5SAGapGt4FodqL8My0mA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  

  <!-- <script src="https://unpkg.com/html5-qrcode"></script> -->
   
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
                  <h4 class="card-title">e-Attendance Scanner</h4>
                    <div class="row" >
                      <div class="col-lg-9 col-md-8 col-sm-12">
                        <div class="form-group">
                          <!-- <label>Classroom ID</label>
                          <input type="hidden" id="spid" name="spid" value="<?php echo $_SESSION['_spid']; ?>">
                          <input type="text" placeholder="Enter classroom ID" class="form-control" name="input_text" id="input_text" autocomplete="off">
           -->
                        </div>
                      </div> 
                      <div class="col-lg-3 col-md-4 col-sm-12 qr_btnSec">
                      <!-- <button class="btn btn-primary button mr-2" id="btnSubmit" type="submit">Generate<i class="ti ti-reload ml-2" style="user-select: auto;"></i></button> -->
                      </div>  
                    </div>
                    <div class="row mt-4 mb-4" style="justify-content:center">
                    <div style="box-shadow: 5px 2px 15px #5555;border-radius:8px;padding:10px;font-weight:700; ">Coming Soon..</div>
                          <!-- <div class="qr-code mb-4"></div>
                          <div><h4 style="text-align:center;font-weight:700;">SCAN THIS CODE!</h4></div> -->
                      </div>
                      </div>
                    </div>
                   


                </div>
              </div>
            </div>
          </div>
          

          <!-- <div id="qr-reader" style="width: 600px"></div> -->

          

        <!-- <div class="user-input-section">
            <section class="heading">
            <div class="title">e-Attendance</div>
            <div class="sub-title">Enter classroom ID:</div>
            </section>
            <section class="user-input">
            <input type="hidden" id="spid" name="spid" value="<?php //echo $_SESSION['_spid']; ?>">
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

<script type="text/javascript">
function onScanSuccess(qrCodeMessage) {
    document.getElementById('result').innerHTML = '<span class="result">'+qrCodeMessage+'</span>';
}
function onScanError(errorMessage) {
  //handle scan error
}
var html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", { fps: 10, qrbox: 250 });
html5QrcodeScanner.render(onScanSuccess, onScanError);
</script>


  
</body>

</html>