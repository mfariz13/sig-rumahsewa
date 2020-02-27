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
      <div class="box-header with border">
      <div align="center">
      <a class="btn btn-warning btn-lg btn-block" role="button" aria-disabled="true">Hasil</a>
        <div class="box-body">  
</div>
        </div>                   
      </div>
      </div>
</div>
        
</div>


  <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
  crossorigin=""></script>
  <script src="assets/js/leaflet-panel-layers-master/src/leaflet-panel-layers.js"></script>
  <script src="assets/js/leaflet.ajax.js"></script>
  <script type="text/javascript">


   	var map = L.map('mapid').setView([-6.8883603,107.9196577], 12);
    


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
		group: "Layer Kecamatan",
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
