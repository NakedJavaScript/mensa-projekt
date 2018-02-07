<?php
	include_once 'dependencies.php';
	include_once 'functions/index_func.php';
	include_once 'modals/index_modals.php';
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>ITS-Stuttgart - Mensa</title>
		<?php
			echo $head_dependencies;
			setlocale(LC_TIME, 'de_DE', 'deu_deu'); // Set the timesetting to german
			$dt = new DateTime;
			if (isset($_GET['year']) && isset($_GET['week'])) { // set and get the year/weeks
				$dt->setISODate($_GET['year'], $_GET['week']);
			} else {
				$dt->setISODate($dt->format('o'), $dt->format('W'));
			}

			$year = $dt->format('o');
			$week = $dt->format('W');
		?>
	</head>

	<body>
		<?php include 'header.php';	?>

		<div class="container col-sm-12">
			<div class="d-inline-flex">
				<div class="col-sm-1 align-self-center d-flex flex-row-reverse">
					<?PHP  $ThreeWeeksAgo = date("W", strtotime("- 3 week")); // Create the current week minus 3 ?>
					<a href="<?php echo $_SERVER['PHP_SELF'].'?week='.($week == 1 ? 52 : $week -1).'&year='.($week == 1 ? $year - 1 : $year) . '"'; if($week <= $ThreeWeeksAgo) { echo " class='disable' "; } // If we reach the week that was 3 weeks ago, then the link is disabled ?>">
						<button class="btn btn-success index-btns" <?PHP if($week == $ThreeWeeksAgo) { echo "disabled"; } // If we reach the week that was 3 weeks ago, then the button is disabled ?> >
							<i class='fas fa-chevron-circle-left'> </i>
						</button>
					</a>
				</div>
				<div class="align-self-stretch">
					<h1>Wochenansicht</h1>
					<table class="table table-bordered day-meal-table">
						<thead class="thead-light">
							<tr>
								<?php
									if($week < 10) {
										$week = '0'. $week;
									}

									$today = new DateTime(); // Creating DateTime object of "right now"
									for($day=1; $day<=5; $day++){
										if ($dt->getTimestamp() == $today->getTimestamp()) { // Sets 'today' if $dt is todays date, that way todays date gets highlighted
											echo "<th class='today'>";
										} else {
											echo "<th>";
										}

										echo strftime("%A", $dt->getTimestamp()) . "<br>" . strftime('%d, %b', $dt->getTimestamp()) . "</th>\n";
										$dt->modify('+1 day'); // Return only the first 5 days of the week
									}
								?>
							</tr>
						</thead>
						<tbody>
							<?php
								$sql = "SELECT * FROM tagesangebot";
								$result = $conn->query($sql);
								$entries =[];

								while($entry = $result->fetch_assoc()) { // Get all daily meals and save them into the array
									$entries[] = $entry;
								}

								for ($i=1 ;$i <=5; $i++) { // Create the table and get every data we need (meals, dates)
									$output=  "<td class='align-middle'>";
									$daymeal_exists = false;
									$gendate = new DateTime();
									$gendate->setISODate($year, $week, $i);
									$date = $gendate->format('Y-m-d');

									foreach ($entries as $entry){
										if ($entry['datum'] == $date) {
											$daymeal_exists = true;
											break;
										}
									}

									if($daymeal_exists) { // Display attributes of the asocciated meal
										$countLikes = "SELECT COUNT(*) AS speise_likes FROM likes WHERE speise_ID =" .$entry['speise_ID']; // Counts how many likes a meal has
										$foodLikes = $conn->query($countLikes)->fetch_assoc()['speise_likes']; // Saves the numbers of likes in a variable

										if (isset($_SESSION["id"])) {
											$checkLiked = "SELECT COUNT(*) AS userlike FROM likes WHERE speise_ID =" .$entry['speise_ID'] ." AND benutzer_ID =". $_SESSION["id"]; // Counts how many lines in the database have the user ID and the meal ID (should only be one)
											$has_liked = $conn->query($checkLiked)->fetch_assoc()['userlike']; // The counted numbers are saved into a variable
										} else {
											$has_liked = 1; // Otherwise the value is always 1
										}

										$sql = "SELECT * FROM speise where speise_ID = ".$entry["speise_ID"];
										$meal = $conn->query($sql)->fetch_assoc(); // Create the index table
										$output = $output . "<div class='d-flex flex-column'>
										<div class='p-2'><b>Name:</b><div>".$meal['name']."</div></div>
										<div class='p-2'><b>Allergene/Inhaltsstoffe:</b><div>".$meal['allergene_inhaltsstoffe']."</div></div>
										<div class='p-2'><b>Sonstiges:</b><div>".$meal['sonstiges']."</div></div>
										<div class='p-2'><b>Preis:</b><div>".$meal['preis']."€</div></div>
										<div class='p-2'>" . likeButtons($meal["speise_ID"], $foodLikes, $has_liked) . "</div>
										</div>";

										if(((isset($_SESSION['adminrechte'])) && $_SESSION['adminrechte'] == 2)) { // If you have admin rights you can delete/edit the daily meals and you'll see how often a meal was bought
											$sql = "SELECT COUNT(*) AS orders FROM buchungen WHERE tagesangebot_ID = ".$entry['tagesangebot_ID'];
											$orders = $conn->query($sql)->fetch_assoc();
											$output = $output . "<button type='button' method='POST' data-href='?delete?daymeal_ID=" .$entry["tagesangebot_ID"]. "' data-toggle='modal' data-target='#confirm-delete' class='btn btn-danger'>
																Löschen</button>
																<button type='button' class='btn btn-success' data-toggle='modal' data-target='#EditDaymeal' onclick=AddValuesToModal('".$date."','".$entry["speise_ID"]."')>
																Ändern</button>
																<div>
																<p><b>Bestellungen: </b>".$orders['orders']."</p></div>";
										}
									} else {
										if(((isset($_SESSION['adminrechte'])) && $_SESSION['adminrechte'] == 2)) { // Display a button to add a new meal (if you're an Admin)
											$output = $output . "<button type='button' class='btn btn-success btn-lg' data-toggle='modal' data-target='#AddDayMeal' onclick=AddValuesToModal('".$date."')>Hinzufügen</button>";
										}
									}

									$output = $output . "</td>";
									echo $output;
								}
							?>
						</tbody>
					</table>
				</div>
				<div class="col-sm-1 align-self-center">
					<a href="<?php echo $_SERVER['PHP_SELF'].'?week='.($week == 52 ? 1 : 1 + $week).'&year='.($week == 52 ? 1 + $year : $year); ?>" class="right-arrow">
						<button class="btn btn-success position-relative">
							<i class='fas fa-chevron-circle-right'> </i>
						</button>
					</a>
				</div>
			</div>
			<p class="mt-2 mb-2">Für mehr Informationen bezüglich der Deklaration von Allergenen klicken sie <a href="allergene.php">hier</a></p>
		</div>

		<!-- Add new daily meal Modal-->
		<div class="modal fade" id="AddDayMeal" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title">Ein neues Tagesangebot erstellen</h3>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<form role="form" method="POST" action="#AddedTagesangebot">
							<div class="form-group">
								<input type="hidden" id="date_field" name="date" value="">
								<label for="foodlist">Speisen</label>
								<select name="foodlist" id="foodlist">
									<?php
										$getFood = "SELECT * FROM speise";
										$result = $conn->query($getFood);
										$food_options ="";

										while($food = $result->fetch_assoc()) {
											$food_options = $food_options . "<option value=". $food['speise_ID'] .">" . $food['name'] ."</option>"; // Every meal is saved in a dropdown menu
										}
										echo $food_options;
									?>
								</select>
							</div>
							<div class="modal-footer">
								<input type="submit" name="Tagesangebot_erstellen" class="btn btn-primary btn-block" value="Tagesangebot erstellen">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
	<?php
		confModal('Wollen Sie dieses Tagesangebot wirklich löschen?');
		include 'footer.php';
	?>
</html>
