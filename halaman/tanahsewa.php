<?php
$title = "Tanah Sewa Yayasan Nazhir Wakaf Pangeran Sumedang";
$judul = "Tanah Sewa Yayasan Nazhir Wakaf Pangeran Sumedang";
$url = 'tanahsewa';


$tn_pemilik = "";
$tn_blok = "";
$tn_status = "";

$row = $db->getOne('data_rumah');
?>
<section class="content">
  <div class="row">
    <div class="col-md-8">
      <div class="box ">
        <div class="box-header with-border">
          <h3 class="box-title">Tanah Sewa Yayasan Nazhir Wakaf Pangeran Sumedang</h3><br><br>
          <div style="align:center">

            <form method="POST" action="">
              <?php
              if (isset($_POST['filter'])) {
                $tn_blok = $_POST['tn_blok'];
                $db->where('tn_blok', '%' . $tn_blok . '%', 'LIKE');
              } else {
                $db->get('data_rumah');
                $tn_blok = "";
              }

              if (isset($_POST['filter'])) {
                $tn_status = $_POST['tn_status'];
                $db->where('tn_status', '%' . $tn_status . '%', 'LIKE');
              } else {
                $db->get('data_rumah');
                $tn_status = "";
              }
              ?>

              <div class="form-group col-md-6" style="width:200px">

                <select name="tn_blok" id="tn_blok" class="form-control">
                  <option value="">Pilih Blok</option>
                  <option value="">Semua</option>
                  <option value="Blok Empang" <?php if ($tn_blok == "Blok Empang") {
                                                echo "selected";
                                              } ?>>Blok Empang</option>
                  <option value="Blok Babakan" <?php if ($tn_blok == "Blok Babakan") {
                                                  echo "selected";
                                                } ?>>Blok Babakan</option>
                </select>
              </div>
              <div class="form-group col-md-6" style="width:200px">

                <select name="tn_status" id="tn_status" class="form-control">
                  <option value="">Fungsi Tanah</option>
                  <option value="">Semua</option>
                  <option value="Rumah Tinggal" <?php if ($tn_status == "Rumah Tinggal") {
                                                  echo "selected";
                                                } ?>>Rumah Tinggal</option>
                  <option value="Tempat Usaha" <?php if ($tn_status == "Tempat Usaha") {
                                                    echo "selected";
                                                  } ?>>Tempat Usaha</option>
                </select>

              </div>
              <div class="col-md-1">
                <button id="filter" name="filter" class="btn btn-warning" value="<?= $filter; ?>">Tampilkan</button>
              </div>
            </form>
          </div>
        </div>
        <div id="mapid"></div>
      </div>

    </div>
    <div class="col-md-4">
      <section class="panel">
        <div class="panel-body">
          <a class="btn btn-warning btn-lg btn-block">Result</a><br>
          <form action="" method="POST" class="form-inline">
            <?php
            if (isset($_POST['search'])) {
              $search = $_POST['search'];
              $db->where('tn_pemilik', '%' . $search . '%', 'LIKE');
            } else {
              $db->get('data_rumah');
              $search = "";
            }
            ?>
            <input type="text" class="form-control mr-2 ml-3" style="width:250px;" name="search" placeholder="nama pemilik tanah" value="<?= $search ?>">
            <button class="btn btn-default">cari</button>
          </form>
          <div class="box-body" style="max-height:400px;overflow:auto;">
            <table class="table table-bordered" id="myTable">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Pemilik Rumah</th>
                  <th>Alamat</th>

                  <th>Info</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                if ($tn_status != '') {
                  $db->where('tn_status', '%' . $tn_status . '%', 'LIKE');
                }
                if ($tn_blok != '') {
                  $db->where('tn_blok', '%' . $tn_blok . '%', 'LIKE');
                }

                $getdata = $db->get('data_rumah');
                foreach ($getdata as $row) {
                ?>
                  <tr>
                    <td><?= $no ?></td>
                    <td><?= $row['tn_pemilik'] ?></td>
                    <td><?= $row['tn_almt'] ?></td>

                    <td>
                      <a name="info" onClick="markersArray[<?= $row['tn_id'] ?>].openPopup()" class="btn btn-default"> <i class="fa fa-info"></i></a>
                    </td>
                  </tr>
                <?php
                  $no++;
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
    <div class="modal-content" style="width: 800px">
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
</div>


<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA==" crossorigin=""></script>
<script src="assets/js/leaflet-panel-layers-master/src/leaflet-panel-layers.js"></script>
<script src="assets/js/leaflet.ajax.js"></script>

<script type="text/javascript">
  var map = L.map('mapid').setView([-6.8625462, 107.9209914], 17);

  <?php
  if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $db->where('tn_pemilik', '%' . $search . '%', 'LIKE');
  } else {
    $db->get('data_rumah');
    $search = "";
  }
  if ($tn_status != '') {
    $db->where('tn_status', '%' . $tn_status . '%', 'LIKE');
  }
  if ($tn_blok != '') {
    $db->where('tn_blok', '%' . $tn_blok . '%', 'LIKE');
  }


  $getdata = $db->get('data_rumah');
  $Marker = array();

  foreach ($getdata as $row) {
    $Json = null;
    $Json['type'] = "Feature";
    $Json['properties'] = [
      "id" => $row['tn_id'],
      "name" => $row['tn_pemilik'],
      "icon" => ($row['tn_marker'] == '') ? assets('icons/marker_home.png') : assets('unggah/marker/' . $row['tn_marker']),
      "Popup" => ('<center><img src="' . assets('unggah/rumah/' . $row['tn_img']) . '"width=100%"</br></br>') .
        "</br>Pemilk Rumah : " . $row['tn_pemilik'] .
        "</br>Alamat : " . $row['tn_almt'] .
        '<br><a  href="" name="infoo" class="btn btn-default"   data-toggle="modal" data-target="#infoo" data-id=' . $row['tn_id'] . '><i class="fa fa-info" ></i> info</a>'

    ];

    $Json['geometry'] = [
      "type" => "Point",
      "coordinates" => [$row['tn_lang'], $row['tn_lat']]
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