<?php

 require_once("../ams.php");
 $JAMES = new AMS("Admin");
 $JAMES->init_user_session();


 if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="3"))
 {
  $JAMES->ams_redirect("../login.php");
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
        <link rel="stylesheet" href="../css/admin.css">
        <link rel="stylesheet" href="../css/student.css">
        
        <!-- js  -->
        <script src="../js/admin/archivesearch.js" type="text/javascript" defer=true></script>
        
        

        <!-- page information-->
        <title>AMS | Archive Search</title>
        
    </head>

    <body>

                <!-------------------------------------------------------Main Content------------------------------------------------------->
                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="row" >
                        
                            <div class="col-sm-12  col-md-12  col-lg-12  grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Search Student</h4>
                                        <form class="forms-sample" method="post">

                                            
                                            <input type="hidden" id="csrfToken" name="_csrfToken" value="<?php echo $JAMES->generateCsrfToken();?>" >
                                            <div class="form-group">
                                                    <label for="spid">SPID</label>
                                                    <input type="text" autocomplete="off" id="studspid" name="studspid" pattern="[0-9]{10}" minlength="10"  maxlength="10" class="form-control" id="studspid" placeholder="XXXXXXXXXX" value=""  required>
                                                </div>

                                            <button type="button" id="search" class="btn btn-primary mr-2 mt-3">Search</button>
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                        <div class="row" id="searchstudprof">
                            <p style='font-size:1.5em;margin:auto;margin-top:100px;'>No Student Data</p>
                        </div>  
                    </div>
                </div>

        <!-- including footer -->
        <?php
        include './common/footer.php'
        ?>

    </body>


</html>

