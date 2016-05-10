<?php

/*
 * Following code will get single product details
 * A product is identified by product id (pid)
 */

// array for JSON response
$response = array();


// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();

// check for post data
if (isset($_GET["sql"])) {
    $sql = $_GET['sql'];

    // get a product from products table
    $result = mysql_query("$sql");

    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
		
		$response["restaurant"] = array();
				
		while ($row = mysql_fetch_array($result)) {
			// temp user array
			$restaurant = array();
			$restaurant["id"] = $row["id"];
			$restaurant["name"] = $row["name"];
			$restaurant["address"] = $row["address"];
			$restaurant["type"] = $row["type"];
			$restaurant["telNum"] = $row["telNum"];
			$restaurant["Userid"] = $row["Userid"];

			// push single product into final response array
			array_push($response["restaurant"], $restaurant);
		}
		
		// success
		$response["success"] = 1;

		// echoing JSON response
		echo json_encode($response);
		
    } else {
        // no product found
        $response["success"] = 0;
        $response["message"] = "No order found";

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
}
?>