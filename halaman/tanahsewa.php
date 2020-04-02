<?php
$title = "Tanah Sewa Yayasan Nazhir Wakaf Pangeran Sumedang";
$judul = "Tanah Sewa Yayasan Nazhir Wakaf Pangeran Sumedang";
$url = 'tanahsewa';

$status = (isset($_GET['status'])) ? $_GET['status'] : '';
if ($status != '') {
    $db->where('status', '%' . $status . '%', 'LIKE');
}

?>
<section class="content">
    <div class="row">
        <div class="col-sm-8">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Tanah Sewa Yayasan Nazhir Wakaf Pangeran Sumedang</h3><br><br>
                    <div align="center">
                        <form>
                            <?= input_hidden('halaman', $url) ?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="">
                                <label class="form-check-label" for="inlineRadio1">Semua</label>
                                <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="Rumah Tinggal">
                                <label class="form-check-label" for="inlineRadio1">Rumah Tinggal</label>
                                <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="Berubah Fungsi">
                                <label class="form-check-label" for="inlineRadio2">Berubah Fungsi</label>
                                <button type="submit" value="input" class="btn btn-default"><i class="fa fa-search"></i></button><br><br>
                            </div>
                        </form>

                    </div>


                    <div id="mapid"></div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <section class="panel">
                <div class="panel-body">
                    <a class="btn btn-warning btn-lg btn-block">Result</a><br>
                    <form class="form-inline">
                        <input class="form-control" style="width:250px" type="text" id="search-bar" onkeyup="search()" placeholder="Cari Pemilik Rumah">
                        
                    </form>
                    <div class="box-body" style="max-height:400px;overflow:auto;">
                        <table class="table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th>Pemilik Rumah</th>
                                    <th>Alamat</th>
                                    <th>Info</th>
                                </tr>
                            </thead>
                            <tbody>


                                <?php
                                $getdata = $db->get('data_rumah');
                                foreach ($getdata as $row) {
                                ?>
                                    <tr>
                                        <td><?= $row['nama_rumah'] ?></td>
                                        <td><?= $row['alamat'] ?></td>
                                        <td>
                                            <a name="info" onClick="markersArray[<?= $row['id_rumah'] ?>].openPopup()" class="btn btn-default"> <i class="fa fa-info"></i></a>
                                        </td>
                                    </tr>
                                <?php

                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
        <?php
        if (isset($_GET['info'])) {

            $id_rumah = "";
            $nama_rumah = "";
            $alamat = "";
            $GeoJSON = "";
            $latitude = "";
            $langitude = "";
            $img_rumah = "";
            $point_marker = "";
            $status = "";

            if (isset($_GET['info']) and isset($_GET['id'])) {

                $id = $_GET['id'];
                $db->where('id_rumah', $id);
                $row = $db->getOne('data_rumah');
                if ($db->count > 0) {
                    $id_rumah = $row['id_rumah'];
                    $nama_rumah = $row['nama_rumah'];
                    $alamat = $row['alamat'];
                    $latitude = $row['latitude'];
                    $langitude = $row['langitude'];
                    $img_rumah = $row['img_rumah'];
                }
            }


        ?>
            <form method="post" enctype="multipart/form-data">
                <div class="col-sm-8">
                    <section class="panel">
                        <div class="panel-body">
                            <a class="btn btn-warning btn-lg btn-block">Result</a>
                            <div class="box-body">
                                <div style="text-align:center;"><?= ($row['img_rumah'] == '' ? '-' : '<img src="' . assets('unggah/rumah/' . $row['img_rumah']) . '"width=500px">') ?></div><br>

                                

                                <table class="table table-bordered">
                                    <tbody>

                                        <tr>
                                            <td>Nama :</td>
                                            <td><?= $row['nama_rumah'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat :</td>
                                            <td><?= $row['alamat'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Latitude :</td>
                                            <td><?= $row['latitude'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Langitude :</td>
                                            <td><?= $row['langitude'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td><?= $row['status'] ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
    </div>
<?php } ?>

</div>

</section>





<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA==" crossorigin=""></script>
<script src="assets/js/leaflet-panel-layers-master/src/leaflet-panel-layers.js"></script>
<script src="assets/js/leaflet.ajax.js"></script>

<script type="text/javascript">
    var map = L.map('mapid').setView([-6.8625462, 107.9209914], 17);
    
    <?php
    $status = (isset($_GET['status'])) ? $_GET['status'] : '';
    if ($status != '') {
        $db->where('status', '%' . $status . '%', 'LIKE');
    }
    $getdata = $db->get('data_rumah');
    $Marker = array();
    foreach ($getdata as $row) {
        $Json = null;
        $Json['type'] = "Feature";
        $Json['properties'] = [
            "id" => $row['id_rumah'],
            "name" => $row['nama_rumah'],
            "icon" => ($row['point_marker'] == '') ? assets('icons/marker_home.png') : assets('unggah/marker/' . $row['point_marker']),
            "Popup" => ('<center>                            
                            <img src="' . assets('unggah/rumah/' . $row['img_rumah']) . '"width=100%"</br></br>') .
                "</br>Pemilk Rumah : " . $row['nama_rumah'] .
                "</br>Alamat : " . $row['alamat'] .
                
                '<br/><a href=' . url($url . '&info&id=' . $row['id_rumah']) .' name="status" name="info" class="btn btn-default"><i class="fa fa-info"></i> info</a></div>'
        ];
        $Json['geometry'] = [
            "type" => "Point",
            "coordinates" => [$row['langitude'], $row['latitude']]
        ];

        $Marker[] = $Json;
    }

    ?>

    var geojsonMarker = <?= json_encode($Marker, JSON_PRETTY_PRINT) ?>;

    var myIcon = L.Icon.extend({
        options: {
            iconSize: [50, 60]
        }
    });


    var markersArray = {};


    L.geoJSON(geojsonMarker, {

        pointToLayer: function(feature, latlng) {
            markersArray[feature.properties.id] = L.marker(latlng, {
                    icon: new myIcon({
                        iconUrl: feature.properties.icon
                    })
                })
                .addTo(map)
                .bindPopup(feature.properties.Popup)

            return L.marker(latlng)

        }


    })



    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 22,
        id: 'mapbox/light-v10',
        accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
    }).addTo(map);


    <?php
    $getLayer = $db->get('geojson');
    foreach ($getLayer as $row) {
        $arrayLyr[] = '{
			name: "' . $row['nama_layer'] . '",
			layer: new L.GeoJSON.AJAX(["assets/unggah/geojson/' . $row['geojson'] . '"],).addTo(map)
			}';
    }
    ?>
    var overLayers = [{
        group: "Layer",
        layers: [
            <?= implode(',', $arrayLyr); ?>
        ]
    }];
</script>