<?php

/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */

// array for JSON response
$response = array();

// check for required fields
if (isset($_GET['name']) && isset($_GET['type']) && isset($_GET['price']) && isset($_GET['image']) && isset($_GET['Restaurantid'])) {
    
    $name = $_GET['name'];
	$type = $_GET['type'];
	$price = $_GET['price'];
	$image = $_GET['image'];
	$Restaurantid = $_GET['Restaurantid'];

    // include db connect class
    require_once __DIR__ . '/db_connect.php';

    // connecting to db
    $db = new DB_CONNECT();
	
	$id = mysql_query("SELECT max(id)as id FROM `food`");
	if (!empty($id)) {
        // check for empty result
        if (mysql_num_rows($id) > 0) {

            $id = mysql_fetch_array($id);

			$id = $id["id"];
			++$id;
			
		} else {
            $id = 1;
        }
	} else {
        $id = 1;
    }
	
    // mysql inserting a new row
    $result = mysql_query("INSERT INTO `food`(id, name, type, price, image, Restaurantid) VALUES('$id', '$name', '$type', '$price', '$image', '$Restaurantid')");

    // check if row inserted or not
    if ($result) {
        // get a product from products table
		$result = mysql_query("SELECT * FROM `food` WHERE id = '$id'");

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