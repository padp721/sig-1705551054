<?php
    include 'conn.php';

    $sql = "SELECT * FROM `coordinates` WHERE poly_id IS NULL";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "var marker = L.marker([".$row['latitude'].",".$row['longitude']."]).addTo(mymap);";
        }
    }
	mysqli_close($conn);
?>