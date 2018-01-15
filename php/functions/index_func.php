<?PHP 
	//Code um eine Speise hinzuzufügen
		if (isset($_POST['Tagesangebot_erstellen'])) {
			$s_ID =$_POST['foodlist'];
			$datum =strtotime($_POST['date']);
			$formated= date('Y-m-d',$datum);
			$insert = "INSERT INTO tagesangebot (speise_ID,datum)
					VALUES ('$s_ID','$formated')";
			if ($conn->query($insert) === TRUE) {
				$Alert = successMessage("Tagesangebot wurde erfolgreich hinzugefügt");
			} else {
				$Alert = dangerMessage("Tagesangebot konnte nicht hinzugefügt werden");
			}
		}
?>