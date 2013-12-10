<?php 
	header("Access-Control-Allow-Origin: *");
	require './bigcommerce.php';
	use Bigcommerce\Api\Client as Bigcommerce;
	
	$store_url = 'https://www.campus-classics.com';
	$username = 'admin';
	$api_key = 'b5c36ba3123a1aa41031c5d783c340c198b98b50';
	
	Bigcommerce::configure(array(
	    'store_url' => $store_url,
	    'username'  => $username,
	    'api_key'   => $api_key
	));
	
	Bigcommerce::setCipher('RC4-SHA');
	Bigcommerce::verifyPeer(false);
    
    $count = Bigcommerce::getOrdersCount()/200;
    for ($i = 1; $i <= $count; $i) {
        $filter = array('limit' => 200, 'page' => $i);
        $orders = Bigcommerce::getOrders($filter);
        foreach($orders as $order) {
            echo $order->name;
            echo $order->price;
        }
     }
?>