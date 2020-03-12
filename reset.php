<?php
    include 'conn.php';
    if($_GET['what'] == 'current'){
        $sql = "DELETE FROM `coordinates` WHERE `poly_id` IS NULL";
    }
    else if($_GET['what'] == 'all'){
        $sql = "DELETE FROM `coordinates`";
    }
    mysqli_query($conn, $sql);
	mysqli_close($conn);
?>