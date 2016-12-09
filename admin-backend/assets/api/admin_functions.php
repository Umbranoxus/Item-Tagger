<?php

function insertItem($handler, $keywordList, $itemLocation, $storeLocation) {
  $query = $handler->prepare("INSERT INTO items (keywords, location, store) VALUES (:keywords, :location, :store)");
  $query->bindParam(":keywords", $keywordList);
  $query->bindParam(":location", $itemLocation);
  $query->bindParam(":store", $storeLocation);
  $query->execute();
  $_SESSION['insertStatus'] = "Inserted Item Succesfully";
}

?>