<?php
require_once('../../order.php');
$userId = isset($_COOKIE['id']) ? $_COOKIE['id'] : null;
$order = new Orders($userId);

$order->myOrders(); 

?>