<?php
    include 'conn.php';
    $sql = "SELECT * FROM `coordinates` WHERE `poly_id` IS NULL";
    if (mysqli_query($conn, $sql)->num_rows > 0) {
        $poly_id = rand();
        $sql    = "UPDATE `coordinates` SET `poly_id` = '$poly_id' WHERE `poly_id` IS NULL";
        mysqli_query($conn, $sql);
    }
	mysqli_close($conn);
?>