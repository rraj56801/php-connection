<?php

/*
 * Following code will update a product information
 * A product is identified by product id (pid)
 */

// array for JSON response
$response = array();

// check for required fields
if (isset($_POST['pid']) && isset($_POST['name']) && isset($_POST['price']) && isset($_POST['description'])) {
    
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // include db connect class
    require_once __DIR__ . '/db_connect.php';
require_once __DIR__ . '/db_config.php';

    // connecting to db
    //$db = new DB_CONNECT();
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die(mysqli_error($con));
$db = mysqli_select_db($con,DB_DATABASE) or die(mysqli_error($con)) or die(mysqli_error($con));

    // mysql update row with matched pid
    $result = mysqli_query($con, "UPDATE products SET name = '$name', price = '$price', description = '$description' WHERE pid = $pid");

    // check if row inserted or not
    if ($result) {
        // successfully updated
        $response["success"] = 1;
        $response["message"] = "Product successfully updated.";
        
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
