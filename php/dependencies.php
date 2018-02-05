<?php
	session_start();
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "mensa";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$conn->query("SET CHARSET 'utf8'");//Für korrekte Ausgabe der Umlaute;
	$expireDate = date("Y-m-d", strtotime("-21 day"));
	$deleteOldTagesangebote = "DELETE FROM mensa.tagesangebot WHERE datum <= '$expireDate'";
	$conn->query($deleteOldTagesangebote); //Löscht alle Einträge,die Älter als 3 Wochen sind(21 tage)

	$head_dependencies = '
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="../vendor/fontawesome/css/fontawesome-all.min.css">
		<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../vendor/tablesorter/css/theme.jui.css">
		<link rel="stylesheet" type="text/css" href="../style/style.css">
		<link rel="stylesheet" type="text/css" href="../style/animate.css">
		<link rel="icon" href="../images/icon.ico">
		<script src="../vendor/Chart.js/Chart.min.js"></script>
	';

	$footer_dependencies = '
		<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
		<script src="../vendor/jquery/sticky_nav.js"></script>
		<script src="../vendor/bootstrap/js/popper.min.js"></script>
		<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="../vendor/tether/js/tether.min.js"></script>
		<script src="../vendor/tablesorter/js/jquery.tablesorter.js"></script>
		<script src="../vendor/tablesorter/js/jquery.tablesorter.widgets.js"></script>
		<script src="../vendor/tablesorter/js/jquery.tablesorter.pager.js"></script>
		<script src="../js/script.js"></script>
	';

	$Alert = ''; //Diese Variable wird verwendet um den Nutzer zu benachrichtigen. Zum Beispiel ob eine Mail erfolgreich versendet wurde.

	/*Funktionen für Alert boxen */
	function successMessage($text) {
		return "<div class='alert alert-success alert-dismissable fade show mt-4'>
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>".$text."</div>";
	}

	function dangerMessage($text) {
		return "<div class='alert alert-danger alert-dismissable fade show mt-4'>
		<a href='essensliste.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>".$text."</div>";
	}

	function confModal($headerText) {
		echo "
		<div class='modal fade' id='confirm-delete' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
			<div class='modal-dialog'>
				<div class='modal-content'>
					<div class='modal-header'>
						<strong>".$headerText."</strong>
					</div>
					<div class='modal-body'>
						Man kann die Löschung <strong>NICHT</strong> rückgängig machen.
					</div>
					<div class='modal-footer'>
						<button type='button' class='btn btn-default' data-dismiss='modal'>Abbrechen</button>
						<a class='btn btn-danger btn-ok'>Löschen</a>
					</div>
				</div>
			</div>
		</div> ";
	}

	// php mailer setup
	require 'phpmailer/PHPMailerAutoload.php';
	// Neue Instanz von PhpMailer
	$mail = new PHPMailer();
	// Php Mailer Host
	$mail->Host = "smtp.gmail.com";
	// Erlaube SMTP
	$mail->isSMTP();
	// setzt SMTP Authentifikation auf TRUE
	$mail->SMTPAuth = true;
	// Login details für den Gmail Account
	$mail->Username = "foodmengroup@gmail.com";
	$mail->Password = "!tsSchuleF00Dmengrp";
	// Schutzprotokoll für SMTP
	$mail->SMTPSecure = "ssl";
	// Port
	$mail->Port = 465;
	// Erlaubt es uns HTML Emails zu schicken
	$mail->isHTML(true);
?>
