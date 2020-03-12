<?php
    include 'conn.php';
    $id = 0;
    do{
        $sql = "SELECT poly_id FROM `coordinates` WHERE poly_id IS NOT NULL AND id > '$id' LIMIT 1 ";
        $result_poly = mysqli_query($conn, $sql);
        $result = mysqli_fetch_assoc($result_poly);
        $poly_id = $result['poly_id'];
        
        $sql = "SELECT * FROM `coordinates` WHERE id > '$id' AND poly_id = '$poly_id'";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {
            echo 'var poly = L.polygon([';
            while($row = $result->fetch_assoc()) {
                echo "[".$row['latitude'].",".$row['longitude']."],";
                $id = $row['id'];
            }
            echo ']).addTo(mymap);';
        }
    }
    while($result_poly->num_rows > 0);
	mysqli_close($conn);
?>