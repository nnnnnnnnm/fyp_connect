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
if (isset($_GET["userid"])) {
    $id = $_GET['userid'];

    // get a product from products table
    $result = mysql_query("SELECT id FROM `customer` WHERE Userid = $id") or die(mysql_error());

    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {

            $result = mysql_fetch_array($result);

            $customerid = $result["id"];
			
    } else {
        // no product found
        $response["success"] = 0;
        $response["message"] = "No order found";

        // echo no users JSON
        echo json_encode($response);
    }
	$cid = "'" + $customerid + "'";
	$results = mysql_query("SELECT *FROM `order` WHERE Customerid = $cid") or die(mysql_error());
			
			if (mysql_num_rows($results) > 0) {
				// looping through all results
				// products node
				$response["order"] = array();
				
				while ($row = mysql_fetch_array($results)) {
					// temp user array
					$order = array();
					$order["number"] = $row["number"];
					$order["date_time"] = $row["date_time"];
					$order["all_pick_up"] = $row["all_pick_up"];
					$order["received_by_customer"] = $row["received_by_customer"];
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