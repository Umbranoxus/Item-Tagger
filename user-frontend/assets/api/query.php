<?php
require 'public_db.php';

function queryList($handler, $itemList, $store)
{
  $list = preg_split('/\r\n|[\r\n]/', $itemList);
  $results = array();
  foreach ($list as $value) {
   array_push($results,  queryItem($handler, $value, $store));
  }
  return $results;
}

function queryItem($handler, $item, $store) {
  $not_found = 'Item not found';
  $item = strtolower($item);
  $queryItem = explode(" ", $item)[0];
  $query = $handler->prepare("SELECT * FROM items WHERE keywords LIKE :item AND store=:store");
  $query->bindValue(":item", '%' . $queryItem . '%');
  $query->bindValue(":store",  $store);
  $query->execute();

  $firstResult = '';
  $likely = '';
  while ($r = $query->fetch(PDO::FETCH_OBJ)) {
  	$keywords = strtolower($r->keywords);
  	$keywordList = explode(",", $keywords);
	foreach($keywordList as $keyword)
	{
		if ($firstResult = "")
		{
			$firstResult = $r->lat .'|'.$r->lon.'|'.$item.'|'. $r->location.'|'; //shot in the dark, can be improved upon
		}
		if ($item == $keyword)
		{
			return $r->lat.'|'.$r->lon.'|'.$item.'|'.$r->location.'|'; //exact result

		}
		if (strpos($item, $keyword) !== false)
		{
			$likely =$r->lat.'|'.$r->lon.'|'.$item.'|'. $r->location.'|'; //very possible result
		}
		//Keep looping to hopefully find an exact result
	}
  }
  if ($likely != "")
  {
	return $likely;
  }
  if ($firstResult != "")
  {
	return $firstResult;
  }
  return $not_found;
}


?>