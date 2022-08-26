<?php


$username = '';
$password = '';
$email = '';
$job = '';
$salary = '';
$form = true;


function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


if(isset($_POST['submit']))
{  
    $username = test_input($_POST['username']);
    $password = test_input($_POST['password']);
    $email = test_input($_POST['email']);
    $job = test_input($_POST['job']);
    $salary = test_input($_POST['salary']);

    if(empty($username))
    {
        $GLOBALS['error']='*Username is required';
    }
    else if(empty($password))
    {
        $GLOBALS['error']='*Password is required';
    }
    else if(empty($email))
    {
        $GLOBALS['error']='*Email is required';
    }
    else if(!filter_var($email,FILTER_VALIDATE_EMAIL))
    {
        $GLOBALS['error']='*Email is invalid';
    }
    else if(empty($job))
    {   
        $GLOBALS['error']='*Job position is necessary';
    }
    else if(empty($salary))
    {
        $GLOBALS['error']='*Salary is required';
    }
    else if(!preg_match("/^\d[0-9]{1,5}$/",$salary))
    {
        $GLOBALS['error']='*Salary invalid !';
    }    
    else
    {
    
    $GLOBALS['form'] = false;

    echo "username=".$_POST['username']."<br>";
    echo "password=".$_POST['password']."<br>";
    echo "email_id=".$_POST['email']."<br>";
    echo "job-type=".$_POST['job']."<br>";
    echo "salary=".$_POST['salary']."<br>";
    }
}
?>

<!DOCTYPE html>
<html lang="en-IN">

<head>
    <title>FORM</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width,intial-scale=1.0">
   <meta http-equiv="refresh" content="60">
  <link rel="shortcut icon" type="shortcut icon" href="">
<style type="text/css">
</style>
</head>

<body>

    <?php


    if($GLOBALS['form']==true)
    {
        include '01_validateform.html';
    }

    ?>

   
</body>
<script type="text/javascript">
</script>
<noscript>SORRY! YOUR BROWSER DOES NOT SUPPORT JAVASCRIPT.</noscript>
</html>
