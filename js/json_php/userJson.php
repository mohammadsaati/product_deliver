<?php
require_once('../../mysql.php');
class Userjson {
    protected $connectJsonServer , $tableName;

    public function getDatabase() {
        return $this->tableName;
    }

    //constructor
    function __construct()
    {
        $this->connectJsonServer = new ConnectMysql("localhost" , "android" , "1700149113" , "myapplication");
    }

    //Get all data from FARMER database 
    public function encodeData() {
        $userId = isset($_COOKIE["id"])? $_COOKIE["id"] :"0";
        $query = "select * from {$this->tableName} ";
        $query .="where id = {$userId} ";
        $result = mysqli_query($this->connectJsonServer->getConnection() , $query);
        $Data = array();
        while($row = mysqli_fetch_array($result)) {
            $Data = array(
                "id" => $row["id"],
                "userName" => $row["userName"],
                "password" => $row["password"],
                "firstName" => ucfirst($row["firstName"]),
                "lastName" => ucfirst($row["lastName"]),
                "identity" => $row["identity"],
                "phoneNumber" => $row["phoneNumber"],
                "address" => $row["address"],
                "email" => $row["email"],
                "natinalCode" => $row["natinalCode"],
                "country" => $row["country"],
                "stat" => $row["stat"]
            );

        }
        return json_encode( $Data );
    }
}
?>