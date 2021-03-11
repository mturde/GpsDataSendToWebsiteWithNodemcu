<?php 
 

	define('DB_HOST', 'cloud.zirvesunucum.com');
	define('DB_USER', 'muhammed_1234');
	define('DB_PASS', 'muhammed586');
	define('DB_NAME', 'muhammed_deneme');
	
	//connecting to database and getting the connection object
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	
	//Checking if any error occured while connecting
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
	}
	
	//creating a query
	$stmt = $conn->prepare("SELECT id,enlem,boylam,hiz,uydu_sayisi FROM konum order by id desc LIMIT 1");
	
	//executing the query 
	$stmt->execute();
	
	//binding results to the query 
	$stmt->bind_result($id, $enlem, $boylam, $hiz, $uydu_sayisi);
	
	$products = array(); 
	
	//traversing through all the result 
	while($stmt->fetch()){
		$temp = array();
		$temp['id'] = $id; 
		$temp['enlem'] = $enlem; 
		$temp['boylam'] = $boylam;  
		$temp['hiz'] = $hiz; 
		$temp['uydu_sayisi'] = $uydu_sayisi; 
		array_push($products, $temp);
	}
	
	//displaying the result in json format 
	echo json_encode($products);