<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Koperasi</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
        integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
        crossorigin="" />
    <style>
        #mapid {
            height: 590px;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
    <div id="mapid">

    </div>
    <input type="button" value="Finalize Line/Polyline" id="update">
</body>
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
    integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
    crossorigin=""></script>
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

    var Marker = L.icon({
        iconUrl: 'https://www.freepnglogos.com/uploads/logo-koperasi-png/logo-koperasi-rpp-koperasi-kelas-pgsd-untan-2.png',

        iconSize: [50, 50], // size of the icon
        iconAnchor: [50, 50], // point of the icon which will correspond to marker's location
        popupAnchor: [-12.5, -30] // point from which the popup should open relative to the iconAnchor
    });

    var marker1 = L.marker([-8.626458, 115.253944], {
        icon: Marker
    }).addTo(mymap);
    marker1.bindPopup(
        "<b>Koperasi Bina Pusaka</b><br>Alamat : Jl. Siulan No.65, Penatih Dangin Puri, Kec. Denpasar Tim., Kota Denpasar, Bali 80237<br>Telp : (0361) 292319"
    );

    var marker2 = L.marker([-8.633838, 115.246517], {
        icon: Marker
    }).addTo(mymap);
    marker2.bindPopup(
        "<b>Koperasi Simpan Pinjam Bina Usaha</b><br>Alamat : Jl. Sekar Jepun V No.15, Kesiman Kertalangu, Kec. Denpasar Tim., Kota Denpasar, Bali 80237<br>Telp : (0361) 464164"
    );

    var marker3 = L.marker([-8.636810, 115.251782], {
        icon: Marker
    }).addTo(mymap);
    marker3.bindPopup(
        "<b>Koperasi Partha Adiguna</b><br>Alamat : JL. Tunjung Bang Tohpati, No. 2, Kesimankerthalangu, 80237, Kesiman Kertalangu, Denpasar, Kota Denpasar, Bali 80237<br>Telp : (0361) 461066"
    );

    var marker4 = L.marker([-8.631900, 115.270024], {
        icon: Marker
    }).addTo(mymap);
    marker4.bindPopup(
        "<b>Koperasi Acintya Sedana Murti</b><br>Alamat : Jl. Batuyang Gg. XII No.47, Batubulan<br>Telp : 0819-1654-2317"
    );

    var marker5 = L.marker([-8.644246, 115.250288], {
        icon: Marker
    }).addTo(mymap);
    marker5.bindPopup(
        "<b>Koperasi Simpan Pinjam Akshaya Patra Dana</b><br>Alamat : Jl. Soka No.14, Kesiman Kertalangu, Kec. Denpasar Tim., Kota Denpasar, Bali 80237<br>Telp : (0361) 7802327"
    );

    var marker6 = L.marker([-8.649151, 115.239879], {
        icon: Marker
    }).addTo(mymap);
    marker6.bindPopup(
        "<b>Koperasi Amoghasiddhi</b><br>Alamat : Jl. Sokasati No.6, Sumerta Kelod, Kec. Denpasar Tim., Kota Denpasar, Bali 80237<br>Telp : (0361) 249883"
    );

    var marker7 = L.marker([-8.643082, 115.262959], {
        icon: Marker
    }).addTo(mymap);
    marker7.bindPopup(
        "<b>Koperasi Simpan Pinjam Winangun</b><br>Alamat : Jl. Bakung I No.36a, Kesiman Kertalangu, Kec. Denpasar Tim., Kota Denpasar, Bali 80237<br>Telp : (0361) 465307"
    );

    var marker8 = L.marker([-8.637892, 115.235930], {
        icon: Marker
    }).addTo(mymap);
    marker8.bindPopup(
        "<b>Koperasi Amoghasiddhi</b><br>Alamat : Jl. Noja No.143, Kesiman Petilan, Kec. Denpasar Tim., Kota Denpasar, Bali 80237<br>Telp : (0361) 9075050"
    );

    var marker9 = L.marker([-8.646194, 115.263200], {
        icon: Marker
    }).addTo(mymap);
    marker9.bindPopup(
        "<b>Koperasi Serba Usaha Angga Jaya</b><br>Alamat : Jl. Sekar Wangi IV No.28, Kesiman Kertalangu, Kec. Denpasar Tim., Kota Denpasar, Bali 80237<br>Telp : (0361) 7817267"
    );

    var marker10 = L.marker([-8.625919, 115.240767], {
        icon: Marker
    }).addTo(mymap);
    marker10.bindPopup(
        "<b>Koperasi Simpan Pinjam Sri Artha Mandiri</b><br>Alamat : JL. Trengguli, No. 80, Dentim, Penatih, Penatih, Kec. Denpasar Tim., Kota Denpasar, Bali 80237<br>Telp : 0813-3870-6300"
    );

    var marker11 = L.marker([-8.636048, 115.241297], {
        icon: Marker
    }).addTo(mymap);
    marker11.bindPopup(
        "<b>Koperasi Simpan Pinjam Sari Majapahit</b><br>Alamat : Jl. Gatot Subroto Tim. No.95, Penatih, Kec. Denpasar Tim., Kota Denpasar, Bali 80237<br>Telp : (0361) 8648630"
    );

    var marker12 = L.marker([-8.633197, 115.242628], {
        icon: Marker
    }).addTo(mymap);
    marker12.bindPopup(
        "<b>Koperasi Serba Usaha Klenting Sari</b><br>Alamat : Jl. Sanggalangit I No.8, Penatih, Kec. Denpasar Tim., Kota Denpasar, Bali 80237<br>Telp : (0361) 462542"
    );

    var marker13 = L.marker([-8.643404, 115.243120], {
        icon: Marker
    }).addTo(mymap);
    marker13.bindPopup(
        "<b>Koperasi Serba Usaha Hitha Bhuwana</b><br>Alamat : Jl. Sulatri 2, Gg. XII No.4, Kesiman Petilan, Kec. Denpasar Tim., Kota Denpasar, Bali 80237<br>Telp : (0361) 7454732"
    );

    var marker14 = L.marker([-8.632076, 115.240778], {
        icon: Marker
    }).addTo(mymap);
    marker14.bindPopup(
        "<b>Koperasi Pegawai Negeri Pradnya Kerthi</b><br>Alamat : JL. Trengguli 1, Tembau, Penatih, Penatih, Kec. Denpasar Tim., Kota Denpasar, Bali 80237<br>Telp : (0361) 8870900"
    );

    var marker15 = L.marker([-8.647277, 115.239511], {
        icon: Marker
    }).addTo(mymap);
    marker15.bindPopup(
        "<b>Koperasi Serba Usaha Sari Yadnya</b><br>Alamat : Pasar Yadnya, JL. Surabi, Kesiman, Sumerta Kelod, Kec. Denpasar Tim., Kota Denpasar, Bali 80237<br>Telp : (0361) 3647329"
    );

    mymap.on('click', function (e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;

        $.ajax({
            url: "save.php",
            type: "POST",
            data: {
                lat: lat,
                lng: lng
            },
            cache: false,
            success: function (dataResult) {
                location.reload();
            }
        });
    });

    $('#update').on('click', function () {
        $.ajax({
            url: "update.php",
            type: "POST",
            cache: false,
            success: function (dataResult) {
                location.reload();
            }
        });
    });

    <?php
        include 'view.php';
        include 'view_beta.php';
    ?>
</script>


</html>