<?php

/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */

// array for JSON response
$response = array();

// check for required fields
if (isset($_GET['customerid'])) {
    
    $customerId = $_GET['customerid'];

    // include db connect class
    require_once __DIR__ . '/db_connect.php';

    // connecting to db
    $db = new DB_CONNECT();
	
	$userid = mysql_query("SELECT max(id)as userid FROM `user`");
	
	if (!empty($userid)) {
        // check for empty result
        if (mysql_num_rows($userid) > 0) {

            $userid = mysql_fetch_array($userid);

			$userid = $userid["userid"];
			$userid = $userid + 1;
			
			
		} else {
            $userid = 10001;
        }
	} else {
        $userid = 10001;
    }
	
	$customerid = mysql_query("SELECT max(id)as customerid FROM `customer`");
	
	if (!empty($customerid)) {
        // check for empty result
        if (mysql_num_rows($customerid) > 0) {

            $customerid = mysql_fetch_array($customerid);

			$customerid = $customerid["customerid"];
			$customerid = $customerid + 1;
			
			
		} else {
            $customerid = c0001;
        }
	} else {
        $customerid = c0001;
    }
	
    // mysql inserting a new row
    $result = mysql_query("INSERT INTO `user`(id, password, user_name) VALUES('$userid', '$userid', 'customer')");
	

    // check if row inserted or not
    if ($result) {
		
        // successfully inserted into database
        
		
		$response["userid"] = $userid;
		$response["message"] = "Order successfully created.";

		$result = mysql_query("INSERT INTO `customer`(id, name, address, email, telNum, payment, credit_card_number, credit_card_security_code, Userid) VALUES('$userid', '$userid', 'customer')");
		





		
        
		

        // echoing JSON response
        echo json_encode($response);
		
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