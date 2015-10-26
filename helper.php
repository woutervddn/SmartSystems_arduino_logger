<?php


function writeToDb($sensorName, $sensorVal){
	$servername = "localhost";
	$username = "pxleai1q_1402985";
	$password = "rU6)$]cIVV_9";
	$dbname = "pxleai1q_1402985";
	$table = "smartsystems";

	try {
	    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	    // set the PDO error mode to exception
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $sql = "INSERT INTO $table (sensor_name, sensor_value) VALUES ('$sensorName', '$sensorVal')";
	    // use exec() because no results are returned
	    $conn->exec($sql);
	    return "New record created successfully";
	}
	catch(PDOException $e){
	    return $sql . "<br>" . $e->getMessage();
	}

	$conn = null;
}