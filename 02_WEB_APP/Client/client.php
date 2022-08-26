<?php
     require_once('../Other/customlib.php'); 
    session_start();
    
    if(!(isset($_SESSION["_csrfToken"])&&isset($_SESSION["_userId"]) && isset($_SESSION["_userType"])&&$_SESSION["_userType"]==="2"))
    {
        header("Location:../index.php");
        exit();
    }
    else if(isset($_POST["logout"]))
    {   
        session_unset();
        session_destroy();
        if(count($_COOKIE) > 0 && isset($_COOKIE["__u9RmdkJ6"]))
        {
        setcookie("__u9RmdkJ6","", time() - 3600, "/");
        }
        header("Location:../index.php");
        exit();
    }
    session_regenerate_id(true);
?>

<!DOCTYPE html>

<html>

<head>

    <title>Shopping cart | Dashboard </title>
    <link rel="icon" type="image/x-icon" href="../Assets/favicon.png">
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type="text/css">
    html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif;}
.w3-sidebar {
  z-index: 3;
  width: 250px;
  top: 43px;
  bottom: 0;
  height: inherit;
}
body::-webkit-scrollbar {
    display: none;
	overflow-y: scroll;
     }
@import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap");



footer {
  background: black;
  color:white;
  width: 100%;
  margin: 0 auto;
  margin-top: 50px;
  box-shadow: #2f4374 0 10px 20px 5px;
  padding: 30px;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 30px;
}

.main {
  width: 100%;
  display: flex;
  gap: 50px;
  flex-wrap: wrap;
}
.heading {
  margin-bottom: 15px;
}
.col1 {
  flex: 1;
  min-width: 200px;
}
.col2 {
  flex: 2;
  min-width: 300px;
}
.col3 {
  flex: 1;
  min-width: 200px;
}

.col1 a {
  display: inline-block;
  padding: 7px 0;
  font-size: 14px;
}
.col1 a:hover {
  color: #58bed5;
}

.col2 .languages {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  font-size: 14px;
}
.col2 a {
  display: inline-block;
  padding: 3px 5px;
  border-radius: 3px;
}
.col2 a:hover {
  background: #58bed5;
}

.social {
  display: flex;
  gap: 20px;
}
.col3 ion-icon {
  font-size: 30px;
}
.social a:hover ion-icon {
  color: #5ac1d8;
}

.terms {
  display: flex;
  gap: 20px;
  font-size: 12px;
}
.terms a {
  color: #7783a0;
}

    </style>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>

<body>
<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-theme w3-top w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-left w3-hide-large w3-hover-white w3-large w3-theme-l1"  style="margin:10px;" href="javascript:void(0)" onclick="w3_open()"><i class="fa fa-bars"></i></a>
    
    <form method="post" onsubmit="return confirm_logout()" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <input class="w3-bar-item w3-right" style="margin:10px;" type="submit" name="logout"  value="logout">
    </form>
    <a href="viewcart.php"><img style="width:60px;margin:10px;" src="../Assets/favicon.png" class="w3-bar-item w3-right w3-theme-l1"></a>
    <a href="#" onclick="changeIframe2('general')" style="margin:10px;" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Home</a>
    <a href="#shopping" style="margin:10px;" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Shopping</a>
    <!-- <a href="#" style="margin:10px;" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Shopping</a> -->
    <a href="#myFooter" style="margin:10px;" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Contact us</a>
    <!-- <a href="#" style="margin:10px;" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-hover-white">Clients</a>
    <a href="#" style="margin:10px;" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-hover-white">Partners</a> -->
    <a href="#" style="margin:10px;text-decoration:none;" class="w3-bar-item w3-right  w3-hide-small w3-hide-medium"><?php echo $_SESSION['_userId']; ?></a>

  </div>
</div>

<!-- Sidebar -->
<nav class="w3-sidebar w3-bar-block w3-collapse w3-large w3-theme-l5 w3-animate-left" style="margin-top:22px;" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-right w3-xlarge w3-padding-large w3-hover-black w3-hide-large" title="Close Menu">
    <i class="fa fa-remove"></i>
  </a>
  <h4 class="w3-bar-item"><b>Categories:</b></h4>
  <?php

