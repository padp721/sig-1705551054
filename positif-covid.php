<?php
    include 'load_kabupaten.php';
    $legend = $result;
    unset($legend['id']);
    unset($legend['tgl']);
    rsort($legend);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Covid-19 di Bali - 1705551054</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
        integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
        crossorigin="" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <style>
        html, body, #mapid {
            height: 100%; width: 100%; padding: 0; margin: 0; 
        }
    </style>
</head>

<body>
    <div id="mapid">

    </div>
</body>
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
    integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
    crossorigin=""></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="rainbowvis.js"></script>
    <script src="leaflet-omnivore.min.js"></script>
<script>
    var mymap = L.map('mapid').setView([-8.4, 115], 9);
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a> | I Putu Angga Darma Putra - 1705551054',
        maxZoom: 25,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoicmFuZG9taXplNzIxIiwiYSI6ImNrNnVlamNjODA4ZWwzcm54NHl0enEybnAifQ.RyV0WnA6uom_aCtR3zQR2w'
    }).addTo(mymap);

    
    var rainbow = new Rainbow(); 
    rainbow.setNumberRange(1, 11);
    rainbow.setSpectrum('<?php echo $mycolor['color2'] ?>', '<?php echo $mycolor['color1'] ?>');
    var s = [];
    for (var i = 1; i <= 11; i++) {
        var hexColour = rainbow.colourAt(i);
        s.push(hexColour);
    }
    console.log(s);

    var warna = <?php echo json_encode($result) ?>;
    delete warna.id;
    delete warna.tgl;

    var sortable = [];
    for (var colors in warna) {
        sortable.push([colors, warna[colors]]);
    }

    sortable.sort(function(a, b) {
        return a[1] - b[1];
    });

    var new_warna = {}
    sortable.forEach(function(item){
        new_warna[item[0]]=item[1]
    })

    console.log(new_warna);

    var i = 0;
    for (var key in new_warna) {
        if (new_warna.hasOwnProperty(key)) {
            new_warna[key] = "#"+s[i];
            i++;
            console.log(key +" = "+ new_warna[key]);
        }
    }

    //BADUNG
    var color = L.geoJson(null, {
        style: function(feature) {
            return { fillColor: new_warna.badung, fillOpacity: <?php echo $mycolor['opacity']; ?> , stroke:true, color:'black'};
        }
    });
    var shape = omnivore.kml('kmls/badung.kml',null,color).addTo(mymap);
    shape.bindPopup(
        "<b>Badung</b><br>Jumlah Positif : <?php echo $result['badung']; ?>"
    );

    //BANGLI
    var color = L.geoJson(null, {
        style: function(feature) {
            return { fillColor: new_warna.bangli, fillOpacity: <?php echo $mycolor['opacity']; ?> , stroke:true, color:'black'};
        }
    });
    var shape = omnivore.kml('kmls/bangli.kml',null,color).addTo(mymap);
    shape.bindPopup(
        "<b>Bangli</b><br>Jumlah Positif : <?php echo $result['bangli']; ?>"
    );

    //BULELENG
    var color = L.geoJson(null, {
        style: function(feature) {
            return { fillColor: new_warna.buleleng, fillOpacity: <?php echo $mycolor['opacity']; ?> , stroke:true, color:'black'};
        }
    });
    var shape = omnivore.kml('kmls/BULELENG.kml',null,color).addTo(mymap);
    shape.bindPopup(
        "<b>Buleleng</b><br>Jumlah Positif : <?php echo $result['buleleng']; ?>"
    );

    //DENPASAR
    var color = L.geoJson(null, {
        style: function(feature) {
            return { fillColor: new_warna.denpasar, fillOpacity: <?php echo $mycolor['opacity']; ?> , stroke:true, color:'black'};
        }
    });
    var shape = omnivore.kml('kmls/denpasar.kml',null,color).addTo(mymap);
    shape.bindPopup(
        "<b>Denpasar</b><br>Jumlah Positif : <?php echo $result['denpasar']; ?>"
    );

    //GIANYAR
    var color = L.geoJson(null, {
        style: function(feature) {
            return { fillColor: new_warna.gianyar, fillOpacity: <?php echo $mycolor['opacity']; ?> , stroke:true, color:'black'};
        }
    });
    var shape = omnivore.kml('kmls/gianyar.kml',null,color).addTo(mymap);
    shape.bindPopup(
        "<b>Gianyar</b><br>Jumlah Positif : <?php echo $result['gianyar']; ?>"
    );

    //JEMBRANA
    var color = L.geoJson(null, {
        style: function(feature) {
            return { fillColor: new_warna.jembrana, fillOpacity: <?php echo $mycolor['opacity']; ?> , stroke:true, color:'black'};
        }
    });
    var shape = omnivore.kml('kmls/jembrana.kml',null,color).addTo(mymap);
    shape.bindPopup(
        "<b>Jembrana</b><br>Jumlah Positif : <?php echo $result['jembrana']; ?>"
    );

    //KARANGASEM
    var color = L.geoJson(null, {
        style: function(feature) {
            return { fillColor: new_warna.karangasem, fillOpacity: <?php echo $mycolor['opacity']; ?> , stroke:true, color:'black'};
        }
    });
    var shape = omnivore.kml('kmls/karangasem.kml',null,color).addTo(mymap);
    shape.bindPopup(
        "<b>Karangasem</b><br>Jumlah Positif : <?php echo $result['karangasem']; ?>"
    );

    //KLUNGKUNG
    var color = L.geoJson(null, {
        style: function(feature) {
            return { fillColor: new_warna.klungkung, fillOpacity: <?php echo $mycolor['opacity']; ?> , stroke:true, color:'black'};
        }
    });
    var shape = omnivore.kml('kmls/klungkung.kml',null,color).addTo(mymap);
    shape.bindPopup(
        "<b>Klungkung</b><br>Jumlah Positif : <?php echo $result['klungkung']; ?>"
    );

    //TABANAN
    var color = L.geoJson(null, {
        style: function(feature) {
            return { fillColor: new_warna.tabanan, fillOpacity: <?php echo $mycolor['opacity']; ?> , stroke:true, color:'black'};
        }
    });
    var shape = omnivore.kml('kmls/tabanan.kml',null,color).addTo(mymap);
    shape.bindPopup(
        "<b>Tabanan</b><br>Jumlah Positif : <?php echo $result['tabanan']; ?>"
    );

