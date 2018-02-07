<?PHP
	//Code um eine Speise hinzuzufügen
		if (isset($_POST['AddDaymeal'])) {
			$s_ID =$_POST['foodList'];
			$datum =strtotime($_POST['date']);
			$formated= date('Y-m-d',$datum);
			$insert = "INSERT INTO tagesangebot (speise_ID,datum)
					VALUES ('$s_ID','$formated')";
			if ($conn->query($insert) === TRUE) { //Wenn Tagesangebot hinzugefügt wurde.
				$alert = successMessage("Tagesangebot wurde erfolgreich hinzugefügt");
				header('refresh: 1.5 ; url = index.php');
				die();
			} else {
				$alert = dangerMessage("Es ist etwas schief gelaufen, bitte versuchen Sie es erneut.");
				header('refresh: 1.5 ; url = index.php');
			}
		}

		//Funktion zum erstellen eines Like-Buttons
		function likeButtons($foodID, $foodLikes, $hasLiked){

			if (isset($_SESSION['email'])) {
						if ($_SESSION['adminrechte'] == 2 ) { //Falls ein Admin eingeloggt ist, kann dieser den Like-Button nicht anklicken.
							return '<div class="like-container"><button type="button" class="btn heart-btn disabled" data-toggle="tooltip" data-placement="bottom" title="Als Administrator können Sie das Essen nicht liken!">
								<i class="fas fa-heart like-heart-disabled"></i></button><p class="like-count">+'.$foodLikes.'</p></div>';

						}
								else if ($hasLiked) {
									return '<form role="form" method="POST" action="">
												<input type="hidden" name="foodID" value="'.$foodID.'">
												<div class="like-container"><button type="submit" name="unlikingFood" class="btn heart-btn like-btn unlike" data-toggle="tooltip" data-placement="bottom" title="Diese Speise nicht mehr liken">
													<i class="fas fa-heart like-heart"></i></button><p class="like-count">+'.$foodLikes.'</p></div>
												</form>';
								}
										else {
											return '<form role="form" method="POST" action="">
														<input type="hidden" name="foodID" value="'.$foodID.'">
														<div class="like-container"><button type="submit" name="LikingFood" class="btn heart-btn like-btn like"data-toggle="tooltip" data-placement="bottom" title="Diese Speise liken.">
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
		if (isset($_POST['LikingFood'])) {
			$userID = $_SESSION['id'];
			$foodID =$_POST['foodID'];
			$insert = "INSERT INTO likes (benutzer_ID, speise_ID)
			VALUES (".$userID."," .$foodID.")";

			$conn->query($insert);
			header('refresh: 0.1 ; url = index.php');
			die();
		}


		//Code zum unliken
			if (isset($_POST['unlikingFood'])) {
				$foodID =$_POST['foodID'];
				$userID = $_SESSION['id'];
				$delete = "DELETE FROM likes WHERE speise_ID = $foodID AND benutzer_ID = $userID";

				$conn->query($delete);
				header('refresh: 0.1 ; url = index.php');
				die();
			}


			//Code zum löschen eines Tagesangebots
			if (isset($_GET['delete?daymealID'])) {
				$daymealID = $_GET['delete?daymealID'];
				$delete = "DELETE FROM tagesangebot WHERE tagesangebot_ID = $daymealID ";
				if ($conn->query($delete) === TRUE) {
					$alert = successMessage('Tagesangebot wurde erfolgreich entfernt');
					header('refresh: 1.5 ; url = index.php');
					die();
				} else {
					$alert = dangerMessage("Es ist etwas schief gelaufen, bitte versuchen Sie es erneut.");
					header('refresh: 1.5 ; url = index.php');
					die();
				}
			}

			//Code zum Ändern eines Tagesangebots
			if (isset($_POST['editDaymeal'])) {
				$oldFoodID = $_POST['food'];
				$newFoodID = $_POST['foodList'];
				$date = strtotime($_POST['date']);
				$formatedDate= date('Y-m-d',$date);
				$insert = "UPDATE tagesangebot SET  speise_ID = $newFoodID WHERE speise_ID = $oldFoodID AND datum = '$formatedDate'";
				if ($conn->query($insert) === TRUE) {
					$alert = successMessage("Tagesangebot wurde erfolgreich bearbeitet");
					header('refresh: 1.5 ; url = index.php');
					die();
				} else {
					$alert = dangerMessage("Es ist etwas schief gelaufen, bitte versuchen Sie es erneut.");
					header('refresh: 1.5 ; url = index.php');
					die();
				}
			}


?>
