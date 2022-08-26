<?php

if(!isset($_GET['category']))
{
    header('Location:client.php');
}

?>

<!DOCTYPE html>

<html>

<head>

    <title>Shopping cart | View products</title>
    <link rel="icon" type="image/x-icon" href="../Assets/favicon.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../Assets/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Assets/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Assets/fonts/linearicons-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Assets/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../Assets/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Assets/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Assets/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../Assets/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Assets/vendor/slick/slick.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Assets/vendor/MagnificPopup/magnific-popup.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Assets/vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="../Assets/css/main.css">
    <style type="text/css">
	body::-webkit-scrollbar {
    display: none;
	overflow-y: scroll;
     }
    </style>

</head>

<body>

<br>

<?php

require_once('../Other/customlib.php');

if(isset($_GET['category'])&&$_GET['category']=="general")
{

$sql = "select * from products where status=1";
        
$connection = dbconnect();

$result = mysqli_query($connection,$sql);

mysqli_close($connection);

if(mysqli_num_rows($result)>1)
{       
   
	echo "<div class='row isotope-grid'>";

while($row = mysqli_fetch_assoc($result)) {
    echo "
			<div class='col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women'  style='float:left;' >
					<!-- Block2 -->
					<div class='block2'>
						<div class='block2-pic hov-img0'>
							<img src='".$row['p_pic']."' alt='img'>

							<a href='#' onclick='addCart(\"".$row['p_name']."\",".$row['price'].",\"".$row['p_pic']."\")' class='block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1'>
								Add to cart
							</a>
						</div>

						<div class='block2-txt flex-w flex-t p-t-14'>
							<div class='block2-txt-child1 flex-col-l '>
								<a href='product-detail.html' class='stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6'>
								"
								.$row['p_name'].
							     "
								</a>

								<span class='stext-105 cl3'>$
								"
									.$row['price'].
								"
								</span>
							</div>

							<div class='block2-txt-child2 flex-r p-t-3'>
								<a href='#' class='btn-addwish-b2 dis-block pos-relative js-addwish-b2'>
									<img class='icon-heart1 dis-block trans-04' src='../Assets/images/icons/icon-heart-01.png' alt='ICON'>
									<img class='icon-heart2 dis-block trans-04 ab-t-l' src='../Assets/images/icons/icon-heart-02.png' alt='ICON'>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
	";
}
echo "</div>";
}
else
{
    echo "<h1 style='margin:auto;'> No products are actively listed by seller at the moment.<\h1>";
}


}
else 
{

  $category = $_GET['category'];

  $sql = "select * from categories where c_name='$category'";

  $connection = dbconnect();

  $result = mysqli_query($connection,$sql);

  $result =  mysqli_fetch_assoc($result);

  $c_id = $result['c_id'];

  $sql = "select * from products where  status=1 and c_id=$c_id;";
          
  $connection = dbconnect();

  $result = mysqli_query($connection,$sql);

  mysqli_close($connection);

  if(mysqli_num_rows($result)>1)
  {       
  echo 	"<div class='row isotope-grid'>";  
  while($row = mysqli_fetch_assoc($result)) {
	echo "
				<div class='col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women' style='float:left;' >
					<!-- Block2 -->
					<div class='block2'>
						<div class='block2-pic hov-img0'>
							<img src='".$row['p_pic']."' alt='img'>

							<a href='#' onclick='addCart(\"".$row['p_name']."\",".$row['price'].",\"".$row['p_pic']."\")' class='block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1'>
								Add to cart
							</a>
						</div>

						<div class='block2-txt flex-w flex-t p-t-14'>
							<div class='block2-txt-child1 flex-col-l '>
								<a href='product-detail.html' class='stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6'>
								"
								.$row['p_name'].
							     "
								</a>

								<span class='stext-105 cl3'>$
								"
									.$row['price'].
								"
								</span>
							</div>

							<div class='block2-txt-child2 flex-r p-t-3'>
								<a href='#' class='btn-addwish-b2 dis-block pos-relative js-addwish-b2'>
									<img class='icon-heart1 dis-block trans-04' src='../Assets/images/icons/icon-heart-01.png' alt='ICON'>
									<img class='icon-heart2 dis-block trans-04 ab-t-l' src='../Assets/images/icons/icon-heart-02.png' alt='ICON'>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
	";
  }
  echo "</div>";
  }
  else
  {
      echo "<h1 style='margin:auto;'> No products are actively listed by seller at the moment.<\h1>";
  }

  }

  ?>
</body>
<script type='text/javascript'>

	Storage.prototype.setObj = function(key,obj){
	return this.setItem(key, JSON.stringify(obj))
	}

	Storage.prototype.getObj = function(key){
	return JSON.parse(this.getItem(key))
	}

function addCart(name,price,path)
{
	alert(name+" is added to cart !");

	var MyCart = JSON.parse(localStorage.getItem("products"));
	var MyCartImg = JSON.parse(localStorage.getItem("images")); 

	if(MyCart==null)
	{
     MyCart = {};
	}
	if(MyCartImg==null)
	{
     MyCartImg = {};
	}
		
	MyCart[name.valueOf()] = price+" $";
	MyCartImg[name.valueOf()] = path;
    
	MyCart = JSON.stringify(MyCart);
	MyCartImg = JSON.stringify(MyCartImg);

	localStorage.setItem("products",MyCart);
	localStorage.setItem("images",MyCartImg);
}
</script>

</html>