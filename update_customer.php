<?php

/*
 * Following code will update a product information
 * A product is identified by product id (pid)
 */

// array for JSON response
$response = array();

// check for required fields
if (isset($_GET['id']) && isset($_GET['name']) && isset($_GET['address']) && isset($_GET['email'])
	&& isset($_GET['telNum']) && isset($_GET['payment']) && isset($_GET['cardnumber']) && isset($_GET['securitycode'])) {
    
    $id = $_GET['id'];
    $name = $_GET['name'];
    $address = $_GET['address'];
    $email = $_GET['email'];
	$telNum = $_GET['telNum'];
	$payment = $_GET['payment'];
    $cardnumber = $_GET['cardnumber'];
	$securitycode = $_GET['securitycode'];

    // include db connect class
    require_once __DIR__ . '/db_connect.php';

    // connecting to db
    $db = new DB_CONNECT();

    // mysql update row with matched pid
    $result = mysql_query("UPDATE `customer` SET name = '$name', address = '$address', email = '$email', telNum = '$telNum', payment = '$payment', credit_card_number = '$cardnumber', credit_card_security_code = '$securitycode' WHERE id = '$id'");
	
    // check if row inserted or not
    if ($result) {
        // successfully updated
        $response["success"] = 1;
        $response["message"] = "Food successfully updated.";
        
        // echoing JSON response
        echo json_encode($response);
    } else {
        
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}
?>
