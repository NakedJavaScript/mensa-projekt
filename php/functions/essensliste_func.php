<?PHP
	//Code um eine Speise hinzuzufügen
		if (isset($_POST['Essen_hinzufügen'])) {
			$name = strtoupper(trim($_POST['name']));
			$all_inh = strtoupper(trim($_POST['allergene']));
			$sonst = strtoupper(trim($_POST['sonstiges']));
			$preis = $_POST['preis'];

				if (!is_numeric($preis)) { //prüft ob im Textfeld nur Zahlen eingegeben wurden.
					$Alert = dangerMessage("Im Feld <strong>'Preis'</strong> sind nur numerische Zeichen erlaubt.");
				}
					else if ($_POST['preis'] < 0) {//prüft ob es keine negative Zahl ist
						$Alert= dangerMessage("Im Feld <strong>'Preis'</strong> sind keine Negativen Zahlen erlaubt.");
																			}
			else {
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


	//Code zum löschen einer Speise
		if (isset($_GET['delete?speiseID'])) {
			$speiseID = $_GET['delete?speiseID'];
			$delete = "DELETE FROM speise WHERE speise_ID = $speiseID";
				if ($conn->query($delete) === TRUE) {
					$Alert = successMessage("Speise wurde erfolgreich entfernt");
				}
				else if ($conn->errno == 1451) {
						$Alert = dangerMessage("Sie haben die Speise bereits in einem Tagesangebot, bitte löschen Sie alle Tagesangebote mit dieser Speise, um sie zu löschen.");
					}
					else {
						$Alert = dangerMessage("<strong>Error:</strong> " . $delete . "<br><strong>[" . $conn->errno . "]</strong>" . $conn->error  ."");
					}
		}
?>
