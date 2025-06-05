<?php 
if(isset($_POST["reset-request-submit)"])){
$selecter =bin2hex(random_bytes(8));
$token = random_bytes(32);
$url = "www.delivernow.net/forgotpassword/create-new-password.php?"
}
else{
    header("Location: ../home.php");
}