<?PHP
	//Code zum löschen eines Nutzers
	if (isset($_GET['delete?userID'])) {
		$userID = $_GET['delete?userID'];
		$delete = "DELETE FROM benutzer WHERE benutzer_ID = $userID";
		if ($conn->query($delete) == TRUE) {
			$alert = successMessage('Nutzer wurde erfolgreich entfernt');
			header('refresh: 1.5 ; url = userList.php');
			die();
		}
		else {
			$alert = dangerMessage("Es ist etwas schief gelaufen, bitte versuchen Sie es erneut!");
			header('refresh: 1.5 ; url = userList.php');
			die();
		}
	}

						//Code um einen Nutzer anzulegen
						if (isset($_POST['newUser'])) {
							if (!is_numeric($_POST['balance'])) { //prüft ob im Textfeld nur Zahlen eingegeben wurden.
								$alert = dangerMessage("Im Feld <strong>'Kontostand'</strong> sind nur numerische Zeichen erlaubt.");
								header('refresh:1.5 ; url = userList.php');
								die();
							}
							else if ($_POST['balance'] < 0) {//prüft ob es keine negative Zahl ist
								$alert= dangerMessage("Im Feld <strong>'Kontostand'</strong> sind keine Negativen Zahlen erlaubt.");
								header('refresh: 1.5 ; url = userList.php');
								die();
							}
							else if(strpos($_POST['email'], '@') !== false) { //Falls die Eingabe ein @ Zeichen enthält erhält der Nutzer unten stehende Nachricht
								$alert = dangerMessage("Im Feld Email soll keine Domäne angegeben werden, bitte entfernen Sie das <strong>'@'</strong> Zeichen und die <strong>Domäne</strong>");
								header('refresh: 1.5 ; url = userList.php');
								die();
							}
							else {
								$firstName = trim($_POST['firstName']);
								$lastName = trim($_POST['lastName']);
								$email = trim($_POST['email']);
								$email = strtolower($email)."@its-stuttgart.de";
								$password = $_POST['password'];
								$balance = $_POST['balance'];
								$adminRights = $_POST['adminRights'];
								$pepper = 'mensa_pfeffer';

								$options = array("cost"=>12);
								$hashPassword = password_hash($password . $pepper,PASSWORD_BCRYPT,$options);
								$check = $conn->query("SELECT * FROM benutzer WHERE email = '$email'"); //sql befehl zum prüfen ob es den User bereits gibt

								if($check->num_rows < 1 ) {   //Wenn keine Zeilen zurückgegeben werden, dann wird das Produkt eingefügt.
									$insert = "INSERT INTO benutzer (vorname, nachname,email, passwort, kontostand, admin_rechte)
									VALUES('".$firstName."', '".$lastName."', '".$email."','".$hashPassword."', '".$balance."', ". $adminRights .")";
									$result = $conn->query($insert);
									if($result === true) {
										$alert = successMessage('Nutzer wurde erfolgreich angelegt');
										header('refresh: 1.5 ; url = userList.php');
										die();
									}
									else {
										$alert = dangerMessage("Der Nutzer konnte nicht angelegt werden, bitte versuchen Sie es erneut.");
										header('refresh: 1.5 ; url = userList.php');
										die();
									}
								}
								else { //Ausgabe wenn es diesen Nutzer bereits gibt
									$alert = dangerMessage("Es gibt bereits einen Nutzer mit dieser Email.");
									header('refresh: 1.5 ; url = userList.php');
									die();
								}

							}//ende von else
						}//ende von if isset

																							if (isset($_POST['bearbeiten_nutzer'])) {
																								if (!is_numeric($_POST['balance'])) { //prüft ob im Textfeld nur Zahlen eingegeben wurden.
																									$alert = dangerMessage("Im Feld <strong>'Kontostand'</strong> sind nur numerische Zeichen erlaubt.");
																									header('refresh: 1.5 ; url = userList.php');
																									die();
																								}
																									else if ($_POST['balance'] < 0) {//prüft ob es keine negative Zahl ist
																										$alert= dangerMessage("Im Feld <strong>'Kontostand'</strong> sind keine Negativen Zahlen erlaubt.");
																										header('refresh: 1.5 ; url = userList.php');
																										die();
																									}
																										else if(strpos($_POST['email'], '@') !== false) {
																											$alert = dangerMessage("Im Feld email soll keine Domäne angegeben werden, bitte entfernen Sie das <strong>'@'</strong> Zeichen und die <strong>Domäne</strong>");
																											header('refresh: 1.5 ; url = userList.php');
																											die();
																										}
																								else {
																											$nutzerID = $_POST['userID'];
																											$firstName = trim($_POST['firstName']);//trim entfernt white space.
																											$lastName = trim($_POST['lastName']);
																											$email = trim($_POST['email']);
																											$email = strtolower($email)."@its-stuttgart.de";
																											$balance = $_POST['balance'];
																											$adminRights = $_POST['adminRights'];
																											$pepper = 'mensa_pfeffer';

																											if( !empty($_POST['password']) ) { //falls der Admin ein neues Passwort setzt wird die variable $password gesetzt
																												$password = $_POST['password'];
																												//password wird gehasht
																												$options = array("cost"=>12);
																												$hashPassword = password_hash($password . $pepper,PASSWORD_BCRYPT,$options);
																											} else { }
																									//aktuelle email des zu bearbeitenden Users wird ausgewählt.
																									$mysqlItem = $conn->query("SELECT email FROM mensa.benutzer WHERE benutzer_ID = $nutzerID");
																									$mysqlItem = $mysqlItem->fetch_assoc();

																									if($email != $mysqlItem['email']) { //falls die email adresse geändert wurde wird geprüft ob die Eingetragene bereits vorhanden ist.
																										$check = $conn->query("SELECT * FROM benutzer WHERE email = '$email'"); //sql befehl zum prüfen ob es den User bereits gibt

																											if($check->num_rows < 1 ) {   //Wenn keine Zeilen zurückgegeben werden, dann wird das Produkt eingefügt.
																												$update = "UPDATE mensa.benutzer SET 	vorname= '$firstName',
																																						nachname = '$lastName',
																																						email = '$email',
																																						kontostand = '$balance',
																																						admin_rechte = $adminRights";
																														if ( !empty($_POST['password']) ) {
																															$update = $update . " , passwort = $hashPassword";
																														} else { }

																														$update = $update . " WHERE benutzer_ID = $nutzerID";

																														$result = $conn->query($update);
																																if ($result == true) {
																																	$alert = successMessage($firstName . " " . $lastName . ' wurde erfolgreich bearbeitet');
																																	header('refresh: 1.5 ; url = userList.php');
																																	die();
																																} else {
																																	$alert = dangerMessage("Es ist etwas schief gelaufen, bitte versuchen Sie es erneut.");
																																	header('refresh: 1.5 ; url = userList.php');
																																	die();
																																}
																											}
																												else { //Ausgabe wenn es diesen Nutzer bereits gibt
																													$alert = dangerMessage("Es gibt bereits einen Nutzer mit dieser Email.");
																													header('refresh: 1.5 ; url = userList.php');
																													die();
																												}
																									}

																														else { //Wenn email adresse gleich bleibt wird update sofort durchgeführt.
																															$update = "UPDATE mensa.benutzer SET vorname= '$firstName'
																															, nachname = '$lastName'
																															, email = '$email'
																															, kontostand = '$balance'
																															, admin_rechte = $adminRights";
																															if(!empty($_POST['password'])) {
																																$update = $update . " , password = '$hashPassword'";
																															}

																															$update = $update . " WHERE benutzer_ID = $nutzerID";
																															$result = $conn->query($update);
																															if($result == true) {
																																$alert = successMessage($firstName . " " . $lastName . ' wurde erfolgreich bearbeitet');
																																header('refresh: 1.5 ; url = userList.php');
																																die();
																															}
																															else {
																																$alert = dangerMessage("Es ist etwas schief gelaufen, bitte versuchen Sie es erneut.");
																																header('refresh: 1.5 ; url = userList.php');
																																die();

																															}
																														}
																								}//ende von else
																							}//ende von if isset
?>
