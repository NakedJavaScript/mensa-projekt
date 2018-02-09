<?PHP
	if(isset($_POST['submit'])){ // If the user hits the submit button in the login form, check his data
		$email = trim($_POST['email']);
		$passwort = trim($_POST['passwort']);
		$pepper = 'mensa_pfeffer';
		$sql = "select * from benutzer where email = '$email'";
		$rs = $conn->query($sql);

		if($rs -> num_rows == 1) {
			$row = $rs->fetch_assoc();

			if(password_verify($passwort . $pepper, $row['passwort'])){ // Verifies the password
				$_SESSION['email'] = $email;
				$_SESSION['vorname'] = $row['vorname'];
				$_SESSION['nachname'] = $row['nachname'];
				$_SESSION['kontostand'] = $row['kontostand'];
				$_SESSION['id'] = $row['benutzer_ID'];
				$_SESSION['adminrechte'] = $row['admin_rechte'];
				$Alert = successMessage('Login erfolgreich');
			} else {
				$Alert = dangerMessage('Falsches Passwort');
			}
		} else {
			$Alert = dangerMessage('Keinen Nutzer mit dieser E-Mail Adresse gefunden.');
		}
	}
?>
