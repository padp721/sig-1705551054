<?php
    ob_start();
    include 'conn.php';
    setcookie("kukis", "kukis");
    if($_COOKIE['kukis'] == "kukis") {
        echo "Cookies are enabled.";
        setcookie('tgl', '');
        setcookie('kelurahan', '');
    }
    else {
        echo "Cookies are disabled. Please enable cookie in your browser or reload this page!";
    }
    $sql = $conn->query("SELECT * FROM kelurahan") or die(mysqli_error($conn));
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
                    <div class="form-group">
                        <label for="email">Kelurahan</label>
                        <select class="form-control" name="kelurahan">
                            <?php
                                while($kelurahan = mysqli_fetch_assoc($sql)){?>
                                    <option value="<?php echo $kelurahan['id_kelurahan']; ?>"><?php echo $kelurahan['nama']; ?></option>';
                                <?php
                                }
                            ?>
                        </select>
                    </div>
                    <a href="input_data_kelurahan.php"><button type="button" class="btn btn-success">Tambah Data</button></a>
                    <button type="submit" name="edit" class="btn btn-primary">Lihat/Ubah</button>
                    <button type="submit" name="hapus" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data?')">Hapus</button>
                    <button type="submit" name="salin" class="btn btn-warning">Salin Data H-1 dari Tanggal Tersebut</button>
                    <a href="covid-kelurahan.php"><button type="button" class="btn btn-info">Kembali</button></a>
                </form>
                <br><br>
                Catatan : 
                <ol>
                    <li>Fitur HAPUS & SALIN hanya menggunakan inputan tanggal, dropdown kelurahan tidak berpengaruh.</li>
                    <li>Data yang digunakan hanya dari tanggal 12 Juni karena jika memakai data dari Mei membuat database servernya mengalami penurunan performa yang besar.</li>
                </ol>
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
        $tgl       = $_POST['tgl'];
        $kelurahan = $_POST['kelurahan'];
        $cek = $conn->query("SELECT * FROM positif_kelurahan WHERE tgl = '$tgl' AND kelurahan = '$kelurahan'") or die(mysqli_error($conn));
        $cek = mysqli_num_rows($cek);
        if ($cek == 0) {
            echo '
                <script>
                alert("Data tanggal di kelurahan tersebut tidak ada! Silahkan kembali dan gunakan menu tambah data.");
                </script>
            ';
        }
        else{
            setcookie('tgl', $_POST['tgl']);
            setcookie('kelurahan', $_POST['kelurahan']);
            header("Location: input_data_kelurahan.php");
        }
    }
    else if (isset($_POST['hapus'])) {
        $tgl = $_POST['tgl'];
        $kelurahan = $_POST['kelurahan'];
        $cek = $conn->query("SELECT * FROM positif_kelurahan WHERE tgl = '$tgl'") or die(mysqli_error($conn));
        $cek = mysqli_num_rows($cek);
        if ($cek == 0) {
            echo '
                <script>
                alert("Data tanggal tersebut tidak ada!");
                </script>
            ';
        }
        else{
            $hapus = $conn->query("DELETE FROM positif_kelurahan WHERE tgl = '$tgl'") or die(mysqli_error($conn));

            if($hapus){
                echo '
                    <script>
                    alert("Data berhasil dihapus!");
                    window.location.href="manage_data_kelurahan.php";
                    </script>
                ';
            }
        }
    }
    else if (isset($_POST['salin'])) {
        $tgl = $_POST['tgl'];
        $cek = $conn->query("SELECT * FROM positif_kelurahan WHERE tgl = '$tgl'") or die(mysqli_error($conn));
        $cek = mysqli_num_rows($cek);
        if ($cek > 0) {
            echo '
                <script>
                alert("Data tanggal tersebut sudah ada!");
                </script>
            ';
        }
        else{
            $pilih = $conn->query("SELECT * FROM positif_kelurahan WHERE tgl = DATE_SUB('$tgl', INTERVAL 1 DAY)") or die(mysqli_error($conn));
            $cek = mysqli_num_rows($pilih);
            if ($cek == 0) {
                echo '
                    <script>
                    alert("Data H-1 tanggal tersebut tidak ada!");
                    </script>
                ';
            }
            else{

                $tambah = $conn->query("INSERT INTO positif_kelurahan SELECT NULL, '$tgl', kelurahan, level, ppln, ppdn, tl, lainnya, perawatan, sembuh, meninggal FROM positif_kelurahan WHERE tgl = DATE_SUB('$tgl', INTERVAL 1 DAY)") or die(mysqli_error($conn));

                if($tambah){
                    echo '
                        <script>
                        alert("Data berhasil disalin!");
                        window.location.href="manage_data_kelurahan.php";
                        </script>
                    ';
                }
            }
        }
    }
?>