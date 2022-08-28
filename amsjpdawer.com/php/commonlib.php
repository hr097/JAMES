<?php
//*-----------------------  COMMON FUNCTIONS  ------------------------------------------*/

function sanitizeInput($data) // to prevent XSS atatcks and SQL injection atatcks;
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
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

function init_user_session()
{
    session_start();
    session_regenerate_id();
}

function redirect($path)
{
    header("Location:".$path);
    exit();
}
//*----------------------- COMMON FUNCTIONS END------------------------------------------*/
?>