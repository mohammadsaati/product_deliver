<?php
    require_once ('functions.php'); 
    require_once('user.php');
   echo head(array('title' =>'on line bussiness'));

 if((isset($_POST['userName'])) & (isset($_POST['password'])))
   {
        if(empty($_POST['userName']) || empty($_POST['password']) || ($_POST['position'] == '...'))
        {
            echo alertMassage(array(
                'name' => 'warning',
                'bold' => 'Error!',
                'text' => 'Something happend wrong Plese check again.'
            ));
        }
        else
        {
          //get user init properties : 
          $userName = $_POST['userName'];
          $password = $_POST['password'];
          $identity = $_POST['position'];
          //init user : 
          $users = new User($userName , $password , $identity);

          $users->userLogIn();
          if(empty($users->getError()))
          {
                echo alertMassage(array(
                    'name' => 'success',
                    'bold' => 'Good',
                    'text' => 'You loged in.'
                ));
          }
          else
          {
            echo alertMassage(array(
                'name' => 'danger',
                'bold' => 'Error!',
                'text' => $users->getError()
            ));   
          }
  
        }
   }

   include('htmlFiles/home.html');

   echo footer(); 
?>