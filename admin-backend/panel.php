<?php

include 'assets/api/admin_functions.php';
include 'assets/api/admin_db.php';
include 'assets/api/public_db.php';

session_start();

if (!array_key_exists('username', $_SESSION)) {
    header("Location: index.php");
}


if (array_key_exists('keywordList', $_POST)){
	insertItem($public_handler, $_POST['keywordList'], $_POST['itemLocation'], $_POST['storeLocation']);
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
				<li><a href='?category=item'>Insert Item</a>
			</ul>
		</div>

		<div id="main-content">
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
						default:
							break;
					}
				}
			?>
		</div>

	</body>
</html>