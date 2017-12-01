<?php

/*
 * Following code will list all the products
 */

// array for JSON response
$response = array();
$response["success"] = 0;
$response["message"] = "No products found";


// include db connect class
require_once __DIR__ . '/db_connect.php';
   require_once __DIR__ . '/db_config.php';


// connecting to db
//$db = new DB_CONNECT();

     $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die(mysqli_error($con));
      $db = mysqli_select_db($con,DB_DATABASE) or die(mysqli_error($con)) or die(mysqli_error($con));


// get all products from products table
$result = mysqli_query($con,"SELECT * FROM products") or die(mysqli_error($con));

// check for empty result
if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["products"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $product = array();
        $product["pid"] = $row["pid"];
        $product["name"] = $row["name"];
        $product["price"] = $row["price"];
        $product["description"] = $row["description"];
        $product["created_at"] = $row["created_at"];
        $product["updated_at"] = $row["updated_at"];



        // push single product into final response array
        array_push($response["products"], $product);
    }
    // success
    $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No products found";

    // echo no users JSON
    echo json_encode($response);
}
?>
