<script type="text/javascript">
   
    var map = L.map('mapid').setView([-6.8625462,107.9209914], 17);
    
    
    

 
    <?php
    $getdata=$db->get('data_rumah');
   $Marker=array();
	foreach ($getdata as $row) {
		$Json=null;
		$Json['type']="Feature";
		$Json['properties']=[
                    "name"=>$row['nama_rumah'],
                    "icon"=>($row['point_marker']=='')?assets('icons/marker_home.png'):assets('unggah/marker/'.$row['point_marker']),
                    "Popup"=>('<center>                            
                            <img src="'.assets('unggah/rumah/'.$row['img_rumah']).'"width=100%"</br></br>').
                            "</br>Pemilk Rumah : ".$row['nama_rumah'].
                            "</br>Alamat : ".$row['alamat'].
                            '</br><a href="'.url($url.'&info&id='.$row['id_rumah']).'"" name="info" class="btn btn-default"  > <i class="fa fa-info"></i></a></div>'                   
                                    ];
		$Json['geometry']=[
									"type" => "Point",
									"coordinates" => [$row['langitude'],$row['latitude']] 
									];	

		$Marker[]=$Json;
    }
    
    ?>
    
  var geojsonMarker = <?=json_encode($Marker, JSON_PRETTY_PRINT)?>;
 
  var myIcon = L.Icon.extend({
	    options: {
	    	iconSize: [50, 60]
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
                layer.bindPopup(feature.properties.Popup);
		    }
        }
    }).addTo(map);

    </script>