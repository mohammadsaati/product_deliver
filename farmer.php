<?php
   require_once ('user');
    class Farmer extends User
{
    //constructor
     public function __construct($userName, $password, $identity)
    {
        parent::__construct($userName, $password, $identity);
    }
    
}
?>