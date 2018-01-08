<?php include_once 'dependencies.php'; ?>
<!DOCTYPE HTML>
<html>
	<head>
		<title></title>
		<?php
			echo $head_dependencies;
		?>
	</head>

	<body>
		<?php include 'header.php';
		if(((!isset($_SESSION['adminrechte'])) || $_SESSION['adminrechte'] != 2)) {
			include('footer.php');
		die('Du hast keinen Zugriff auf diese Seite. Bitte logge dich als ein Administrator ein.'); } //Verweigert leuten den Zugriff auf diese Seite?>
		<div class="container">
			<div class="row">
				<h3>Umsatz anzeigen für</h3>
				<div class="dropdown">
				  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    Dropdown button
				  </button>
				  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				    <a class="dropdown-item" href="#">Action</a>
				    <a class="dropdown-item" href="#">Another action</a>
				    <a class="dropdown-item" href="#">Something else here</a>
				  </div>
				</div>
			</div>
			<div class="row">
			</div>
		</div>
		<?php include 'footer.php'; ?>
	</body>
</html>
