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
if (isset($_GET["keyword"]) && isset($_GET["type"]) && isset($_GET["min"]) && isset($_GET["max"])) {
    
	$keyword = $_GET['keyword'];
	$type = $_GET['type'];
	$min = $_GET['min'];
	$max = $_GET['max'];
	
	if(($keyword=="null" || $keyword=="NULL") && ($min=="null" || $min=="NULL" || $max=="null" || $max=="NULL")){
		
		// get a product from products table
		$result = mysql_query("SELECT * FROM `food` WHERE type='$type'");
		
	}else if ($keyword=="null" || $keyword=="NULL") {

		// get a product from products table
		$result = mysql_query("SELECT * FROM `food` WHERE type='$type' AND  price >= $min AND price <= $max");
		
	}else if ($min=="null" || $min=="NULL" || $max=="null" || $max=="NULL") {
		
		// get a product from products table
		$result = mysql_query("SELECT * FROM `food` WHERE id LIKE '%$keyword%' OR name LIKE '%$keyword%' OR type LIKE '%$keyword%' 
		OR price LIKE '%$keyword%' OR image LIKE '%$keyword%' OR Restaurantid LIKE '%$keyword%' 
		AND type='$type'");
	
	}else {
		
		// get a product from products table
		$result = mysql_query("SELECT * FROM `food` WHERE id LIKE '%$keyword%' OR name LIKE '%$keyword%' OR type LIKE '%$keyword%' 
		OR price LIKE '%$keyword%' OR image LIKE '%$keyword%' OR Restaurantid LIKE '%$keyword%' 
		AND type='$type' AND  price >= $min AND price <= $max");
		
	}
	

	if (!empty($result)) {
		// check for empty result
		if (mysql_num_rows($result) > 0) {
			// looping through all results
			// products node
			$response["food"] = array();
			
			while ($row = mysql_fetch_array($result)) {
				// temp user array
				$food = array();
				$food["id"] = $row["id"];
				$food["name"] = $row["name"];
				$food["type"] = $row["type"];
				$food["price"] = $row["price"];
				$food["image"] = $row["image"];
				$food["Restaurantid"] = $row["Restaurantid"];

				// push single product into final response array
				array_push($response["food"], $food);
			}
			// success
			$response["success"] = 1;

			// echoing JSON response
			echo json_encode($response);
		} else {
			// no product found
			$response["success"] = 0;
			$response["message"] = "No result found";

			// echo no users JSON
			echo json_encode($response);
		}
	} else {
		// no product found
		$response["success"] = 0;
		$response["message"] = "No result found";

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