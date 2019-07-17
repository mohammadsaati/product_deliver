<?php
 require_once('user.php');
    class Customer extends User {
        //constructor
        function __construct($userName, $password, $identity)
        {
            parent::__construct($userName, $password, $identity);
        }
    }
?>