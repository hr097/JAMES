<?php

require_once("../ams.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();

if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="2"))
{
 $JAMES->ams_redirect("../login.php");
}

 
$u = $_SESSION["_userId"];

//fetch related classroom id's
$sql= "select ASFM.ams_setup_id FROM Ams_setup_faculties_map ASFM,Faculties F where F.fid=ASFM.fid and F.email='$u'and ASFM.setup_status=TRUE;";//query
$result = mysqli_query($JAMES->connection(),$sql);

if(mysqli_num_rows($result)>0)
{
    $classroom_codes = "<label>Classroom Code</label><select name='classcode_selection' id='classcode_selection' class='form-control'><option value=''>Not Selected</option></option>";

    while($record = mysqli_fetch_assoc($result))
    {
      $classroom_codes.="<option value='".$record['ams_setup_id']."' >".$record['ams_setup_id']."</option>";
    }

    $classroom_codes.="</select>";
}
else
{
  $classroom_codes = "<label>Classroom Code</label><select name='classcode_selection' id='classcode_selection' class='form-control'><option value='0'>Not Selected</option></option></select>";
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

          
          <button type='button' onclick="window.history.back()" style="verticle-align:middle;padding:9px;width:90px;height:40px;float:left;position:relative;bottom:10px;display:inline;border-radius:12px;" class='btn form-control btn-primary btn-icon-text ml-3 mb-3'>
                                                            
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg>
            Back
          </button>
          
            <div class="col-lg-12 col-md-12 col-sm-12">
               <div class="card">
                <div class="card-body">
                  <h4 class="card-title">e-Attendance</h4>
                    <div class="row" >
                      <div class="col-lg-9 col-md-8 col-sm-12">
                        <div class="form-group">
                          <!-- <label>Classroom ID</label> -->
                          <!-- <input type="hidden" id="ip" name="ip" value="<?php// echo $ip_address; ?>"> -->
                          <!-- <input type="text" placeholder="Enter classroom ID" class="form-control" name="input_text" id="input_text" autocomplete="off"> -->
                          <!--Course -->

                          <?php echo $classroom_codes;?>

                        <input type="hidden" id="csrfToken" name="_csrfToken" value="<?php echo $JAMES->generateCsrfToken();?>" >


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
                          <div><h4 style="text-align:center;font-weight:700;">SCAN THIS QR <br> FOR ATTENDANCE !</h4></div>
                      </div>
                      </div>
                    </div>
                    <!-- <p style='font-size:1.5em;text-align:center;' class='mt-5'>Coming Soon!</p> -->
                </div>
              </div>
            </div>
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