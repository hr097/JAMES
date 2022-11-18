<?php

require_once("../ams.php");
$JAMES = new AMS("Admin");
$JAMES->init_user_session();

if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="3"))
{
 $JAMES->ams_redirect("../login.php");
}

if(isset($_POST['_rno'])&&isset($_POST['_ct'])&&$_POST['_ct']==$_SESSION['_csrfToken']&&isset($_SESSION['_userId']))
{
        $r_no = $JAMES->sanitizeInput($_POST['_rno']);

        
        $sql= "inserte into Ams_readers(reader_no) values($r_no);";
        
        if(mysqli_query($GLOBALS['JAMES']->connection(),$sql)==1)
        {
           echo "<script>alert('reader added successfully !')</script>";
        }
        else
        {
            echo "<script>alert('reader couldn't be added!')</script>"; 
        }
         
}

//fetch readers
$sql= "select * from Ams_readers;";//query
$result = mysqli_query($JAMES->connection(),$sql);

if(mysqli_num_rows($result)>0)
{
    $reader = "";

    while($record = mysqli_fetch_assoc($result))
    {
      $reader.=
      "
            <tr>
            <td>".$record['reader_id']."</td>
            <td>".$record['reader_no']."</td>
            <td>
                <button id='".$record['reader_id']."' type='button' class='btn btn-danger rounded px-3 py-2 deletereader'><i
                        class='ti-trash'></i></button>
            </td>
            </tr>
      ";
    }

}
else
{
    $reader = "<tr><td  colspan='3' style='font-size:1.2em;text-align:center;'>No Reader Registered Yet!</td></tr>";
}





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- including header -->
    <?php
    require_once('./common/header.php');
    ?>

    <link rel="stylesheet" href="../css/modal.css">

    <!-- js  -->
    <script src="../js/admin/amsreaderregistration.js" type="text/javascript" defer=true></script>

    <!-- page information-->
    <title>AMS | Reader Regisration</title>

</head>

<body>
    <!-------------------------------------------------------Main Content------------------------------------------------------->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12  col-md-12  col-lg-12  grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">AMS Reader Regisration</h4>
                            <form class="forms-sample" action="amsreaderregistration.php" method="POST">

                                <input type="hidden" id="csrfToken" name="_ct" value="<?php echo $JAMES->generateCsrfToken();?>" >

                                <!-- Reader nO -->
                                <div class="row">

                                    <div class="form-group col-md-12">
                                        <label>Reader No</label>
                                        <input type="number" class="form-control" name="_rno" placeholder="Enter Reader No" required>
                                    </div>
                                </div>


                                <button type="submit" id="" class="btn btn-primary mr-2 mt-3">Add Reader</button>
                                <button class="btn btn-light mt-3">Clear</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!--Reader Registration Form End-->

                <div class="col-sm-12  col-md-12  col-lg-12  grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">AMS Readers Details</h4>
                            <!-- <form class="forms-sample"> 

                                
                               <div class="row">
                                    <div class="form-group col-md-10">
                                        <label>Search Reader</label>
                                        <input type="text" class="form-control" placeholder="Enter Reader Id">
                                    </div>

                                    <div class="form-group col-md-2 ">
                                        <button type="button" id=""
                                            class="btn btn-primary searchbtn mt-4">Search</button>
                                    </div>
                                </div>

                            </form> -->

                            <div class="table-responsive mt-4">
                                <table id="" class="table">
                                    <thead>
                                        <tr>
                                            <th>Reader ID</th>
                                            <th>Reader No</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody id="readerdata">
                                        <?php echo $reader; ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Reader Updation End -->

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
            <button id="yes-button" class="modal-btn">Okay</button>
            <button id="no-button" class="modal-btn">Cancel</button>
    </div>
    </div>


    <!-- including footer -->
    <?php
    require_once('./common/footer.php');
    ?>

</body>

</html>