<?php
session_start();?>
<!DOCTYPE HTML>
<html>
<?php include 'dependencies.php' ?>
	<head>
		<title>ITS-Stuttgart - Mensa</title>
		<?php
			echo $head_dependencies;
			//Jahr wird in 52 Wochen geteilt
			$year = (isset($_GET['year'])) ? $_GET['year'] : date("Y");
			$week = (isset($_GET['week'])) ? $_GET['week'] : date('W');
			if($week > 52) {
				$year++;
				$week = 1;
			} elseif($week < 1) {
				$year--;
				$week = 52;
			}
			//Code um eine Speise hinzuzufügen
			if (isset($_POST['Tagesangebot_erstellen'])) {
				$s_ID =$_POST['foodlist'];
				$datum =$_POST['date'];
				$insert = "INSERT INTO tagesangebot (speise_ID,datum)
						VALUES ('$s_ID','$datum')";
				if ($conn->query($insert) === true) {
					$result_message = "<div class='alert alert-success alert-dismissable'>
  				<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Tagesangebot wurde erfolgreich hinzugefügt</div>";
				} else {
					$result_message = "<div class='alert alert-danger alert-dismissable'>
					<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Tagesangebot konnte nicht hinzugefügt werden</div>";
				}
				echo $result_message;
				}
			?>
	</head>

	<body>
		<?php include 'header.php' ?>
		<div class="container">
      <div class="row">
        <div class="col-sm-1">
		<a href="<?php echo $_SERVER['PHP_SELF'].'?week='.($week == 1 ? 52 : $week -1).'&year='.($week == 1 ? $year - 1 : $year); ?>">
          <button class="btn btn-success index-btns">
            <i class='fa fa-arrow-circle-left'> </i>
          </button></a> <!--Button um eine Woche zurück zu springen -->
        </div>
        <div class="col-sm-10">
            <h1>Wochenansicht</h1>

           <table class="table table-bordered">
        <thead class="thead-light">
          <tr>
            <?php
						  if($week < 10) {
					$week = '0'. $week;
				}
				for($day= 1; $day <= 5; $day++) {
					$d = strtotime($year ."W". $week . $day);


					echo "<th>". date('l', $d) ."<br>". date('d M', $d) ."</th>";
					//die ersten 5 tage der aktuellen woche werden ausgegeben.
}
				?>
          </tr>
        </thead>
        <tbody>
					<?php
					for ($i=1 ;$i <=5; $i++) {
						$output=  "<td>";
						if(true) {
							$gendate = new DateTime();
							$gendate->setISODate($year,$week,$i);
							$date = $gendate->format('Y-m-d');
							$output = $output . "<button type='button' class='btn btn-success btn-lg' data-toggle='modal' data-target='#AddDayMeal' onclick=AddDateToModal('".$date."')>Hinzufügen</button>";
						}
						else {
							$output = $output . "Hier ist laut dem Code Essen.";
						}

						$output = $output . "</td>";
						echo $output;
					}
					?>

        </tbody>
      </table>
        </div>
        <div class="col-sm-1 test1">
		<a href="<?php echo $_SERVER['PHP_SELF'].'?week='.($week == 52 ? 1 : 1 + $week).'&year='.($week == 52 ? 1 + $year : $year); ?>">
          <button class="btn btn-success index-btns">
            <i class='fa fa-arrow-circle-right'> </i>
          </button></a> <!--Button um eine Woche vor zu springen -->
        </div>
      </div>
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
					<form role="form" method="POST" action="index.php">
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
	<?php include 'footer.php' ?>
</html>
