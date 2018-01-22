<?PHP
	//Code um eine Speise hinzuzufügen
		if (isset($_POST['Essen_hinzufügen'])) {
			$name = strtoupper(trim($_POST['name']));
			$sonst = strtoupper(trim($_POST['sonstiges']));

				if (!is_numeric($_POST['preis'])) { //prüft ob im Textfeld nur Zahlen eingegeben wurden.
					$Alert = dangerMessage("Im Feld <strong>'Preis'</strong> sind nur numerische Zeichen erlaubt.");
				}
					else if ($_POST['preis'] < 0) {//prüft ob es keine negative Zahl ist
						$Alert= dangerMessage("Im Feld <strong>'Preis'</strong> sind keine Negativen Zahlen erlaubt.");
																			}
              else if(empty($_POST['allergene'])) {
                $Alert = dangerMessage("Bitte wählen Sie mindestens ein Allergen oder wählen Sie 'keine Allergene'. ");
              }
			else {
					$all_inh = implode(", ", $_POST['allergene']);
					$preis = doubleval($_POST['preis']); //wandelt preis in double um.
					$check = $conn->query("SELECT * FROM speise WHERE name = '$name'"); //sql befehl zum prüfen ob es die Speise bereits gibt
							if($check->num_rows < 1 ) {   //Wenn keine Zeilen zurückgegeben werden, dann wird das Produkt eingefügt.
								$insert = "INSERT INTO speise (name,allergene_inhaltsstoffe,sonstiges,preis)
											VALUES ('$name', '$all_inh', '$sonst','$preis')";

								if ($conn->query($insert) === TRUE) { //Wenn erfolgreich eingefügt, dann wird erfolgsmessage angezeigt
										$Alert = successMessage("Speise wurde erfolgreich hinzugefügt");
								}
										else {
											$Alert = dangerMessage("Error: " . $sql . "<br>" . $conn->error . "");
										}
							}
					else {
						$Alert = dangerMessage("Es gibt bereits ein Produkt mit diesem Namen.");
					}

				}
			}

			//Code um eine Speise hinzuzufügen
				if (isset($_POST['Essen_bearbeiten'])) {
					$speiseID = $_POST['speise_ID'];
					$name = strtoupper(trim($_POST['name']));
					$sonst = strtoupper(trim($_POST['sonstiges']));

						if (!is_numeric($_POST['preis'])) { //prüft ob im Textfeld nur Zahlen eingegeben wurden.
							$Alert = dangerMessage("Im Feld <strong>'Preis'</strong> sind nur numerische Zeichen erlaubt.");
						}
							else if ($_POST['preis'] < 0) {//prüft ob es keine negative Zahl ist
								$Alert= dangerMessage("Im Feld <strong>'Preis'</strong> sind keine Negativen Zahlen erlaubt.");
							}
								else if(empty($_POST['allergene'])) {
									$Alert= dangerMessage("Bitte wählen Sie mindestens ein Allergen oder wählen Sie 'Keine Allergene'.");
								}
					else {
							$all_inh = implode(", ", $_POST['allergene']); //implode teilt array auf. wird mit komma zeichen getrennt.
							$preis = doubleval($_POST['preis']); //wandelt preis in double um.
							$mysqlItem = $conn->query("SELECT name FROM mensa.speise WHERE speise_ID = $speiseID");
							$mysqlItem = $mysqlItem->fetch_assoc();

							if($name != $mysqlItem['name']){ //Falls der Name der Speise nicht mit dem auf der DB übereinstimmt wird überprüft ob eine andere Speise bereits diesen Namen hat.
							$check = $conn->query("SELECT * FROM speise WHERE name = '$name'"); //sql befehl zum prüfen ob es die Speise bereits gibt
										if($check->num_rows < 1 ) {   //Wenn keine Zeilen zurückgegeben werden, dann wird das Produkt eingefügt.
													$update = "UPDATE mensa.speise SET name = '$name'
																														,allergene_inhaltsstoffe = '$all_inh'
																														,sonstiges = '$sonst'
																														,preis='$preis'
																WHERE speise_ID = $speiseID";

													if ($conn->query($update) === TRUE) { //Wenn erfolgreich eingefügt, dann wird erfolgsmessage angezeigt
															$Alert = successMessage("Speise Wurde erfolgreich bearbeitet");
													}
															else { //Falls irgendein Fehler auftaucht wird diese hier angezeigt
																$Alert = dangerMessage("Error: " . $sql . "<br>" . $conn->errno . ": " . $conn->error);
															}
												}
										else {
											$Alert = dangerMessage("Es gibt bereits ein Produkt mit diesem Namen.");
										}

						}
						else { //Wenn das Produkt den selben Namen hat, dann wird das Update sofort durchgeführt.
							$update = "UPDATE mensa.speise SET name = '$name'
																								,allergene_inhaltsstoffe = '$all_inh'
																								,sonstiges = '$sonst'
																								,preis='$preis'
										WHERE speise_ID = $speiseID";

							if ($conn->query($update) === TRUE) { //Wenn erfolgreich eingefügt, dann wird erfolgsmessage angezeigt
									$Alert = successMessage("Speise Wurde erfolgreich bearbeitet");
							}
									else { //Falls irgendein Fehler auftaucht wird diese hier angezeigt
										$Alert = dangerMessage("Error: " . $sql . "<br>" . $conn->errno . ": " . $conn->error);
									}

						}
					}
			}


	//Code zum löschen einer Speise
		if (isset($_GET['delete?speiseID'])) {
			$speiseID = $_GET['delete?speiseID'];
			$delete = "DELETE FROM speise WHERE speise_ID = $speiseID";
				if ($conn->query($delete) === TRUE) {
					$Alert = successMessage("Speise wurde erfolgreich entfernt");
				}
				else if ($conn->errno == 1451) { //1451 entspricht dem Error code wenn ein Wert als Foreign Key verwendet wird.
						$Alert = dangerMessage("Sie haben die Speise bereits in einem Tagesangebot, bitte löschen Sie alle Tagesangebote mit dieser Speise, um sie zu löschen.");
					}
					else {
						$Alert = dangerMessage("<strong>Error:</strong> " . $delete . "<br><strong>[" . $conn->errno . "]</strong>" . $conn->error  ."");
					}
		}
?>
