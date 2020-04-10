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
<script>
    var mymap = L.map('mapid').setView([-8.668265, 115.213284], 12);
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a> | I Putu Angga Darma Putra - 1705551054',
        maxZoom: 25,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoicmFuZG9taXplNzIxIiwiYSI6ImNrNnVlamNjODA4ZWwzcm54NHl0enEybnAifQ.RyV0WnA6uom_aCtR3zQR2w'
    }).addTo(mymap);

    var kmzParser = new L.KMZParser({
        onKMZLoaded: function(layer, name) {
            control.addOverlay(layer, name);
            layer.addTo(mymap);
        },
            bindTooltip: false,
    });
    
    kmzParser.load('bali-kabupaten-colorized.kmz');

    var control = L.control.layers(null, null, { collapsed:true }).addTo(mymap);
</script>
<a href="https://github.com/Raruto/leaflet-kmz" class="view-on-github" style="position: fixed;top: 10px;left: calc(50% - 60px);z-index: 9999;"> <img alt="View on Github" src="5847f98fcef1014c0b5e48c0.png" title="View on Github"
		  width="163"> </a>


</html>