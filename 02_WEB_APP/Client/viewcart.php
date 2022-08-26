
    <?php 
    session_start();
    echo "<script type='text/javascript'>var uname ='".$_SESSION['_userId']."'</script>";
    ?>

<!DOCTYPE html>

<html>

<head>

    <title>Shopping cart | View cart</title>
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

    </style>

</head>

<body>
<body class="animsition">
	<!-- Shoping Cart -->
	<div class="bg0 p-t-75 p-b-85">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
					<div class="m-l-25 m-r--38 m-lr-0-xl">
						<div class="wrap-table-shopping-cart">
							<table id="mycart" class="table-shopping-cart">


							

							</table>
						</div>

						<div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
							<div class="flex-w flex-m m-r-20 m-tb-5">
								<input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text" name="coupon" placeholder="Coupon Code">
									
								<div class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
									Apply coupon
								</div>
							</div>

							<div onclick="window.location.href='client.php'" class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
								Add More
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
					<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
						<h4 class="mtext-109 cl2 p-b-30">
							Cart Totals
						</h4>

						<!-- <div class="flex-w flex-t bor12 p-b-13">
							<div class="size-208">
								<span class="stext-110 cl2">
									Subtotal:
								</span>
							</div>

							<div class="size-209">
								<span class="mtext-110 cl2">
									$79.65
								</span>
							</div>
						</div> -->

						<div class="flex-w flex-t bor12 p-t-15 p-b-30">
							<div class="size-208 w-full-ssm">
								<span class="stext-110 cl2">
									Shipping:
								</span>
							</div>

							<div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
								<p class="stext-111 cl6 p-t-2">
									There are no shipping methods available. Please double check your address, or contact us if you need any help.
								</p>
								
								<div class="p-t-15">
									<span class="stext-112 cl8">
										Calculate Shipping
									</span>

									<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
										<select id="a1" class="js-select2" name="time">
											<option>Select a country...</option>
											<option>USA</option>
											<option>UK</option>
										</select>
										<div class="dropDownSelect2"></div>
									</div>

									<div class="bor8 bg0 m-b-12">
										<input id="a2" class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="state" placeholder="State /  country">
									</div>

									<div class="bor8 bg0 m-b-22">
										<input id="a3" class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="postcode" placeholder="Postcode / Zip">
									</div>
									
									<div class="flex-w">
										<div class="flex-c-m stext-101 cl2 size-115 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer">
											Update Totals
										</div>
									</div>
										
								</div>
							</div>
						</div>

						<div class="flex-w flex-t p-t-27 p-b-33">
							<div class="size-208">
								<span class="mtext-101 cl2">
									Total:
								</span>
							</div>

							<div class="size-209 p-t-1">
								<span id="cart_total" class="mtext-110 cl2">
									0
								</span>
                                <td style="position:relative;right:40px;">$</td>
							</div>
						</div>

						<button onclick="placeOrder()" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
							Proceed to Checkout
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
		
	
		

	<!-- Footer -->
	<footer class="bg3 p-t-75 p-b-32">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Categories
					</h4>

					<ul>
						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Women
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Men
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Shoes
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Watches
							</a>
						</li>
					</ul>
				</div>

				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Help
					</h4>

					<ul>
						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Track Order
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Returns 
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Shipping
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								FAQs
							</a>
						</li>
					</ul>
				</div>

				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						GET IN TOUCH
					</h4>

					<p class="stext-107 cl7 size-201">
						Any questions? Let us know in store at 8th floor, 379 Hudson St, New York, NY 10018 or call us on (+1) 96 716 6879
					</p>

					<div class="p-t-27">
						<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-facebook"></i>
						</a>

						<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-instagram"></i>
						</a>

						<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-pinterest-p"></i>
						</a>
					</div>
				</div>

				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Newsletter
					</h4>

					<form>
						<div class="wrap-input1 w-full p-b-4">
							<input class="input1 bg-none plh1 stext-107 cl7" type="text" name="email" placeholder="email@example.com">
							<div class="focus-input1 trans-04"></div>
						</div>

						<div class="p-t-18">
							<button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
								Subscribe
							</button>
						</div>
					</form>
				</div>
			</div>

		
			</div>
		</div>
	</footer>


	<!-- Back to top -->
	<!-- <div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div> -->

<!--===============================================================================================-->	
	<script src="../Assets/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="../Assets/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="../Assets/vendor/bootstrap/js/popper.js"></script>
	<script src="../Assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="../Assets/vendor/select2/select2.min.js"></script>
	<script>
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
	</script>
<!--===============================================================================================-->
	<script src="../Assets/vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
<!--===============================================================================================-->
	<script src="../Assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script>
		$('.js-pscroll').each(function(){
			$(this).css('position','relative');
			$(this).css('overflow','hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function(){
				ps.update();
			})
		});
	</script>
<!--===============================================================================================-->
	<script src="../Assets/js/main.js"></script>

</body>
</html>

<script type="text/javascript">

var html =  `<tr class="table_head">
									<th class="column-1">Product</th>
									<th class="column-2"></th>
									<th class="column-3">Price</th>
									<th class="column-4">Quantity</th>
									<th class="column-5">Total</th>
								</tr>`;

 var MyCart = JSON.parse(localStorage.getItem("products")); 

