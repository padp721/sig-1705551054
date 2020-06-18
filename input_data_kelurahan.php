<?php
    include 'conn.php';
    if (isset($_COOKIE['tgl']) && isset($_COOKIE['kelurahan'])) {
        $tgl       = $_COOKIE['tgl'];
        $kelurahan = $_COOKIE['kelurahan'];
        $sql = $conn->query("SELECT nama FROM kelurahan WHERE id_kelurahan = '$kelurahan'") or die(mysqli_error($conn));
        $nama_kelurahan = mysqli_fetch_array($sql);
        $sql = "SELECT * FROM positif_kelurahan WHERE tgl = '$tgl' AND kelurahan = '$kelurahan'";
        $execute = mysqli_query($conn, $sql);
        $result = mysqli_fetch_assoc($execute);
    }
    $sql = $conn->query("SELECT * FROM kelurahan") or die(mysqli_error($conn));
?>
<?php
    
?>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="row"  style="margin-top:1%">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-8">
                <h1><?php if (isset($_COOKIE['tgl'])) { echo 'Edit Data Tanggal '.$tgl.' di Kelurahan '.$nama_kelurahan[0]; } else { echo 'Tambah Data'; }?></h1>
                <form action="#" method="post">
                        <?php
                            if (!isset($_COOKIE['tgl'])) {?>
                            <div class="form-group">
                                <label for="email">Tanggal</label>
                                <input type="date" class="form-control" name="tgl" required>
                            </div>
                            <?php
                            }
                    
                    if(!isset($_COOKIE['kelurahan'])){
                    ?>
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
                    <?php
                    }
                    ?>
                    <div class="form-group">
                        <label for="email">Level</label>
                        <input type="number" class="form-control" value="<?php if (isset($_COOKIE['tgl']) && isset($_COOKIE['kelurahan'])) { echo $result['level'];} ?>" name="level" required>
                    </div>
                    <div class="form-group">
                        <label for="email">PP-LN</label>
                        <input type="number" class="form-control" value="<?php if (isset($_COOKIE['tgl']) && isset($_COOKIE['kelurahan'])) { echo $result['ppln'];} ?>" name="ppln" required>
                    </div>
                    <div class="form-group">
                        <label for="email">PP-DN</label>
                        <input type="number" class="form-control" value="<?php if (isset($_COOKIE['tgl']) && isset($_COOKIE['kelurahan'])) { echo $result['ppdn'];} ?>" name="ppdn" required>
                    </div>
                    <div class="form-group">
                        <label for="email">TL</label>
                        <input type="number" class="form-control" value="<?php if (isset($_COOKIE['tgl']) && isset($_COOKIE['kelurahan'])) { echo $result['tl'];} ?>" name="tl" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Lainnya</label>
                        <input type="number" class="form-control" value="<?php if (isset($_COOKIE['tgl']) && isset($_COOKIE['kelurahan'])) { echo $result['lainnya'];} ?>" name="lainnya" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Perawatan</label>
                        <input type="number" class="form-control" value="<?php if (isset($_COOKIE['tgl']) && isset($_COOKIE['kelurahan'])) { echo $result['perawatan'];} ?>" name="perawatan" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Sembuh</label>
                        <input type="number" class="form-control" value="<?php if (isset($_COOKIE['tgl']) && isset($_COOKIE['kelurahan'])) { echo $result['sembuh'];} ?>" name="sembuh" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Meninggal</label>
                        <input type="number" class="form-control" value="<?php if (isset($_COOKIE['tgl']) && isset($_COOKIE['kelurahan'])) { echo $result['meninggal'];} ?>" name="meninggal" required>
                    </div>
                    <button type="submit" name="simpan" class="btn btn-success">Simpan</button></a>
                    <a href="manage_data_kelurahan.php"><button type="button" class="btn btn-danger">Kembali</button></a>
                </form>
                </div>
                <div class="col-sm-2">
                </div>
            </div>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</html>
<?php
    if (isset($_POST['simpan'])) {
        $level           = $_POST['level'];
        $ppln            = $_POST['ppln'];
        $ppdn            = $_POST['ppdn'];
        $tl              = $_POST['tl'];
        $lainnya         = $_POST['lainnya'];
        $perawatan       = $_POST['perawatan'];
        $sembuh          = $_POST['sembuh'];
        $meninggal       = $_POST['meninggal'];

        if (isset($_COOKIE['tgl']) && isset($_COOKIE['kelurahan'])){
            $edit = $conn->query("UPDATE positif_kelurahan SET
                level       = '$level',
                ppln        = '$ppln',
                ppdn        = '$ppdn',
                tl          = '$tl',
                lainnya     = '$lainnya',
                perawatan   = '$perawatan',
                sembuh      = '$sembuh',
                meninggal   = '$meninggal'
                WHERE tgl = '$tgl' AND kelurahan = '$kelurahan'") or die(mysqli_error($conn));

            if($edit){
                setcookie('tgl', '');
                setcookie('kelurahan', '');
                echo '
                    <script>
                    alert("Data berhasil disimpan!");
                    window.location.href="manage_data_kelurahan.php";
                    </script>
                ';
            }
        }
        else {
            $tgl       = $_POST['tgl'];
            $kelurahan = $_POST['kelurahan'];
            $cek = $conn->query("SELECT * FROM positif_kelurahan WHERE tgl = '$tgl' AND kelurahan = '$kelurahan'") or die(mysqli_error($conn));
            $cek = mysqli_num_rows($cek);
            if ($cek > 0) {
                echo '
                    <script>
                    alert("Data tanggal di kelurahan tersebut sudah ada! Silahkan kembali dan gunakan menu edit.");
                    </script>
                ';
            }
            else{
                $tambah = $conn->query("INSERT INTO positif_kelurahan VALUES(null, '$tgl','$kelurahan','$level','$ppln','$ppdn', '$tl', '$lainnya', '$perawatan', '$sembuh', '$meninggal')") or die(mysqli_error($conn));

                if($tambah){
                    echo '
                        <script>
                        alert("Data berhasil disimpan!");
                        window.location.href="manage_data_kelurahan.php";
                        </script>
                    ';
                }
            }
        }
    }
?>