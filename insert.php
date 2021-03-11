<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
//Creating Array for JSON response
$response = array();
 
// Check if we got the field from the user
if (isset($_GET['enlem']) && isset($_GET['boylam']) && isset($_GET['hiz']) && isset($_GET['uydu_sayisi'])) {
 
    $lat = $_GET['enlem'];
    $lon = $_GET['boylam'];
    $speed = $_GET['hiz'];
    $sat = $_GET['uydu_sayisi'];
 
    // Include data base connect class
    $filepath = realpath (dirname(__FILE__));
	require_once($filepath."/db_connect.php");
 
    // Connecting to database 
    $db = new DB_CONNECT();
 
    // Fire SQL query to insert data in weather
    $result = mysql_query("INSERT INTO konum(enlem,boylam,hiz,uydu_sayisi) VALUES('$lat','$lon','$speed','$sat')");
 
    // Check for succesfull execution of query
    if ($result) {
        // successfully inserted 
        $response["success"] = 1;
        $response["message"] = "Konum basariyla kaydedildi";
 
        // Show JSON response
        echo json_encode($response);
    } else {
        // Failed to insert data in database
        $response["success"] = 0;
        $response["message"] = "Konum kaydedilemedi";
 
        // Show JSON response
        echo json_encode($response);
    }
} else {
    // If required parameter is missing
    $response["success"] = 0;
    $response["message"] = "Lütfen parametleri dogru giriniz.";
 
    // Show JSON response
    echo json_encode($response);
}
?>