if(Object.keys(MyCart).length==0)
{
 html+= `<tr class="table_row">
					<td class="column-1">
										<div class="how-itemcart1">
											
										</div>
									</td>
									<td class="column-2">No product is added to cart.</td>
									<td class="column-4">
									</td>
									<tr>`;
}    
else
{   var MyCartImg = JSON.parse(localStorage.getItem("images")); 

    for(let key in MyCart)
    {
        html+=` <tr class="table_row">
									<td class="column-1">
										<div class="how-itemcart1">
											<img src="${MyCartImg[key]}" alt="IMG">
										</div>
									</td>
									<td class="column-2">${key}</td>
									<td class="column-3">${MyCart[key]}</td>
									<td class="column-4">
										<div class="wrap-num-product flex-w m-l-auto m-r-0">
											<div  onclick="q_minus('${key}')" class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
												<i  class="fs-16 zmdi zmdi-minus"></i>
											</div>

											<input class="mtext-104 cl3 txt-center num-product" type="number" id="${key}" value="1">

											<div onclick="q_plus('${key}')" class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
												<i  class="fs-16 zmdi zmdi-plus"></i>
											</div>
										</div>
									</td>
									<td class="column-5" name="final_price" id="${key}_final">${MyCart[key]}</td>
                                    <td style="position:relative;right:40px;">$</td>
								</tr>`;
         
         if(localStorage.getItem(key)==undefined)
         localStorage.setItem(key,"1");
    }


 
    
}

var final_amt = 0;

document.getElementById("mycart").innerHTML = html;

for(let key in MyCart)
{
    setCart(key);
}

function setCart(id)
{
    let qunt = localStorage.getItem(id);
    document.getElementById(id).value =  parseInt(qunt);
    let ini_price = parseInt(document.getElementById(id+"_final").innerHTML);
    let x = parseInt(ini_price*qunt);
    document.getElementById(id+"_final").innerHTML  = x;

    final_amt = final_amt + x;
}

document.getElementById("cart_total").innerHTML = final_amt;

function q_minus(id)
{   
    if(parseInt(document.getElementById(id).value)>1)
    {
    let old_qunt = parseInt(document.getElementById(id).value);
    let new_qunt = old_qunt-1;

    // console.log("get old total price : "+parseInt(document.getElementById(id+"_final").innerHTML));
    // console.log("get old total quantity: "+parseInt(document.getElementById(id).value));
    // console.log("after getting single price : "+( parseInt(document.getElementById(id+"_final").innerHTML) /  parseInt(document.getElementById(id).value)));
    
    let  old_total_price = parseInt(document.getElementById(id+"_final").innerHTML);

    let single_price = parseInt(old_total_price /  old_qunt );

    document.getElementById(id+"_final").innerHTML = parseInt(single_price * new_qunt);

    document.getElementById(id).value = new_qunt;

    localStorage.setItem(id,new_qunt);
    
    let y = parseInt(document.getElementById("cart_total").innerHTML);
    document.getElementById("cart_total").innerHTML = y - single_price;  

    }
    else
    {  
        //delete product from cart
        var MyCart = JSON.parse(localStorage.getItem("products"));
        var MyCart2 = JSON.parse(localStorage.getItem("images"));
        
        delete MyCart[id];
        delete MyCart2[id];
        
        MyCart = JSON.stringify(MyCart);
        MyCart2 = JSON.stringify(MyCart2);

        localStorage.setItem("products",MyCart);
        localStorage.setItem("images",MyCart2);
        window.location.reload();
    }
}



function q_plus(id)
{    
     
    let old_qunt = parseInt(document.getElementById(id).value);
    let new_qunt = old_qunt+1;

    // console.log("get old total price : "+parseInt(document.getElementById(id+"_final").innerHTML));
    // console.log("get old total quantity: "+parseInt(document.getElementById(id).value));
    // console.log("after getting single price : "+( parseInt(document.getElementById(id+"_final").innerHTML) /  parseInt(document.getElementById(id).value)));
    
    let  old_total_price = parseInt(document.getElementById(id+"_final").innerHTML);

    let single_price = parseInt(old_total_price /  old_qunt );

    document.getElementById(id+"_final").innerHTML = parseInt(single_price * new_qunt);

    document.getElementById(id).value = new_qunt;

    localStorage.setItem(id,new_qunt);
    
    let y = parseInt(document.getElementById("cart_total").innerHTML);
    document.getElementById("cart_total").innerHTML = y + single_price;  
    
}

function run(pname,quantity,addr) {

  // Creating Our XMLHttpRequest object 
  var xhr = new XMLHttpRequest();

  // Making our connection  
  var url = 'placeorder.php?'+"productName="+pname+"&quantity="+quantity+"&uname="+uname+"&addr="+addr;
  xhr.open("GET", url, true);
   
  // function execute after request is successful 
  xhr.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
          alert(this.responseText);
          window.location.reload();
      }
  }
  // Sending our request 
  xhr.send();
}

function placeOrder()
{
    let total = parseInt(document.getElementById("cart_total").innerHTML); 

    let y1 = document.getElementById("a1").value ;
    let y2 = document.getElementById("a2").value ;
    let y3 = document.getElementById("a3").value ;
    
    if(y1==""||y2==""||y3=="")
    {
        alert("please enter delivery address !");
    }
    else
    {
    var addr =  y1 + "," + y2 + "," + y3 + ",";
    
    if(total > 0)
    {
        for(let key in MyCart)
        {   
            document.getElementById(key).value=
            run(key,document.getElementById(key).value,addr);
        }
    }
    else
    {
        alert("please add product to cart !");
    }

    }
   
}
</script>

</body>
</html