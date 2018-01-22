<?PHP

	//Code zum löschen eines Nutzers
	if (isset($_GET['delete?userID'])) {
		$userID = $_GET['delete?userID'];
		$delete = "DELETE FROM benutzer WHERE benutzer_ID = $userID";
			if ($conn->query($delete) === TRUE) {
				$Alert = successMessage('Nutzer wurde erfolgreich entfernt');
			}
				else {
					$Alert = dangerMessage("<strong>Error:</strong> " . $delete . "<br>" . $conn->error ."");
				}
	}


	//Code um einen Nutzer anzulegen

	if (isset($_POST['neuer_nutzer'])) {
		if (!is_numeric($_POST['kontostand'])) { //prüft ob im Textfeld nur Zahlen eingegeben wurden.
			$Alert = dangerMessage("Im Feld <strong>'Kontostand'</strong> sind nur numerische Zeichen erlaubt.");
		}
			else if ($_POST['kontostand'] < 0) {//prüft ob es keine negative Zahl ist
					$Alert= dangerMessage("Im Feld <strong>'Kontostand'</strong> sind keine Negativen Zahlen erlaubt.");
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
										$Alert = successMessage('Nutzer wurde erfolgreich angelegt');
									}
										else {
											$Alert = dangerMessage("<strong>Error:</strong> " . $insert . "<br>" . $conn->error . "");
										}
						}
							else { //Ausgabe wenn es diesen Nutzer bereits gibt
								$Alert = dangerMessage("Es gibt bereits einen Nutzer mit dieser Email.");
							}

				}//ende von else
	}//ende von if isset

										if (isset($_POST['bearbeiten_nutzer'])) {
											if (!is_numeric($_POST['kontostand'])) { //prüft ob im Textfeld nur Zahlen eingegeben wurden.
												$Alert = dangerMessage("Im Feld <strong>'Kontostand'</strong> sind nur numerische Zeichen erlaubt.");
											}
												else if ($_POST['kontostand'] < 0) {//prüft ob es keine negative Zahl ist
														$Alert= dangerMessage("Im Feld <strong>'Kontostand'</strong> sind keine Negativen Zahlen erlaubt.");
												}
													else {
														$nutzerID = $_POST['benutzer_ID'];
														$vorname = $_POST['vorname'];
														$nachname = $_POST['nachname'];
														$email = $_POST['email'];
														$kontostand = $_POST['kontostand'];
														$adminrechte = $_POST['adminrechte'];
														$pepper = 'mensa_pfeffer';

														$check = $conn->query("SELECT * FROM benutzer WHERE email = '$email'"); //sql befehl zum prüfen ob es den User bereits gibt

															if($check->num_rows < 1 ) {   //Wenn keine Zeilen zurückgegeben werden, dann wird das Produkt eingefügt.
																$update = "UPDATE mensa.benutzer SET vorname= '$vorname'
																																		, nachname = '$nachname'
																																		, email = '$email'
																																		, kontostand = '$kontostand'
																																		, admin_rechte = $adminrechte
																					WHERE benutzer_ID = $nutzerID";
																					
																	$result = $conn->query($update);
																		if($result === true) {
																			$Alert = successMessage($vorname . " " . $nachname . ' wurde erfolgreich bearbeitet');
																		}
																			else {
																				$Alert = dangerMessage("<strong>Error:</strong> " . $update . "<br>" . $conn->errno . " " . $conn->error);
																			}
															}
																else { //Ausgabe wenn es diesen Nutzer bereits gibt
																	$Alert = dangerMessage("Es gibt bereits einen Nutzer mit dieser Email.");
																}

													}//ende von else
										}//ende von if isset


?>
