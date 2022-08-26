<?php

function sanitizeInput($data) // to prevent XSS atatcks and SQL injection atatcks;
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function dbconnect() // to connect database
{
    $connection = mysqli_connect('localhost','root','','SHOPPING_CART');

    if(!$connection)
    {
    echo"connection failed to database !";
    }

    return $connection;
}

function generateCsrfToken()// return csrf token set in session or if already exists otherwise generate new one
{
    return (isset($_SESSION["_csrfToken"]))?$_SESSION["_csrfToken"]:bin2hex(random_bytes(8));
}

$ciphering = "AES-128-CTR"; // Store the cipher method
$enc_dec_key = "kGj2Yb3Cu5cs121jsn53bEa774kI353uIa"; // encryption key and decryption key
$enc_dec_iv = '0101010101010101'; // Non-NULL Initialization Vector for encryption-decryption
$options = 0; // options  for disjunction of the flags 

function customEncrypt($string) // encryption function
{
    if($string!=="")
    {
        $enc_str = openssl_encrypt($string, $GLOBALS['ciphering'],$GLOBALS['enc_dec_key'],$GLOBALS['options'],$GLOBALS['enc_dec_iv']);// Use openssl_encrypt() function to encrypt the data
        return $enc_str;
    }
    else
    {
        return "";
    }
}

function customDecrypt($encStr) // decryption function
{
    if($encStr!=="")
    {
        $dec_str=openssl_decrypt($encStr,$GLOBALS['ciphering'],$GLOBALS['enc_dec_key'],$GLOBALS['options'],$GLOBALS['enc_dec_iv']);// Use openssl_decrypt() function to decrypt the data
        return $dec_str;
    }
    else
    {
        return "";
    }
}

function startSession($uname,$type)
{
session_start();
$_SESSION["_userId"] = $uname;
$_SESSION["_userType"] = ($type==="1")?"1":"2";
$_SESSION["_csrfToken"] = bin2hex(random_bytes(8));

$redirect = ($type==="1")?"Location:./admin/admin.php":"Location:./client/client.php";
header($redirect); 
exit();   
}

function updateToken($token) // to uodate token to latest on each login
{   
    $connection = dbconnect();
   
    $newToken = bin2Hex(random_bytes(8));

    if(mysqli_query($connection,"update users set token='$newToken' where token='".$token."';"))
    {   
        mysqli_close($connection);
        $newToken = customEncrypt($newToken);
        setcookie("__u9RmdkJ6",$newToken,time()+(86400*7),"/","",false,true);
        return true;
    }
    else
    {   
        mysqli_close($connection);
        return false;
    }
}

function authUserToken($token) // to verify user token 
{   
    $connection = dbconnect();

    $result = mysqli_query($connection,"select * from users where token='$token';");
    mysqli_close($connection);

    if(mysqli_num_rows($result)===1)
    {  
        $user = mysqli_fetch_assoc($result);;
        
        if(($user["token"]===$token)) 
        {   
            // if(updateToken($token)) // for now disable it
            // {   
            //     return $user;
            // }
            // else
            // {
            //     return "";
            // }
            return $user;
        }
    }
    else
    {
        return "";
    }
}

?>
