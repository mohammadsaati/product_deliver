<?php
require_once('../../mysql.php');
class Pppr {
    protected $connectJsonServer , $tableName;

    public function getDatabase() {
        return $this->tableName;
    }

    //constructor
    function __construct()
    {
        $this->connectJsonServer = new ConnectMysql("localhost" , "android" , "1700149113" , "myapplication");
    }

    public function encodeData() {
        $query = "select * from products";
        $result = mysqli_query($this->connectJsonServer->getConnection() , $query);
        $Data = array();
        while($row = mysqli_fetch_array($result)) {
            $Data [] = array(
                'id' => $row['id'],
                'title' => $row['title'],
                'body' => $row['body'],
                'price' => $row['price']
            );
        }

        return json_encode( $Data );
    }
}

$ppo = new Pppr();
echo $ppo->encodeData();
?>