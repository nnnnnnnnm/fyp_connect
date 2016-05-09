<?php

/*
 * Following code will update a product information
 * A product is identified by product id (pid)
 */

// array for JSON response
$response = array();

// check for required fields
if (isset($_GET['ordernumber']) && isset($_GET['restaurantid'])) {
    
    $ordernumber = $_GET['ordernumber'];
    $restaurantid = $_GET['restaurantid'];
	
	$currentTime = mkTime() + (6*3600);
	$dateTime = date('y-m-d H:i:s' , $currentTime);
	
	
    // include db connect class
    require_once __DIR__ . '/db_connect.php';

    // connecting to db
    $db = new DB_CONNECT();

    // mysql update row with matched pid
    $result = mysql_query("UPDATE `orderline` SET `pick_up`='$dateTime' WHERE Ordernumber=$ordernumber and Restaurantid='$restaurantid'");
	
    // check if row inserted or not
    if ($result) {
        // successfully updated
        $response["success"] = 1;
        $response["message"] = "Food successfully updated.";
        
        // echoing JSON response
        echo json_encode($response);
    } else {
        
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing111111111111111111";

    // echoing JSON response
    echo json_encode($response);
}
?>
