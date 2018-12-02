<?php

include 'proses/connect.php';
include 'proses/suku.php';
include 'proses/datuak.php';
include 'proses/pendidikan.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Tugas BDL</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        #map {
        height: 600px;
      }
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }

      #wrapper { position: relative; }
   #over_map { position: absolute; top: 100px; left: 124px; z-index: 99; color:white; }
   i{
       margin-left:10px;
   }


   .slider {
    -webkit-appearance: none;
    width: 100%;
    height: 15px;
    border-radius: 5px;
    background: black;
    outline: none;
    opacity: 0.7;
    -webkit-transition: .2s;
    transition: opacity .2s;
}

.slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 25px;
    height: 25px;
    border-radius: 50%;
    background: #4CAF50;
    cursor: pointer;
}

.slider::-moz-range-thumb {
    width: 25px;
    height: 25px;
    border-radius: 50%;
    background: #4CAF50;
    cursor: pointer;
}
    </style>


</head>

<body>

    <div class="container" style='background-color:#00e575; color:black;'>

        <div class='row'>
            <div class='col-sm-6'>
                <div class="btn-group">
                    <b>Penduduk</b>
                    <button style='background-color:#32cb00;' type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split"
                        data-toggle="dropdown">
                    </button>
                    <div class="dropdown-menu">
                        <a onclick="rumah_k()" class="dropdown-item" href="#">Marker</a>
                        <a class="dropdown-item" href="#">---</a>
                    </div>
                </div>

                <div class="btn-group">
                    <b>Rumah</b>
                    <button style='background-color:#32cb00;' type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split"
                        data-toggle="dropdown">
                    </button>
                    <div class="dropdown-menu">
                        <a onclick='rumah_kosong()' class="dropdown-item" href="#">Rumah Kosong</a>
                        <a onclick='rumah_berisi()' class="dropdown-item" href="#">Rumah Berisi</a>
                        <a onclick='bukan_rumah()' class="dropdown-item" href="#">Bukan Rumah</a>
                        <a onclick='memiliki_pam()' class="dropdown-item" href="#">Memiliki Air Pam</a>
                        <a onclick='tidak_memiliki_pam()' class="dropdown-item" href="#">Tidak Memiliki Air Pam</a>
                        <a onclick='listrik_besar()' class="dropdown-item" href="#">Listrik >=900</a>
                        <a onclick='listrik_kecil()' class="dropdown-item" href="#">Listrik <900</a> </div> </div> <div
                                class="btn-group">
                                <b>Industri</b>
                                <button style='background-color:#32cb00;' type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split"
                                    data-toggle="dropdown">
                                </button>
                                <div class="dropdown-menu">
                                    <a onclick='bangunan_all()' class="dropdown-item" href="#">Bangunan Industri</a>
                                    <a onclick='bangunan_perak()' class="dropdown-item" href="#">Bangunan Industri
                                        Perak</a>
                                    <a onclick='bangunan_kuliner()' class="dropdown-item" href="#">Bangunan Industri
                                        Kuliner</a>
                                    <a onclick='bangunan_tekstil()' class="dropdown-item" href="#">Bangunan Industri
                                        Sulaman</a>
                                </div>
                    </div>

                    <div class="btn-group">
                        <b>Kesehatan</b>
                        <button style='background-color:#32cb00;' type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split"
                            data-toggle="dropdown">
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Link 1</a>
                            <a class="dropdown-item" href="#">Link 2</a>
                        </div>
                    </div>

                    <div class="btn-group">
                        <b>Tools</b>
                        <button style='background-color:#32cb00;' type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split"
                            data-toggle="dropdown">
                        </button>
                        <div class="dropdown-menu">
                            <a id='hapus' onclick='delete_p()' class="dropdown-item" href="#">Hapus</a>
                            <a class="dropdown-item" href="#">Link 2</a>
                        </div>
                    </div>






                </div>

                <div class='col-sm-6'>

                    <script>
                        function cari_id() {
                            hapus();
                            nama = document.getElementById("cari_id").value;
                            console.log(nama);

                            layernya = new google.maps.Data();
                            layernya.loadGeoJson('proses/cari_id.php?nama=' + nama);

                            layernya.setMap(map);
                        }

                        function cari_pendapatan() {
                            hapus();
                            nama = document.getElementById("cari_pendapatan").value;
                            console.log(nama);

                            layernya = new google.maps.Data();
                            layernya.loadGeoJson('proses/cari_pendapatan.php?nama=' + nama);

                            layernya.setMap(map);
                        }
                   </script>

                    <input id="cari_id" type="text" name="nama">
                    <button onclick="cari_id()">Cari ID</button>


                    <input id="cari_pendapatan" type="text" name="nama">
                    <button onclick="cari_pendapatan()">Pendapatan</button>

                </div>

            </div>


            <b>Pemilik:</b>
            <select onchange='rumah_suku()' id='suku'>

            </select>

            <select onchange='rumah_datuk()' id='datuak'>

            </select>

            <select onchange='rumah_pendidikan()' id='pendidikan'>

            </select>



            <b>Penghuni:</b>
            <select onchange='rumah_suku1()' id='suku1'>

            </select>

            <select onchange='rumah_datuk1()' id='datuak1'>

            </select>

            <select onchange='rumah_pendidikan1()' id='pendidikan1'>

            </select>
        </div>

        <!-- Make Marker Onclick Google Maps -->



        <!-- Script Select Option -->

        <script>
            var suku = <?php echo json_encode($hasil_suku) ?>;
            console.log(suku);
            var jumlah_suku = suku.features.length;


            var i = 0;
            while (i < jumlah_suku) {
                var x = document.getElementById("suku");
                var option = document.createElement("option");
                option.text = suku.features[i].properties.nama_suku;
                option.value = suku.features[i].properties.id_suku;
                x.add(option);
                i++;
            }

            var suku1 = <?php echo json_encode($hasil_suku) ?>;
            // console.log(suku1);
            var jumlah_suku1 = suku1.features.length;


            var i = 0;
            while (i < jumlah_suku1) {
                var x = document.getElementById("suku1");
                var option = document.createElement("option");
                option.text = suku1.features[i].properties.nama_suku;
                option.value = suku1.features[i].properties.id_suku;
                x.add(option);
                i++;
            }
        </script>


        <script>
            var pendidikan_json = <?php echo json_encode($hasil_pendidikan) ?>;
            console.log("test");
            console.log(pendidikan_json);

            var jumlah_pendidikan = pendidikan_json.features.length;


            var i = 1;
            while (i < jumlah_pendidikan) {
                var x = document.getElementById("pendidikan");
                var option = document.createElement("option");

                option.text = pendidikan_json.features[i].properties.tingkat_pendidikan;
                option.value = pendidikan_json.features[i].properties.tingkat_pendidikan;
                x.add(option);
                i++;
            }

            var i = 1;
            while (i < jumlah_pendidikan) {
                var x = document.getElementById("pendidikan1");
                var option = document.createElement("option");

                option.text = pendidikan_json.features[i].properties.tingkat_pendidikan;
                option.value = pendidikan_json.features[i].properties.tingkat_pendidikan;
                x.add(option);
                i++;
            }
        </script>


        <script>
            var datuak = <?php echo json_encode($hasil_datuak)?>;
            // console.log(suku);
            var jumlah_datuak = datuak.features.length;


            var i = 0;
            while (i < jumlah_datuak) {
                var x = document.getElementById("datuak");
                var option = document.createElement("option");
                option.text = datuak.features[i].properties.nama_datuak;
                option.value = datuak.features[i].properties.id_datuak;
                x.add(option);
                i++;
            }

            var i = 0;
            while (i < jumlah_datuak) {
                var x = document.getElementById("datuak1");
                var option = document.createElement("option");
                option.text = datuak.features[i].properties.nama_datuak;
                option.value = datuak.features[i].properties.id_datuak;
                x.add(option);
                i++;
            }
        </script>



        <script>
            $(document).ready(function () {
                $('#suku').on('change', function () {
                    var suku = $(this).val();
                    if (suku) {
                        $.ajax({
                            type: 'GET',
                            url: 'proses/get_suku.php?suku=' + suku,
                            success: function (html) {
                                //   alert(html);
                                tampil_suku(suku);

                            }

                        });
                    } else {

                    }
                });
            });
        </script>



        <!-- Container Map -->

        <div id="wrapper">
            <div class='container' id="map"> </div>
            <div id="over_map">
                <div class='panel panel-info'>
                    <div class='panel-body' style='background-color:#76ff03'>


                        <select>

                            <option>
                                Test
                            </option>
                            <option>
                                Test
                            </option>
                        </select>

                        <script>
                            var marker_user;
                            function click_marker() {
                                if(marker_user==undefined)
                                {
                                    alert("Pilih Posisi Di Peta");
                                map.addListener('click', function (e) {
                                    placeMarker(e.latLng, map);
                                });
                                function placeMarker(position, map) {
                                    marker_user = new google.maps.Marker({
                                        position: position,
                                        map: map
                                    });
                                    map.panTo(position);

                                }
                                }
                                else{
                                    marker_user=undefined;
                                }

                                if(circle_radius==undefined)
                                {

                                }
                                else
                                {
                                    circle_radius.setMap(null);
                                    circle_radius=undefined;
                                }


                            }

                            var circle_radius;

                            function data_radius(lat,lng,value)
                            {
                                marker_user.setMap(null);

                                hapus();

                                var test1 = new Array();
                                $.ajax({
                                url: 'proses/get_radius.php',
                                data: "",
                                dataType: 'json',
                                  success: function (rows) {
                                      alert(rows);

                                  }


                               });

                        layernya = new google.maps.Data();
                        layernya.loadGeoJson('proses/get_radius.php?lng='+lng+'&lat='+lat+'&radius='+value);

                        layernya.setMap(map);

                            }


                            // Fungsi Data Radius Industri

                            
                            function data_radius_industri(lat,lng,value)
                            {
                                marker_user.setMap(null);

                                hapus();

                                var test1 = new Array();
                                $.ajax({
                                url: 'proses/get_radius_industri.php',
                                data: "",
                                dataType: 'json',
                                  success: function (rows) {
                                      alert(rows);

                                  }


                               });

                        layernya = new google.maps.Data();
                        layernya.loadGeoJson('proses/get_radius_industri.php?lng='+lng+'&lat='+lat+'&radius='+value);

                        layernya.setMap(map);

                            }


                            // Data Radius make_circle_b_berisi
                            function data_radius_berisi(lat,lng,value)
                            {
                                marker_user.setMap(null);

                                hapus();

                                var test1 = new Array();
                                $.ajax({
                                url: 'proses/get_radius_berisi.php',
                                data: "",
                                dataType: 'json',
                                  success: function (rows) {
                                      alert(rows);

                                  }


                               });

                        layernya = new google.maps.Data();
                        layernya.loadGeoJson('proses/get_radius_industri.php?lng='+lng+'&lat='+lat+'&radius='+value);

                        layernya.setMap(map);

                            }
                            function make_circle()
                            {
                                if(circle_radius==undefined)
                                {

                                var value=parseInt(document.getElementById("range").value);
                                // console.log(value);
                                var lat = marker_user.getPosition().lat();
                                var lng = marker_user.getPosition().lng();
                                var position=marker_user.getPosition();
                                // console.log(lat);
                                // console.log(lng);
                                circle_radius = new google.maps.Circle({
                                     strokeColor: '#FF0000',
                                     strokeOpacity: 0.8,
                                     strokeWeight: 2,
                                     fillColor: '#FF0000',
                                     fillOpacity: 0.35,
                                     map: map,
                                     center: position,
                                     radius: value
                                    });
                                    data_radius(lat,lng,value);
                                }
                                else
                                {
                                    circle_radius.setMap(null);
                                    circle_radius=undefined;
                                    var value=parseInt(document.getElementById("range").value);
                                console.log(value);
                                var lat = marker_user.getPosition().lat();
                                var lng = marker_user.getPosition().lng();
                                var position=marker_user.getPosition();
                                // console.log(lat);
                                // console.log(lng);
                                circle_radius = new google.maps.Circle({
                                     strokeColor: '#FF0000',
                                     strokeOpacity: 0.8,
                                     strokeWeight: 2,
                                     fillColor: '#FF0000',
                                     fillOpacity: 0.35,
                                     map: map,
                                     center: position,
                                     radius: value
                                    });
                                    data_radius(lat,lng,value);
                                }
                            }


                            // Make Circle Industri

                                  function make_circle_industri()
                            {
                                if(circle_radius==undefined)
                                {

                                var value=parseInt(document.getElementById("range_industri").value);
                                // console.log(value);
                                var lat = marker_user.getPosition().lat();
                                var lng = marker_user.getPosition().lng();
                                var position=marker_user.getPosition();
                                // console.log(lat);
                                // console.log(lng);
                                circle_radius = new google.maps.Circle({
                                     strokeColor: '#FF0000',
                                     strokeOpacity: 0.8,
                                     strokeWeight: 2,
                                     fillColor: '#FF0000',
                                     fillOpacity: 0.35,
                                     map: map,
                                     center: position,
                                     radius: value
                                    });
                                    data_radius_industri(lat,lng,value);
                                }
                                else
                                {
                                    circle_radius.setMap(null);
                                    circle_radius=undefined;
                                    var value=parseInt(document.getElementById("range_industri").value);
                                console.log(value);
                                var lat = marker_user.getPosition().lat();
                                var lng = marker_user.getPosition().lng();
                                var position=marker_user.getPosition();
                                // console.log(lat);
                                // console.log(lng);
                                circle_radius = new google.maps.Circle({
                                     strokeColor: '#FF0000',
                                     strokeOpacity: 0.8,
                                     strokeWeight: 2,
                                     fillColor: '#FF0000',
                                     fillOpacity: 0.35,
                                     map: map,
                                     center: position,
                                     radius: value
                                    });
                                    data_radius_industri(lat,lng,value);
                                }
                            }


                            // Make Circle Rumah rumah_berisi

                              function make_circle_b_berisi()
                            {
                                if(circle_radius==undefined)
                                {

                                var value=parseInt(document.getElementById("range_rumah_berisi").value);
                                // console.log(value);
                                var lat = marker_user.getPosition().lat();
                                var lng = marker_user.getPosition().lng();
                                var position=marker_user.getPosition();
                                // console.log(lat);
                                // console.log(lng);
                                circle_radius = new google.maps.Circle({
                                     strokeColor: '#FF0000',
                                     strokeOpacity: 0.8,
                                     strokeWeight: 2,
                                     fillColor: '#FF0000',
                                     fillOpacity: 0.35,
                                     map: map,
                                     center: position,
                                     radius: value
                                    });
                                    data_radius_berisi(lat,lng,value);
                                }
                                else
                                {
                                    circle_radius.setMap(null);
                                    circle_radius=undefined;
                                    var value=parseInt(document.getElementById("range_rumah_berisi").value);
                                console.log(value);
                                var lat = marker_user.getPosition().lat();
                                var lng = marker_user.getPosition().lng();
                                var position=marker_user.getPosition();
                                // console.log(lat);
                                // console.log(lng);
                                circle_radius = new google.maps.Circle({
                                     strokeColor: '#FF0000',
                                     strokeOpacity: 0.8,
                                     strokeWeight: 2,
                                     fillColor: '#FF0000',
                                     fillOpacity: 0.35,
                                     map: map,
                                     center: position,
                                     radius: value
                                    });
                                    data_radius_berisi(lat,lng,value);
                                }
                            }
                        </script>

                        <button class="fa fa-location-arrow" onclick="click_marker()"> </button>




                    </div>
                </div>

                <div class="panel panel-info" style='margin-top:20px;'>

                    <div class='panel-head' style='background-color:#00e676'>
                        Menu Float
                    </div>

                    <div class='panel-body' style='width:200px;background-color:#66ffa6;'>
                        <b> Radius Semua Bangunan:</b>
                        <input id="range" onchange="make_circle()" type="range" min="1" max="1000" value="1" class="slider"
                            id="myRange">
                        <b> Radius Bangunan Industri:</b>
                        <input id="range_industri" onchange="make_circle_industri()" type="range" min="1" max="1000"
                            value="1" class="slider" id="myRange">
                        <b> Radius Rumah Berisi:</b>
                        <input id="range_rumah_berisi" onchange="make_circle_b_berisi()" type="range" min="1" max="1000"
                            value="1" class="slider" id="myRange">
                        <b style='color:red;'>Pencarian Pemilik</b>

                        <input id="cari_pemilik" type="text" name="nama">
                        <button onclick="cari_pemilik()">Cari</button>

                        <br />
                        <b style='color:red;'>Pencarian Penghuni</b>

                        <input id="cari_penghuni" type="text" name="nama">
                        <button onclick="cari_penghuni()">Cari</button>

                        <br />
                        <b style='color:red;'>Cari Nama Industri</b>

                        <input id="cari_industri" type="text" name="nama">
                        <button onclick="cari_industri()">Cari</button>

                    </div>

                    <script>
                        function cari_pemilik() {
                            hapus();
                            nama = document.getElementById("cari_pemilik").value;
                            console.log(nama);

                            layernya = new google.maps.Data();
                            layernya.loadGeoJson('proses/cari_pemilik.php?nama=' + nama);

                            layernya.setMap(map);


                        }


                        function cari_penghuni() {
                            hapus();
                            nama = document.getElementById("cari_penghuni").value;
                            console.log(nama);

                            layernya = new google.maps.Data();
                            layernya.loadGeoJson('proses/cari_penghuni.php?nama=' + nama);

                            layernya.setMap(map);
                        }

                        function cari_industri() {
                            hapus();
                            nama = document.getElementById("cari_industri").value;
                            console.log(nama);

                            layernya = new google.maps.Data();
                            layernya.loadGeoJson('proses/cari_industri.php?nama=' + nama);

                            layernya.setMap(map);
                        }
                    </script>



                </div>
            </div>

        </div>

        <div class='container' style='background-color:black; color:white;'>
            Saya Jesi
        </div>


        <script>
            var map;
            var layernya;
            var layernya1 = new Array();

            function initMap() {
                map = new google.maps.Map(document.getElementById('map'), {
                    center: {
                        lat: -0.316938,
                        lng: 100.356981
                    },
                    zoom: 18
                });
                loadLayer();
            }






            function loadLayer() {

                var infowindow = new google.maps.InfoWindow();

                layernya = new google.maps.Data();
                layernya.loadGeoJson('proses/bangunan.php');
                results = layernya.loadGeoJson('proses/bangunan.php');
                layernya.setMap(map);

                layernya.addListener('click', function(event) {
        
                var myHTML = event.feature.getProperty("id_pemilik_b");
                var nama_pemilik=event.feature.getProperty("nama_penduduk");
                console.log(myHTML);

  


 swal(
    myHTML);
                

                 });  

            }


            function bangunan_perak() {
                hapus();


                layernya = new google.maps.Data();
                layernya.loadGeoJson('proses/getindustri.php');
                layernya.setMap(map);

            }


            function bangunan_kuliner() {
                hapus();


                layernya = new google.maps.Data();
                layernya.loadGeoJson('proses/kuliner.php');
                layernya.setMap(map);

            }


            function bangunan_tekstil() {
                hapus();
                layernya = new google.maps.Data();
                layernya.loadGeoJson('proses/tekstil.php');
                layernya.setMap(map);
            }


            function bangunan_all() {
                hapus();


                layernya = new google.maps.Data();
                layernya.loadGeoJson('proses/industri_all.php');
                layernya.setMap(map);

            }


            function rumah_kosong() {
                hapus();


                layernya = new google.maps.Data();
                layernya.loadGeoJson('proses/rumahkosong.php');
                layernya.setMap(map);
            }

            function rumah_berisi() {
                hapus();


                layernya = new google.maps.Data();
                layernya.loadGeoJson('proses/rumahberisi.php');
                layernya.setMap(map);
            }


            function bukan_rumah() {

                hapus();


                layernya = new google.maps.Data();
                layernya.loadGeoJson('proses/bukanrumah.php');
                layernya.setMap(map);

            }

            function memiliki_pam() {
                hapus();


                layernya = new google.maps.Data();
                layernya.loadGeoJson('proses/memiliki_pam.php');
                layernya.setMap(map);

            }

            function tidak_memiliki_pam() {
                hapus();


                layernya = new google.maps.Data();
                layernya.loadGeoJson('proses/tidak_memiliki_pam.php');
                layernya.setMap(map);

            }

            function listrik_besar() {
                hapus();


                layernya = new google.maps.Data();
                layernya.loadGeoJson('proses/listrik_besar.php');
                layernya.setMap(map);

            }

            function listrik_kecil() {
                hapus();


                layernya = new google.maps.Data();
                layernya.loadGeoJson('proses/listrik_kecil.php');
                layernya.setMap(map);

            }


            function tampil_suku(suku) {
                hapus();


                layernya = new google.maps.Data();
                layernya.loadGeoJson('proses/get_suku.php?suku=' + suku);
                layernya.setMap(map);
            }



            function hapus() {
                layernya.setMap(null);

            }

            function delete_p() {
                console.log(layernya1.length);
                for (var i = 0; i < layernya1.length; i++) {
                    map.data.remove(layernya1[i][0]);

                }
            }



            function rumah_k() {
                // alert("Tampilkan semua rumah kosong");
                hapus();

                var test1 = new Array();



                $.ajax({
                    url: 'proses/get_bangunan_point.php',
                    data: "",
                    dataType: 'json',
                    success: function (rows) {

                        console.log(rows.features[0].properties.air_pam);
                        console.log(rows.features[0].geometry);
                        var myHTML;


                        console.log(rows.features.length);
                        var infowindow = new google.maps.InfoWindow();

                        for (i = 0; i < rows.features.length - 1; i++) {

                            layernya1[i] = new google.maps.Data();
                            test = rows.features[i].geometry;
                            test1[i] = {
                                type: "Feature",
                                geometry: test
                            };


                            map.data.addListener('click', function (event) {
                                myHTML = rows.features[i].properties.air_pam;
                                infowindow.setContent(
                                    "<div style='width:150px; text-align: center;'>" +
                                    myHTML + "</div>");
                                infowindow.setPosition(event.feature.getGeometry().get());
                                infowindow.setOptions({
                                    pixelOffset: new google.maps.Size(0, -30)
                                });
                                infowindow.open(map);
                            });

                            layernya1[i] = map.data.addGeoJson(test1[i]);


                        }

                    }

                });
            }
        </script>


        <script>
            function rumah_suku() {
                var id_suku = document.getElementById('suku').value;
                console.log(id_suku);

                hapus();


                layernya = new google.maps.Data();
                layernya.loadGeoJson('proses/rumah_suku1.php?id_suku=' + id_suku);
                layernya.setMap(map);
            }

            function rumah_suku1() {
                var id_suku = document.getElementById('suku1').value;
                console.log(id_suku);

                hapus();


                layernya = new google.maps.Data();
                layernya.loadGeoJson('proses/rumah_suku1.php?id_suku=' + id_suku);
                layernya.setMap(map);
            }

            function rumah_datuk() {
                var id_datuk = document.getElementById('datuak').value;
                console.log(id_datuk);

                hapus();

                layernya = new google.maps.Data();
                layernya.loadGeoJson('proses/rumah_datuk.php?id_datuk=' + id_datuk);
                layernya.setMap(map);
            }


            function rumah_datuk1() {
                var id_datuk = document.getElementById('datuak1').value;
                console.log(id_datuk);

                hapus();

                layernya = new google.maps.Data();
                layernya.loadGeoJson('proses/rumah_datuk1.php?id_datuk=' + id_datuk);
                layernya.setMap(map);
            }


            function rumah_pendidikan() {
                var nama_pendidikan = document.getElementById('pendidikan').value;
                console.log(nama_pendidikan);
                hapus();

                layernya = new google.maps.Data();
                layernya.loadGeoJson('proses/pendidikan_pemilik.php?nama_pendidikan=' + nama_pendidikan);
                layernya.setMap(map);

            }

            function rumah_pendidikan1() {
                var nama_pendidikan = document.getElementById('pendidikan1').value;
                console.log(nama_pendidikan);
                hapus();

                layernya = new google.maps.Data();
                layernya.loadGeoJson('proses/pendidikan_penghuni.php?nama_pendidikan=' + nama_pendidikan);
                layernya.setMap(map);

            }
        </script>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1TwYksj1uQg1V_5yPUZqwqYYtUIvidrY&callback&callback=initMap"
            async defer>
        </script>


</body>

</html>