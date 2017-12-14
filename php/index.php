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
					for ($i=0;$i <5; $i++) {
						$output=  "<td>";
						if(true) {
							$output = $output . "<button class='btn btn-success'>Essen hinzufügen</button></a>";
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

	</body>
	<?php include 'footer.php' ?>
</html>
