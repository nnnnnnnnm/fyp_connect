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

// get a product from products table
$result = mysql_query("SELECT *FROM `food`") or die(mysql_error());

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
    // no products found
    $response["success"] = 0;
    $response["message"] = "No food found";

    // echo no users JSON
    echo json_encode($response);
}

?>