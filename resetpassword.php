<?php
    require_once ('functions.php'); 
    require_once('user.php');
   echo head(array('title' =>'reset password'));

    if(isset($_POST['email']))
    {
        if(!empty($_POST['email']))
        {
            $email = $_POST['email'];
           // $user = new User("admin" , "123" , "farmer");
            // var_dump($user->ALLEMAILS());
        }
    }
   include("htmlFiles/resetpassword.html");

   echo footer();
?>