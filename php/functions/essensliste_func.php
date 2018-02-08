<?PHP
	include_once 'misc.php';

	// Code to add a new meal
	if (isset($_POST['Essen_hinzufügen'])) {
		$_POST = sanitize_form($_POST);
		if ($_POST) {
			$name = strtoupper(trim($_POST['name']));
			$sonst = strtoupper(trim($_POST['sonstiges']));

			if (!is_numeric($_POST['preis'])) { // Checks if the textfield has only numbers
				$Alert = dangerMessage("Im Feld <strong>'Preis'</strong> sind nur numerische Zeichen erlaubt.");
				header('refresh: 1.5 ; url = essensliste.php');
			}
			else if ($_POST['preis'] < 0) { // Checks if its not a negative number
				$Alert= dangerMessage("Im Feld <strong>'Preis'</strong> sind keine Negativen Zahlen erlaubt.");
				header('refresh: 1.5 ; url = essensliste.php');
			}
			else if(empty($_POST['allergene'])) { // Checks if the user picked the allergens
				$Alert = dangerMessage("Bitte wählen Sie mindestens ein Allergen oder wählen Sie 'keine Allergene'. ");
				header('refresh: 1.5 ; url = essensliste.php');
			}
			else {
				$all_inh = implode(", ", $_POST['allergene']); // Implode splits the array
				$preis = doubleval($_POST['preis']); // Changes the price into a double
				$check = $conn->query("SELECT * FROM speise WHERE name = '$name'"); // Checks if the meal already exists
				if($check->num_rows < 1 ) {   //Wenn keine Zeilen zurückgegeben werden, dann wird das Produkt eingefügt.
					$insert = "INSERT INTO speise (name,allergene_inhaltsstoffe,sonstiges,preis)
					VALUES ('$name', '$all_inh', '$sonst','$preis')";

					if ($conn->query($insert) === TRUE) {
						$Alert = successMessage("Speise wurde erfolgreich hinzugefügt");
						header('refresh: 1.5 ; url = essensliste.php');
					}
					else {
						$Alert = dangerMessage("Die Speise konnte nicht angelegt werden, bitte versuchen Sie es erneut.");
						header('refresh: 1.5 ; url = essensliste.php');
					}
				}
				else {
					$Alert = dangerMessage("Es gibt bereits ein Produkt mit diesem Namen.");
					header('refresh: 1.5 ; url = essensliste.php');
				}
			}
		} else {
			$Alert = dangerMessage('Fehler: Invalide Eingabe.');
			header('refresh: 1.5 ; url = essensliste.php');
		}
	}

	// Code to edit an existing meal
	if (isset($_POST['Essen_bearbeiten'])) {
		$_POST = sanitize_form($_POST);
		if ($_POST) {
			$speiseID = $_POST['speise_ID'];
			$name = strtoupper(trim($_POST['name']));
			$sonst = strtoupper(trim($_POST['sonstiges']));

			if (!is_numeric($_POST['preis'])) { // Checks if the textfield has only numbers
				$Alert = dangerMessage("Im Feld <strong>'Preis'</strong> sind nur numerische Zeichen erlaubt.");
				header('refresh: 1.5 ; url = essensliste.php');
			}
			else if ($_POST['preis'] < 0) { // Checks if its not a negative number
				$Alert= dangerMessage("Im Feld <strong>'Preis'</strong> sind keine Negativen Zahlen erlaubt.");
				header('refresh: 1.5 ; url = essensliste.php');
			}
			else if(empty($_POST['allergene'])) { // Checks if the user picked the allergens
				$Alert= dangerMessage("Bitte wählen Sie mindestens ein Allergen oder wählen Sie 'Keine Allergene'.");
				header('refresh: 1.5 ; url = essensliste.php');
			}
			else {
				$all_inh = implode(", ", $_POST['allergene']); // Implode splits the array
				$preis = doubleval($_POST['preis']); // Changes the price into a double
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

						if ($conn->query($update) === TRUE) { // Success
							$Alert = successMessage("Speise wurde erfolgreich bearbeitet");
							header('refresh: 1.5 ; url = essensliste.php');
						}
						else { // Error
							$Alert = dangerMessage("Es ist etwas schief gelaufen, bitte versuchen Sie es erneut.");
							header('refresh: 1.5 ; url = essensliste.php');
						}
					}
					else { // If the meal has a name that already exists
						$Alert = dangerMessage("Es gibt bereits ein Produkt mit diesem Namen.");
						header('refresh: 1.5 ; url = essensliste.php');
					}
				}
				else { // If the meal has the same name the updates will be set immediately
					$update = "UPDATE mensa.speise SET name = '$name'
					,allergene_inhaltsstoffe = '$all_inh'
					,sonstiges = '$sonst'
					,preis='$preis'
					WHERE speise_ID = $speiseID";

					if ($conn->query($update) === TRUE) { // Success
						$Alert = successMessage("Speise wurde erfolgreich bearbeitet");
						header('refresh: 1.5 ; url = essensliste.php');
					}
					else { // If the meal has a name that already exists
						$Alert = dangerMessage("Es ist etwas schief gelaufen, bitte versuchen Sie es erneut.");
						header('refresh: 1.5 ; url = essensliste.php');
					}
				}
			}
		} else {
			$Alert = dangerMessage('Fehler: Invalide Eingabe.');
			header('refresh: 1.5 ; url = essensliste.php');
		}
	}

	// Code to delete a meal
	if (isset($_GET['delete?speiseID'])) {
		$_GET = sanitize_form($_GET);
		if ($_GET) {
			$speiseID = $_GET['delete?speiseID'];
			$delete = "DELETE FROM speise WHERE speise_ID = $speiseID";
			if ($conn->query($delete) === TRUE) {
				$Alert = successMessage("Speise wurde erfolgreich entfernt");
			}
			else if ($conn->errno == 1451) {  // If the meal is already in the daily meals this messages shows up
				$Alert = dangerMessage("Sie haben die Speise bereits in einem Tagesangebot, bitte löschen Sie alle Tagesangebote mit dieser Speise, um sie zu löschen.");
				header('refresh: 1.5 ; url = essensliste.php');
			} else {
				$Alert = dangerMessage("Es ist etwas schief gelaufen, bitte versuchen Sie es erneut.");
				header('refresh: 1.5 ; url = essensliste.php');
			}
		} else {
			$Alert = dangerMessage('Fehler: Invalide Eingabe.');
			header('refresh: 1.5 ; url = essensliste.php');
		}
	}
?>
