<?php
require_once ('functions.php'); 
require_once ('product.php'); 
//Echo our html's header 
echo head(array('title' =>'Add Product'));

$userId = isset($_COOKIE['id'])?$_COOKIE['id'] : 0;
$identity = isset($_COOKIE['identity'])?$_COOKIE['identity'] : null;

if(isset($_POST['title']) & isset($_POST['price']) & isset($_POST['body'])) {
    if(empty($_POST['title']) & empty($_POST['price']) & empty($_POST['body'])){
        echo alertMassage(array(
            'name' => 'danger',
            'bold' => 'Error!',
            'text' => 'Please fill three filds.'
        ));
    }
    else{
        $title = $_POST['title'];
        $price = $_POST['price'];
        $body = $_POST['body'];

        $product = new Products($userId);

        $product->setTitle($title);
        $product->setPrice($price);
        $product->setBody($body);

        $product->addProduct();
        if(empty($product->error)) {
            echo alertMassage(array(
                'name' => 'success',
                'bold' => 'Save!',
                'text' => 'Your new product saved successfully.
                Do you wanna <a href="panel.php">back</a>?'
            ));
        }
    }
}

//Access denied for who does not login
if(($userId == 0) & empty($identity)) {
    include('htmlFiles/permission.html');
} else {
    //Incude UI page for panel
    include('htmlFiles/addProduct.html');
}
//Echo our html's footer
echo footer();
?>