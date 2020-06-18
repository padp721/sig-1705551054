<?php
    include 'conn.php';

    if (isset($_POST['tgl']) && isset($_POST['selected-date'])){
        $tgl = $_POST['tgl'];
        $sql = "SELECT *, (ppln+ppdn+tl+lainnya) AS 'jumlah_positif'
            FROM positif_kelurahan a 
            INNER JOIN kelurahan b ON a.kelurahan=b.id_kelurahan
            WHERE tgl = '$tgl'";
        $sql2 = "SELECT SUM(ppln+ppdn+tl+lainnya) AS 'total' FROM positif_kelurahan WHERE tgl = '$tgl' GROUP BY tgl";
    }
    else {
        $sql = "SELECT *, (ppln+ppdn+tl+lainnya) AS 'jumlah_positif'
        FROM positif_kelurahan a 
        INNER JOIN kelurahan b ON a.kelurahan=b.id_kelurahan
        WHERE tgl IN(SELECT MAX(tgl) FROM positif_kelurahan)";
        $sql2 = "SELECT SUM(ppln+ppdn+tl+lainnya) AS 'total' FROM positif_kelurahan WHERE tgl IN(SELECT MAX(tgl) FROM positif_kelurahan)";
    }

    $execute = mysqli_query($conn, $sql);
    $cek = mysqli_num_rows($execute);
        if($cek == 0){
            echo '
                <script>
                alert("Tidak ada data pada tanggal tersebut!");
                window.location.href="covid-kelurahan.php";
                </script>
            ';
        }
    $execute2 = mysqli_query($conn, $sql2);
    $cek = mysqli_num_rows($execute2);
        if($cek == 0){
            echo '
                <script>
                alert("Tidak ada data pada tanggal tersebut!");
                window.location.href="covid-kelurahan.php";
                </script>
            ';
        }
    $results = mysqli_fetch_all($execute, MYSQLI_ASSOC);
    $total_positif = mysqli_fetch_assoc($execute2);

    

    $data_kelurahan = array();

    foreach($results as $row){
        if($row['jumlah_positif'] == 0){
            $row['color'] = 'lightgreen';
        }
        elseif($row['jumlah_positif'] > 0 && $row['perawatan'] == 0 ){
            $row['color'] = 'green'; 
        }
        elseif($row['ppln'] == 1 || $row['ppdn'] == 1  && $row['perawatan'] > 0){
            $row['color'] = 'yellow'; 
        }
        elseif($row['tl'] >= 1  && $row['perawatan'] > 0){
            $row['color'] = 'darkred'; 
        }
        
        elseif($row['ppln'] > 1 || $row['ppdn'] > 1  && $row['perawatan'] > 0){
            $row['color'] = 'pink'; 
        }

        $data_kelurahan[$row['nama']] = $row;
    }
?>