<?php

include 'assets/api/admin_functions.php';
include 'assets/api/admin_db.php';
include 'assets/api/public_db.php';

session_start();

if (!array_key_exists('username', $_SESSION)) {
    header("Location: index.php");
}

if (array_key_exists('keywordList', $_POST)){
	insertItem($public_handler, $_POST['lat'], $_POST['lon'], $_POST['keywordList'], $_POST['itemLocation'], explode('|', $_POST['storeLocation'])[0]);
}
if (array_key_exists('name', $_POST)) {
	insertStore($public_handler,$_POST['lat'],$_POST['lon'], $_POST['name']);
}


?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="assets/css/panel/style.css">
	</head>
	<body>
		<div id="panel-box">
		    Welcome, <?php echo $_SESSION['username'];?> | 
			<a href="logout.php">Log Out</a>
		</div>

		<div id="left-panel">
			<ul>
				<li><a href='?category=item'>Add Item(s) to Store</a>
				<li><a href='?category=storeAdder'>Add Supported Store</a>
			</ul>
		</div>
			<?php
				if (array_key_exists('insertStatus', $_SESSION)) {
   					 echo $_SESSION['insertStatus'];
   					 unset($_SESSION['insertStatus']);
				}
				if (array_key_exists('category', $_GET)) {
					switch ($_GET['category']) {
						case 'item':
							echo file_get_contents("assets/html/item_form.htm");
							break;
						case 'storeAdder':
							echo file_get_contents("assets/html/store_adder_form.htm");
							break;
						default:
							break;
					}
				}
			?>
		</div>
	</body>
</html>