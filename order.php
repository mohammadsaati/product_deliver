<?php
require_once('mysql.php');
class Orders {
    private $connectServer,
            $saveDate,
            $result ,
            $userId,
            $insertId , 
        
            $ordersDates = array();

    //Getter functions
    public function getOrdersDates()
    {       
        return $this->ordersDates;
    }        

    function __construct($userId)
    {   
        $this->userId = $userId;
        $this->connectServer = new ConnectMysql("localhost" , "android" , "1700149113" , "myapplication");
    }

    //Save order product
    private function orderProduct($productId , $orderId) {

        $query ="insert into orderproduct ( ";
        $query .="orderID , productID ";
        $query .=") values ( ";
        $query .= "{$orderId} , {$productId} ";
        $query .=" ) ";
        $this->result = mysqli_query($this->connectServer->getConnection() , $query);

        if($this->result) {
            
        } else {
            die("We have problem in saving order-product");

        }
    }

    //Save order user information
    private function orderUser($orderId) {

        $userIdentity = isset($_COOKIE['identity']) ? $_COOKIE['identity'] : null;

        if(!empty($userIdentity)) {
            $query = "insert ";
            $query .="INTO order_{$userIdentity} ( ";
            $query .="orderID , {$userIdentity}ID ";
            $query .=") values ( ";
            $query .="{$orderId} , {$this->userId}";
            $query .= " ) ";
            $this->result = mysqli_query($this->connectServer->getConnection() , $query);
            if($this->result) {
               
            }else {
                die("We have problem in saving order-users");
                
            }

        }
    }
    
    //Set last order is in to insert id 
    private function setInsertId() {

        $query = "select id from orders";
        $this->result = mysqli_query($this->connectServer->getConnection() , $query);
        while($rows = mysqli_fetch_array($this->result)) {
            $this->insertId = $rows;
        }
     
    }
    

    //Save order (Insert into orders)
    public function addOrder() {
        $this->saveDate = date("Y-m-d H:i:s");
       
        $query ="insert ";
        $query .="INTO orders ( ";
        $query .="orderData ";
        $query .= ") VALUES ( '{$this->saveDate}' ) ";

        $this->result = mysqli_query($this->connectServer->getConnection() , $query);
    
        if($this->result) {
            $this->setInsertId();            
            
        } else {
            die("We have problem in saving order");
        }

    }

    //Do all orders process 
    public function orderProcess($productId) {
        $this->addOrder();

        $this->orderProduct($productId , end($this->insertId));
        $this->orderUser(end($this->insertId));
    }

    
    //Select all user's order(s) 
    public function myOrders() {
        $userIdentity = isset($_COOKIE['identity']) ? $_COOKIE['identity'] : null;
       $query = "select title from products ";
       $query .="inner join orderproduct on ";
       $query .="products.id = orderproduct.productID ";
       $this->result = mysqli_query($this->connectServer->getConnection() , $query);
    
        if($this->result) {
            while($row = mysqli_fetch_array($this->result)) {
              $this->ordersDates[]  = $row['title'];
            }    


        } else {
            die("We have problem in saving order");
        }
       
      echo json_encode( $this->getOrdersDates() );
    }
}
?>