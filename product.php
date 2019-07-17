<?php
require_once('mysql.php');
class Products {
    //Properties
    public $error;
    private $userId,
            $productId,
            $title,
            $body,
            $price,
            $connectServer,
            $result,
            $userType;

    //Getter functions
    public function getId()
    {
        return $this->productId;
    }
    public function getUserId() {
        return $this->userId;
    }        

    public function getTitle() {
        return $this->title;
    }

    public function getBody() {
        return $this->body;
    }

    public function getPrice() {
        return $this->price;
    }
    //Setter functions 
    public function setPrice($price) {
        $this->price = $price;
    }
    public function setBody($body) {
        $this->body = $body;
    }
    public function setTitle($title) {
        $this->title = $title;
    }
    //Constructor
    function __construct($userId)
    {   
        $this->userId = $userId;
        $this->connectServer = new ConnectMysql("localhost" , "android" , "1700149113" , "myapplication");
    }
    //Get user type
    private function getUserType() {
        return isset($_COOKIE["identity"]) ? $this->userType = $_COOKIE["identity"] : $this->userType = null;
    }
    //Add product for farmers and customers
    public function addProduct() {
        $this->getUserType();

        $query = "insert ";
        $query .="INTO products ( ";
        $query .="title , body ,  price , farmerID  ";
        $query .=" ) VALUES ( ";
        $query .="'{$this->title}' , '{$this->body}' , {$this->price} , {$this->userId}  ";
        $query .=") ";
        $this->result = mysqli_query($this->connectServer->getConnection() , $query);
        //Check result
        if($this->result) {
            return $this->result;
        } else {
            die('Oh sorry !! We have problem in SQL codes.'.mysqli_errno($this->result));
            $error = "we have som problem to save new product.";           
        }
    }

    //Get user's product(s) 
    public function myProduct() {
        $query ="select * from products ";
        $query .=" where farmerID = {$this->userId} ";
        $this->result = mysqli_query($this->connectServer->getConnection() , $query);
        $myProducts = array();
        while($row = mysqli_fetch_array($this->result)){
            $myProducts[] = array(

                "id" => $row["id"],
                "title" => $row["title"],
                "body" => $row["body"],
                "price" => $row["price"]
            );
        }

        return json_encode($myProducts);
    }


    //Get product by id
    public function getProductByid($productId){
        $query = "select * from products ";
        $query .="where id = {$productId} ";

        $this->result = mysqli_query($this->connectServer->getConnection() , $query);
        //Check result
        if($this->result) {
            while($row = mysqli_fetch_array($this->result)) {
                $this->title = $row['title'];
                $this->body = $row['body'];
                $this->price = $row['price'];
                $this->productId = $row['id'];
            }
        } else {
            die('Oh sorry !! We have problem in SQL codes.'.mysqli_errno($this->result));
            $error = "we have som problem to save new product.";           
        }

        
        
        
    }


    //Delete product 
    public function deleteProduct($productId) {
        $query = "delete from products ";
        $query .="where id = {$productId} ";

        $this->result = mysqli_query($this->connectServer->getConnection() , $query);
        //Check result
        if($this->result) {
            return $this->result;
        } else {
            die('Oh sorry !! We have problem in SQL codes.'.mysqli_errno($this->result));
            $error = "we have som problem to save new product.";           
        }
    }

    //updata product
    public function updateProduct($productId) {
        $query = "update products ";
        $query .="set title = '{$this->title}' , body = '{$this->body}' , price = '{$this->price}' ";
        $query .="where id = {$productId}";

        $this->result = mysqli_query($this->connectServer->getConnection() , $query);
        //Check result
        if($this->result) {
            return $this->result;
        } else {
            die('Oh sorry !! We have problem in SQL codes.'.mysqli_errno($this->result));
            $error = "we have som problem to save new product.";           
        }

    }

    //All products
    public function allProduct() {

        $query = "select * from products ";

        $this->result = mysqli_query($this->connectServer->getConnection() , $query);
        //Check result
      
            
                $row = mysqli_fetch_array($this->result);
                $this->productId = $row['id'];
                $this->title = $row['title'];
                $this->body = $row['body'];
                $this->price = $row['price'];
            
       
    }
}


?>