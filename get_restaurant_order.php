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

	


	// get all products from products table

	// check for empty result
	if (mysql_num_rows($result) > 0) {
		// looping through all results
		// products node
		
		while ($row = mysql_fetch_array($result)) {
			
			// success
			$response["success"] = 1;



			// push single product into final response array
		}
		// success
		$response["success"] = 1;

		// echoing JSON response
		echo json_encode($response);
	} else {
		// no products found
		$response["success"] = 0;

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
