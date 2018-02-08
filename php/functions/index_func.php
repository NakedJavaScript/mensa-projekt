<?PHP
	include_once 'misc.php';

		// Function that creates the like buttons (not the functionality)
		function likeButtons($foodID, $foodLikes, $has_liked){

			if (isset($_SESSION['email'])) {
				if ($_SESSION['adminrechte'] == 2 ) { // If you're admin you wont be able to click the like button
					return '<div class="like-container"><button type="button" class="btn heart-btn disabled" data-toggle="tooltip" data-placement="bottom" title="Als Administrator können Sie das Essen nicht liken!">
					<i class="fas fa-heart like-heart-disabled"></i></button><p class="like-count">+'.$foodLikes.'</p></div>';


				} else if ($has_liked) { // If you've already liked
					return '<form role="form" method="POST" action="">
					<input type="hidden" name="food_ID" value="'.$foodID.'">
					<div class="like-container"><button type="submit" name="Speisen_unliken" class="btn heart-btn like-btn unlike" data-toggle="tooltip" data-placement="bottom" title="Diese Speise nicht mehr liken">
					<i class="fas fa-heart like-heart"></i></button><p class="like-count">+'.$foodLikes.'</p></div>
					</form>';
				} else { // If you're a normal user you can smash the like button
					return '<form role="form" method="POST" action="">
					<input type="hidden" name="food_ID" value="'.$foodID.'">
					<div class="like-container"><button type="submit" name="Speisen_liken" class="btn heart-btn like-btn like"data-toggle="tooltip" data-placement="bottom" title="Diese Speise liken.">
					<i class="fas fa-heart like-heart"></i></button><p class="like-count">+'.$foodLikes.'</p></div>
					</form>';
				}

			} else { // If you're not logged in you can't smash the like button
				return '<div class="d-flex justify-content-center align-items-center"><button type="button" class="btn heart-btn disabled" data-toggle="tooltip" data-placement="bottom" title="Sie müssen eingeloggt sein um zu liken.">
				<i class="fas fa-heart like-heart-disabled"></i></button><p class="like-count">+'.$foodLikes.'</p></div>';
			}
		}

		// Code for the functionality of the like
		if (isset($_POST['Speisen_liken'])) {
			$_POST = sanitize_form($_POST);
			if ($_POST) {
				$user_ID = $_SESSION['id'];
				$food_ID =$_POST['food_ID'];
				$insert = "INSERT INTO likes (benutzer_ID, speise_ID)
				VALUES (".$user_ID."," .$food_ID.")";

				$conn->query($insert);
			} else {
				$Alert = dangerMessage('Fehler: Invalide Eingabe.');
        header('refresh: 1.5 ; url = index.php');
			}
		}

		// Code for the functionality of the dislike
			if (isset($_POST['Speisen_unliken'])) {
				$_POST = sanitize_form($_POST);
				if ($_POST) {
					$food_ID =$_POST['food_ID'];
					$user_ID = $_SESSION['id'];
					$delete = "DELETE FROM likes WHERE speise_ID = $food_ID AND benutzer_ID = $user_ID";

					$conn->query($delete);
				} else {
					$Alert = dangerMessage('Fehler: Invalide Eingabe.');
          header('refresh: 1.5 ; url = index.php');
				}
			}

		// Code to create a new daily meal
			if (isset($_POST['Tagesangebot_erstellen'])) {
				$_POST = sanitize_form($_POST);
				if ($_POST) {
					$s_ID =$_POST['foodlist'];
					$datum =strtotime($_POST['date']);
					$formated= date('Y-m-d',$datum);
					$insert = "INSERT INTO tagesangebot (speise_ID,datum)
							VALUES ('$s_ID','$formated')";
					if ($conn->query($insert) === TRUE) { // Sucess
						$Alert = successMessage("Tagesangebot wurde erfolgreich hinzugefügt");
			  header('refresh: 1.5 ; url = index.php');
				} else { // Error
						$Alert = dangerMessage("Es ist etwas schief gelaufen, bitte versuchen Sie es erneut.");
			  header('refresh: 1.5 ; url = index.php');
					}
				} else {
					$Alert = dangerMessage('Fehler: Invalide Eingabe.');
				}
			}

			// Code to change a daily meal
			if (isset($_POST['EditDaymeal'])) {
				$_POST = sanitize_form($_POST);
				if ($_POST) {
					$old_food_ID = $_POST['food'];
					$new_food_ID = $_POST['foodlist'];
					$date = strtotime($_POST['date']);
					$formated_date= date('Y-m-d',$date);
					$insert = "UPDATE tagesangebot SET  speise_ID = $new_food_ID WHERE speise_ID = $old_food_ID AND datum = '$formated_date'";
					if ($conn->query($insert) === TRUE) {
						$Alert = successMessage("Tagesangebot wurde erfolgreich bearbeitet");
			header('refresh: 1.5 ; url = index.php');

					} else {
						$Alert = dangerMessage("<strong>Error:</strong>".$conn->errno.": ".$conn->error);
			header('refresh: 1.5 ; url = index.php');

					}
				} else {
					$Alert = dangerMessage('Fehler: Invalide Eingabe.');
		  header('refresh: 1.5 ; url = index.php');
				}
			}

			// Code to delete a daily meal
			if (isset($_GET['delete?daymeal_ID'])) {
				$_GET = sanitize_form($_GET);
				if ($_GET) {
					$daymeal_ID = $_GET['delete?daymeal_ID'];
					$delete = "DELETE FROM tagesangebot WHERE tagesangebot_ID = $daymeal_ID ";
					if ($conn->query($delete) === TRUE) {
						$Alert = successMessage('Tagesangebot wurde erfolgreich entfernt');
            header('refresh: 1.5 ; url = index.php');
					} else {
						$Alert = dangerMessage("<strong>Error:</strong> " . $delete . "<br>" . $conn->error ."");
            header('refresh: 1.5 ; url = index.php');
					}
				} else {
					$Alert = dangerMessage('Fehler: Invalide Eingabe.');
          header('refresh: 1.5 ; url = index.php');
				}
			}


?>
