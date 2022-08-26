<?php
     
    require_once('../Other/customlib.php'); 
    $error = "";
    session_start();

    if(!(isset($_SESSION["_csrfToken"])&&isset($_SESSION["_userId"]) && isset($_SESSION["_userType"])&&$_SESSION["_userType"]==="1"))
    {
        header("Location:../index.php");
        exit();
    }
    else if(isset($_POST["insert"])&&isset($_POST['category'])&&isset($_POST['product_name'])&&isset($_POST['status'])&&isset($_FILES['productimage']))
    {
        $pname = sanitizeInput($_POST['product_name']);
        $category = $_POST['category'];
        $status = $_POST['status'];

        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["productimage"]["name"]);
         
        $sql = "select * from products where p_name='$pname';";
        
        $connection = dbconnect();

        $result = mysqli_query($connection,$sql);

        if(mysqli_num_rows($result)===0)
        {       

            $connection = dbconnect();
            $sql  = "select * from categories where c_name='$category'";
            $result = mysqli_query($connection,$sql);

            $result = mysqli_fetch_assoc($result);

            $category = $result['c_id'];

            $sql = "insert into products(p_name,status,c_id,p_pic) values('$pname','$status',$category,'$target_file');";
            
            $connection = dbconnect();

            if(mysqli_query($connection,$sql))
            {    
                move_uploaded_file($_FILES["productimage"]["tmp_name"],$target_file); 
                $error = "product added successfully.";
            }
            else
            {
                $error = "Failed to add product";
            }
            mysqli_close($connection);
        }
        else
        {
            $error = "Product is Already Registered!";
        }
    }
    else if(isset($_POST["update"])&&isset($_POST['product'])&&isset($_POST['product_name'])&&isset($_POST['status'])&&isset($_FILES['productimage']))
    {
        $pname = sanitizeInput($_POST['product_name']);
        $status = $_POST['status'];
        
        $t = $_POST['product'];

        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["productimage"]["name"]);

        $sql = "select * from products where p_name='$t';";
        
        $connection = dbconnect();

        $result = mysqli_query($connection,$sql);

        if(mysqli_num_rows($result)===1)
        {       

        $result = mysqli_fetch_assoc($result);

        $sql = "update products set p_name='".$pname."',status=$status,p_pic='$target_file' where p_id='". $result['p_id']."';";
        
        $connection = dbconnect();

        if(mysqli_query($connection,$sql))
        {        
            move_uploaded_file($_FILES["productimage"]["tmp_name"],$target_file); 
            $error = "product updated successfully.";
        }
        else
        {
            $error = "Failed to update product !";
        }

        }
        else
        {
            $error = "No such product exists.";
        }
        mysqli_close($connection);
    }
    else if(isset($_POST["delete"])&&isset($_POST['product_name']))
    {
        $pname = sanitizeInput($_POST['product_name']);
        
        $sql = "select * from products where p_name='$pname';";
        
        $connection = dbconnect();

        $result = mysqli_query($connection,$sql);

        if(mysqli_num_rows($result)===1)
        {       
                $sql = "delete from products where p_name='$pname'";
                
                $connection = dbconnect();

                if(mysqli_query($connection,$sql))
                {
                    $error = "product deleted successfully.";
                }
                else
                {
                    $error = "Failed to delete a product!";
                }
                mysqli_close($connection);
        }
        else
        {
            $error = "product not exists !";
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
<form method="post"  enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
       
        <h1>Manage products :</h1>

        <label for="category">Choose a category :</label>

        <select name="category" id="category">
        
        </select>
            
        <br><br>

        <label for="product">Choose a product :</label>

        <select name="product" id="product">
        
        </select>

        <br><br>
        <label for="product">Product Name: </label>
        <input type="text"  id="product_name" name="product_name" placeholder="Enter product name " required="true"> 
        <br><br>
    
        <label>Product status : </label>
        <label for="Active"> Active <input type="radio" name="status" id="Active" value="1"></label>
        <label for="Inactive"> Inactive <input type="radio" name="status" id="Inactive" value="0"></label>
        <br><br>
        <label> Product image : </label>
        <input type="file" name="productimage" id="productimage">
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

    $.post("getProductsData.php",{auth:true},

    function(data,status){
        
        var php = JSON.parse(data); 
        let categories="<option value=\"\" selected>Not selected</option>"; 
        let i=0;
        var categories_array = [];
        while(i<php.products.length)
        {
            categories_array.push(php.products[i].category);       
            i++;
        }
        categories_array = [...new Set(categories_array)];
        i=0;
        while(i<categories_array.length)
        {
            categories += "<option value=\""+categories_array[i]+"\">"+categories_array[i]+"</option>";     
            i++;
        }
        
        $("#category").html(categories);
        
        $("#category").change(function(){
             
        let products="<option value=\"\" selected>Not selected</option>"; 
        let i=0;

        while(i<php.products.length)
        {    
            if($("#category").val()==php.products[i].category)
            { products += "<option value=\""+php.products[i].p_name+"\">"+php.products[i].p_name+"</option>";}
            i++;
        }

        $("#product").html(products);

        $("#product").change(function(){
            
        $("#product_name").val($(this).val());

            for(let i=0;i<php.products.length;i++)
            {
                if(php.products[i].p_name == $("#product").val())
                {
                    if(php.products[i].status == "1")
                    {   
                        $('#Active').each(function(){ this.checked = true; });
                    }
                    else
                    {
                        $('#Inactive').each(function(){ this.checked = true; });
                    }
                }
                else if($("#product").val()=="")
                {
                    $('#Active').each(function(){ this.checked = false; }); 
                    $('#Inactive').each(function(){ this.checked = false; });
                }
            }  

             });  

        });  
    });
});
</script>