<?PHP
if(isset($_POST['submit'])){
	$email = trim($_POST['email']);
	$passwort = trim($_POST['passwort']);
	$pepper = 'mensa_pfeffer';

	$sql = "select * from benutzer where email = '$email'";
	$rs = $conn->query($sql);

	if($rs -> num_rows  == 1){

		$row = $rs->fetch_assoc();
		if(password_verify($passwort . $pepper,$row['passwort'])){
			$_SESSION['email'] = $email;
			$_SESSION['firstName'] = $row['vorname'];
			$_SESSION['lastName'] = $row['nachname'];
			$_SESSION['balance'] = $row['kontostand'];
			$_SESSION['id'] = $row['benutzer_ID'];
			$_SESSION['adminRights'] = $row['admin_rechte'];
			$alert = successMessage('Login erfolgreich');
			header( 'Location: index.php' ); //Nach dem Login wird der Nutzer zum Index Redirected
			die();
		}
		else{
			$alert = dangerMessage('Falsches Passwort');
			header('refresh: 1.5 ; url = index.php');
			die();
		}
	}
	else{
		$alert = dangerMessage('Keinen Nutzer mit dieser E-Mail Adresse gefunden.');
		header('refresh: 1.5 ; url = index.php');
		die();
	}
}
?>
