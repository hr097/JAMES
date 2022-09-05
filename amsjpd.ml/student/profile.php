<!DOCTYPE html>
<html lang="en">

<head>
    <!-- including header -->
    <?php
    include '../common/header.php'
    ?>

  <!-- css  -->
  <link rel="stylesheet" href="../css/student.css">

  <!-- page information-->
  <title>AMS | Profile</title>

</head>

<body>


      <!-------------------------------------------------------Main Content Start------------------------------------------------------->

      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">

            <!-------------------------------------------------------Student Card Start------------------------------------------------------->
            <div class="container my-3" align="center" style="padding-bottom: 3%;">

              <div class="scene">
                <div class="flip-card" >
                  <div class="card__face card__face--front" style="border-radius: 10px;">
                    <img src="../assets/profiles/student-profile.jpg" class="my-4" alt="Student profile"
                      style="width:130px;height:130px; border-radius: 49%;">
                    <h3 style="color: white; margin-top: -15px;">Archit Ghevariya</h3>
                  </div>

                  <div class="card__face card__face--back py-4 pl-4" align="left">
                    <p style="font-weight: 700;"> Student id : 2020049819</p>
                    <p><strong> Enrollment no :</strong> E20110018000610015</p>
                    <p><strong> DOB :</strong> 7/6/2020</p>
                    <p><strong> Email id :</strong> archit@vnsgu.ac.in</p>
                    <p><strong> Course name :</strong> E20110018000610015</p>
                  </div>
                </div>
              </div>
              <!-------------------------------------------------------Studnet Card End------------------------------------------------------->
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
                  <h6 class="info-title">First Name</h6>
                  <h4 class="info-data">ARCHIT</h4>

                  <h6 class="info-title"> Last Name</h6>
                  <h4 class="info-data">GHEVARIYA</h4>

                  <h6 class="info-title">Birth Date </h6>
                  <h4 class="info-data">08-03-2003</h4>

                  <h6 class="info-title">Gender</h6>
                  <input type="radio" checked> Male
                  <input type="radio" class="info-data"> Female

                  <h6 class="info-title">Semester</h6>
                  <h4 class="info-data">4th</h4>

                  <h6 class="info-title"> Student Id</h6>
                  <h4 class="info-data">2020049819</h4>

                  <h6 class="info-title">Enrollment / Registration Id </h6>
                  <h4 class="info-data">E20110018000610015</h4>

                  <h6 class="info-title">Course Name</h6>
                  <h4 class="info-data">B. SC. (I. T.) ( M. SC. (I. T.) 5 YEAR INTEGRATED COURSE ) ( M.SC. (I.T.)
                    2020-25 )</h4>
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
                  <h4 class="info-data">archit@vnsgu.ac.in</h4>

                  <h6 class="info-title">Mobile No.</h6>
                  <h4 class="info-data">9813245125</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  <!-------------------------------------------------------Main Content End------------------------------------------------------->
  
  <script>
      // $(document).ready(() => {
      //   $('#stud_card').click(function () {
      //     $('#stud_card').flip({ trigger: "manual" });
      //   });
      // });
      var card = document.querySelector('.flip-card');
    card.addEventListener('click', function () {
        card.classList.toggle('is-flipped');
    });
  </script>

    <!-- including footer -->
    <?php
    include '../common/footer.php'
    ?>


  
</body>

</html>