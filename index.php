<?php 
	//header("Access-Control-Allow-Origin: *");
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
	
	$currentdate = strtotime(date("Ymd"));	
	//echo $currentdate;
    
    $mindate = date(DateTime::RFC2822, $currentdate);
    //echo $mindate;
    
    $displaydate = date('m/d/Y', $currentdate);
    
    //$ping = Bigcommerce::getTime();

    //if ($ping) echo $ping->format('H:i:s');
    $count = Bigcommerce::getOrdersCount()/5;
    //for ($i = 1; $i <= $count; $i) {
    	
    	$filter = array('min_date_created' => $mindate, 'status_id' => 11, 'limit' => 5, 'page' => 1);
    	$orders = Bigcommerce::getOrders($filter);
    	if(!$orders) {
	 	   	echo '<div class="BCerror">';
	 	   	$error = Bigcommerce::getLastError();
	 	   	echo $error->code;
	 	   	echo $error->message;
	 	   	echo '</div>';
	 	} else {
		 	echo 'Recent Orders:<br />';
		 	//$arraystring = '<pre>'.print_r($orders, true).'</pre>';
		 	//echo $arraystring;
		 	foreach($orders as $order) {
            	echo 'Order #: ' . $order->id . '<br />';
            	echo 'Order Total: ' . $order->total_inc_tax . '<br />';
            }
		}
	//}
    
    $productsCount = Bigcommerce::getProductsCount();

    echo $productsCount . ' Products<br />';
    
    $categoriesCount = Bigcommerce::getCategoriesCount();
    
    echo $categoriesCount . ' Categories<br />';
    
    $customersCount = Bigcommerce::getCustomersCount();
    
    echo $customersCount . ' Customers<br />';
    
    //$orderStatuses = Bigcommerce::getOrderStatuses();
    
    //$arraystring = '<pre>'.print_r($orderStatuses, true).'</pre>';
    
    //echo $arraystring;
?>