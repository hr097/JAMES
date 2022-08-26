<?php
     
    require_once('../Other/customlib.php'); 
    $error = "";
    session_start();

    if(!(isset($_SESSION["_csrfToken"])&&isset($_SESSION["_userId"]) && isset($_SESSION["_userType"])&&$_SESSION["_userType"]==="1"))
    {
        header("Location:../index.php");
        exit();
    }
    else if(isset($_POST["delete"]))
    {
        $uname = sanitizeInput($_POST['username']);
        
        $sql = "select * from users where username='$uname';";
        
        $connection = dbconnect();

        $result = mysqli_query($connection,$sql);

        if(mysqli_num_rows($result)===1)
        {       
                $sql = "delete from users where username='$uname'";
                
                $connection = dbconnect();

                if(mysqli_query($connection,$sql))
                {
                    $error = "User deleted successfully.";
                }
                else
                {
                    $error = "Failed to delete user!";
                }
                mysqli_close($connection);
        }
        else
        {
            $error = "User not exists !";
        }
    }

?>

<!DOCTYPE html>

<html>

<head>

    <title>Shopping cart | Manage Users </title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <style type="text/css">
    table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 500px;
    max-width: 800px;
    }

    td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
    margin:10px;
    }

    </style>

</head>

<body>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <h3 id="errorMessage" style="color:blue;">
        <?php 
            if($GLOBALS['error']!=="")
            {
                echo $GLOBALS['error'];
                echo "<script type='text/javascript'> setTimeout(function(){document.getElementById('errorMessage').innerHTML='';},2000);</script>";
            }
        ?>
        </h3>
        <h1>User Details:</h1>

        <table id="userstable">
            
        </table>

        <br><br>
        <label for="username">username: </label>
        <input type="text" maxlength="30" id="username" name="username" placeholder="Enter username" required="true"> 
        <br><br>
        
        <input type="submit" name="delete" value="delete">
    </form>
     <br>
     <a href="admin.php">Back to Dashboard</a> 

</body>

</html>

<script type="text/javascript">

// jQuery used
$(document).ready(function(){

    $.post("getUsersData.php",{auth:true},
    function(data,status){
        let html = "<tr><th>User Name</th></tr>";
        html+=data;
        $("#userstable").html(html);
        $("tr").click(function(){
        $("#username").val($(this).text().trim());
        });
    });

    
});

</script>