<?php
	include_once 'dependencies.php';
	include_once 'functions/revenue.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Umsatz</title>
		<?php
			echo $head_dependencies;
		?>
	</head>

	<body>
		<?php include 'header.php';
			if(((!isset($_SESSION['adminrechte'])) || $_SESSION['adminrechte'] != 2)) {
				include'footer.php';
				die('Du hast keinen Zugriff auf diese Seite. Bitte logge dich als ein Administrator ein.');
			}
		?>
		<div class="container">
			<div class="row">
				<h3 class="pr-2">Umsatz anzeigen für</h3>
				<div class="dropdown">
					<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Auswahl treffen</button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<?php
							echo '<a class="dropdown-item mx-0 my-0 pt-0 pb-0 pl-2 pr-2" onclick="drawGraph(\''.getRevenue('days') .'\')">Letze Woche</a>';
							echo '<a class="dropdown-item mx-0 my-0 pt-0 pb-0 pl-2 pr-2" onclick="drawGraph(\''.getRevenue('weeks') .'\')">Letzer Monat</a>';
							echo '<a class="dropdown-item mx-0 my-0 pt-0 pb-0 pl-2 pr-2" onclick="drawGraph(\''.getRevenue('months') .'\')">Letztes Jahr</a>';
						?>
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
