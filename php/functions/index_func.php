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

		// Code um Speisen zu liken
		if (isset($_POST['Speisen_liken'])) {
			$user_ID = $_SESSION['id'];
			$food_ID =$_POST['food_ID'];
			$insert = "INSERT INTO likes (benutzer_ID, speise_ID)
			VALUES (".$user_ID."," .$food_ID.")";

			$conn->query($insert);
		}


		//Code zum unliken
			if (isset($_POST['Speisen_unliken'])) {
				$food_ID =$_POST['food_ID'];
				$user_ID = $_SESSION['id'];
				$delete = "DELETE FROM likes WHERE speise_ID = $food_ID AND benutzer_ID = $user_ID";

				$conn->query($delete);
			}
?>
