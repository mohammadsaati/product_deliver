<?php
require_once('userJson.php');
class Driverjson extends Userjson{
   
    //constructor
    function __construct()
    {
        parent::__construct();
    }

   protected $tableName = 'drivers';
}

//Create intial from this class
$driverJson = new Driverjson();
echo $driverJson->encodeData();
?>