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

		$conn->query("SET NAMES 'utf8'");//Für korrekte Ausgabe der Umlaute;


	$head_dependencies = '
		 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta charset="UTF-8">
		<script defer src="../vendor/fontawesome/js/fontawesome-all.min.js"></script>
		<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../style/style.css">
		<link rel="stylesheet" type="text/css" href="../style/animate.css">
		<link rel="icon" href="../images/icon.ico">
';
	$footer_dependencies = '<!-- Javascript -->
		<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>

		<script src="../vendor/bootstrap/js/popper.min.js"></script>
		<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="../vendor/tether/js/tether.min.js"></script>
		<script src="../js/script.js"></script>
';


$Output = ''; //Diese Variable wird verwendet um den Nutzer zu benachrichtigen. Zum Beispiel ob eine Mail erfolgreich versendet wurde.

/*Hier stehen die Funktionen für benutzerliste.php; */
//Code zum löschen eines Nutzers
			if (isset($_GET['delete?userID'])) {
				$userID = $_GET['delete?userID'];
				$delete = "DELETE FROM benutzer WHERE benutzer_ID = $userID";
				if ($conn->query($delete) === TRUE) {
					$Output = "<div class='alert alert-success alert-dismissable'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Nutzer wurde erfolgreich entfernt</div>";
				} else {
					$Output = "<div class='alert alert-danger alert-dismissable '>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Error:</strong> " . $delete . "<br>" . $conn->error . "</div>";
					}
			}

			//Code um einen Nutzer anzulegen

			if (isset($_POST['neuer_nutzer'])) {
				if (!is_numeric($_POST['kontostand'])) { //prüft ob im Textfeld nur Zahlen eingegeben wurden.
				$Output = "<div class='alert alert-danger alert-dismissable'>
  <a href='essensliste.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Im Feld <strong>'Kontostand'</strong> sind nur numerische Zeichen erlaubt.</div>";
				}
				else if ($_POST['kontostand'] < 0) {//prüft ob es keine negative Zahl ist
					$Output= "<div class='alert alert-danger alert-dismissable'>
  <a href='essensliste.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Im Feld <strong>'Kontostand'</strong> sind keine Negativen Zahlen erlaubt.</div>";
}
				else {
				$vorname = $_POST['vorname'];
				$nachname = $_POST['nachname'];
				$email = $_POST['email'];
				$passwort = $_POST['passwort'];
				$kontostand = $_POST['kontostand'];
				$adminrechte = $_POST['adminrechte'];
				$pepper = 'mensa_pfeffer';

				$options = array("cost"=>12);
				$hashPassword = password_hash($passwort . $pepper,PASSWORD_BCRYPT,$options);
				$check = $conn->query("SELECT * FROM benutzer WHERE email = '$email'"); //sql befehl zum prüfen ob es den User bereits gibt

										if($check->num_rows < 1 ) {   //Wenn keine Zeilen zurückgegeben werden, dann wird das Produkt eingefügt.
										$insert = "INSERT INTO benutzer (vorname, nachname,email, passwort, kontostand, admin_rechte)
										VALUES('".$vorname."', '".$nachname."', '".$email."','".$hashPassword."', '".$kontostand."', ". $adminrechte .")";
												$result = $conn->query($insert);
														if($result === true) {
																$Output = "<div class='alert alert-success alert-dismissable'>
																<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Nutzer wurde erfolgreich angelegt</div>";
																}
																		else {
																					$Output = "<div class='alert alert-danger alert-dismissable'>
																						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Error:</strong> " . $insert . "<br>" . $conn->error . "</div>";
																					}
																				}
																				else { //Ausgabe wenn es diesen Nutzer bereits gibt
																					$Output = "<div class='alert alert-danger alert-dismissable'>
																	<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Es gibt bereits einen Nutzer mit dieser Email.</div>";
																				}

															}
														}








/* Hier stehen die Funktionen für essensliste.php Seite*/

			//Code um eine Speise hinzuzufügen
			if (isset($_POST['Essen_hinzufügen'])) {
				$name = strtoupper(trim($_POST['name']));
				$all_inh = strtoupper(trim($_POST['allergene']));
				$sonst = strtoupper(trim($_POST['sonstiges']));
				$preis = $_POST['preis'];

				if (!is_numeric($preis)) { //prüft ob im Textfeld nur Zahlen eingegeben wurden.
				$Output = "<div class='alert alert-danger alert-dismissable'>
  <a href='essensliste.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Im Feld <strong>'Preis'</strong> sind nur numerische Zeichen erlaubt.</div>";
				}
				else if ($_POST['preis'] < 0) {//prüft ob es keine negative Zahl ist
					$Output= "<div class='alert alert-danger alert-dismissable'>
  <a href='essensliste.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Im Feld <strong>'Preis'</strong> sind keine Negativen Zahlen erlaubt.</div>";
																			}
								else {
											$preis = doubleval($_POST['preis']); //wandelt preis in double um.
											$check = $conn->query("SELECT * FROM speise WHERE name = '$name'"); //sql befehl zum prüfen ob es die Speise bereits gibt
														if($check->num_rows < 1 ) {   //Wenn keine Zeilen zurückgegeben werden, dann wird das Produkt eingefügt.
																$insert = "INSERT INTO speise (name,allergene_inhaltsstoffe,sonstiges,preis)
																VALUES ('$name', '$all_inh', '$sonst','$preis')";

																	if ($conn->query($insert) === TRUE) { //Wenn erfolgreich eingefügt, dann wird erfolgsmessage angezeigt
																			$Output = "<div class='alert alert-success alert-dismissable'>
	  																	<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Speise wurde erfolgreich hinzugefügt</div>";
																	}
																else {
																	$Output = "<div class='alert alert-danger alert-dismissable'>
	    														<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Error: " . $sql . "<br>" . $conn->error . "</div>";
																		}
					}
					else {
						$Output = "<div class='alert alert-danger alert-dismissable'>
	  <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Es gibt bereits ein Produkt mit diesem Namen.</div>";
						}

				}
			}
			//Code zum löschen einer Speise
			if (isset($_GET['delete?speiseID'])) {
				$speiseID = $_GET['delete?speiseID'];
				$delete = "DELETE FROM speise WHERE speise_ID = $speiseID";
				if ($conn->query($delete) === TRUE) {
					$Output = "<div class='alert alert-success alert-dismissable'>
  <a href='essensliste.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Speise wurde erfolgreich entfernt</div>";
				} else {
					$Output = "<div class='alert alert-danger alert-dismissable'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Error:</strong> " . $delete . "<br>" . $conn->error . "</div>";
					}
			}
?>
