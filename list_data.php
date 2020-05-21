<?php
    include 'conn.php';
    $color = $conn->query("SELECT * FROM color") or die(mysqli_error($conn));
    $mycolor = mysqli_fetch_assoc($color);

?>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="row"  style="margin-top:10%">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-8">
                <h1>Manage Data</h1>
                <form action="#" method="post">
                    <div class="form-group">
                        <label for="email">Pilih Tanggal</label>
                        <input type="date" class="form-control" placeholder="Input Tanggal" name="tgl" required>
                    </div>
                    <a href="input_data.php"><button type="button" class="btn btn-success">Tambah Data</button></a>
                    <button type="submit" name="edit" class="btn btn-primary">Lihat/Ubah</button>
                    <button type="submit" name="hapus" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data?')">Hapus</button>
                    <button type="submit" name="salin" class="btn btn-warning">Salin Data H-1 dari Tanggal Tersebut</button>
                    <a href="positif-covid.php"><button type="button" class="btn btn-info">Kembali</button></a>
                </form>
                <br><br>
                <h1>Pengaturan Warna</h1>
                <form class="form-inline" action="#" method="post">
                    <label for="color1" class="mr-sm-2">Warna Tertinggi</label>
                    <input type="color" class="mb-2 mr-sm-2" name="color1" id="color1" value="<?php echo $mycolor['color1']; ?>">
                    <label for="color2" class="mr-sm-2">Warna Terendah</label>
                    <input type="color" class="mb-2 mr-sm-2" name="color2" id="color2" value="<?php echo $mycolor['color2']; ?>">
                    <label for="opacity" class="mr-sm-2">Transparansi</label>
                    <input type="number" class="mb-2 mr-sm-2" name="opacity" id="opacity" value="<?php echo $mycolor['opacity']; ?>" min="0" max="1" step="0.1" required>
                    <button type="submit" name="color" class="btn btn-primary mb-2">Perbarui</button>
                </form>
                <?php
                    setcookie("test", "test");
                    if($_COOKIE['test'] == "test") {
                    echo "Cookies are enabled.";
                    setcookie('tgl', '');
                    } else {
                    echo "Cookies are disabled. Please enable cookie in your browser!";
                    }
                ?>
                </div>
                <div class="col-sm-2">
                </div>
            </div>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script>
        $('#sandbox-container input').datepicker({
            format: "yyyy-mm-dd"
        });
    </script>
</html>
<?php
    if (isset($_POST['edit'])) {
        $tgl = $_POST['tgl'];
        $cek = $conn->query("SELECT * FROM positif WHERE tgl = '$tgl'") or die(mysqli_error($conn));
        $cek = mysqli_num_rows($cek);
        if ($cek == 0) {
            echo '
                <script>
                alert("Data tanggal tersebut tidak ada! Silahkan kembali dan gunakan menu tambah data.");
                </script>
            ';
        }
        else{
            setcookie('tgl', $_POST['tgl']);
            header("Location: input_data.php");
        }
    }
    else if (isset($_POST['hapus'])) {
        $tgl = $_POST['tgl'];
        $cek = $conn->query("SELECT * FROM positif WHERE tgl = '$tgl'") or die(mysqli_error($conn));
        $cek = mysqli_num_rows($cek);
        if ($cek == 0) {
            echo '
                <script>
                alert("Data tanggal tersebut tidak ada!");
                </script>
            ';
        }
        else{
            $hapus = $conn->query("DELETE FROM positif WHERE tgl = '$tgl'") or die(mysqli_error($conn));

            if($hapus){
                echo '
                    <script>
                    alert("Data berhasil dihapus!");
                    window.location.href="list_data.php";
                    </script>
                ';
            }
        }
    }
    else if (isset($_POST['salin'])) {
        $tgl = $_POST['tgl'];
        $cek = $conn->query("SELECT * FROM positif WHERE tgl = '$tgl'") or die(mysqli_error($conn));
        $cek = mysqli_num_rows($cek);
        if ($cek > 0) {
            echo '
                <script>
                alert("Data tanggal tersebut sudah ada!");
                </script>
            ';
        }
        else{
            $pilih = $conn->query("SELECT * FROM positif WHERE tgl = DATE_SUB('$tgl', INTERVAL 1 DAY)") or die(mysqli_error($conn));
            $cek = mysqli_num_rows($pilih);
            if ($cek == 0) {
                echo '
                    <script>
                    alert("Data H-1 tanggal tersebut tidak ada!");
                    </script>
                ';
            }
            else{
                $result = mysqli_fetch_assoc($pilih);
                $jembrana           = $result['jembrana'];
                $tabanan            = $result['tabanan'];
                $badung             = $result['badung'];
                $denpasar           = $result['denpasar'];
                $gianyar            = $result['gianyar'];
                $bangli             = $result['bangli'];
                $klungkung          = $result['klungkung'];
                $karangasem         = $result['karangasem'];
                $buleleng           = $result['buleleng'];
                $kabupaten_lainnya  = $result['kabupaten_lainnya'];
                $wna                = $result['wna'];

                $tambah = $conn->query("INSERT INTO positif VALUES(null, '$tgl','$jembrana','$tabanan','$badung','$denpasar', '$gianyar', '$bangli', '$klungkung', '$karangasem', '$buleleng', '$kabupaten_lainnya', '$wna')") or die(mysqli_error($conn));

                if($tambah){
                    echo '
                        <script>
                        alert("Data berhasil disalin!");
                        window.location.href="list_data.php";
                        </script>
                    ';
                }
            }
        }
    }
    else if(isset($_POST['color'])){
        $color1  = $_POST['color1'];
        $color2  = $_POST['color2'];
        $opacity = $_POST['opacity'];

        $newcolor = $conn->query("UPDATE color SET color1 = '$color1', color2 = '$color2', opacity = '$opacity'");

        if($newcolor){
            echo '
                <script>
                alert("Warna berhasil diperbarui!");
                window.location.href="list_data.php";
                </script>
            ';
        }
    }
?>