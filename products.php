<?php
require_once('mysql');
class Products {
    private $productName , 
            $productPrice  ,
            $productDiscription ,
            $connectServer;

    //Getter functions
    public function getProductName() {
        return $this->productName;
    }

    public function getProductPrice() {
        return $this->productPrice;
    }

    public function getProductDiscription() {
        return $this->productDiscription;
    }

    //constuctor
    function __construct()
    {
        $this->connectServer = new ConnectMysql("localhost" , "android" , "1700149113" , "myapplication");
    }
}
?>