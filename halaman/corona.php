<?php
  $title="Rumah Sewa Sumedang";
  $judul="Penyebaran Virus Corona";
  $url='corona'
?>
<section class="content">
<div class="row">
  <div class="col-sm-8">
    <div class="box">
        <div class="box-header with-border">
		    <h3 class="box-title">Penyebaran Virus Corona</h3>
                <div align="center">
                    <a href="<?=url('tanahsewa')?>"class="btn btn-default"  title="Rumah Sewa Sumedang"><i class="fa fa-home"></i></a>
                    <a href="<?=url('corona')?>"class="btn btn-default"  title="Corona"><i class="fa fa-map-marker"></i></a>
                    <br><br>
                    <div id="mapid"></div>
                               
                </div>   
        </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="box">
      <div class="box-header with-border">
	  <div text-align="center">
	  <a class="btn btn-warning btn-lg btn-block">Hasil</a>
    </div>
    <div style="width: 500x; height: 500px; overflow-y: scroll;">
        
      </div>
  </div>
</div>
</div>
  </section>

  <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
   crossorigin=""></script>
  <script src="assets/js/leaflet-panel-layers-master/src/leaflet-panel-layers.js"></script>
  <script src="assets/js/leaflet.ajax.js"></script>
  



   	<script type="text/javascript">

   	var map = L.map('mapid').setView([-3.824181, 114.8191513], 4);

 	L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
	    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
	    maxZoom: 18,
	    id: 'mapbox.dark',
	    accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
	}).addTo(map);
	
	<?php
	$url="https://services1.arcgis.com/0MSEUqKaxRlEPj5g/arcgis/rest/services/ncov_cases/FeatureServer/1/query?f=json&where=1%3D1&returnGeometry=false&spatialRel=esriSpatialRelIntersects&outFields=*&orderByFields=Confirmed%20desc,Country_Region%20asc,Province_State%20asc&outSR=102100&resultOffset=0&resultRecordCount=250&cacheHint=true";
	$ch=curl_init($url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);	
	curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'Content-Type : application/json',
			'Access-Control-Allow-Origin : *'
		]);
	$result= curl_exec($ch);
	curl_close($ch);
	?>
	var getCoronaJson=<?=$result?>;
	var coronaData=getCoronaJson.features;
    console.log(coronaData)

	
	for(i=0;i<coronaData.length;i++){
		var data=coronaData[i].attributes;
		var  circle = L.circle([data.Lat,data.Long_],{
			radius:100000,
			color:'red',
			fillColor:'#f03',
			fillOpacity:0.5
			
		}).addTo(map)
				.bindPopup(
						"Negara : "+data.Country_Region+"<br>"+
						"Provinsi : "+data.Province_State+"<br>"+
						"Terinfeksi : "+data.Confirmed+"<br>"+
						"Meninggal : "+data.Deaths+"<br>"+
						"Sembuh : "+data.Recovered+"<br>"
					).addTo(map)
	
	}


		
	
   </script>
