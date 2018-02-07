<?php include_once 'dependencies.php';
	  include_once 'views/index.php';
	  include_once 'modals/index.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>ITS-Stuttgart - Mensa</title>
		<?php
			echo $head_dependencies;
			setlocale(LC_TIME, 'de_DE', 'deu_deu');
			$dt = new DateTime;
    		if (isset($_GET['year']) && isset($_GET['week'])) {
        		$dt->setISODate($_GET['year'], $_GET['week']);
    		}
					else {
        		$dt->setISODate($dt->format('o'), $dt->format('W'));
    			}
    		$year = $dt->format('o');
    		$week = $dt->format('W');

		?>
	</head>

	<body>
		<?php include 'header.php';	?>

		<div class="container col-sm-12">
      <div class="row">
        <div class="col-sm-1">
					<?PHP  $ThreeWeeksAgo = date("W", strtotime("- 3 week")); //Current week -3 ?>
								<a href="<?php echo $_SERVER['PHP_SELF'].'?week='.($week == 1 ? 52 : $week -1).'&year='.($week == 1 ? $year - 1 : $year) . '"'; if($week <= $ThreeWeeksAgo) { echo " class='disable' "; } //if we reach the week 3 weeks ago, than the link is disabled ?>">
								<button class="btn btn-success index-btns" <?PHP if($week == $ThreeWeeksAgo) { echo "disabled"; } //if we reach the week 3 weeks ago, than the button is disabled ?> >
									<i class='fas fa-chevron-circle-left'> </i>
								</button></a> <!--Button um eine Woche zurück zu springen -->
        </div>
        <div class="col-sm-10">
            <h1>Wochenansicht</h1>

           <table class="table table-bordered daymealTable">
        <thead class="thead-light">
          <tr>
            <?php
								setlocale(LC_TIME, 'de_DE', 'deu_deu');
								if($week < 10) {
									$week = '0'. $week;
								}
								$today = new DateTime(); //Creating DateTime object of right now
								for($day=1;$day<=5;$day++){
				    				if ($dt->getTimestamp() == $today->getTimestamp()) { //sets 'today' if $dt is todays date, that way todays date gets highlighted
													echo "<th class='today'>";
										}
											else {
											echo "<th>";
											}
											echo strftime("%A", $dt->getTimestamp()) . "<br>" . strftime('%d, %b', $dt->getTimestamp()) . "</th>\n";
				    				$dt->modify('+1 day'); //die ersten 5 tage der aktuellen woche werden ausgegeben.
				        		}
					?>
          </tr>
        </thead>
        <tbody>
					<?php
								$sql = "SELECT * FROM tagesangebot"; // This is not optimized, need only daymeals of one week
								$result = $conn->query($sql);
								$entries =[]; //array $entries wird erstellt
								while($entry = $result->fetch_assoc()) { //alle werte werden in $entries gespeichert
									$entries[] = $entry; //
								}
								for ($i=1 ;$i <=5; $i++) {
									$output=  "<td class='align-middle'>";
									$daymeal_exists = false;
									$gendate = new DateTime();
									$gendate->setISODate($year,$week,$i);
									$date = $gendate->format('Y-m-d');
									foreach ($entries as $entry){
										if ($entry['datum'] == $date) {
											$daymeal_exists = true;
											break;
										}
									}
									if($daymeal_exists) { // Display attributes of the asocciated meal
										$countLikes = "SELECT COUNT(*) AS speise_likes FROM likes WHERE speise_ID =" .$entry['speise_ID']; //zählt wie viele likes eine Speise hat.
										$foodLikes = $conn->query($countLikes)->fetch_assoc()['speise_likes']; //Die Anzahl der likes wird in der Variable $foodLikes gespeichert.
												if (isset($_SESSION["id"])) {
													$checkLiked = "SELECT COUNT(*) AS userlike FROM likes WHERE speise_ID =" .$entry['speise_ID'] ." AND benutzer_ID =". $_SESSION["id"]; //Zählt wie viele zeilen mit genau dieser user Id und der speise ID vorkommen (normalerweise darf es maximal ein mal vorkommen)
													$has_liked = $conn->query($checkLiked)->fetch_assoc()['userlike'];//der gezählt Wert wird in der Variable $has_liked gespeichert (also 1[true] oder 0[false])
												}
												 		else {
																$has_liked = 1; //anonsten hat $has_liked immer den Wert 1[true]
														}
															$sql = "SELECT * FROM speise where speise_ID =".$entry["speise_ID"];
															$meal = $conn->query($sql)->fetch_assoc();
															$output = $output . "<ul class='foodDetailList'>
															<li><b>Name:</b><br>".$meal['name']."</li>
															<li><b>Allergene/Inhaltsstoffe:</b><br>".$meal['allergene_inhaltsstoffe']."</li>
															<li><b>Sonstiges:</b><br>".$meal['sonstiges']."</li>
															<li><b>Preis:</b><br>".$meal['preis']."€</li>
															<li>" . likeButtons($meal["speise_ID"], $foodLikes, $has_liked) . "</li>
															</ul>";
															if(((isset($_SESSION['adminrechte'])) && $_SESSION['adminrechte'] == 2)) {
																$sql = "SELECT COUNT(*) AS orders FROM buchungen WHERE tagesangebot_ID = ".$entry['tagesangebot_ID'];
																$orders = $conn->query($sql)->fetch_assoc();
																$output = $output . "<button type='button' method='POST' data-href='?delete?daymeal_ID=" .$entry["tagesangebot_ID"]. "' data-toggle='modal' data-target='#confirm-delete' class='btn btn-danger'>
																					Löschen</button>
																					<button type='button' class='btn btn-success' data-toggle='modal' data-target='#EditDaymeal' onclick=AddValuesToModal('".$date."','".$entry["speise_ID"]."')>
																					Ändern</button>
																					<div>
																					<p><b>Bestellungen: </b>".$orders['orders']."</p></div>"

																					;
															}
									}
											else { // Display a button for the adding of a meal
													if(((isset($_SESSION['adminrechte'])) && $_SESSION['adminrechte'] == 2)) { //falls noch kein Tagesangebot erstellt wurde und ein Admin eingeloggt ist wird der "Hinzufügen" button gezeigt.
														$output = $output . "<button type='button' class='btn btn-success btn-lg' data-toggle='modal' data-target='#AddDayMeal' onclick=AddValuesToModal('".$date."')>Hinzufügen</button>";
													}
											}
												$output = $output . "</td>";
												echo $output;
							}//end of for loop
							?>
        </tbody>
      </table>
        </div>
        <div class="col-sm-1 test1">
		<a href="<?php echo $_SERVER['PHP_SELF'].'?week='.($week == 52 ? 1 : 1 + $week).'&year='.($week == 52 ? 1 + $year : $year); ?>" class="right-arrow">
          <button class="btn btn-success index-btns">
            <i class='fas fa-chevron-circle-right'> </i>
          </button></a> <!--Button um eine Woche vor zu springen -->
        </div>
      </div>
			<p>Für mehr Informationen bezüglich der Deklaration von Allergenen klicken sie <a href="allergene.php">hier</a></p>
		</div>


		<!--AddDayMeal Modal-->
		<div class="modal fade" id="AddDayMeal" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
				<!-- header -->
					<div class="modal-header">
						<h3 class="modal-title">Ein neues Tagesangebot erstellen</h3>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
				<!-- body -->
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
												$food_options = $food_options . "<option value=". $food['speise_ID'] .">" . $food['name'] ."</option>";//Alle speisen werden als dropdownoption gespeichert.
											}
											echo $food_options;
										?>
									</select>
								</div>
							</div>
							<!-- footer -->
							<div class="modal-footer">

								<input type="submit" name="Tagesangebot_erstellen" class="btn btn-primary btn-block" value="Tagesangebot erstellen">
							</div>
						</form>
				</div>
			</div>
		</div>
		<!--AddDayMeal Modal End-->
	</body>
	<?php
	confModal('Wollen Sie dieses Tagesangebot wirklich löschen?');
	include 'footer.php';

	 ?>
</html>
