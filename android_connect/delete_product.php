<?php

/*
 * Following code will delete a product from table
 * A product is identified by product id (pid)
 */

// array for JSON response
$response = array();

// check for required fields
if (isset($_POST['pid'])) {
    $pid = $_POST['pid'];

    // include db connect class
    require_once __DIR__ . '/db_connect.php';
require_once __DIR__ . '/db_config.php';

    // connecting to db
  //  $db = new DB_CONNECT();
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die(mysqli_error($con));
      $db = mysqli_select_db($con,DB_DATABASE) or die(mysqli_error($con)) or die(mysqli_error($con));

    // mysql update row with matched pid
    $result = mysqli_query($con, "DELETE FROM products WHERE pid = $pid");
    
    // check if row deleted or not
    if (mysql_affected_rows() > 0) {
        // successfully updated
        $response["success"] = 1;
        $response["message"] = "Product successfully deleted";

        // echoing JSON response
        echo json_encode($response);
    } else {
        // no product found
        $response["success"] = 0;
        $response["message"] = "No product found";

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