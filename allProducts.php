<?php
require_once ('functions.php'); 
require_once('product.php');
//Echo our html's header 
echo head(array('title' =>'products'));

$ordered = isset($_GET['ordered']) ? $_GET['ordered'] : null;
if(!empty($ordered)) {
    echo alertMassage(array(
        'name' => 'success',
        'bold' => 'Ordered',
        'text' => 'Your order saved successfully.'
    ));
}
//Incude UI page for panel
include('htmlFiles/allProducts.html');

//Echo our html's footer
echo footer(); 
?>