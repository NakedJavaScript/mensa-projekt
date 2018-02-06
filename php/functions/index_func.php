<?PHP
	include_once 'misc.php';

	//Code um eine Speise hinzuzufügen
		if (isset($_POST['Tagesangebot_erstellen'])) {
			$_POST = sanitize_form($_POST);
			if ($_POST) {
				$s_ID =$_POST['foodlist'];
				$datum =strtotime($_POST['date']);
				$formated= date('Y-m-d',$datum);
				$insert = "INSERT INTO tagesangebot (speise_ID,datum)
						VALUES ('$s_ID','$formated')";
				if ($conn->query($insert) === TRUE) { //Wenn Tagesangebot hinzugefügt wurde.
					$Alert = successMessage("Tagesangebot wurde erfolgreich hinzugefügt");
				} else {
					$Alert = dangerMessage("Es ist etwas schief gelaufen, bitte versuchen Sie es erneut.");
				}
			} else {
				$Alert = dangerMessage('Fehler: Invalide Eingabe.');
			}
		}

		//Funktion zum erstellen eines Like-Buttons
		function likeButtons($foodID, $foodLikes, $has_liked){

			if (isset($_SESSION['email'])) {
						if ($_SESSION['adminrechte'] == 2 ) { //Falls ein Admin eingeloggt ist, kann dieser den Like-Button nicht anklicken.
							return '<div class="like-container"><button type="button" class="btn heart-btn disabled" data-toggle="tooltip" data-placement="bottom" title="Als Administrator können Sie das Essen nicht liken!">
								<i class="fas fa-heart like-heart-disabled"></i></button><p class="like-count">+'.$foodLikes.'</p></div>';

						}
								else if ($has_liked) {
									return '<form role="form" method="POST" action="">
												<input type="hidden" name="food_ID" value="'.$foodID.'">
												<div class="like-container"><button type="submit" name="Speisen_unliken" class="btn heart-btn like-btn unlike" data-toggle="tooltip" data-placement="bottom" title="Diese Speise nicht mehr liken">
													<i class="fas fa-heart like-heart"></i></button><p class="like-count">+'.$foodLikes.'</p></div>
												</form>';
								}
										else {
											return '<form role="form" method="POST" action="">
														<input type="hidden" name="food_ID" value="'.$foodID.'">
														<div class="like-container"><button type="submit" name="Speisen_liken" class="btn heart-btn like-btn like"data-toggle="tooltip" data-placement="bottom" title="Diese Speise liken.">
															<i class="fas fa-heart like-heart"></i></button><p class="like-count">+'.$foodLikes.'</p></div>
														</form>';
										}

									}
											else {
												return '<div class="like-container"><button type="button" class="btn heart-btn disabled" data-toggle="tooltip" data-placement="bottom" title="Sie müssen eingeloggt sein um zu liken.">
																<i class="fas fa-heart like-heart-disabled"></i></button><p class="like-count">+'.$foodLikes.'</p></div>';
										}
			}

		// Code um Speisen zu liken
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
			}
		}


		//Code zum unliken
			if (isset($_POST['Speisen_unliken'])) {
				$_POST = sanitize_form($_POST);
				if ($_POST) {
					$food_ID =$_POST['food_ID'];
					$user_ID = $_SESSION['id'];
					$delete = "DELETE FROM likes WHERE speise_ID = $food_ID AND benutzer_ID = $user_ID";

					$conn->query($delete);
				} else {
					$Alert = dangerMessage('Fehler: Invalide Eingabe.');
				}
			}


			//Code zum löschen eines Tagesangebots
			if (isset($_GET['delete?daymeal_ID'])) {
				$_GET = sanitize_form($_GET);
				if ($_GET) {
					$daymeal_ID = $_GET['delete?daymeal_ID'];
					$delete = "DELETE FROM tagesangebot WHERE tagesangebot_ID = $daymeal_ID ";
					if ($conn->query($delete) === TRUE) {
						$Alert = successMessage('Tagesangebot wurde erfolgreich entfernt');
					} else {
						$Alert = dangerMessage("<strong>Error:</strong> " . $delete . "<br>" . $conn->error ."");
					}
				} else {
					$Alert = dangerMessage('Fehler: Invalide Eingabe.');
				}
			}

			//Code zum Ändern eines Tagesangebots
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
						$Alert = dangerMessage("<strong>Error:</strong>".$conn->errno.": ".$conn->error);
					}
				} else {
					$Alert = dangerMessage('Fehler: Invalide Eingabe.');
				}
			}


?>
