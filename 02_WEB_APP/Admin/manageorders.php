<?php
     
    require_once('../Other/customlib.php'); 
    $error = "";
    session_start();

    if(!(isset($_SESSION["_csrfToken"])&&isset($_SESSION["_userId"]) && isset($_SESSION["_userType"])&&$_SESSION["_userType"]==="1"))
    {
        header("Location:../index.php");
        exit();
    }
    else if(isset($_POST["update"])&&isset($_POST["orderid"]))
    {
        $oid = sanitizeInput($_POST['orderid']);
        
        $sql = "select * from orders where o_id='$oid';";
        
        $connection = dbconnect();

        $result = mysqli_query($connection,$sql);

        if(mysqli_num_rows($result)===1)
        {       
                $sql = "update orders set d_status=1 where o_id=$oid";
                
                $connection = dbconnect();

                if(mysqli_query($connection,$sql))
                {
                    $error = "Order marked as sent !";
                }
                else
                {
                    $error = "Failed to mark order !";
                }
                mysqli_close($connection);
        }
        else
        {
            $error = "No such order id exists !";
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
    input[type="submit"]{
    background-color: black; /* Green */
    border: none;
    color: white;
    padding: 16px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    transition-duration: 0.4s;
    cursor: pointer;
    }
    input[type="submit"]:hover {
    background-color: white;
    color: black;
    border:1px solid black;
    box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
    }
    a
    {
        text-decoration: none;
    }
    label
    {
        font-size:1.2em;
    }
    input[type=text] {
        width: 20%;
        padding: 12px 20px;
        margin: 8px 0;
        box-sizing: border-box;
    }
    </style>

</head>

<body>
<center style="font-size:0.9em;position:relative;top:5px;">
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
        <h1>Order Details:</h1> 

        <label for="spo"><input type="checkbox" id="spo" name="spo">Show pending only</label>
        <br><br>
        <label for="orderid">order id: </label>
        <input type="text" maxlength="30" id="orderid" name="orderid" placeholder="Enter order id" required="true"> 
        <br><br>
        
        <input type="submit" name="update" value="Order sent">
    </form>
     <br>
     <a href="admin.php">Back to Dashboard</a> 

     <br><br>

    <table id="orderstable">
        
    </table>
    </center>
</body>

</html>

<script type="text/javascript">

// jQuery used
$(document).ready(function(){

    $.post("getOrdersData.php",{auth:true},
    function(data,status){

        let html = "<tr><th>Order ID</th><th>User Name</th><th>Product Name</th><th>Quantity</th><th>Address</th><th>Delivery status</th></tr>";
        html+=data;

        $("#spo").change(function()
        {    
            $("tr").filter(function(){

            if("1"== ($(this).html()).charAt((($(this).html()).lastIndexOf("<")-1)) )
            {   
                $(this).toggle();
            }
           
            });
            
        });

        $("#orderstable").html(html);
        $("tr").click(function(){
        $("#orderid").val( ($(this).html()).slice( 4,($(this).html()).indexOf("<",4)) );
        
      });
    });

    
});

</script>