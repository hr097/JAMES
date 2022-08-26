<?php
    session_start();
    $string=random_bytes(64);
    $string=md5($string);
    $string=substr($string, 0,5);
    $_SESSION['captcha']=$string;

    //image create 
    $height=25;
    $width=60;
    $image_p = imagecreate($width, $height);

    //fill in image backgrount color
    imagecolorallocate($image_p, 10, 34, 67);
    $white = imagecolorallocate($image_p,255,255,255);

    //fill string in image 
    $font_size = 14;
    imagestring($image_p, $font_size, 6, 5, $string, $white);


    // image in line drow
    $line = imagecolorallocate($image_p,239,239,234);
    // imageline(image, x1, y1, x2, y2, color);    
    imageline($image_p, 0, 0, 39, 29, $line);
    imageline($image_p, 40, 0, 64, 29, $line);
    imagejpeg($image_p); ?> " >

?>