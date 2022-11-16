<?php

require_once("../ams.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();

if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="2"))
{
 $JAMES->ams_redirect("../login.php");
}

//fetch readers
$sql= "select * from Ams_readers;";//query
$result = mysqli_query($JAMES->connection(),$sql);

if(mysqli_num_rows($result)>0)
{
    $reader = "<label>Select Reader</label><select name='reader_selection' id='reader_selection' class='form-control'><option value='0'>Not Selected</option>";

    while($record = mysqli_fetch_assoc($result))
    {
      $reader.="<option value='".$record['reader_no']."' >".$record['reader_no']."</option>";
    }

    $reader.="</select>";
}
else
{
    $JAMES->ams_redirect("../login.php");
}


if(isset($_SESSION["_liverfidreq"]))
{
  $_SESSION["_liverfidreq"]=" ";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
          <!-- including footer -->
          <?php
          include './common/header.php'
        ?>

        <!-- Page info -->
        <title>AMS | Live Scan</title>

        <!-- css  -->
        <link rel="stylesheet" href="../css/faculty.css">

        <!-- js  -->
        <script src="../js/faculty/livereading.js" type="text/javascript" defer=true></script>
</head>

<body>
      <!-------------------------------------------------------Main Content------------------------------------------------------->

      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            
          <button type='button' onclick="window.history.back()" style="verticle-align:middle;padding:9px;width:90px;height:40px;float:left;position:relative;bottom:10px;display:inline;border-radius:12px;" class='btn form-control btn-primary btn-icon-text ml-3 mb-3'>
                                                            
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg>
            Back
          </button>
         
            <div class="col-md-12  grid-margin stretch-card">

              <!-- Add Faculty Start -->

              <div class="card">
                <div class="card-body">

                  <h4 class="card-title mb-2">Classroom Reader</h4>
                  <form class="forms-sample">

                    <!-- Live RFID Reader Updates Button -->
                    <input type="hidden" id="csrfToken" name="_csrfToken" value="<?php echo $JAMES->generateCsrfToken();?>" >
                     
                    <div class='row'>
                        <div class='col-md-6'>
                            <div class='form-group rs'>
                                
                                <!--reader list -->

                                <?php echo $reader;?>

                               </div>
                            </div>
                            <div id="btnreaderchange" class="form-group search_fetch_btn col-md-12">
                            </div>
                        </div>
                    </div>


                    <!-- <hr > -->
                    <!-- RFID data Start -->
                    <div class="card" style="margin-bottom:10px;margin-top:-30px;" id="add_stud_tbl">
                      <div class="card-body">
                        <h4 class="card-title">Card Scanning Details</h4>
                        <div class="row">
                          <div class="col-12">
                            <div class="table-responsive">
                              <table id="order-listing" class="table">
                                <thead>
                                  <tr>
                                    <th>SPID</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Scanned At</th>
                                    <th>Semester</th>
                                  </tr>
                                </thead>
                                <tbody id="rfidcarddata">
                                <tr><td  colspan='5' style='font-size:1.2em;text-align:center;'>No Data Available</td></tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

            
                    <!--RFID Stud card Data End-->

                   </form>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Add Faculty End -->

   <!-- including footer -->
   <?php
    include './common/footer.php'
    ?>
</body>

</html>