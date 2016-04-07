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
if (isset($_GET["type"]) && isset($_GET["keyword"])) {
    
	$type = $_GET['type'];
	$keyword = $_GET['keyword'];
	
	if($type == "food"){
		
		// get a product from products table
		$result = mysql_query("SELECT * FROM `food` WHERE id LIKE '%$keyword%' OR name LIKE '%$keyword%' OR type LIKE '%$keyword%' OR price LIKE '%$keyword%' OR image LIKE '%$keyword%' OR Restaurantid LIKE '%$keyword%'");

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
	}else if ($type == 'restaurant'){
		// get a product from products table
		$result = mysql_query("SELECT * FROM restaurant WHERE id LIKE '%$keyword%' OR name LIKE '%$keyword%' OR address LIKE '%$keyword%' OR type LIKE '%$keyword%' OR telNum LIKE '%$keyword%' OR Userid LIKE '%$keyword%'");
	
		if (!empty($result)) {
			// check for empty result
			if (mysql_num_rows($result) > 0) {
				// looping through all results
				// products node
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
	} else if ($type == 'both'){
		// get a product from products table
		$result = mysql_query("SELECT * FROM `food` WHERE id LIKE '%$keyword%' OR name LIKE '%$keyword%' OR type LIKE '%$keyword%' OR price LIKE '%$keyword%' OR image LIKE '%$keyword%' OR Restaurantid LIKE '%$keyword%'");
	
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
				$response["food_result"] = 1;

				
				
				// get a product from products table
				$result = mysql_query("SELECT * FROM restaurant WHERE id LIKE '%$keyword%' OR name LIKE '%$keyword%' OR address LIKE '%$keyword%' OR type LIKE '%$keyword%' OR telNum LIKE '%$keyword%' OR Userid LIKE '%$keyword%'");
			
				if (!empty($result)) {
					// check for empty result
					if (mysql_num_rows($result) > 0) {
						// looping through all results
						// products node
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
						$response["restaurant_result"] = 1;

						// echoing JSON response
						echo json_encode($response);
					} else {
						// no product found
						$response["restaurant_result"] = 0;
						echo json_encode($response);
					}
				} else if($response["food_result"] == 0 && $response["restaurant_result"] == 0){
					// no product found
					$response["success"] = 0;
					$response["message"] = "No result found";

					// echo no users JSON
					echo json_encode($response);
				}
			}else {
				$response["food_result"] = 0;
				// get a product from products table
				$result = mysql_query("SELECT * FROM restaurant WHERE id LIKE '%$keyword%' OR name LIKE '%$keyword%' OR address LIKE '%$keyword%' OR type LIKE '%$keyword%' OR telNum LIKE '%$keyword%' OR Userid LIKE '%$keyword%'");
			
				if (!empty($result)) {
					// check for empty result
					if (mysql_num_rows($result) > 0) {
						// looping through all results
						// products node
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
						$response["restaurant_result"] = 1;

						// echoing JSON response
						echo json_encode($response);
					} else {
						// no product found
						$response["restaurant_result"] = 0;
						echo json_encode($response);
					}
				} else if($response["food_result"] == 0 && $response["restaurant_result"] == 0){
					// no product found
					$response["success"] = 0;
					$response["message"] = "No result found";

					// echo no users JSON
					echo json_encode($response);
				}
			}	
		}else {
			$response["food_result"] = 0;
			// get a product from products table
				$result = mysql_query("SELECT * FROM restaurant WHERE id LIKE '%$keyword%' OR name LIKE '%$keyword%' OR address LIKE '%$keyword%' OR type LIKE '%$keyword%' OR telNum LIKE '%$keyword%' OR Userid LIKE '%$keyword%'");
			
				if (!empty($result)) {
					// check for empty result
					if (mysql_num_rows($result) > 0) {
						// looping through all results
						// products node
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
						$response["restaurant_result"] = 1;

						// echoing JSON response
						echo json_encode($response);
					} else {
						// no product found
						$response["restaurant_result"] = 0;
						echo json_encode($response);
					}
				} else if($response["food_result"] == 0 && $response["restaurant_result"] == 0){
					// no product found
					$response["success"] = 0;
					$response["message"] = "No result found";

					// echo no users JSON
					echo json_encode($response);
				}
		}
		
	} else {
		// required field is missing
		$response["success"] = 0;
		$response["message"] = "Required field(s) is missing";

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