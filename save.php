<?php
	include 'conn.php';
	$lat    = $_POST['lat'];
	$lng    = $_POST['lng'];
    $sql    = "INSERT INTO `coordinates` ( `latitude`, `longitude`) VALUES ('$lat','$lng')";
    mysqli_query($conn, $sql);
	mysqli_close($conn);
?>