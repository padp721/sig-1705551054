<?php
	//ClearDB
	$servername = "us-cdbr-gcp-east-01.cleardb.net";
	$username = "b70fae5594e1b1";
	$password = "d51644a7";
    $db="gcp_1cb724905c9d985afa41";

	//Local
	// $servername = "localhost";
	// $username = "root";
	// $password = "";
    // $db="leaflet";
    
    $conn = mysqli_connect($servername, $username, $password,$db);
?>