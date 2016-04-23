<?php

/*
 * Following code will list all the products
 */

// array for JSON response
$response = array();


// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();

if (isset($_GET["restaurantid"])) {
	
    $restaurantid = $_GET['restaurantid'];


	// get all products from products table
	$result = mysql_query("SELECT * FROM `orderline` WHERE Restaurantid = '$restaurantid'") or die(mysql_error());

	// check for empty result
	if (mysql_num_rows($result) > 0) {
		// looping through all results
		// products node
		$response["orderline"] = array();
		
		while ($row = mysql_fetch_array($result)) {
			
			$orderline = array();
			$orderline["Ordernumber"] = $row["Ordernumber"];
			$orderline["Foodid"] = $row["Foodid"];
			$orderline["quanitity"] = $row["quanitity"];
			$orderline["pick_up"] = $row["pick_up"];
			$orderline["status"] = $row["status"];
			$orderline["item_total"] = $row["item_total"];
			$orderline["Restaurantid"] = $row["Restaurantid"];
			// success
			$response["success"] = 1;



			// push single product into final response array
			array_push($response["orderline"], $orderline);
		}
		// success
		$response["success"] = 1;

		// echoing JSON response
		echo json_encode($response);
	} else {
		// no products found
		$response["success"] = 0;
		$response["message"] = "No orderline found";

		// echo no users JSON
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
