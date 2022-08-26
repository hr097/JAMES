<?php
     
    require_once('../Other/customlib.php'); 
    $error = "";
    session_start();

    if(!(isset($_SESSION["_csrfToken"])&&isset($_SESSION["_userId"]) && isset($_SESSION["_userType"])&&$_SESSION["_userType"]==="1"))
    {
        header("Location:../index.php");
        exit();
    }
    else if(isset($_POST["insert"])&&isset($_POST['category_name'])&&isset($_POST['status']))
    {
        $cname = sanitizeInput($_POST['category_name']);
        $status = $_POST['status'];

        $sql = "select * from categories where c_name='$cname';";
        
        $connection = dbconnect();

        $result = mysqli_query($connection,$sql);

        if(mysqli_num_rows($result)===0)
        {       

                $sql = "insert into categories(c_name,status) values('$cname','$status');";
                
                $connection = dbconnect();

                if(mysqli_query($connection,$sql))
                {
                    $error = "category added successfully.";
                }
                else
                {
                    $error = "Failed to add category!";
                }
                mysqli_close($connection);
        }
        else
        {
            $error = "Category Already Registered!";
        }
    }
    else if(isset($_POST["update"])&&isset($_POST['category_name'])&&isset($_POST['status'])&&isset($_POST['category']))
    {
        $cname = sanitizeInput($_POST['category_name']);
        $status = $_POST['status'];
        $c2_name = $_POST['category'];
        
        $sql = "select * from categories where c_name='$c2_name';";
        
        $connection = dbconnect();

        $result = mysqli_query($connection,$sql);

        if(mysqli_num_rows($result)===1)
        {       

        $result = mysqli_fetch_assoc($result);

        $sql = "update categories set c_name='".$cname."',status=$status where c_id='". $result['c_id']."';";
        
        $connection = dbconnect();

        if(mysqli_query($connection,$sql))
        {       
            $error = "Category updated successfully.";
        }
        else
        {
            $error = "Failed to update category !";
        }

        }
        else
        {
            $error = "No such category exists.";
        }
        mysqli_close($connection);
    }
    else if(isset($_POST["delete"])&&isset($_POST['category_name']))
    {
        $cname = sanitizeInput($_POST['category_name']);
        
        $sql = "select * from categories where c_name='$cname';";
        
        $connection = dbconnect();

        $result = mysqli_query($connection,$sql);

        if(mysqli_num_rows($result)===1)
        {       
                $sql = "delete from categories where c_name='$cname'";
                
                $connection = dbconnect();

                if(mysqli_query($connection,$sql))
                {
                    $error = "category deleted successfully.";
                }
                else
                {
                    $error = "Failed to delete a category!";
                }
                mysqli_close($connection);
        }
        else
        {
            $error = "category not exists !";
        }
    }   

?>

<!DOCTYPE html>

<html>

<head>

    <title>Shopping cart | Manage Users </title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <style type="text/css">
    
    </style>

</head>

<body>
        <h3 id="errorMessage" style="color:blue;">
        <?php 
            if($GLOBALS['error']!=="")
            {
                echo $GLOBALS['error'];
                echo "<script type='text/javascript'> setTimeout(function(){document.getElementById('errorMessage').innerHTML='';},2000);</script>";
            }
        ?>
        </h3>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
       
        <h1>Manage product categories :</h1>

        <label for="category">Choose a category :</label>

        <select name="category" id="category">
        
        </select>

        <br><br>
        <label for="category">Category name : </label>
        <input type="text"  id="category_name" name="category_name" placeholder="Enter category name " required="true"> 
        <br><br>

        <label>Category status : </label>
        <label for="Active"> Active <input type="radio" name="status" id="Active" value="1"></label>
        <label for="Inactive"> Inactive <input type="radio" name="status" id="Inactive" value="0"></label>
         
        <br><br><br>
        <input type="submit" name="delete" value="delete">
        <input type="submit" name="update" value="update">
        <input type="submit" name="insert" value="insert">
    </form>
     <br>
     <a href="admin.php">Back to Dashboard</a> 

</body>

</html>

<script type="text/javascript">


// jQuery used
$(document).ready(function(){

    $.post("getCategoriesData.php",{auth:true},

    function(data,status){

        var php = JSON.parse(data); 
        let categories="<option value=\"\" selected>Not selected</option>"; 
        let i=0;

        while(i<php.categories.length)
        {
             categories += "<option value=\""+php.categories[i].c_name+"\">"+php.categories[i].c_name+"</option>";
             i++;
        }
     
        $("#category").html(categories);
        
        $("#category").change(function(){

        $("#category_name").val($(this).val());

        for(let i=0;i<php.categories.length;i++)
        {
            if(php.categories[i].c_name == $("#category_name").val())
            {
                if(php.categories[i].status == "1")
                {   
                    $('#Active').each(function(){ this.checked = true; });
                }
                else
                {
                    $('#Inactive').each(function(){ this.checked = true; });
                }
            }
            else if($("#category_name").val()=="")
            {
                $('#Active').each(function(){ this.checked = false; }); 
                $('#Inactive').each(function(){ this.checked = false; });
            }
        }   
        });  
    });
});
</script>