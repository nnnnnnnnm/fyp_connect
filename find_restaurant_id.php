<?php

/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */

// array for JSON response
$response = array();

// check for required fields
if (isset($_GET['userid'])) {
    
    $userid = $_GET['userid'];

    // include db connect class
    require_once __DIR__ . '/db_connect.php';

    // connecting to db
    $db = new DB_CONNECT();
	
	$id = mysql_query("SELECT id FROM `restaurant` WHERE Userid = $userid");
	if (!empty($id)) {
        // check for empty result
        if (mysql_num_rows($id) > 0) {

            $id = mysql_fetch_array($id);
			
			$id = $id["id"];
			
		} else {
            // failed to insert row
			$response["success"] = 0;
			$response["message"] = "This user id is not reataurant";
			
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

    // successfully inserted into database
    $response["success"] = 1;
	$response["id"] = $id;
    $response["message"] = "End !!!!";

    // echoing JSON response
    echo json_encode($response);
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}
?>