</script>
<a href="https://github.com/randomize721/sig-1705551054" class="view-on-github" style="position: fixed;top: 10px;left: calc(50% - 60px);z-index: 9999;" target="_blank"> <img alt="View on Github" src="5847f98fcef1014c0b5e48c0.png" title="View on Github"
		  width="163"> </a>

<div class="shadow card" style="position: fixed;top: 10px;left: calc(69% - 60px);z-index: 9999;">
  <div class="card-body">
  <b>Menampilkan Data Tanggal : <?php echo $result['tgl'];?></b>
    <a href="list_data.php" ><button type="button" class="btn btn-warning">Manage Data</button></a>
  </div>
</div>



<div class="shadow card" style="position: fixed;top: calc(84% - 45px); left: 10px;z-index: 9999;">
  <div class="card-header"><b>Tampilkan Per Tanggal - Klik Area untuk Melihat Detail</b></div>
  <div class="card-body">
    <form class="form-inline" action="#" method="post">
        <input type="date" class="form-control mb-2 mr-sm-2" placeholder="Pilih Tanggal" name="tgl">
        <button type="submit" name="selected-date" class="btn btn-primary mb-2 mr-sm-2">Submit</button>
        <button type="submit" name="lates-data"class="btn btn-success mb-2">Tampilkan Data Terbaru</button>
    </form>
  </div>
</div>

<div class="shadow card" style="position: fixed;top: 13%; left: 10px;z-index: 9999; width:11%;">
  <div class="card-header"><center><b>Kabupaten Lain</b></center></div>
  <div class="card-body">
    <center><h1><?php echo $result['kabupaten_lainnya']; ?></h1></center>
  </div>
</div>

<div class="shadow card" style="position: fixed;top: 43%; left: 10px;z-index: 9999; width:11%;">
  <div class="card-header"><center><b>Warga Negara<br>Asing</b></center></div>
  <div class="card-body">
    <center><h1><?php echo $result['wna']; ?></h1></center>
  </div>
</div>

<div class="shadow card" style="position: fixed;top: calc(20% - 10px); left: calc(99% - 60px);z-index: 9999; height:75%;">
<div class="card-header"><center><b><?php echo $legend['0']; ?></b></center></div>
  <div class="card-body" style="background: linear-gradient(to bottom, <?php echo $mycolor['color1']; ?>, <?php echo $mycolor['color2']; ?>);"></div>
<div class="card-footer"><center><b><?php echo $legend['10']; ?></b></center></div>
</div>


</html>