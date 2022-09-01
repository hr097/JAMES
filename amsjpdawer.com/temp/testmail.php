<?php     
$to_email = 'harshilramani9777@gmail.com';
$subject = 'Testing PHP Mail';
$message = 'This mail is sent using the PHP mail function';
$headers = 'From: ams.jpd@gmail.com';
echo mail($to_email,$subject,$message,$headers);
?>