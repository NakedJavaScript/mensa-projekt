<?php
	// Initial session start and connection settings for the mysql database
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

	$conn->query("SET CHARSET 'utf8'"); // Allows umlauts
	$expireDate = date("Y-m-d", strtotime("-21 day")); // Deletes daily meals who are older than 3 weeks
	$deleteOldTagesangebote = "DELETE FROM mensa.tagesangebot WHERE datum <= '$expireDate'";
	$conn->query($deleteOldTagesangebote);

	// Set the links, scripts and meta data in the header
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

	// Set the scripts in the footer
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

	$Alert = ''; // We use this variable to show our success and danger messages

	// Functions for the alert boxes
	function successMessage($text) {
		return "<div class='alert alert-success alert-dismissable fade show mt-4'>
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>".$text."</div>";
	}

	function dangerMessage($text) {
		return "<div class='alert alert-danger alert-dismissable fade show mt-4'>
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>".$text."</div>";
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

	// php mailer plugin setup
	require 'phpmailer/PHPMailerAutoload.php';
	$mail = new PHPMailer(); // Creates a new instance of PHPMailer
	$mail->Host = "smtp.gmail.com"; // Set the send hosts
	$mail->isSMTP(); // Allow SMTP
	$mail->SMTPAuth = true; // Allow SMTP Authentification
	$mail->Username = "foodmengroup@gmail.com"; // Account details of the sender
	$mail->Password = "!tsSchuleF00Dmengrp";
	$mail->SMTPSecure = "ssl"; // Secure protocol for the SMTP
	$mail->Port = 465; // Which port to use
	$mail->isHTML(true); // Allows HTML E-Mails
?>
