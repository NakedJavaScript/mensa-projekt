<?php include_once 'dependencies.php';
	  include_once 'functions/index_func.php';
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
									$output=  "<td>";
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
													$has_liked = $conn->query($checkLiked)->fetch_assoc()['userlike'];//der gezählte Wert wird in der Variable $has_liked gespeichert (also 1[true] oder 0[false])
												}
												 		else {
																$has_liked = 1; //anonsten hat $has_liked immer den Wert 1[true]
														}
															$sql = "SELECT * FROM speise where speise_ID =".$entry["speise_ID"];
															$meal = $conn->query($sql)->fetch_assoc();
															if (!isset($_SESSION['id'])) { //Wenn nutzer nicht eingeloggt ist, sind alle Checkboxen disabled
																$output = $output . "<div class='form-check'>
																	<input class='form-check-input indexCB' name='bestellungen[]' type='checkbox'  value='".$entry['tagesangebot_ID']."' data-toggle='tooltip' data-placement='right' data-original-title='Sie müssen eingeloggt sein um bestellen zu können.' disabled></div>";
															}
																	else {
																		$checkIfBooked = $conn->query("SELECT * FROM mensa.buchungen WHERE schueler_ID = '".$_SESSION['id']."'AND tagesangebot_ID = '".$entry['tagesangebot_ID']."'");
																	if($entry['datum'] <= date("Y-m-d") || $checkIfBooked->num_rows >= 1) { //Wenn das Datum des Tagesangebots hinter dem heutigen Tag liegt oder der Nutzer bereits gebucht hat, dann wird die checkbox als "disabled" angezeigt
																		$output = $output . "<div class='form-check'>
																		<input class='form-check-input indexCB' name='bestellungen[]' type='checkbox'  value='".$entry['tagesangebot_ID']."' data-toggle='tooltip' data-placement='right' data-original-title='Entweder haben sie diese Angebot bereits bestellt oder die Bestellfrist ist abgelaufen' disabled></div>";
																}
																			else { //sonst kann man das es ganz normal aussuchen und Buchen.
																			$output = $output . "<div class='form-check'>
																				<input class='form-check-input indexCB' name='bestellungen[]' type='checkbox'  value='".$entry['tagesangebot_ID']."'></div>";
																			}
																		}
																					$output = $output . "<ul class='foodDetailList'>
																						<li><b>Name:</b><br>".$meal['name']."</li>
																						<li><b>Allergene/Inhaltsstoffe:</b><br>".$meal['allergene_inhaltsstoffe']."</li>
																						<li><b>Sonstiges:</b><br>".$meal['sonstiges']."</li>
																						<li><b>Preis:</b><br>".$meal['preis']."€</li>
																					</ul>" . likeButtons($meal["speise_ID"], $foodLikes, $has_liked) . "";
									}
											else { // Button zum erstellen eines Tagesangebots wird gezeigt.
													if(((isset($_SESSION['adminrechte'])) && $_SESSION['adminrechte'] == 2)) { //falls noch kein Tagesangebot erstellt wurde und ein Admin eingeloggt ist wird der "Hinzufügen" button gezeigt.
														$output = $output . "<button type='button' class='btn btn-success btn-lg' data-toggle='modal' data-target='#AddDayMeal' onclick=AddDateToModal('".$date."')>Hinzufügen</button>";
													}
											}
												$output = $output . "</td>";
												echo $output;
							}//end of for loop
							?>
        </tbody>
      </table>
			<div class="bestellBtn">
					<input type="button" name="bestellen" class="btn btn-success bestellBtn" id="bestellBtn" value="Kostenpflichtig Bestellen" data-toggle='modal' data-target='#confirm-submit' disabled>
					<!-- Confirm Modal -->
					<?PHP confBestellung(); ?>
					<!-- Confirm Modal -->
			</div>
		        </div>
		        <div class="col-sm-1 test1">
				<a href="<?php echo $_SERVER['PHP_SELF'].'?week='.($week == 52 ? 1 : 1 + $week).'&year='.($week == 52 ? 1 + $year : $year); ?>" class="right-arrow">
		          <button class="btn btn-success index-btns">
		            <i class='fas fa-chevron-circle-right'> </i>
		          </button></a> <!--Button um eine Woche vor zu springen -->
		        </div>
		      </div>

			<p>Für mehr Informationen bezüglich der Deklaration von Allergenen klicken sie <a href="allergene.php">hier</a></p>

</div><!--end of div container -->




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

								<input type="submit"  name="Tagesangebot_erstellen" class="btn btn-primary btn-block" value="Tagesangebot erstellen">
							</div>
						</form>
				</div>
			</div>
		</div>
		<!--AddDayMeal Modal End-->
	</body>
	<?php include 'footer.php'; ?>
		<!-- Modal zur Bestätigung des Kaufs-->


	<script>
	function submit() {
	    var bestellungen = [];
	    $(".indexCB:checked").each(function(){
	        bestellungen.push($(this).val());
	    });
		$.ajax({
			 type: "POST",
			 url: 'index.php',
			 data: ({bestellungen}),
			 success: function(data) {
			   $("#confirm-submit").modal('hide');
			   $('#successOrder').addClass('show');
			   $('.indexCB:checked').prop('disabled', true);
			   $('.indexCB:checked').prop('checked', false);
			  }
		});
	}
</script>
<script>
	var boxes = $('.indexCB');

boxes.on('change', function () {
    $('#bestellBtn').prop('disabled', !boxes.filter(':checked').length);
}).trigger('change');
	</script>
</html>
