<?php
     
    require_once('./Other/customlib.php'); 
    $error = "";

    session_start();


    // session_start();

    // if(!(isset($_SESSION["_csrfToken"])&&isset($_SESSION["_userId"]) && isset($_SESSION["_userType"])&&$_SESSION["_userType"]==="1"))
    // {
    //     header("Location:../index.php");
    //     exit();
    // }
    if(isset($_POST["register"])&&isset($_POST["captcha"])&&isset($_SESSION["captcha"]))
    {   

        $uname = sanitizeInput($_POST['username']);
        $pswd = sanitizeInput($_POST['password']);

        if($_POST["captcha"]==$_SESSION["captcha"])
        {

            $type = 2;

            $sql = "select * from users where username='$uname';";
            
            $connection = dbconnect();

            $result = mysqli_query($connection,$sql);

            if(mysqli_num_rows($result)===0)
            {       
                    $token = bin2Hex(random_bytes(8));

                    $pswd = crypt($pswd,'$2a$10$1qAz2wSx3eDc4rFv5tGb5t');

                    $sql = "insert into users(username,password,token,type) values('$uname','$pswd','$token',$type);";
                    
                    $connection = dbconnect();

                    if(mysqli_query($connection,$sql))
                    {
                        $error = "User added successfully.";
                    }
                    else
                    {
                        $error = "Failed to add user!";
                    }
                    mysqli_close($connection);
            }
            else
            {
                $error = "Username isn't available!";
            }

        }
        else
        {
            $error = "Invalid captcha !";
        }

    }

?>

<!DOCTYPE html>

<html>

<head>

    <title>Shopping cart | Register </title>
    <link rel="icon" type="image/x-icon" href="./Assets/favicon.png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">

    <script type="text/javascript" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/popper.min.js"></script>

</head>

<body>


<div class="container mt-2" style="position:relative;top:70px;">
	<div class="row justify-content-center align-items-center text-center p-2">
		<div class="m-1 col-sm-8 col-md-6 col-lg-4 shadow-sm p-3 mb-5 bg-white border rounded">
			<div class="pt-5 pb-5">
				<img class="rounded mx-auto d-block" src="./Assets/favicon.png" alt="" width=70px height=70px>
				<p class="text-center text-uppercase mt-3">Shopping cart | Registration </p>
                <h5 id="errorMessage" style="color:red;">
                <?php 
                    if($GLOBALS['error']!=="")
                    {
                        echo $GLOBALS['error'];
                        echo "<script type='text/javascript'> setTimeout(function(){document.getElementById('errorMessage').innerHTML='';},2000);</script>";
                    }
                ?>
                </h5>
				<form class="form text-center" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
					<div class="form-group input-group-md">
						<input class="form-control"  id="username" type="text" name="username" placeholder="Enter your username" required="true" aria-describedby="emailHelp">
						<!--<div class="invalid-feedback">
							 Errors in email during form validation, also add .is-invalid class to the input fields
						</div> -->
					</div>
					<div class="form-group input-group-md">
						<input class="form-control"id="password" maxlength="8" minlength="8" type="password" name="password" placeholder="Enter your password" required="true">
					</div>
                    <div class="form-group input-group-md">
                    <img style="" src="./Other/captcha.php" alt="no captcha">
                    <input type="text" name="captcha" maxlength="5" placeholder="Enter your captcha">    
					</div>
					<button name="register" class="btn btn-lg btn-block btn-primary mt-4" type="submit">
                        Register 
               </button>
               <br>
				</form>
			</div>
			<a href="index.php" class="text-center d-block mt-2">Already have an acoount? </a>
		</div>
	</div>
</div>

     
</body>

</html>