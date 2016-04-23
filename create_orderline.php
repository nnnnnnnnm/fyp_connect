<?php

/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */

// array for JSON response
$response = array();

// check for required fields
if (isset($_GET['ordernumber']) && isset($_GET['foodid']) && isset($_GET['quanitity']) && isset($_GET['Restaurantid']) && isset($_GET['item_total'])) {
    
    $ordernumber = $_GET['ordernumber'];
	$foodid = $_GET['foodid'];
    $quanitity = $_GET['quanitity'];
	$Restaurantid= $_GET['Restaurantid'];
	$item_total = $_GET['item_total'];

    // include db connect class
    require_once __DIR__ . '/db_connect.php';

    // connecting to db
    $db = new DB_CONNECT();
	
    // mysql inserting a new row
    $result = mysql_query("INSERT INTO `orderline`(Ordernumber, Foodid, quanitity, pick_up, item_total, Restaurantid) VALUES('$ordernumber', '$foodid', '$quanitity', NULL, $item_total,  '$Restaurantid')");

    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "OrderLine successfully created.";

        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred.";
        
        // echoing JSON response
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}
?>