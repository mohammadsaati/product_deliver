<?php
    require_once('../../user.php');
   
    //Chech if cookies set
    $userCookies = User::CHECK_COOKIES();
    if($userCookies) {
        $userName = $_COOKIE["userName"];
        $password = $_COOKIE["password"];
        $identity = $_COOKIE["identity"];
        $id = $_COOKIE["id"];

        //Create json fiel
        $cookiesData = array(
            "userName" => $userName,
            "paaword" => $password,
            "identity" => $identity,
            "id" => $id
        );

        echo json_encode( $cookiesData );
    } else {
        echo "no";
    }

?>