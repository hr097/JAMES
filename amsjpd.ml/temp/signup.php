<?php
     
    require_once('customlib.php'); 
    $error = "";

    session_start();


    // session_start();

    // if(!(isset($_SESSION["_csrfToken"])&&isset($_SESSION["_userId"]) && isset($_SESSION["_userType"])&&$_SESSION["_userType"]==="1"))
    // {
    //     header("Location:../index.php");
    //     exit();
    // }

    if(isset($_POST["register"])&&isset($_POST["usertype"])&& isset($_POST["username"])&&isset($_POST["password"]))
    {   

        $uname = sanitizeInput($_POST['username']);
        $pswd = sanitizeInput($_POST['password']);
        $type = sanitizeInput($_POST['usertype']);
        

        // if($_POST["captcha"]==$_SESSION["captcha"])
        // {

            $sql = "select * from users where username='$uname';";
            
            $connection = dbconnect();

            $result = mysqli_query($connection,$sql);

            if(mysqli_num_rows($result)===0)
            {       
                    $token = bin2Hex(random_bytes(8));

                    $pswd = crypt($pswd,'$2a$10$1qAz2wSx3eDc4rFv5tGb5t');

                    $sql = "insert into users(username,password,user_token,user_type) values('$uname','$pswd','$token',$type);";
                    
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
                $error = "User already exists!";
            }

        //}
        // else
        // {
        //     $error = "Invalid captcha !";
        // }

    }

?>

<!DOCTYPE html>

<html>

<head>

    <title> AMS | Register </title>
    <link rel="icon" type="image/x-icon" href="../assets/logos/favicon.ico">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">

    <script type="text/javascript" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/popper.min.js"></script>
     
    <!-- bootstrap icon-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

</head>

<body>


<div class="container mt-2" style="position:relative;top:70px;">
	<div class="row justify-content-center align-items-center text-center p-2">
		<div class="m-1 col-sm-8 col-md-6 col-lg-4 shadow-sm p-3 mb-5 bg-white border rounded">
			<div class="pt-5 pb-5">
				<img class="rounded mx-auto d-block" src="../assets/logos/login-logo.png" alt="" width=70px height=70px>
				<p class="text-center text-uppercase mt-3"> AMS | Registration </p>
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
					</div>
					<div class="form-group input-group-md">
                        <i class="bi bi-eye-slash fa-lg eye-icon" style="cursor: pointer;position:relative;left:155px;top:30px;" id="togglePassword"></i>
						<input class="form-control"id="password" maxlength="16" minlength="8" type="password" name="password" placeholder="Enter your password" required="true">
					</div>
                    <div class="form-group input-group-md">
                    
                    <br>
                    <label for="usertype">Type :</label>

                    <select name="usertype" id="usertype">
                    <option value="1" selected="true">Student</option>
                    <option value="2">Faculty</option>
                    <option value="3">Manager</option>
                    <option value="4">Admin</option>
                    </select>

					</div>
					<button name="register" class="btn btn-lg btn-block btn-primary mt-4" type="submit">
                        Register 
               </button>
               <br>
				</form>
			</div>
			<!-- <a href="index.php" class="text-center d-block mt-2">Already have an acoount? </a> -->
		</div>
	</div>
</div>

     
</body>
<script type="text/javascript">

/* START:to hide and show password */

const togglePassword = document.querySelector("#togglePassword");
const password = document.querySelector("#password");

togglePassword.addEventListener("click", function () {
    // toggle the type attribute
    const type = password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);
    
    // toggle the icon
    this.classList.toggle("bi-eye");
});

/* END: to hide and show password */
</script>
</html>