<?PHP
	//Code um ein Tagesangebot zu erstellen
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

				if(isset($_POST['bestellungen'])) {
					$json_array = array();
					$Bestellungen = $_POST['bestellungen'];
					$nutzerID = $_SESSION['id'];
					$buchungsdatum = date("Y-m-d");
						foreach ($Bestellungen as $key => $value) {
							$insertBuchungen = "INSERT INTO buchungen (schueler_ID, tagesangebot_ID, buchungsdatum) VALUES ('$nutzerID', '$value', '$buchungsdatum')";
							$checkIfBooked = $conn->query("SELECT * FROM mensa.buchungen WHERE schueler_ID = '$nutzerID' AND tagesangebot_ID = '$value'"); //Prüfen ob Nutzer nicht doch schon gebucht hat
							$getPreis = $conn->query("SELECT sp.preis FROM mensa.tagesangebot as t INNER JOIN mensa.speise as sp ON sp.speise_ID = t.speise_ID WHERE tagesangebot_ID = '$value' LIMIT 1");//Selektieren den Preis der Speise
							$getPreis = $getPreis->fetch_object();//Selektierung wird gefetcht
								if($checkIfBooked->num_rows >= 1){ //überprüfung ob user nicht doch schon gebucht hat.
									$json_array['status'] = false;
									$json_array['msg'] = "Sie haben das bereits bestellt!";
								}
									else if ($_SESSION['kontostand'] < $getPreis->preis) { //Wenn der Nutzer nicht genug Geld auf seinem Konto hat
										$json_array['status'] = false;
										$json_array['msg'] = "<strong>Leider haben sie nicht genug Geld auf ihrem Konto!</strong> Sie können ihr Konto beim Caterer aufladen.";
									}
									else {
												if($conn->query($insertBuchungen) == true) { //Wenn buchung erfolgreich
													$preis = $getPreis->preis;
													$newKontostand = $_SESSION['kontostand'] - $preis; //Preis wird vom aktuellen kontostand abgezogen
													$_SESSION['kontostand'] = $newKontostand; //neuer Kontostand wird auch in der session aktualisiert
													$conn->query("UPDATE mensa.benutzer SET kontostand = $newKontostand  WHERE  benutzer_ID = $nutzerID "); //neuer Kontostand wird in der Datenbank gesetzt
													$json_array['status'] = true;
													$json_array['msg'] = "Ihre Bestellung war erfolgreich! Sehen sie sich <a href='profil.php#v-pills-order'>hier</a> Ihre Bestellungen an <br/> <strong>Ihr neuer Kontostand: $newKontostand €</strong>";
												}
													else {
														$json_array['status'] = false;
														$json_array['msg'] = "<strong>Error:</strong> Es is ein Fehler aufgetreten, bitte versuchen Sie es erneut oder infomieren sie den Caterer";
													}
													header('Content-Type: application/json');
													echo json_encode($json_array);die();
								}
						}//Ende foreach
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

			//funktion zur erstellung des bestellBestätigungs modal.
			function confBestellung() {
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
											<input type='button' onclick='submit()' name='bestellenBestätigen' class='btn btn-success bestellBtn' value='Kostenpflichtig Bestellen'>
									</div>
							</div>
					</div>
				</div> ";
			}
?>
