<?php
	session_start();
	session_destroy(); // Ends the session
	header("refresh: 1.5 ; url = index.php");
	include 'dependencies.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<?php echo $headDependencies; ?>
		<title>Mensa Logout </title>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="modalbox success col-sm-8 col-md-6 col-lg-5 float-none ml-auto mr-auto animate">
					<div class="icon">
						<i class="fas fa-check-circle fa-5x success-icn"></i>
					</div>
					<div class="pb-2">
						<h1>Logout Erfolgreich!</h1>
						<p>Sie haben sich erfolgreich ausgeloggt.</p>
					</div>
					<a href="index.php">
						<button type="button" class="redo btn rounded mb-2">Zurück zur Startseite</button>
					</a>
					<span class="change">Klicken Sie entweder auf den Button um zurück zur Startseite zu gelangen oder warten Sie einen moment bevor Sie automatisch zurückgeleitet werden.</span>
				</div>
			</div>
		</div>
	</body>
</html>
