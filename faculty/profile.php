<!DOCTYPE html>
<html lang="en">

<head>
    <!-- including header -->
    <?php
    include './common/header.php'
    ?>

    <!-- css  -->
    <link rel="stylesheet" href="../css/faculty.css">
    <link rel="stylesheet" href="../css/modal.css">

    <!-- js  -->
    <script src="../js/faculty/faculty.js" type="text/javascript" defer=true></script>

    <!-- page information-->
    <title>AMS | Profile</title>

</head>

<body>


    <!-------------------------------------------------------Main Content Start------------------------------------------------------->

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">

                <!-------------------------------------------------------Faculty Card Start------------------------------------------------------->
                <div class="container my-3" align="center" style="padding-bottom: 3%;">

                    <div class="scene">
                      <!-- Front-side -->
                        <div class="flip-card">
                            <div class="card__face card__face--front" style="border-radius: 10px;">
                                <img src="../assets/profiles/faculty-profile.jpg" class="my-4" alt="Faculty profile"
                                    style="width:130px;height:130px; border-radius: 49%;">
                                <h3 style="color: white; margin-top: -15px;">Archit Ghevariya</h3>
                            </div>

                            <!-- back side -->
                            <div  class="card__face card__face--back py-4 pl-4" style="font-weight:500;font-size: 15px;" align="left">
                              <p class="mt-3">
                              <span  class="card_back_title mr-5"> Faculty id :&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>
                              <span class="card_back_data" style="font-weight:normal;">FID123</span>
                              </p>

                              <p>
                              <span  class="card_back_title mr-4"> Department name :</span>
                              <span lass="card_back_data" style="font-weight:normal;" >Department of ICT</span>
                              </p>

                              <p>
                              <span  class="card_back_title mr-5"> Designation :&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>
                              <span lass="card_back_data" style="font-weight:normal;" >Assistant</span>
                              </p>

                              <p>
                              <span  class="card_back_title mr-5"> Joining year :&nbsp&nbsp&nbsp&nbsp&nbsp</span>
                              <span lass="card_back_data" style="font-weight:normal;" >18-5-2022</span>
                              </p>

                              <p>
                              <span  class="card_back_title mr-5"> Course name :&nbsp&nbsp&nbsp</span>
                              <span lass="card_back_data" style="font-weight:normal;" >IT</span>
                              </p>
                                  </div>
                              </div>
                              </div>
                    <!-------------------------------------------------------Faculty Card End------------------------------------------------------->
                </div>
            </div>
            <!--Personal Info-->
            <div class="row">
                <div class="col-md-12 mb-2">
                    <h4 class="font-weight-bold">Personal Information</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">

                            <h6 class="info-title">Birth Date </h6>
                            <h4 class="info-data">08-03-2003</h4>

                            <h6 class="info-title">Gender</h6>
                            <h4 class="info-data">Male</h4>

                            <h6 class="info-title"> Joining Year</h6>
                            <h4 class="info-data">2020</h4>
                        </div>
                    </div>
                </div>
            </div>



            <!--Contact Info-->
            <div class="row">
                <div class="col-md-12 mb-2">
                    <h4 class="font-weight-bold">Contact Information</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                        <h6 class="info-title">Email</h6>
                 <span id="mode">
                    <i class="ti-pencil email_edit_icon d-flex justify-content-end" style="position:relative;bottom:10px;" id="edit_icon"></i>
                </span>
                 <h4 id="para_email" class="email_edit_para info-data">archit@gmail.com</h4> 
                 <input type="hidden" id="csrfToken" name="_csrfToken" value="generateCsrfToken"> 
                <h6 class="info-title">Contact No.</h6>
                 <h4 class="info-data">123456789</h4>
                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal -->
    <div id="modal" class="modal">
            <!-- modal content -->
            <div class="modal-content" style="width:360px;">
                    <span class="close">&times;</span>
                    <p class="msg unselectable" id="modalmsg"></p>
                    <div class="row" style="margin:auto;margin-bottom:30px;">
                    <button id="yes-button" class="modal-btn"></button>
            </div>
        </div>
    <!-------------------------------------------------------Main Content End------------------------------------------------------->

    <!-- <script>
    // $(document).ready(() => {
    //   $('#stud_card').click(function () {
    //     $('#stud_card').flip({ trigger: "manual" });
    //   });
    // });
    var card = document.querySelector('.flip-card');
    card.addEventListener('click', function() {
        card.classList.toggle('is-flipped');
    });
    </script> -->

    <!-- including footer -->
    <?php
    include './common/footer.php'
    ?>



</body>

</html>