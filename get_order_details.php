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
if (isset($_GET["number"])) {
    $number = $_GET['number'];

    // get a product from products table
    $result = mysql_query("SELECT *FROM `order` WHERE number = $number");

    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {

            $result = mysql_fetch_array($result);

            $order = array();
            $order["number"] = $result["number"];
            $order["date_time"] = $result["date_time"];
            $order["all_pick_up"] = $result["all_pick_up"];
            $order["received_by_customer"] = $result["received_by_customer"];
            $order["Customerid"] = $result["Customerid"];
            $order["Driverid"] = $result["Driverid"];
            // success
            $response["success"] = 1;

            // user node
            $response["order"] = array();

            array_push($response["order"], $order);

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
?>