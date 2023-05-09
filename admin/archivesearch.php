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
                        <button type='button' onclick="window.history.back()"
                        style="vertical-align:middle;padding:9px;width:90px;height:40px;float:left;position:relative;bottom:10px;display:inline;border-radius:12px;"
                        class='btn form-control btn-primary btn-icon-text ml-3 mb-2'>

                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                        </svg>
                        Back
                        </button>
                            <div class="col-sm-12  col-md-12  col-lg-12  grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Search Archived Student</h4>
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

