<?php
    require_once('order.php');
    $productId = isset($_GET['productId']) ? $_GET['productId'] : null;
    $userId = isset($_COOKIE['id']) ? $_COOKIE['id'] : null;

    if(!empty($productId) & !empty($userId)) {
        $order = new Orders($userId);

        $order->orderProcess($productId);
        header("Location: allProducts.php?ordered=true");
        exit();
    } else {
        die ("You shuould first log in.");
    }
?>