<?php
    include 'conn.php';
    $color = $conn->query("SELECT * FROM color") or die(mysqli_error($conn));
    $mycolor = mysqli_fetch_assoc($color);
    
    if (isset($_POST['tgl']) && isset($_POST['selected-date'])){
        $tgl = $_POST['tgl'];
        $sql = "SELECT * FROM positif WHERE tgl = '$tgl'";
        $execute = mysqli_query($conn, $sql);
        $cek = mysqli_num_rows($execute);
        if($cek == 0){
            echo '
                <script>
                alert("Tidak ada data pada tanggal tersebut!");
                window.location.href="positif-covid.php";
                </script>
            ';
        }
        else{
            $result = mysqli_fetch_assoc($execute);
        }
    }
    else{
        $sql = "SELECT * FROM positif ORDER BY tgl DESC LIMIT 1";
        $execute = mysqli_query($conn, $sql);
        $result = mysqli_fetch_assoc($execute);
    }
?>