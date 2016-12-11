<?php
include 'assets/api/query.php';
include 'assets/api/public_db.php';
?>

<html>
	<head>
	</head>
	<body>
		<center>
			<form action="index.php" method="post">
				<div id="map" style="width:400px;height:400px;"></div><br />
				<input type="hidden" id="store" name="store">
				
				<script>
			      var map;
			      function initMap() {
			        map = new google.maps.Map(document.getElementById('map'), {
			          center: {lat: -27.365669431751215, lng: 153.01551818847656},
			          zoom: 14
			        });
			        google.maps.event.addListener(map,'click',function(event) {
		                 var xmlHttp = new XMLHttpRequest();
						 xmlHttp.open( "GET", 'http://localhost/codechallenge.com/assets/api/closest_store.php?lat=' + event.latLng.lat() + '&lon=' + event.latLng.lng() +'&wn=0', false ); // false for synchronous request
						 xmlHttp.send( null );
						 document.getElementById('store').value = xmlHttp.responseText;
		             });
			      }
				</script><br />
				
					<?php
						if (array_key_exists('store', $_POST)) {
							var_dump(queryList($public_handler, $_POST['items'], $_POST['store']));
						} else {
							echo '<textarea name="items" rows="4" cols="50"></textarea><br /><br />';
						}
					?>
					<input type="submit" value="Find Location"></input>
			</form>
		</center>
	</body>
	<script src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap"
async defer></script>
</html>