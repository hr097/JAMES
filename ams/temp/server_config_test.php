<?php


function set_server_configuration()
{    
    echo "<br>".ini_set('session.use_strict_mode',1); //enable strict mode to prevent session fixation attacks
    echo "<br>".ini_set('session.use_trans_sid',0); //This will tell PHP not to include the identifier in the URL, and not to read the URL for identifiers.
    echo "<br>".ini_set('session.use_only_cookies',1);//This will tell PHP to never use URLs with session identifiers.
    //echo "<br>".ini_set('session.hash_function', 'sha512');
    echo "<br>".ini_set('session.use_cookies',1); // to allow stire session ID in  clientside
    //echo "<br>".ini_set('session.hash_bits_per_character',6); //remove in php 7.0+
    // echo "<br>".ini_set('session.entropy_file','/dev/urandom'); //remove in php 7.0+
    // echo "<br>".ini_set('session.entropy_length',256);  //remove in php 7.0+
    echo "<br>".ini_set('session.cookie_httponly', 1);    // Prevents javascript XSS attacks aimed to steal the session ID
    echo "<br>".ini_set('session.use_only_cookies', 1);   // Prevent Session ID from being passed through  URLs
    echo "<br>".ini_set('session.name','lxy2Se2k3Un23l5u5E657S9jsn0NI8d05f4AnU53r'); // set session name
    // echo "<br>".ini_set('display_errors','Off'); // for display error
    // echo "<br>".ini_set('display_startup_errors','Off'); // for display startup error
    // echo "<br>".ini_set('file_uploads','On'); // turn on file upload
    // echo "<br>".ini_set('allow_url_include','Off'); // for allowing external link http/https files with include/require
    // echo "<br>".ini_set('mysqli.reconnect','On'); // recomend the MYSQL
    // echo "<br>".ini_set('mysqli.rollback_on_cached_plink','On'); //rollback changes in db when connection is half closed


    $secure = false; // if you only want to receive the cookie over HTTPS
    $httponly = true; // prevent JavaScript access to session cookie
    $samesite = 'Strict';

    echo "<br> cookie : ".session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'domain' => $_SERVER['HTTP_HOST'],
        'secure' => $secure ,
        'httponly' => $httponly,
        'samesite' => $samesite
    ]);
}


set_server_configuration();

?>