$sql = "select * from categories where status=1;";
        
$connection = dbconnect();

$result = mysqli_query($connection,$sql);
mysqli_close($connection);

if(mysqli_num_rows($result)>1)
{       
   
while($row = mysqli_fetch_assoc($result)) {
    echo "<a class=\"w3-bar-item w3-button w3-hover-black\" onclick=\"changeIframe(this)\" href=\"#\"".$row['c_name']."\">".$row['c_name']."</a>";
}
}
else
{
    echo "<a class=\"w3-bar-item w3-button\" href=\"#\">No categories to show</a>\"";

}

?>
</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->
<div class="w3-main"  id="shopping" style="margin-left:250px">


  <!-- Pagination -->
  <!-- <div class="w3-center w3-padding-32">
    <div class="w3-bar">
      <a class="w3-button w3-black" href="#">1</a>
      <a class="w3-button w3-hover-black" href="#">2</a>
      <a class="w3-button w3-hover-black" href="#">3</a>
      <a class="w3-button w3-hover-black" href="#">4</a>
      <a class="w3-button w3-hover-black" href="#">5</a>
      <a class="w3-button w3-hover-black" href="#">»</a>
    </div>
  </div> -->

  <!-- <footer id="myFooter">
    <div class="w3-container w3-theme-l2 w3-padding-32">
      <h4>Footer</h4>
    </div>

    <div class="w3-container w3-theme-l1">
      <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
    </div>
  </footer> -->


  <iframe id="iframe"  style="width:80%;height:1000px;margin-right:10%;margin-left:10%;margin-top:50px;border:none;" src="viewcategory.php?category=general"></iframe>

  <footer id="myFooter">
  <div class="main">
    <div class="col1">
      <h3 class="heading">
        About the store
      </h3>
      <ul>
        <li>
          <a href="#">
            Home
          </a>
        </li>
        <li>
          <a href="#">
            Become a customer
          </a>
        </li>
        <li>
          <a href="#">
            About us
          </a>
        </li>
        <li>
          <a href="#">
            FAQ
          </a>
        </li>
        <li>
          <a href="#">
            Return policy
          </a>
        </li>
        <li>
          <a href="#">
            Contact us
          </a>
        </li>
      </ul>
    </div>

    <div class="col2">
      <h3 class="heading">
        Language
      </h3>
      <div class="languages">
        <a href="#">Deutsch</a>
        <a href="#">English</a>
        <a href="#">Espaṅol</a>
        <a href="#">Français</a>
        <a href="#">Indonesian</a>
        <a href="#">Italian</a>
        <a href="#">Nederlands</a>
        <a href="#">Polnisch</a>
        <a href="#">Português</a>
        <a href="#">pyccknṅ</a>
        <a href="#">Tiéng Viêt</a>
        <a href="#">Türkçe</a>
      </div>
    </div>

    <div class="col3">
      <h3 class="heading">
        Get in touch
      </h3>
      <div class="social">
        <a href="#">
          <ion-icon name="logo-facebook"></ion-icon>
        </a>
        <a href="#">
          <ion-icon name="logo-twitter"></ion-icon>
        </a>
        <a href="#">
          <ion-icon name="logo-linkedin"></ion-icon>
        </a>
      </div>
    </div>
  </div>

  <p class="terms">
    <a href="#">Terms of purchase</a>
    <a href="#">Security and privacy</a>
    <a href="#">Newsletter</a>
  </p>
</footer>

<!-- END MAIN -->
</div>

</body>
<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}

function confirm_logout()
{
    let response =  window.confirm('Are you sure you want to logout ?');

    if(response)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function changeIframe(category)
{
  document.getElementById("iframe").setAttribute("src","viewcategory.php?category="+category.innerHTML);
}
function changeIframe2(category)
{
  document.getElementById("iframe").setAttribute("src","viewcategory.php?category="+category);
  console.log(category);
}




</script>
</html>
