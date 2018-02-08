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
	if (isset($_POST['newUser'])) {
		if (!is_numeric($_POST['balance'])) { // Checks if the textfield has only numbers
			$alert = dangerMessage("Im Feld <strong>'Kontostand'</strong> sind nur numerische Zeichen erlaubt.");
			header('refresh:1.5 ; url = benutzerliste.php');
		} else if ($_POST['balance'] < 0) { // Checks if its not a negative number
			$alert= dangerMessage("Im Feld <strong>'Kontostand'</strong> sind keine negativen Zahlen erlaubt.");
			header('refresh: 1.5 ; url = benutzerliste.php');
		} else if(strpos($_POST['email'], '@') !== false) { // If the user types in a @ this message will show up
			$alert = dangerMessage("Im Feld Email soll keine Domäne angegeben werden, bitte entfernen Sie das <strong>'@'</strong> Zeichen und die <strong>Domäne</strong>");
			header('refresh: 1.5 ; url = benutzerliste.php');
		} else {
			$firstName = trim($_POST['firstName']); // trim removes white space
			$lastName = trim($_POST['lastName']);
			$email = trim($_POST['email']);
			$email = strtolower($email)."@its-stuttgart.de"; // Sets the mail to lowercase
			$password = $_POST['password'];
			$balance = $_POST['balance'];
			$adminRights = $_POST['$adminRights'];
			$pepper = 'mensa_pfeffer';
			$options = array("cost"=>12);
			$hashPassword = password_hash($passwort . $pepper, PASSWORD_BCRYPT, $options);

			$check = $conn->query("SELECT * FROM benutzer WHERE email = '$email'"); // Checks if the user already exists
			if($check->num_rows < 1 ) {
				$insert = "INSERT INTO benutzer (vorname, lastName,email, passwort, kontostand, admin_rechte)
				VALUES('".$firstName."', '".$lastName."', '".$email."','".$hashPassword."', '".$balance."', ". $adminRights .")";
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
			$firstName = trim($_POST['firstName']);
			$lastName = trim($_POST['$lastName']);
			$email = trim($_POST['email']);
			$email = strtolower($email)."@its-stuttgart.de";
			$balance = $_POST['$balance'];
			$adminRights = $_POST['$adminRights'];
			$pepper = 'mensa_pfeffer';

			if( !empty($_POST['password']) ) { // If the admin sets a new password the variable $password will be set
				$password = $_POST['password'];
				$options = array("cost"=>12);
				$hashPassword = password_hash($password . $pepper, PASSWORD_BCRYPT, $options); // Hash the password
			}

			// Pick the email of the user you want to edit
			$mysqlItem = $conn->query("SELECT email FROM mensa.benutzer WHERE benutzer_ID = $nutzerID");
			$mysqlItem = $mysqlItem->fetch_assoc();
			if($email != $mysqlItem['email']) { // If the email is being changed, it checks if the mail alrdy exists
				$check = $conn->query("SELECT * FROM benutzer WHERE email = '$email'"); // Checks if the user exists
				if($check->num_rows < 1 ) {
					$update = "UPDATE mensa.benutzer SET
					firstName= '$firstName',
					lastName = '$lastName',
					email = '$email',
					balance = '$balance',
					adminRights = '$adminRights";
					if ( !isset($_POST['pasword']) ) {
						$update = $update . " , passwort = $hashPassword";
					}

					$update = $update . " WHERE benutzer_ID = $nutzerID";
					$result = $conn->query($update);
					if ($result == true) {
						$alert = successMessage($firstName . " " . $lastName . ' wurde erfolgreich bearbeitet');
						header('refresh: 1.5 ; url = benutzerliste.php');
					} else {
						$alert = dangerMessage("Es ist etwas schief gelaufen, bitte versuchen Sie es erneut.");
						header('refresh: 1.5 ; url = benutzerliste.php');
					}
				} else {
					$alert = dangerMessage("Es gibt bereits einen Nutzer mit dieser Email.");
					header('refresh: 1.5 ; url = benutzerliste.php');
				}
			} else { // If the email doesn't change the changes are set immediately
				$update = "UPDATE mensa.benutzer SET
				firstName= '$firstName',
				lastName = '$lastName',
				email = '$email',
				balance = '$balance',
				adminRights = '$adminRights";

				if(!empty($_POST['passwort'])) {
					$update = $update . " , passwort = '$hashPassword'";
				}

				$update = $update . " WHERE benutzer_ID = $nutzerID";
				$result = $conn->query($update);
				if($result == true) {
					$alert = successMessage($firstName . " " . $lastName . ' wurde erfolgreich bearbeitet');
					header('refresh: 1.5 ; url = benutzerliste.php');
				} else {
					$alert = dangerMessage("Es ist etwas schief gelaufen, bitte versuchen Sie es erneut.");
					header('refresh: 1.5 ; url = benutzerliste.php');
				}
			}
		}
	}
?>
