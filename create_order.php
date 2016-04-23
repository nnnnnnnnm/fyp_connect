<?php

/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */

// array for JSON response
$response = array();

// check for required fields
if (isset($_GET['customerid']) && isset($_GET['order_total'])) {
    
    $customerId = $_GET['customerid'];
	$order_total = $_GET['order_total'];

    // include db connect class
    require_once __DIR__ . '/db_connect.php';

    // connecting to db
    $db = new DB_CONNECT();
	
	$currentTime = mkTime() + (6*3600);
	$dateTime=date('y-m-d H:i:s' , $currentTime);
	
	$number = mysql_query("SELECT max(number)as number FROM `order`");
	if (!empty($number)) {
        // check for empty result
        if (mysql_num_rows($number) > 0) {

            $number = mysql_fetch_array($number);

			$number = $number["number"];
			$number = $number + 1;
			
			
		} else {
            $number = 1;
        }
	} else {
        $number = 1;
    }
	
    // mysql inserting a new row
    $result = mysql_query("INSERT INTO `order`(number, date_time, order_total, Customerid) VALUES($number, '$dateTime', $order_total, '$customerId')");

    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
		$response["number"] = $number;
        $response["message"] = "Order successfully created.";

        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred.";
        
        // echoing JSON response
        echo json_encode($response);
		echo $number . "       ";
		echo $dateTime. "       " . $order_total. "       " . $customerId;
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}
?>