<?php

require_once("../ams.php");
$JAMES = new AMS("Admin");
$JAMES->init_user_session();

if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="3"))
{
 $JAMES->ams_redirect("../login.php");
}

$error = "";

if(isset($_POST['_sb'])&&isset($_POST['_rn'])&&isset($_POST['_ct'])&&$_POST['_ct']==$_SESSION['_csrfToken']&&isset($_SESSION['_userId']))
{
        $r_n = $JAMES->sanitizeInput($_POST['_rn']);

        
        $sql= "insert into Faculty_roles(role_name) values('$r_n');";
        
        if(mysqli_query($GLOBALS['JAMES']->connection(),$sql))
        {
            $error = "<span id='response_msg' style='color:green;float:right;'>New role added successfully !</span>";
        }
        else
        {
            $error = "<span id='response_msg' id=style='color:red;float:right;'>New role couldn't be added!</span>"; 
        }

        $error.="<script>setTimeout(function(){ $('#response_msg').html('');},3000);</script>";
         
}

//fetch readers
$sql= "select * from Faculty_roles order by role_id;";//query
$result = mysqli_query($JAMES->connection(),$sql);

if(mysqli_num_rows($result)>0)
{
    $roles = "";

    while($record = mysqli_fetch_assoc($result))
    {
      $roles.=
      "
            <tr>
            <td>".$record['role_id']."</td>
            <td>".$record['role_name']."</td>
            <td>
                <button id='".$record['role_id']."' type='button' class='btn btn-danger rounded px-3 py-2 deleterole'><i
                        class='ti-trash'></i></button>
            </td>
            </tr>
      ";
    }

}
else
{
    $roles = "<tr><td  colspan='3' style='font-size:1.2em;text-align:center;'>No Role Registered Yet!</td></tr>";
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
    <script src="../js/admin/facrolesregistration.js" type="text/javascript" defer=true></script>

    <!-- page information-->
    <title>AMS | Faculty Roles Registration</title>

</head>

<body>
    <!-------------------------------------------------------Main Content------------------------------------------------------->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12  col-md-12  col-lg-12  grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Faculty Roles Regisration <?php echo $error;?></h4>
                            <form class="forms-sample" action="facrolesregistration.php" method="POST">

                                <input type="hidden" id="csrfToken" name="_ct" value="<?php echo $JAMES->generateCsrfToken();?>" >

                                <!-- Reader nO -->
                                <div class="row">

                                    <div class="form-group col-md-12">
                                        <label>New Role Name</label>
                                        <input type="text" class="form-control" name="_rn" placeholder="Enter Role Name" required>
                                    </div>
                                </div>


                                <button type="submit" name="_sb"  id="" class="btn btn-primary mr-2 mt-3">Add Role</button>
                                <button class="btn btn-light mt-3">Clear</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!--Reader Registration Form End-->

                <div class="col-sm-12  col-md-12  col-lg-12  grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Faculty Roles Details</h4>
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
                                            <th>Role ID</th>
                                            <th>Role Name</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody id="roledata">
                                        <?php echo $roles; ?>
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