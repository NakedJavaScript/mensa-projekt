<?php include_once 'dependencies.php'; ?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Umsatz</title>
		<?php
			echo $headDependencies;
		?>
	</head>

	<body>
		<?php include 'header.php';
		if(((!isset($_SESSION['adminrechte'])) || $_SESSION['adminrechte'] != 2)) {
			include'footer.php';
		die('Du hast keinen Zugriff auf diese Seite. Bitte logge dich als ein Administrator ein.'); } //Verweigert leuten den Zugriff auf diese Seite?>
		<div class="container">
			<div class="row">
				<h3>Umsatz anzeigen für</h3> &nbsp&nbsp
				<div class="dropdown">
				  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    Dropdown button
				  </button>
				  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				    <a class="dropdown-item" href="#" onclick=drawGraph()>Action</a>
				    <a class="dropdown-item" href="#" onclick=drawGraph()>Another action</a>
				    <a class="dropdown-item" href="#" onclick=drawGraph()>Something else here</a>
				  </div>
				</div>
			</div>
			<div class="row">
				<canvas id="myChart" width="400" height="400"></canvas>
			</div>
		</div>
		<?php include 'footer.php'; ?>
	</body>
</html>
