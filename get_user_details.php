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
if (isset($_GET["id"]) && isset($_GET["password"])) {
    
	$id = $_GET['id'];
	$password = $_GET['password'];

    // get a product from products table
    $result = mysql_query("SELECT *FROM `user` WHERE id = $id and password = $password");

    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {

            $result = mysql_fetch_array($result);
			
			if($result["user_name"] == "admin"){
				
				$result = mysql_query("SELECT *FROM `admin` WHERE Userid = $id");
				$result = mysql_fetch_array($result);
				
				$user = array();
				$user["id"] = $result["id"];
				$user["name"] = $result["name"];
				$user["Userid"] = $result["Userid"];

				// success
				$response["success"] = 1;
				$response["type"] = "admin";

				// user node
				$response["user"] = array();

				array_push($response["user"], $user);
				
			}else{
				if($result["user_name"] == "customer"){
				
				$result = mysql_query("SELECT *FROM `customer` WHERE Userid = $id");
				$result = mysql_fetch_array($result);
				
				$user = array();
				$user["id"] = $result["id"];
				$user["name"] = $result["name"];
				$user["address"] = $result["address"];
				$user["email"] = $result["email"];
				$user["telNum"] = $result["telNum"];
				$user["Userid"] = $result["Userid"];

				// success
				$response["success"] = 1;
				$response["type"] = "customer";

				// user node
				$response["user"] = array();

				array_push($response["user"], $user);
				
				}else{
					if($result["user_name"] == "driver"){
				
						$result = mysql_query("SELECT *FROM `driver` WHERE Userid = $id");
						$result = mysql_fetch_array($result);
						
						$order = array();
						$order["id"] = $result["id"];
						$order["name"] = $result["name"];
						$order["telNum"] = $result["telNum"];
						$order["Userid"] = $result["Userid"];

						// success
						$response["success"] = 1;
						$response["type"] = "driver";

						// user node
						$response["order"] = array();

						array_push($response["order"], $order);
						
					}else{
						if($result["user_name"] == "restaurant"){
				
						$result = mysql_query("SELECT *FROM `restaurant` WHERE Userid = $id");
						$result = mysql_fetch_array($result);
						
						$order = array();
						$order["id"] = $result["id"];
						$order["name"] = $result["name"];
						$order["address"] = $result["address"];
						$order["type"] = $result["type"];
						$order["telNum"] = $result["telNum"];
						$order["Userid"] = $result["Userid"];

						// success
						$response["success"] = 1;
						$response["type"] = "restaurant";

						// user node
						$response["order"] = array();

						array_push($response["order"], $order);
						
						}else{
							// no product found
							$response["success"] = 0;
							$response["message"] = "No user found";
						}
					}
				}
			}

			// echo no users JSON
			echo json_encode($response);

        } else {
            // no product found
            $response["success"] = 0;
            $response["message"] = "No user found";

            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no product found
        $response["success"] = 0;
        $response["message"] = "No user found";

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