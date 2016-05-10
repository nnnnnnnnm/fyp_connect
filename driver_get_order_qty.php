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
$result = mysql_query("SELECT *FROM `order` WHERE Driverid is null ORDER BY order_total") or die(mysql_error());

// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["order"] = array();
    
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $order = array();
        $order["number"] = $row["number"];
        $order["date_time"] = $row["date_time"];
        $order["all_pick_up"] = $row["all_pick_up"];
        $order["received_by_customer"] = $row["received_by_customer"];
		$order["order_total"] = $row["order_total"];
        $order["Customerid"] = $row["Customerid"];
        $order["Driverid"] = $row["Driverid"];



        // push single product into final response array
        array_push($response["order"], $order);
    }
    // success
    $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No order found";

    // echo no users JSON
    echo json_encode($response);
}
?>
