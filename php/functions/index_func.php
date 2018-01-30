<?PHP
	//Code um eine Speise hinzuzufügen
		if (isset($_POST['Tagesangebot_erstellen'])) {
			$s_ID =$_POST['foodlist'];
			$datum =strtotime($_POST['date']);
			$formated= date('Y-m-d',$datum);
			$insert = "INSERT INTO tagesangebot (speise_ID,datum)
					VALUES ('$s_ID','$formated')";
			if ($conn->query($insert) === TRUE) { //Wenn Tagesangebot hinzugefügt wurde.
				$Alert = successMessage("Tagesangebot wurde erfolgreich hinzugefügt");
			} else { //Fall es nicht klappt wird der Nutzer mit einem Errorcode und einer Errornummer konfrontiert
				$Alert = dangerMessage("<strong>Error:</strong>".$conn->errno.": ".$conn->error);
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


			//Code zum löschen eines Tagesangebots
			if (isset($_GET['delete?speise_ID'])) {
				$speise_ID = $_GET['delete?speise_ID'];
				$date = strtotime($_GET['date']);
				$formated= date('Y-m-d',$date);
				$delete = "DELETE FROM tagesangebot WHERE speise_ID = $speise_ID AND datum = '$formated'";
				echo $delete;
					if ($conn->query($delete) === TRUE) {
						$Alert = successMessage('Tagesangebot wurde erfolgreich entfernt');
					}
						else {
							$Alert = dangerMessage("<strong>Error:</strong> " . $delete . "<br>" . $conn->error ."");
						}
			}

			//Code zum Ändern eines Tagesangebots
			if (isset($_POST['Tagesangebot_erstellen'])) {
				$s_ID =$_POST['foodlist'];
				$datum =strtotime($_POST['date']);
				$formated= date('Y-m-d',$datum);
				$insert = "INSERT INTO tagesangebot (speise_ID,datum)
						VALUES ('$s_ID','$formated')";
				if ($conn->query($insert) === TRUE) { //Wenn Tagesangebot hinzugefügt wurde.
					$Alert = successMessage("Tagesangebot wurde erfolgreich hinzugefügt");
				} else { //Fall es nicht klappt wird der Nutzer mit einem Errorcode und einer Errornummer konfrontiert
					$Alert = dangerMessage("<strong>Error:</strong>".$conn->errno.": ".$conn->error);
				}
			}


?>
