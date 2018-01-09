<?php include_once 'dependencies.php'; ?>
<!DOCTYPE HTML>
<html>
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
		<?php include 'header.php'; ?>
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
					//die ersten 5 tage der aktuellen woche werden ausgegeben.
}
				?>
          </tr>
        </thead>
        <tbody>
          <td>Essen</td>
          <td>Essen</td>
          <td>Essen</td>
          <td>Essen</td>
          <td>Essen</td>
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
		</div>
	</body>
	<?php include 'footer.php'; ?>
</html>
