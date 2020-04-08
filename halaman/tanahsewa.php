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
                    <form action="" method="POST" class="form-inline">
                        <?php
                        if (isset($_POST['search'])) {
                            $search = $_POST['search'];
                            $db->where('nama_rumah', '%' . $search . '%', 'LIKE');
                        } else {
                            $db->get('data_rumah');
                            $search = "";
                        }
                        ?>

                        <input type="text" class="form-control" name="search" placeholder="nama pemilik tanah" value="<?= $search; ?>">
                        <button class="btn btn-default">search</button>
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
                                if ($status != '') {
                                    $db->where('status', '%' . $status . '%', 'LIKE');
                                }
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

</div>

</section>
<div class="modal fade" id="infoo" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">INFO DETAIL</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">
                <div class="fetched-data"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
            </div>
        </div>
    </div>
</div>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


<!-- <div class="modal" id="infoo">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>ini bakal keganti</p>
            </div>
            <div class="modal-footer">                
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div> -->
</div>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script> -->


<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA==" crossorigin=""></script>
<script src="assets/js/leaflet-panel-layers-master/src/leaflet-panel-layers.js"></script>
<script src="assets/js/leaflet.ajax.js"></script>

<script type="text/javascript">
    var map = L.map('mapid').setView([-6.8625462, 107.9209914], 17);

    <?php
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
            "Popup" => ('<center><img src="' . assets('unggah/rumah/' . $row['img_rumah']) . '"width=100%"</br></br>') .
                "</br>Pemilk Rumah : " . $row['nama_rumah'] .
                "</br>Alamat : " . $row['alamat'] .
                '<br><a  href="" name="infoo" class="btn btn-default"   data-toggle="modal" data-target="#infoo" data-id=' .$row['id_rumah']. '><i class="fa fa-info" ></i> info</a>'

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
    })



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


    });



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