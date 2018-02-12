<?PHP
	include_once 'misc.php';

	// Function that creates the like buttons (not the functionality)
	function likeButtons($foodID, $foodLikes, $has_liked){

		if (isset($_SESSION['email'])) {
			if ($_SESSION['adminrechte'] == 2 ) { // If you're admin you wont be able to click the like button
				return '<div class="like-container d-flex justify-content-center"><button type="button" class="btn heart-btn disabled" data-toggle="tooltip" data-placement="bottom" title="Als Administrator können Sie das Essen nicht liken!">
				<i class="fas fa-heart like-heart-disabled"></i></button><p class="like-count">+'.$foodLikes.'</p></div>';
			} else if ($has_liked) { // If you've already liked
				return '<form role="form" method="POST" action="">
				<input type="hidden" name="food_ID" value="'.$foodID.'">
				<div class="like-container d-flex justify-content-center"><button type="submit" name="Speisen_unliken" class="btn heart-btn like-btn unlike" data-toggle="tooltip" data-placement="bottom" title="Diese Speise nicht mehr liken">
				<i class="fas fa-heart like-heart"></i></button><p class="like-count">+'.$foodLikes.'</p></div>
				</form>';
			} else { // If you're a normal user you can smash the like button
				return '<form role="form" method="POST" action="">
				<input type="hidden" name="food_ID" value="'.$foodID.'">
				<div class="like-container d-flex justify-content-center"><button type="submit" name="Speisen_liken" class="btn heart-btn like-btn like"data-toggle="tooltip" data-placement="bottom" title="Diese Speise liken.">
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
			header('refresh: 0.1 ; url = index.php');
		} else {
			$Alert = dangerMessage('Fehler: Invalide Eingabe.');
    		header('refresh: 0.1 ; url = index.php');
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
			header('refresh: 0.1 ; url = index.php');
		} else {
			$Alert = dangerMessage('Fehler: Invalide Eingabe.');
  			header('refresh: 0.1 ; url = index.php');
		}
	}

	// Code to create a new daily meal
	if (isset($_POST['create_daily_meal'])) {
		$_POST = sanitize_form($_POST);
		if ($_POST) {
			$s_ID = $_POST['foodlist'];
			$index_date = strtotime($_POST['date']);
			$formated = date('Y-m-d', $index_date);
			$insert = "INSERT INTO tagesangebot (speise_ID,datum)
					VALUES ('$s_ID','$formated')";
			if ($conn->query($insert) === TRUE) { // Sucess
				$Alert = successMessage("Tagesangebot wurde erfolgreich hinzugefügt");
		} else { // Error
				$Alert = dangerMessage("Es ist etwas schief gelaufen, bitte versuchen Sie es erneut.");
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

			} else {
				$Alert = dangerMessage("Es ist etwas schief gelaufen, bitte versuchen Sie es erneut.");

			}
		} else {
			$Alert = dangerMessage('Fehler: Invalide Eingabe.');
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
			} else {
				$Alert = dangerMessage("Es ist etwas schief gelaufen, bitte versuchen Sie es erneut.");
			}
		} else {
			$Alert = dangerMessage('Fehler: Invalide Eingabe.');
		}
	}

	// Code for ordering daily meals
	if(isset($_POST['orders'])) {
		$json_array = array();
		$orders = $_POST['orders'];
		$userID = $_SESSION['id'];
		$orderDate = date("Y-m-d");

		foreach ($orders as $key => $value) {
			$getPrice = $conn->query("SELECT sp.preis FROM mensa.tagesangebot as t INNER JOIN mensa.speise as sp ON sp.speise_ID = t.speise_ID WHERE tagesangebot_ID = '$value' LIMIT 1"); // Selects the price of the meal
			$getPrice = $getPrice->fetch_object(); // Selection will be fetched
			$insertOrders = "INSERT INTO buchungen (schueler_ID, tagesangebot_ID, buchungsdatum, preis) VALUES ('$userID', '$value', '$orderDate', ' $getPrice->preis')";
			$checkIfBooked = $conn->query("SELECT * FROM mensa.buchungen WHERE schueler_ID = '$userID' AND tagesangebot_ID = '$value'"); // Checks if the user didn't book the meal alrdy

			if ($checkIfBooked->num_rows >= 1) { // Checks if the user didn't book the meal alrdy
				$json_array['status'] = false;
				$json_array['msg'] = "Sie haben das bereits bestellt!";
			} else if ($_SESSION['kontostand'] < $getPrice->preis) { // If the user has not enough money
				$json_array['status'] = false;
				$json_array['msg'] = "<strong>Leider haben Sie nicht genug Guthaben für diese Bestellung!</strong> Bitte reduzieren Sie Ihre Bestellung, oder laden Sie Ihr Konto auf.";
			} else {
					if ($conn->query($insertOrders) == true) { // If the order is okay
						$price = $getPrice->preis;
						$newBalance = $_SESSION['kontostand'] - $price; // Remove the price from the account balance
						$_SESSION['kontostand'] = $newBalance; // new balance will be created
						$conn->query("UPDATE mensa.benutzer SET kontostand = $newBalance  WHERE  benutzer_ID = $userID "); // new Balance is set in the database
						$json_array['status'] = true;
						$json_array['msg'] = "Ihre Bestellung war erfolgreich! Sehen Sie sich <a href='profile.php#v-pills-order'>hier</a> Ihre Bestellungen an. <strong>Ihr neuer Kontostand: $newBalance €</strong>";
					} else {
						$json_array['status'] = false;
						$json_array['msg'] = "<strong>Error:</strong> Es is ein Fehler aufgetreten, bitte versuchen Sie es erneut oder infomieren Sie den Caterer";
					}
				}

		}
		header('Content-Type: application/json');
		echo json_encode($json_array);
		die();
	}

	// Function that creates a modal for the food order
	function confOrders() {
		echo "<div class='modal fade' id='confirm-submit' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
				<div class='modal-dialog'>
					<div class='modal-content'>
						<div class='modal-header'>
							<strong>Wollen Sie diese Bestellung wirklich tätigen?</strong>
						</div>
						<div class='modal-body'>
							Der Betrag wird von ihrem Konto sofort abgebucht!
						</div>
						<div class='modal-footer'>
							<button type='button' class='btn btn-default' data-dismiss='modal'>Abbrechen</button>
							<input type='button' onclick='submit()' name='bestellenBestätigen' class='btn btn-success order-btn' value='Kostenpflichtig bestellen'>
						</div>
					</div>
				</div>
			 </div>";
	}
?>
