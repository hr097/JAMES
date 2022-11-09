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

  <!-- QR CODE  -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js" integrity="sha512-CNgIRecGo7nphbeZ04Sc13ka07paqdeTu0WR1IM4kNcpmBAUSHSQX0FslNhTDadL4O5SAGapGt4FodqL8My0mA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


  <!-- page information-->
  <title>AMS | e-Attendance </title>

</head>

<body>


      <!-------------------------------------------------------Main Content Start------------------------------------------------------->

      <div class="main-panel">
        <div class="content-wrapper">

        <div class="user-input-section">
            <section class="heading">
            <div class="title">e-Attendance</div>
            <div class="sub-title">Enter classroom ID:</div>
            </section>
            <section class="user-input">
            <input type="hidden" id="spid" name="spid" value="<?php echo $_SESSION['_spid']; ?>">
            <input type="text" placeholder="Type something..." name="input_text" id="input_text" autocomplete="off">
            <button class="button" type="submit">Generate<i class="fa-solid fa-rotate"></i></button>
            </section>
        </div>

        <!-- BELOW TWO DIV IS FOR QR-->

        <div class="qr-code-container">
            <div class="qr-code"></div>
        </div>
        
       </div>
      </div>
  <!-------------------------------------------------------Main Content End------------------------------------------------------->
  
  <script>
  
    <!-- including footer -->
    <?php
    require_once('./common/footer.php');
    ?>


  
</body>

</html>