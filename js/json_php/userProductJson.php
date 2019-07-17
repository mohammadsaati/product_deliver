<?php
require_once('../../product.php');
$userId = isset($_COOKIE['id'])?$_COOKIE['id'] : null;

if(!empty($userId)) {
    $product = new Products($userId);

    echo $product->myProduct();
}
?>