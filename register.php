<?php 
    require_once ('functions.php'); 
    require_once('user.php');
   echo head(array('title' =>'New Account'));

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

         //assigne POST method to variables : 
         $firstName = $_POST['firstName'];
         $lastName = $_POST['lastName'];
         $phoneNumber = $_POST['phoneNumber'];
         $email = $_POST['email'];
         $natinalCode = $_POST['natinalCode'];
         $address = $_POST['address'];
         $country = $_POST['country'];
         $state = $_POST['state'];

         //assigne user properties : 
         $users->setFirstName($firstName);
         $users->setLastName($lastName);
         $users->setNatinalCode($natinalCode);
         $users->setEmail($email);
         $users->setPhoneNumber($phoneNumber);
         $users->setAddress($address);
         $users->setCountry($country);
         $users->setState($state);

         //check error and save : 
         $users->addNewUser();
         
         if(empty($users->getError()))
         {
            echo alertMassage(array(
                'name' => 'success',
                'bold' => 'Thanks',
                'text' => 'Your register was success , now you can login and sell your products.'
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

    include('htmlFiles/register.html');
    

   echo footer(); 
   
?>