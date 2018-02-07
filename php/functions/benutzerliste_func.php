<?PHP
	// Code to delete a user
	if (isset($_GET['delete?userID'])) {
		$userID = $_GET['delete?userID'];
		$delete = "DELETE FROM benutzer WHERE benutzer_ID = $userID";
		if ($conn->query($delete) == TRUE) {
			$Alert = successMessage('Nutzer wurde erfolgreich entfernt');
			header('refresh: 1.5 ; url = benutzerliste.php');
		} else {
			$Alert = dangerMessage("Es ist etwas schief gelaufen, bitte versuchen Sie es erneut!");
			header('refresh: 1.5 ; url = benutzerliste.php');
		}
	}

	// Code to add a user
	if (isset($_POST['neuer_nutzer'])) {
		if (!is_numeric($_POST['kontostand'])) { // Checks if the textfield has only numbers
			$Alert = dangerMessage("Im Feld <strong>'Kontostand'</strong> sind nur numerische Zeichen erlaubt.");
			header('refresh:1.5 ; url = benutzerliste.php');
		} else if ($_POST['kontostand'] < 0) { // Checks if its not a negative number
			$Alert= dangerMessage("Im Feld <strong>'Kontostand'</strong> sind keine negativen Zahlen erlaubt.");
			header('refresh: 1.5 ; url = benutzerliste.php');
		} else if(strpos($_POST['email'], '@') !== false) { // If the user types in a @ this message will show up
			$Alert = dangerMessage("Im Feld Email soll keine Domäne angegeben werden, bitte entfernen Sie das <strong>'@'</strong> Zeichen und die <strong>Domäne</strong>");
			header('refresh: 1.5 ; url = benutzerliste.php');
		} else {
			$vorname = trim($_POST['vorname']); // trim removes white space
			$nachname = trim($_POST['nachname']);
			$email = trim($_POST['email']);
			$email = strtolower($email)."@its-stuttgart.de"; // Sets the mail to lowercase
			$passwort = $_POST['passwort'];
			$kontostand = $_POST['kontostand'];
			$adminrechte = $_POST['adminrechte'];
			$pepper = 'mensa_pfeffer';
			$options = array("cost"=>12);
			$hashPassword = password_hash($passwort . $pepper, PASSWORD_BCRYPT, $options);

			$check = $conn->query("SELECT * FROM benutzer WHERE email = '$email'"); // Checks if the user already exists
			if($check->num_rows < 1 ) {
				$insert = "INSERT INTO benutzer (vorname, nachname,email, passwort, kontostand, admin_rechte)
				VALUES('".$vorname."', '".$nachname."', '".$email."','".$hashPassword."', '".$kontostand."', ". $adminrechte .")";
				$result = $conn->query($insert);
				if($result === true) {
					$Alert = successMessage('Nutzer wurde erfolgreich angelegt');
					header('refresh: 1.5 ; url = benutzerliste.php');
				} else {
					$Alert = dangerMessage("Der Nutzer konnte nicht angelegt werden, bitte versuchen Sie es erneut.");
					header('refresh: 1.5 ; url = benutzerliste.php');
				}
			} else {
				$Alert = dangerMessage("Es gibt bereits einen Nutzer mit dieser Email.");
				header('refresh: 1.5 ; url = benutzerliste.php');
			}
		}
	}

	// Code to edit an existing user
	if (isset($_POST['bearbeiten_nutzer'])) {
		if (!is_numeric($_POST['kontostand'])) { // Checks if the textfield has only numbers
			$Alert = dangerMessage("Im Feld <strong>'Kontostand'</strong> sind nur numerische Zeichen erlaubt.");
			header('refresh: 1.5 ; url = benutzerliste.php');
		} else if ($_POST['kontostand'] < 0) { //Checks if its not a negative number
			$Alert= dangerMessage("Im Feld <strong>'Kontostand'</strong> sind keine negativen Zahlen erlaubt.");
			header('refresh: 1.5 ; url = benutzerliste.php');
		} else if (strpos($_POST['email'], '@') !== false) { // If the user types in a @ a message will be promped
			$Alert = dangerMessage("Im Feld Email soll keine Domäne angegeben werden, bitte entfernen Sie das <strong>'@'</strong> Zeichen und die <strong>Domäne</strong>");
			header('refresh: 1.5 ; url = benutzerliste.php');
		} else {
			$nutzerID = $_POST['benutzer_ID'];
			$vorname = trim($_POST['vorname']);
			$nachname = trim($_POST['nachname']);
			$email = trim($_POST['email']);
			$email = strtolower($email)."@its-stuttgart.de";
			$kontostand = $_POST['kontostand'];
			$adminrechte = $_POST['adminrechte'];
			$pepper = 'mensa_pfeffer';

			if( !empty($_POST['passwort']) ) { // If the admin sets a new password the variable $password will be set
				$passwort = $_POST['passwort'];
				$options = array("cost"=>12);
				$hashPassword = password_hash($passwort . $pepper, PASSWORD_BCRYPT, $options); // Hash the password
			}

			// Pick the email of the user you want to edit
			$mysqlItem = $conn->query("SELECT email FROM mensa.benutzer WHERE benutzer_ID = $nutzerID");
			$mysqlItem = $mysqlItem->fetch_assoc();

			if($email != $mysqlItem['email']) { // If the email is being changed, it checks if the mail alrdy exists
				$check = $conn->query("SELECT * FROM benutzer WHERE email = '$email'"); // Checks if the user exists
				if($check->num_rows < 1 ) {
					$update = "UPDATE mensa.benutzer SET
					vorname= '$vorname',
					nachname = '$nachname',
					email = '$email',
					kontostand = '$kontostand',
					admin_rechte = $adminrechte";
					if ( !isset($_POST['passwort']) ) {
						$update = $update . " , passwort = $hashPassword";
					}

					$update = $update . " WHERE benutzer_ID = $nutzerID";
					$result = $conn->query($update);
					if ($result == true) {
						$Alert = successMessage($vorname . " " . $nachname . ' wurde erfolgreich bearbeitet');
						header('refresh: 1.5 ; url = benutzerliste.php');
					} else {
						$Alert = dangerMessage("Es ist etwas schief gelaufen, bitte versuchen Sie es erneut.");
						header('refresh: 1.5 ; url = benutzerliste.php');
					}
				} else {
					$Alert = dangerMessage("Es gibt bereits einen Nutzer mit dieser Email.");
					header('refresh: 1.5 ; url = benutzerliste.php');
				}
			} else { // If the email doesn't change the changes are set immediately
				$update = "UPDATE mensa.benutzer SET
				vorname= '$vorname',
				nachname = '$nachname',
				email = '$email',
				kontostand = '$kontostand',
				admin_rechte = $adminrechte";

				if(!empty($_POST['passwort'])) {
					$update = $update . " , passwort = '$hashPassword'";
				}

				$update = $update . " WHERE benutzer_ID = $nutzerID";
				$result = $conn->query($update);
				if($result == true) {
					$Alert = successMessage($vorname . " " . $nachname . ' wurde erfolgreich bearbeitet');
					header('refresh: 1.5 ; url = benutzerliste.php');
				} else {
					$Alert = dangerMessage("Es ist etwas schief gelaufen, bitte versuchen Sie es erneut.");
					header('refresh: 1.5 ; url = benutzerliste.php');
				}
			}
		}
	}
?>
