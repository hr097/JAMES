<?php
 
require_once("./Other/customlib.php");

$error = "";

if(count($_COOKIE) > 0 && isset($_COOKIE["__u9RmdkJ6"]))
{
     //decrypt cookies for user authentication 
     $authToken = customDecrypt($_COOKIE["__u9RmdkJ6"]);

     //verify user with password and usertype
     $user = authUserToken($authToken);
     
     if($user!=="")
     {
        startSession($user["username"],$user["type"]);
     }
     else
     {
        //echo "<script>alert('\"JPD AMS\":Either site cookies has been tampered or Multiple browser login detected ! kindly log in again.');</script>";
        setcookie("__u9RmdkJ6","", time() - 3600, "/");
     }
}
else
{
    session_start();

    if(isset($_SESSION["_csrfToken"])&&isset($_SESSION["_userId"]) && isset($_SESSION["_userType"])&&$_SESSION["_userType"]==="1")
    {
        header("Location:./Admin/admin.php");
    }
    else if(isset($_SESSION["_csrfToken"])&&isset($_SESSION["_userId"]) && isset($_SESSION["_userType"])&&$_SESSION["_userType"]==="2")
    {
        header("Location:./Client/client.php");
    }
    else if(isset($_POST["login"]))
    {   

        $uname =  sanitizeInput($_POST["username"]);
        $pswd  =  sanitizeInput($_POST["password"]);

        $connection= dbconnect();
        $result = mysqli_query($connection,"select * from users where username='$uname';");
        mysqli_close($connection);

        if(mysqli_num_rows($result)===1)
        {
            $user = mysqli_fetch_assoc($result);

            if(password_verify($pswd,$user["password"])!=1)
            {    
                $GLOBALS['error'] = "Credentials doesn't matches!";
            }
            else
            {

                if(isset($_POST["rememberme"])&&$_POST["rememberme"]==="on")
                {  
                    $authToken = customEncrypt($user["token"]);
                    setcookie("__u9RmdkJ6",$authToken,time()+(86400*7),"/","",false,true);
                }

                startSession($user["username"],$user["type"]);
            }

        }
        else
        {
            $GLOBALS['error'] = "User not exists.";
        }
    }
}

?>
<!DOCTYPE html>

<html>

<head>

    <title>Shopping cart | LOGIN </title>
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
				<p class="text-center text-uppercase mt-3">Shopping cart | Login</p>
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
					<button name="login" class="btn btn-lg btn-block btn-primary mt-4" type="submit">
                        Login
               </button>
               <br>
                 <label for="rememberme"><input type="checkbox" id="rememberme" name="rememberme" >Remember me</label>
				</form>
			</div>
			<a href="register.php" class="text-center d-block mt-2">Create an account? </a>
		</div>
	</div>
</div>

</body>

</html>