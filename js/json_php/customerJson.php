<?php
require_once('userJson.php');
class Customerjson extends Userjson{

    function __construct()
    {
        parent::__construct();
    }

    protected $tableName = 'customers';
}

//Create intial from this class
$customerJson = new Customerjson();
echo $customerJson->encodeData();
?>