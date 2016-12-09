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
				Item name <br/><br />
				<input name="item" type="text"></input><br /><br />
				From
				<select name="store">
					<option value="coles">coles</option>
					<option value="aldi">aldi</option>
				</select><br /><br />
				<input type="submit" value="Find Location"></input>
				<?php
					if (array_key_exists('item', $_POST)) {
						echo '<br /><br />';
						echo(queryItem($public_handler, $_POST['item'], $_POST['store']));
					}
				?>
			</form>
		</center>
	</body>
</html>