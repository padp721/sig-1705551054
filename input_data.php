<?php
    include 'conn.php';
    if (isset($_COOKIE['tgl'])) {
        $tgl = $_COOKIE['tgl'];
        $sql = "SELECT * FROM positif WHERE tgl = '$tgl'";
        $execute = mysqli_query($conn, $sql);
        $result = mysqli_fetch_assoc($execute);
    }
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
                <h1><?php if (isset($_COOKIE['tgl'])) { echo 'Edit Data Tanggal '.$tgl; } else { echo 'Tambah Data'; }?></h1>
                <form action="#" method="post">
                        <?php
                            if (!isset($_COOKIE['tgl'])) {?>
                            <div class="form-group">
                                <label for="email">Tanggal</label>
                                <input type="date" class="form-control" name="tgl" required>
                            </div>
                            <?php
                            }
                        ?>
                    <div class="form-group">
                        <label for="email">Jembrana</label>
                        <input type="number" class="form-control" value="<?php if (isset($_COOKIE['tgl'])) { echo $result['jembrana'];} ?>" name="jembrana" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Tabanan</label>
                        <input type="number" class="form-control" value="<?php if (isset($_COOKIE['tgl'])) { echo $result['tabanan'];} ?>" name="tabanan" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Badung</label>
                        <input type="number" class="form-control" value="<?php if (isset($_COOKIE['tgl'])) { echo $result['badung'];} ?>" name="badung" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Denpasar</label>
                        <input type="number" class="form-control" value="<?php if (isset($_COOKIE['tgl'])) { echo $result['denpasar'];} ?>" name="denpasar" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Gianyar</label>
                        <input type="number" class="form-control" value="<?php if (isset($_COOKIE['tgl'])) { echo $result['gianyar'];} ?>" name="gianyar" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Bangli</label>
                        <input type="number" class="form-control" value="<?php if (isset($_COOKIE['tgl'])) { echo $result['bangli'];} ?>" name="bangli" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Klungkung</label>
                        <input type="number" class="form-control" value="<?php if (isset($_COOKIE['tgl'])) { echo $result['klungkung'];} ?>" name="klungkung" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Karangasem</label>
                        <input type="number" class="form-control" value="<?php if (isset($_COOKIE['tgl'])) { echo $result['karangasem'];} ?>" name="karangasem" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Buleleng</label>
                        <input type="number" class="form-control" value="<?php if (isset($_COOKIE['tgl'])) { echo $result['buleleng'];} ?>" name="buleleng" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Kabupaten Lainnya</label>
                        <input type="number" class="form-control" value="<?php if (isset($_COOKIE['tgl'])) { echo $result['kabupaten_lainnya'];} ?>" name="kabupaten_lainnya" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Warga Negara Asing</label>
                        <input type="number" class="form-control" value="<?php if (isset($_COOKIE['tgl'])) { echo $result['wna']; }?>" name="wna" required>
                    </div>
                    <button type="submit" name="simpan" class="btn btn-success">Simpan</button></a>
                    <a href="list_data.php"><button type="button" class="btn btn-danger">Kembali</button></a>
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
        $jembrana           = $_POST['jembrana'];
        $tabanan            = $_POST['tabanan'];
        $badung             = $_POST['badung'];
        $denpasar           = $_POST['denpasar'];
        $gianyar            = $_POST['gianyar'];
        $bangli             = $_POST['bangli'];
        $klungkung          = $_POST['klungkung'];
        $karangasem         = $_POST['karangasem'];
        $buleleng           = $_POST['buleleng'];
        $kabupaten_lainnya  = $_POST['kabupaten_lainnya'];
        $wna                = $_POST['wna'];

        if (isset($_COOKIE['tgl'])){
            $edit = $conn->query("UPDATE positif SET
                jembrana            = '$jembrana',
                tabanan             = '$tabanan',
                badung              = '$badung',
                denpasar            = '$denpasar',
                gianyar             = '$gianyar',
                bangli              = '$bangli',
                klungkung           = '$klungkung',
                karangasem          = '$karangasem',
                buleleng            = '$buleleng',
                kabupaten_lainnya   = '$kabupaten_lainnya',
                wna                 = '$wna'
                WHERE tgl = '$tgl'") or die(mysqli_error($conn));

            if($edit){
                setcookie('tgl', '');
                echo '
                    <script>
                    alert("Data berhasil disimpan!");
                    window.location.href="list_data.php";
                    </script>
                ';
            }
        }
        else {
            $tgl = $_POST['tgl'];
            $cek = $conn->query("SELECT * FROM positif WHERE tgl = '$tgl'") or die(mysqli_error($conn));
            $cek = mysqli_num_rows($cek);
            if ($cek > 0) {
                echo '
                    <script>
                    alert("Data tanggal tersebut sudah ada! Silahkan kembali dan gunakan menu edit.");
                    </script>
                ';
            }
            else{
                $tambah = $conn->query("INSERT INTO positif VALUES(null, '$tgl','$jembrana','$tabanan','$badung','$denpasar', '$gianyar', '$bangli', '$klungkung', '$karangasem', '$buleleng', '$kabupaten_lainnya', '$wna')") or die(mysqli_error($conn));

                if($tambah){
                    echo '
                        <script>
                        alert("Data berhasil disimpan!");
                        window.location.href="list_data.php";
                        </script>
                    ';
                }
            }
        }
    }
?>