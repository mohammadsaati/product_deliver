<?php 
class ConnectMysql{
   private $hostName , $userName , $password , $dataBaseName;
   private $connection;
   
   function __construct($hostName , $userName , $password , $dataBaseName)
   {
       $this->hostName = $hostName;
       $this->userName = $userName;
       $this->password = $password;
       $this->dataBaseName = $dataBaseName;
       $this->connect();
   }

   public function getConnection(){
       return $this->connection;
   }

   function connect(){
       $this->connection = mysqli_connect($this->hostName , $this->userName , $this->password , $this->dataBaseName);
       if(!$this->connection){
           die("Woops! Sorry We have error to connect database.Please try again.");
       }
   }

   public function close(){
       
         mysqli_close($this->connection);
   }
   
/*
   public function createTable($tableName){

        $query = "SHOW TABLES LIKE '{$tableName}'";
        $test = mysqli_query($this->connection , $query);
        if($test->num_rows == 1){
            die("You can't create this table with <b>{$tableName}</b> name , <b>{$tableName}</b> alredy exist");
        }
        
            We'll customize create database.
        
   }
*/

}


?>