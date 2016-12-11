<?php

function insertItem($handler, $lat, $lon, $keywordList, $itemLocation, $storeLocation) {
  $query = $handler->prepare("INSERT INTO items (lat, lon, keywords, location, store) VALUES (:lat, :lon,:keywords, :location, :store)");
  $query->bindParam(":lat", $lat);
  $query->bindParam(":lon", $lon);
  $query->bindParam(":keywords", $keywordList);
  $query->bindParam(":location", $itemLocation);
  $query->bindParam(":store", $storeLocation);
  $query->execute();
  $_SESSION['insertStatus'] = "Inserted Item Succesfully";
}

function insertStore($handler, $lat, $lon, $name) {
  $query = $handler->prepare("INSERT INTO stores (latitude, longitude, name) VALUES (:lat, :lon, :name)");
  $query->bindParam(":lat", $lat);
  $query->bindParam(":lon", $lon);
  $query->bindParam(":name", $name);
  $query->execute();
  $_SESSION['insertStatus'] = "Inserted Item Succesfully";
}

?>