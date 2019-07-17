<?php
require_once('userJson.php');
class Farmerjson extends Userjson{
   
    function __construct()
    {
        parent::__construct();
    }

    protected $tableName = 'farmers';
    
}

//Create intial from this class
$farmerJson = new Farmerjson();
echo $farmerJson->encodeData();
foreach($_POST as $pos) {
    echo $pos;
}
?>