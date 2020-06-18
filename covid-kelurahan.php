<?php
    include "load_kelurahan.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KMZ File Loader - 1705551054</title>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://unpkg.com/leaflet-kmz@latest/dist/leaflet-kmz.js"></script>
    <script src="https://unpkg.com/leaflet-pointable@0.0.3/leaflet-pointable.js"></script>
    <script src="https://unpkg.com/geojson-vt@3.0.0/geojson-vt.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script>
    var mymap = L.map('mapid').setView([-8.4, 115.5], 10);
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a> | I Putu Angga Darma Putra - 1705551054',
        maxZoom: 25,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoicmFuZG9taXplNzIxIiwiYSI6ImNrNnVlamNjODA4ZWwzcm54NHl0enEybnAifQ.RyV0WnA6uom_aCtR3zQR2w'
    }).addTo(mymap);

    var data_kelurahan = <?php echo json_encode($data_kelurahan) ?>;

    var kmzParser = new L.KMZParser({
        onKMZLoaded: function(layer, name) {
            control.addOverlay(layer, name);
            var layers = layer.getLayers()[0].getLayers();

            layers.forEach(function(layer,index){
                var kelurahan  = layer.feature.properties.NAME_4;

                kelurahan = kelurahan.replace(/\s+/g, " ");

                if(data_kelurahan[kelurahan] !== undefined){
                  layer.setStyle({fillOpacity:'0.75',fillColor:data_kelurahan[kelurahan]['color'],color:'black',weight:0.5,opacity:1});
                }

                layer.bindPopup("<b>"+data_kelurahan[kelurahan]['nama']+
                "</b> <table><tr><td>Positif </td><td>: "+data_kelurahan[kelurahan]['jumlah_positif']+
                "</td></tr><tr><td> Level</td><td> : "+data_kelurahan[kelurahan]['level']+
                "</td></tr><tr><td> PP-LN</td><td> : "+data_kelurahan[kelurahan]['ppln']+
                "</td></tr><tr><td> PP-DN</td><td> : "+data_kelurahan[kelurahan]['ppdn']+
                "</td></tr><tr><td> TL</td><td> : "+data_kelurahan[kelurahan]['tl']+
                "</td></tr><tr><td> Lainnya</td><td> : "+data_kelurahan[kelurahan]['lainnya']+
                "</td></tr><tr><td> Perawatan</td><td> : "+data_kelurahan[kelurahan]['perawatan']+
                "</td></tr><tr><td> Sembuh</td><td> : "+data_kelurahan[kelurahan]['sembuh']+
                "</td></tr><tr><td> Meninggal</td><td> : "+data_kelurahan[kelurahan]['meninggal']+"</td></tr></table>")
        
            })
            layer.addTo(mymap);
            
          }
        });
    
    kmzParser.load('bali-kelurahan.kmz');

    var control = L.control.layers(null, null, { collapsed:true }).addTo(mymap);
</script>
<a href="https://github.com/randomize721/sig-1705551054" class="view-on-github" style="position: fixed;top: 10px;left: calc(50% - 60px);z-index: 9999;" target="_blank"> <img alt="View on Github" src="5847f98fcef1014c0b5e48c0.png" title="View on Github"
		  width="163"> </a>

<div class="shadow card" style="position: fixed;top: 10px;left: calc(75% - 60px);z-index: 9999;">
  <div class="card-body">
  <b>Menampilkan Data Tanggal : <?php echo $data_kelurahan['Abiansemal']['tgl'];?></b>
    <a href="manage_data_kelurahan.php" ><button type="button" class="btn btn-warning" style="margin-left:1em">Manage Data</button></a>
  </div>
</div>

<div class="shadow card" style="position: fixed;top: calc(63% - 60px);left: calc(65% - 45px);z-index: 9999;">
  <div class="card-body">
  <h3>Keterangan</h3>
  <table border="1" style="margin-top:1em">
    <tr>
      <td style="width:3em; height:3em"><center><?php echo $total_positif['total']; ?></center></td>
      <td style="padding:10px;">Jumlah kasus positif seluruh Bali sampai tanggal <?php echo $data_kelurahan['Abiansemal']['tgl']; ?></td>
    </tr>
    <tr>
      <td bgcolor="lightgreen" style="width:3em; height:3em"></td>
      <td style="padding:10px;">Tidak pernah ada positif</td>
    </tr>
    <tr>
      <td bgcolor="green" style="width:3em; height:3em"></td>
      <td style="padding:10px;">Pernah ada positif dan kondisi (semuanya sudah sembuh atau semuanya meninggal)</td>
    </tr>
    <tr>
      <td bgcolor="yellow" style="width:3em; height:3em"></td>
      <td style="padding:10px;">Hanya ada 1 positif PP-LN/PP-DN dan kondisi masih dalam perawatan</td>
    </tr>
    <tr>
      <td bgcolor="pink" style="width:3em; height:3em"></td>
      <td style="padding:10px;">Lebih dari 1 positif PP-LN/DN dan kondisi masih dalam perawatan</td>
    </tr>
    <tr>
      <td bgcolor="darkred" style="width:3em; height:3em"></td>
      <td style="padding:10px;">Ada 1 atau lebih TL positif dan kondisi masih dalam perawatan</td>
    </tr>
  </table>
  </div>
</div>

<div class="shadow card" style="position: fixed;top: calc(89% - 45px); left: 10px;z-index: 9999;">
  <div class="card-header"><b>Tampilkan Per Tanggal - Klik Area untuk Melihat Detail</b></div>
  <div class="card-body">
    <form class="form-inline" action="#" method="post">
        <input type="date" class="form-control mb-2 mr-sm-2" placeholder="Pilih Tanggal" name="tgl">
        <button type="submit" name="selected-date" class="btn btn-primary mb-2 mr-sm-2">Submit</button>
        <button type="submit" name="lates-data"class="btn btn-success mb-2">Tampilkan Data Terbaru</button>
    </form>
  </div>
</div>

</html>