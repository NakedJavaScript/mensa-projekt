<?php include_once 'dependencies.php';
	  include_once 'functions/index_func.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>ITS-Stuttgart - Mensa</title>
		<?php
			echo $head_dependencies;
			$year = (isset($_GET['year'])) ? $_GET['year'] : date("Y");
			$week = (isset($_GET['week'])) ? $_GET['week'] : date('W');
				if($week > 52) {

    			$year++;
    			$week = 1;
				}
				elseif($week < 1) {
    			$year--;
    			$week = 52;
				}

							function likeButtons()
							{
								if (((isset($_SESSION['email'])) && $_SESSION['adminrechte'] != 2)) {
									return '<button type="button" class="btn heart-btn">
										<i class="fas fa-heart like-heart"></i>
									</button>';
								} else if (((isset($_SESSION['email'])) && $_SESSION['adminrechte'] = 2)) {
									return '<button type="button" class="btn heart-btn disabled" data-toggle="tooltip" data-placement="bottom" title="Als Administrator können Sie das Essen nicht liken!">
									  <i class="fas fa-heart like-heart-disabled"></i>
								  </button>';
								}
								else {
								  return '<button type="button" class="btn heart-btn disabled" data-toggle="tooltip" data-placement="bottom" title="Bitte loggen Sie sich ein um zu liken!">
									  <i class="fas fa-heart like-heart-disabled"></i>
								  </button>';
								}
							}

		?>

	</head>

	<body>
		<?php include 'header.php';	?>
		<div class="container">
			<div class="row">
				<div class="col-sm-1">
					<a href="<?php echo $_SERVER['PHP_SELF'].'?week='.($week == 1 ? 52 : $week -1).'&year='.($week == 1 ? $year - 1 : $year); ?>">
					<button class="btn btn-success index-btns">
						<i class='fas fa-chevron-circle-left'> </i>
					</button></a> <!--Button um eine Woche zurück zu springen -->
				</div>
				<div class="col-sm-10">
					<h1>Wochenansicht</h1>

           <table class="table table-bordered">
        <thead class="thead-light">
          <tr>
            <?php
							setlocale(LC_TIME, 'de_DE', 'deu_deu');
						  if($week < 10) {
									$week = '0'. $week;
							}

                for($day= 1; $day <= 5; $day++) {
                  $d = strtotime($year ."W". $week . $day);
                  echo "<th>". strftime('%A', $d) ."<br>". strftime('%d, %b', $d) ."</th>";

					//die ersten 5 tage der aktuellen woche werden ausgegeben
        }
				?>
          </tr>
        </thead>
        <tbody>
					<?php
					$sql = "SELECT * FROM tagesangebot"; // This is not optimized, need only daymeals of one week
					$result = $conn->query($sql);
					$entrys =[];
					while($entry = $result->fetch_assoc()) {
						$entrys[] = $entry;
					}
					for ($i=1 ;$i <=5; $i++) {
						$output=  "<td>";
						$daymeal_exists = false;
						$gendate = new DateTime();
						$gendate->setISODate($year,$week,$i);
						$date = $gendate->format('Y-m-d');
						foreach ($entrys as $entry){
							if ($entry['datum'] == $date) {
								$daymeal_exists = true;
								break;
							}
						}
						if($daymeal_exists) {
							$output = $output . "Hier ist laut dem Code Essen.";
						}
						else {
							if(((isset($_SESSION['adminrechte'])) && $_SESSION['adminrechte'] == 2)) {
								 $output = $output . "<button type='button' class='btn btn-success btn-lg' data-toggle='modal' data-target='#AddDayMeal' onclick=AddDateToModal('".$date."')>Hinzufügen</button>";
							}
						}

						$output = $output . "<div class='like-box'>" . likeButtons() . "<p class='like-numbers'>+2</p> </div> </td>";
						echo $output;
					}
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

		<!--New Food Modal-->
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
										$sql = "SELECT * FROM speise";
										$result = $conn->query($sql);
										$food_options ="";
										while($food = $result->fetch_assoc()) {
											$food_options = $food_options . "<option value=". $food['speise_ID'] .">" . $food['name'] ."</option>";
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
		<!--New Food Modal End-->
	</body>
	<?php include 'footer.php'; ?>
</html>
