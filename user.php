<?php
require_once('mysql.php');
class User{
    private $id, 
            $firstName ,
             $lastName ,
             $natinalCode ,
             $email , 
             $identity ,
             $phoneNumber ,
             $address ,
             $country ,
             $state;

    protected  $userName ,
               $password,
               $error,
 /*
    This attribute shows user in which database should be save
 */
               $userDatabaseName;

    private  $connectServer ,
             $result , 
             $userCookies = array('userName' , 'Password' , 'identity' , 'id');

   //constructor
   function __construct($userName , $password , $identity )
   {
     $this->userName = $userName;
     $this->password = $password;
     $this->identity = $identity;
     $this->connectServer = new ConnectMysql("localhost" , "android" , "1700149113" , "myapplication");
   }

    //Getter funcions
    public function getError(){
        return $this->error;
    }
    public function getuserName()
    {
        return $this->userName;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getIdentity() {
        return $this->identity;
    }
    //Setter functions
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }
    public function setNatinalCode($natinalCode)
    {
        $this->natinalCode = $natinalCode;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }
    public function setAddress($address)
    {
        $this->address = $address;
    }
    public function setCountry($country)
    {
        $this->country = $country;
    }
    public function setState($state)
    {
        $this->state = $state;
    }

   


    //Check cookies is TRUE(cooky set) or FALSE(cooky unset)
    public static function CHECK_COOKIES()
    {
        if((isset($_COOKIE["userName"])) & (isset($_COOKIE["password"])))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    //we're going to add send email 
    // public  function ALLEMAILS() {
    //     $query = "select email from users where 1 ";
    //     $this->result = mysqli_query($this->connectServer->getConnection() , $query);     
    // }

    //Check user exists
    protected function userExists()
    {
        $this->userDatabaseName = $this->getIdentity();
        $query = "select * from {$this->userDatabaseName} ";
        $query .= "where  userName ='{$this->userName}'";
       $this->result = mysqli_query($this->connectServer->getConnection() , $query);
       
       if(mysqli_num_rows($this->result) > 0)
       {
          $this->error = "This userName already exists , Pleas change an other.";
          
       }
    }

    //Get user's  id
    protected function getUserId() {
    

        $this->userDatabaseName = $this->getIdentity();
        $query = "select * from {$this->userDatabaseName} ";
        $query .="where userName = '{$this->userName}' AND password = '{$this->password}' ";
        $this->result = mysqli_query($this->connectServer->getConnection() , $query);

        while($row = mysqli_fetch_assoc($this->result)) {
            return $row['id'];
        }

    }

    //When user logn in cookies will have set
    private function setUserCookies()
    {
        
        $this->userCookies['userName'] = $this->userName;
        $this->userCookies['password'] = $this->password;
        $this->userCookies['identity'] = $this->identity;
        $this->userCookies['id'] = $this->getUserId();
        $expire = time() + 60 * 60 * 60;
        setcookie("userName" , $this->userCookies['userName'] , $expire);
        setcookie("password" , $this->userCookies['password'] , $expire);
        setcookie("identity" , $this->userCookies['identity'] , $expire);
        setcookie("id" , $this->userCookies['id'] , $expire);
    }

    //Check userName and password if TRUE user loged in else show massege
    public function userLogIn()
    {
        $this->userDatabaseName = $this->getIdentity();
        $query = "select * from {$this->userDatabaseName} ";
        $query .="where userName = '{$this->userName}' AND password = '{$this->password}' ";
        $this->result = mysqli_query($this->connectServer->getConnection() , $query);
        
        if(mysqli_num_rows($this->result) <= 0)
        {
            $this->error = "Woops! Your userName or password is wrong , Please check again.";
        }
        else
        { 
           $this->getUserId(); 
           $this->setUserCookies();
            header("Location: panel.php");
            exit();
        }
    }

    //Log out user whit clean all cookies
    public static function LOG_OUT() {
        setcookie("userName");
        setcookie("password");
        setcookie("identity");
        setcookie("id" );

        header("Location: index.php");
        exit();

    }

    //Show all users
    public function showAllUser()
    {
        $this->userDatabaseName = $this->getIdentity();
        $query = "select * from {$this->userDatabaseName} ";
        $this->result = mysqli_query($this->connectServer->getConnection() , $query);
        return $this->result;
    }
    
    //Add user in data base 
    public  function addNewUser()
    {
       $this->userDatabaseName = $this->getIdentity();
        $this->userExists();   
        if(empty($this->error))
        {
            $query = "insert ";
            $query .="INTO {$this->userDatabaseName} ( ";
            $query .="userName , password , firstName , lastName , natinalCode , email , identity , phoneNumber , address , country , stat ";
            $query .=") VALUES ( ";
            $query .="'{$this->userName}' , '{$this->password}' , '{$this->firstName}' , '{$this->lastName}' , '{$this->natinalCode}' , '{$this->email}' , '{$this->identity}' , {$this->phoneNumber} , '{$this->address}' , '{$this->country}' , '{$this->state}' ";
            $query .=") ";
            $this->result = mysqli_query($this->connectServer->getConnection() , $query);
            if($this->result)
            {
                return $this->result;
            }
            else
            {
                die("We have problem to create new user , Pleas try an other time.");
            }
        }
        
    }

    //Update user
    public function updateUser()
    {
        $this->userDatabaseName = $this->getIdentity();
        $query = "update {$this->userDatabaseName} ";
        $query .="set firstName = '{$this->firstName}' , lastName = '{$this->lastName}' , phoneNumber = '{$this->phoneNumber}' ";
        $query .="where userName = '{$this->userName}'";
        $this->result = mysqli($this->connectServer->getConnection() , $query);
        return $this->result;
    }

    //Delete user
    public function deleteUser()
    {
        $this->userDatabaseName = $this->getIdentity();
        $query = "delete {$this->userDatabaseName} ";
        $query .="where userName = '{$this->userName}'";
        $this->result = mysqli_query($this->connectServer->getConnection() , $query);
        return $this->result;
    }

}
?>