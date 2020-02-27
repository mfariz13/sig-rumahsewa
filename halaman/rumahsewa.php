<?php
  $title="Rumah Sewa Sumedang";
  $judul="Rumah sewa Sumedang";
?>


<section class="content">
<div class="row">
  <div class="col-sm-8">
    <div class="box">
      <div class="box-header with-border">
		<h3 class="box-title">Rumah Sewa Sumedang</h3>
          <div align="center">
            <a href="<?=url('rumahsewa')?>"class="btn btn-default"  title="Rumah Sewa Sumedang"><i class="fa fa-home"></i></a>
            <br><br>
            <div id="mapid"></div>
            </div>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="box">
      <div class="box-header with-border">
	  <div align="center">
	  <a class="btn btn-warning btn-lg btn-block" role="button" aria-disabled="true">Hasil</a>
</div>
        <table class="table table-bordered">
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
            $no=1;
            $getdata=$db->get('data_rumah');
            foreach($getdata as $row){
            ?>
                <tr>
                    <td><?=$no?></td>
                    <td><?=$row['nama_rumah']?></td>
				          	<td><?=$row['alamat']?></td>
					<td>
					<a href=""class="btn btn-default" > <i class="fa fa-info"></i></a>
          
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


<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
   crossorigin=""></script>

 <script src="assets/js/leaflet-panel-layers-master/src/leaflet-panel-layers.js"></script>
 <script src="assets/js/leaflet.ajax.js"></script>

   <script type="text/javascript">

   
   	var map = L.map('mapid').setView([-6.8611192,107.918678], 16);


<?php
   $getdata=$db->get('data_rumah');
   $jsonPoint=array();
	foreach ($getdata as $row) {
		$saveJson=null;
		$saveJson['type']="Feature";
		$saveJson['properties']=[
                  "name"=>$row['nama_rumah'],
                  "icon"=>($row['point_marker']=='')?assets('icons/marker_home.png'):assets('unggah/marker/'.$row['point_marker']),
                  "popUp"=>('<img src="'.assets('unggah/rumah/'.$row['img_rumah']).'" width="200px </br></br>"">')."</br>Pemilk Rumah : ".$row['nama_rumah']."<br>Latitude : ".$row['latitude']."<br>Langitude : ".$row['langitude']
									];
		$saveJson['geometry']=[
									"type" => "Point",
									"coordinates" => [$row['langitude'],$row['latitude']] 
									];	

		$jsonPoint[]=$saveJson;
	}

	?>
  var geojsonMarker = <?=json_encode($jsonPoint, JSON_PRETTY_PRINT)?>;

  var myIcon = L.Icon.extend({
	    options: {
	    	iconSize: [60, 70]
	    }
	});
  L.geoJSON(geojsonMarker, {
	    pointToLayer: function (feature, latlng) {
	        return L.marker(latlng, {
	        	icon : new myIcon({iconUrl: feature.properties.icon})
	        });
	    },
    	onEachFeature: function(feature,layer){
    		 if (feature.properties) {
		        layer.bindPopup(feature.properties.popUp);
		    }
    	}
	}).addTo(map);
     
	   L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
}).addTo(map);
	

<?php
		$getLayer=$db->get('geojson');
		foreach ($getLayer as $row) {
			$arrayLyr[]='{
			name: "'.$row['nama_layer'].'",
			layer: new L.GeoJSON.AJAX(["assets/unggah/geojson/'.$row['geojson'].'"],).addTo(map)
			}';
		}
	?>

	var overLayers = [{
		group: "Layer",
		layers: [
			<?=implode(',', $arrayLyr);?>
		]
	}
	];
  var panelLayers = new L.Control.PanelLayers(baseLayers, overLayers,{
		collapsibleGroups: true
	});

	map.addControl(panelLayers);


</script>

