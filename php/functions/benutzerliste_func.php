<?PHP
	include_once 'misc.php';

	//Code zum löschen eines Nutzers
	if (isset($_GET['delete?userID']) ) {
			$userID = $_GET['delete?userID'];
			$delete = "DELETE FROM benutzer WHERE benutzer_ID = $userID";
			if ($conn->query($delete) == TRUE) {
				$Alert = successMessage('Nutzer wurde erfolgreich entfernt');
        header('refresh: 1.5 ; url = benutzerliste.ph');
			  die();
			}
			else {
				$Alert = dangerMessage("Es ist etwas schief gelaufen, bitte versuchen Sie es erneut!");
        header('refresh: 1.5 ; url = benutzerliste.ph');
			  die();
			}
	}

						//Code um einen Nutzer anzulegen
						if (isset($_POST['neuer_nutzer'])) {
							$_POST = sanitize_form($_POST);
							if ($_POST) {
							if (!is_numeric($_POST['kontostand'])) { //prüft ob im Textfeld nur Zahlen eingegeben wurden.
								$Alert = dangerMessage("Im Feld <strong>'Kontostand'</strong> sind nur numerische Zeichen erlaubt.");
								header('refresh:1.5 ; url = benutzerliste.ph');
								die();
							}
							else if ($_POST['kontostand'] < 0) {//prüft ob es keine negative Zahl ist
								$Alert= dangerMessage("Im Feld <strong>'Kontostand'</strong> sind keine Negativen Zahlen erlaubt.");
								header('refresh: 1.5 ; url = benutzerliste.ph');
								die();
							}
							else if(strpos($_POST['email'], '@') !== false) { //Falls die Eingabe ein @ Zeichen enthält erhält der Nutzer unten stehende Nachricht
								$Alert = dangerMessage("Im Feld Email soll keine Domäne angegeben werden, bitte entfernen Sie das <strong>'@'</strong> Zeichen und die <strong>Domäne</strong>");
								header('refresh: 1.5 ; url = benutzerliste.ph');
								die();
							}
							else {
								$vorname = trim($_POST['vorname']);
								$nachname = trim($_POST['nachname']);
								$email = trim($_POST['email']);
								$email = strtolower($email)."@its-stuttgart.de";
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
										$Alert = successMessage('Nutzer wurde erfolgreich angelegt');
										header('refresh: 1.5 ; url = benutzerliste.ph');
										die();
									}
									else {
										$Alert = dangerMessage("Der Nutzer konnte nicht angelegt werden, bitte versuchen Sie es erneut.");
										header('refresh: 1.5 ; url = benutzerliste.ph');
										die();
									}
								}
								else { //Ausgabe wenn es diesen Nutzer bereits gibt
									$Alert = dangerMessage("Es gibt bereits einen Nutzer mit dieser Email.");
									header('refresh: 1.5 ; url = benutzerliste.ph');
									die();
								}

							}//ende von else
							} else {
								$Alert = dangerMessage('Fehler: Invalide Eingabe.');
							}
						}//ende von if isset

																							if (isset($_POST['bearbeiten_nutzer'])) {
																								$_POST = sanitize_form($_POST);
																								if ($_POST) {
																								if (!is_numeric($_POST['kontostand'])) { //prüft ob im Textfeld nur Zahlen eingegeben wurden.
																									$Alert = dangerMessage("Im Feld <strong>'Kontostand'</strong> sind nur numerische Zeichen erlaubt.");
																									header('refresh: 1.5 ; url = benutzerliste.ph');
																									die();
																								}
																									else if ($_POST['kontostand'] < 0) {//prüft ob es keine negative Zahl ist
																										$Alert= dangerMessage("Im Feld <strong>'Kontostand'</strong> sind keine Negativen Zahlen erlaubt.");
																										header('refresh: 1.5 ; url = benutzerliste.ph');
																										die();
																									}
																										else if(strpos($_POST['email'], '@') !== false) {
																											$Alert = dangerMessage("Im Feld email soll keine Domäne angegeben werden, bitte entfernen Sie das <strong>'@'</strong> Zeichen und die <strong>Domäne</strong>");
																											header('refresh: 1.5 ; url = benutzerliste.ph');
																											die();
																										}
																								else {
																											$nutzerID = $_POST['benutzer_ID'];
																											$vorname = trim($_POST['vorname']);//trim entfernt white space.
																											$nachname = trim($_POST['nachname']);
																											$email = trim($_POST['email']);
																											$email = strtolower($email)."@its-stuttgart.de";
																											$kontostand = $_POST['kontostand'];
																											$adminrechte = $_POST['adminrechte'];
																											$pepper = 'mensa_pfeffer';

																											if( !empty($_POST['passwort']) ) { //falls der Admin ein neues Passwort setzt wird die variable $passwort gesetzt
																												$passwort = $_POST['passwort'];
																												//passwort wird gehasht
																												$options = array("cost"=>12);
																												$hashPassword = password_hash($passwort . $pepper,PASSWORD_BCRYPT,$options);
																											} else { }
																									//aktuelle email des zu bearbeitenden Users wird ausgewählt.
																									$mysqlItem = $conn->query("SELECT email FROM mensa.benutzer WHERE benutzer_ID = $nutzerID");
																									$mysqlItem = $mysqlItem->fetch_assoc();

																									if($email != $mysqlItem['email']) { //falls die email adresse geändert wurde wird geprüft ob die Eingetragene bereits vorhanden ist.
																										$check = $conn->query("SELECT * FROM benutzer WHERE email = '$email'"); //sql befehl zum prüfen ob es den User bereits gibt

																											if($check->num_rows < 1 ) {   //Wenn keine Zeilen zurückgegeben werden, dann wird das Produkt eingefügt.
																												$update = "UPDATE mensa.benutzer SET 	vorname= '$vorname',
																																						nachname = '$nachname',
																																						email = '$email',
																																						kontostand = '$kontostand',
																																						admin_rechte = $adminrechte";
																														if ( !empty($_POST['passwort']) ) {
																															$update = $update . " , passwort = $hashPassword";
																														} else { }

																														$update = $update . " WHERE benutzer_ID = $nutzerID";

																														$result = $conn->query($update);
																																if ($result == true) {
																																	$Alert = successMessage($vorname . " " . $nachname . ' wurde erfolgreich bearbeitet');
																																	header('refresh: 1.5 ; url = benutzerliste.ph');
																																	die();
																																} else {
																																	$Alert = dangerMessage("Es ist etwas schief gelaufen, bitte versuchen Sie es erneut.");
																																	header('refresh: 1.5 ; url = benutzerliste.ph');
																																	die();
																																}
																											}
																												else { //Ausgabe wenn es diesen Nutzer bereits gibt
																													$Alert = dangerMessage("Es gibt bereits einen Nutzer mit dieser Email.");
																													header('refresh: 1.5 ; url = benutzerliste.ph');
																													die();
																												}
																									}

																														else { //Wenn email adresse gleich bleibt wird update sofort durchgeführt.
																															$update = "UPDATE mensa.benutzer SET vorname= '$vorname'
																															, nachname = '$nachname'
																															, email = '$email'
																															, kontostand = '$kontostand'
																															, admin_rechte = $adminrechte";
																															if(!empty($_POST['passwort'])) {
																																$update = $update . " , passwort = '$hashPassword'";
																															}

																															$update = $update . " WHERE benutzer_ID = $nutzerID";
																															$result = $conn->query($update);
																															if($result == true) {
																																$Alert = successMessage($vorname . " " . $nachname . ' wurde erfolgreich bearbeitet');
																																header('refresh: 1.5 ; url = benutzerliste.ph');
																																die();
																															}
																															else {
																																$Alert = dangerMessage("Es ist etwas schief gelaufen, bitte versuchen Sie es erneut.");
																																header('refresh: 1.5 ; url = benutzerliste.ph');
																																die();

																															}
																														}
																													}//ende von else
																								} else {
																									$Alert = dangerMessage('Fehler: Invalide Eingabe.');
																								}
																							}//ende von if isset
?>
