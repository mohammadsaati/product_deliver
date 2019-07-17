<?php
 require_once('product.php');
 
 $userId = isset($_COOKIE['id']) ? $_COOKIE['id'] : null;
 $delete = isset($_GET['delete']) ? $_GET['delete'] : null;
 $update = isset($_GET['update']) ? $_GET['update'] : null;
 $price ='';
 $title = '';
 $body = '';
 
 if(!empty($userId)) {

    $product = new Products($userId);

    //if user wanna delete : 
    if(!empty($delete)){
        $product->deleteProduct($delete);
        header("Location: panel.php");
        exit();

    } 
    
    //if user wanna update : 
    elseif (!empty($update)) {

        require_once ('functions.php'); 
        //Echo our html's header 
        echo head(array('title' =>'update product'));
        
        //get producct data by id and then show them
        $product->getProductByid($update);

        $price = $product->getPrice();
        $body = $product->getBody();
        $title = $product->getTitle();

        if(isset($_POST['updateOpration'])){
        
        //set information and update
        $product->setTitle($_POST['title']);
        $product->setBody($_POST['body']);
        $product->setPrice($_POST['price']);

        //update opration
        $product->updateProduct($update);

        //show message
        if(empty($product->error)) {
            echo alertMassage(array(
                'name' => 'success',
                'bold' => 'Update!',
                'text' => 'Your new product updated successfully.
                Do you wanna <a href="panel.php">back</a>?'
            ));
        }

        header("Location: panel.php");
    }



        //Incude UI page for panel
        include('htmlFiles/updateProduct.html');

        //Echo our html's footer
        echo footer(); 
    }
   

 } else {
     die("empty");
 }
?>