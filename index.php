<?php 
   require_once('user.php');
   $isCookies = User::CHECK_COOKIES();
   if($isCookies)
   {
    header("Location: panel.php");
    exit();
   }
   else
   {
    header("Location: login.php");
    exit(); 
   }


   

?>