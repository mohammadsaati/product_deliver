<?php
require_once ('functions.php'); 
require_once('user.php');
//Echo our html's header 
echo head(array('title' =>'panel'));

//Check assign userName , password and identity cookies
$checkCookies = User::CHECK_COOKIES();
if($checkCookies) {
 
    //asign initial values for user
    $userName = $_COOKIE["userName"];
    $password = $_COOKIE["password"];
    $identity = $_COOKIE["identity"];
    
    //Initial user
    $user = new User($userName , $password , $identity);
   
} else {
    /*
        if cookies dont set this page should not show for users.
        redrirect to home page for login or register.
    */
    header("Location: index.php");
    exit();
}

//Incude UI page for panel
include('htmlFiles/panel.html');

//Echo our html's footer
echo footer(); 
?>