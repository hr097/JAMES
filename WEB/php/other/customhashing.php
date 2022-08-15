<?php
/*
$base_encryption_array = array(
'0'=>'b76',
'1'=>'d75',
'2'=>'f74',
'3'=>'h73',
'4'=>'j72',
'5'=>'l71',
'6'=>'n70',
'7'=>'p69',
'8'=>'r68',
'9'=>'t67',
'a'=>'v66',
'b'=>'x65',
'c'=>'z64',
'd'=>'a63',
'e'=>'d62',
'f'=>'e61',
'g'=>'h60',
'h'=>'i59',
'i'=>'j58',
'j'=>'g57',
'k'=>'f56',
'l'=>'c55',
'm'=>'b54',
'n'=>'y53',
'o'=>'w52',
'p'=>'u51',
'q'=>'s50',
'r'=>'q49',
's'=>'o48',
't'=>'m47',
'u'=>'k46',
'v'=>'i45',
'w'=>'g44',
'x'=>'e43',
'y'=>'c42',
'z'=>'a41',
' '=>'b67',

);

function my_custom_encode($string){
global $base_encryption_array ;
$string = (string)$string;
$length = strlen($string);
$hash = '';
    for ($i=0; $i<$length; $i++) {
        if(isset($string[$i])){
            $hash .= $base_encryption_array[$string[$i]];
        }
    }
return $hash;
}


function my_custom_decode($hash){
global $base_encryption_array ;

$base_encryption_array = array_flip($base_encryption_array);

$hash = (string)$hash;
$length = strlen($hash);
$string = '';

    for ($i=0; $i<$length; $i=$i+3) {
        if(isset($hash[$i]) && isset($hash[$i+1]) && isset($hash[$i+2]) && isset($base_encryption_array[$hash[$i].$hash[$i+1].$hash[$i+2]])){
            $string .= $base_encryption_array[$hash[$i].$hash[$i+1].$hash[$i+2]];
        }
    }
return $string;
}
*/

//Generate the hash value of the password

$hash = crypt('Jpdadmin@000','$5$n$8Jsn*B&!94jhr');

//Check the password value is submitted by the user or not

echo $hash." HELLO<br>";

$pswd = password_verify("Jpdadmin@000", $hash);

echo $pswd;

?> 