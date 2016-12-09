<?php
require 'public_db.php';

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
			$firstResult = "We're not to sure, maybe " . $r->location . ' at ' . $r->store; //shot in the dark, can be improved upon
		}
		if ($item == $keyword)
		{
			return 'Definitely ' . $r->location . ' at ' . $r->store; //exact result
		}
		if (strpos($item, $keyword) !== false)
		{
			$likely = 'Most likely ' . $r->location . ' at ' . $r->store; //very possible result
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