<?php
include 'public_db.php';
$lat = $_GET['lat'];
$lon = $_GET['lon'];
$withName = $_GET['wn'];
$maxDistance = 3.10686;

$query = $public_handler->prepare("SELECT id, name, latitude, longitude, 3956 * 2 * 
          ASIN(SQRT( POWER(SIN((:lat - latitude)*pi()/180/2),2)
          +COS(:lat*pi()/180 )*COS(latitude*pi()/180)
          *POWER(SIN((:lon-longitude)*pi()/180/2),2))) 
          as distance FROM stores WHERE 
          longitude between (:lon-:maxDistance/cos(radians(:lat))*69) 
          and (:lon+:maxDistance/cos(radians(:lat))*69) 
          and latitude between (:lat-(:maxDistance/69)) 
          and (:lat+(:maxDistance/69)) 
          having distance < :maxDistance ORDER BY distance limit 1"); //Haversine formula

$query->bindParam(":lat", $lat);
$query->bindParam(":lon", $lon);
$query->bindParam(":maxDistance", $maxDistance);
$query->execute();

while ($r = $query->fetch(PDO::FETCH_OBJ)) {
     if ($withName == 0)
     {
          echo $r->id;
     } else {
          echo $r->id . '|' . $r->name;
     }
}

?>