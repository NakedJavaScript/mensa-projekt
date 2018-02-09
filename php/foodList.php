<?php
	include_once 'dependencies.php';
	include_once 'views/foodList.php';
	include_once 'modals/foodList.php';
?>

<!DOCTYPE HTML>
<html>
	<head>
		<?php
			echo $head_dependencies;
			$sql = "SELECT * FROM speise";
			$result = $conn->query($sql);
		?>
		<title>Essensliste</title>
	</head>

	<body>
		<?php include 'header.php';
			if(((!isset($_SESSION['adminrechte'])) || $_SESSION['adminrechte'] != 2)) { // Checks if the user has Admin rights
				include'footer.php';
				die('Sie haben keinen Zugriff auf diese Seite. Bitte loggen Sie sich als ein Administrator ein.'); // If not the user wont be able to access the site
			}
		?>

		<div class="container col-sm-10">
			<h1>Essensliste</h1>
			<br>
			<p>Das ist die globale Essensliste auf die nur Sie als Administrator Zugriff haben. Hier können Sie sehen welche Essen existieren, diese sortieren, nach ihnen suchen, sie bearbeiten oder löschen. Zudem können Sie mit dem Button weiter unten ein neues Essen erstellen.</p>
			<br>
			<button type='button' class='btn btn-success btn-lg' data-toggle="modal" data-target="#new-food">Hinzufügen <i class='fas fa-plus'></i></button>

			<br/>
			<br/>

			<table class="tabelsorterTable table table-hover tablesorter">
				<thead>
					<tr>
						<th>Name der Speise <i class="fas fa-exchange-alt"></i></th>
						<th>Allergene/Inhaltsstoffe <i class="fas fa-exchange-alt"></i></th>
						<th>Sonstiges <i class="fas fa-exchange-alt"></i></th>
						<th>Preis <i class="fas fa-exchange-alt"></i></th>
						<th class="filter-false" data-sorter="false">Löschen/Bearbeiten</th>
					</tr>
				</thead>
				<tbody>
					<?php
						if ($result->num_rows > 0) {
							// Returns the data in a table
							while($row = $result->fetch_assoc()) {
								echo "<tr><td class='align-middle'>".$row['name']."</td>";
								echo "<td class='align-middle'>".$row['allergene_inhaltsstoffe']."</td>";
								echo "<td class='align-middle'>".$row['sonstiges']."</td>";
								echo "<td class='align-middle'>".$row['preis']."€</td>";
								echo "<td class='align-middle'><button type='button' method='POST' data-href='?delete?speiseID=".$row['speise_ID']."' data-toggle='modal' data-target='#confirm-delete' class='btn btn-danger'>
								<i class='fas fa-trash'> </i></button>
								<button type='button' class='btn btn-success' speise_ID='".$row['speise_ID']."' speise_name='".$row['name']."' sonstiges='".$row['sonstiges']."' allergens='".$row['allergene_inhaltsstoffe']."' preis='".$row['preis']."' data-toggle='modal' data-target='#editFood' method='POST' id='edit_food'  >
								<i class='fas fa-pencil-alt'> </i></button>
								</td>
								</tr>";
							}
						}
						else {
							echo "<tr><td class='align-middle'><strong>Keine Ergebnisse</strong></td></tr>";
						}
					?>
				</tbody>
			</table>

			<!-- jQuery Tablesorter Pager -->
			<div id="pager" class="pager">
				<form>
					<i class="fas fa-angle-double-left first"/></i>
					<i class="fas fa-angle-left prev"/></i>
					<span class="pagedisplay" data-pager-output-filtered="{startRow:input} &ndash; {endRow} / {filteredRows} of {totalRows} total rows"></span>
					<i class="fas fa-angle-right next"/></i>
					<i class="fas fa-angle-double-right last"/></i>
					<select class="pagesize">
						<option value="10">10</option>
						<option value="20">20</option>
						<option value="30">30</option>
						<option value="40">40</option>
						<option value="all">Alle Essen</option>
					</select>
				</form>
			</div>
		</div>

		<?PHP // Opens the modal to delete a meal
			confModal('Wollen Sie diese Speise wirklich löschen?');
			include 'footer.php';
		?>
	</body>
</html>
