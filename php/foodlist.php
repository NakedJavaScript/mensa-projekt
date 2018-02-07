<?php include_once 'dependencies.php';
	  include_once 'functions/foodlist_func.php';
	  include_once 'modals/foodlist_modals.php';
?>

<!DOCTYPE HTML>
<html>
	<head>
		<?php
			echo $head_dependencies;
			if (isset($_GET["page"])) { //Schaut bei welcher Site wir gerade sind, falls keine eingegeben wurde, zeigt er die erste Seite. $page = aktuelle Seite.
				 $page  = $_GET["page"];
			 }
			 else {
				 $page=1;
			 };
					$start_from = ($page-1) * 10; //Rechnet aus bei welchen Eintrag wir nun sind, 10 entspricht den Limit pro Seite.
					$sql = "SELECT * FROM speise ORDER BY speise_ID ASC LIMIT $start_from ,10"; //nimmt das Ergebnis aus $start_from und nimmt dann die darauf folgenden 10 Ergebnisse.
					$result = $conn->query($sql);
		?>
					<title>Essensliste</title>
	</head>

	<body>
		<?php include 'header.php';
			if(((!isset($_SESSION['adminrechte'])) || $_SESSION['adminrechte'] != 2)) { //Verweigert Unbefugten den Zugriff auf diese Seite
				include'footer.php';
				die('Sie haben keinen Zugriff auf diese Seite. Bitte loggen Sie sich als ein Administrator ein.'); } //Verweigert Unbefugten den Zugriff auf diese Seite
		?>
		<div class="container">

			<h1>Essensliste</h1>
			<br>
			<p>Das ist die globale Essensliste auf die nur Sie als Administrator Zugriff haben. Hier können Sie sehen welche Essen existieren, diese sortieren, nach ihnen suchen, sie bearbeiten oder löschen. Zudem können Sie mit dem Button weiter unten ein neues Essen erstellen.</p>
			<br>
			<button type='button' class='btn btn-success btn-lg' data-toggle="modal" data-target="#NewFood">
				Hinzufügen <i class='fas fa-plus'> </i>
			</button>

			<br/>
			<br/>

			<table class="tabelsorterTable table table-hover tablesorter">>
    		<thead>
		      <tr>
        		<th>Name der Speise</th>
        		<th>Allergene/Inhaltsstoffe</th>
        		<th>Sonstiges</th>
        		<th>Preis</th>
				<th class="filter-false" data-sorter="false">Löschen/Bearbeiten</th>
      	</tr>
    	</thead>
		    <tbody>
						<?php
							if ($result->num_rows > 0) {
							// ausgabe der Daten aus jeder Zeile der Tabelle.
									while($row = $result->fetch_assoc()) {
											echo 	"<tr><td class='align-middle'>".$row['name']."</td>";
											echo		"<td class='align-middle'>".$row['allergene_inhaltsstoffe']."</td>";
											echo		"<td class='align-middle'>".$row['sonstiges']."</td>";
											echo		"<td class='align-middle'>".$row['preis']."€</td>";
											echo		"<td class='align-middle'><button type='button' method='POST' data-href='?delete?speiseID=".$row['speise_ID']."' data-toggle='modal' data-target='#confirm-delete' class='btn btn-danger'>
														<i class='fas fa-trash'> </i></button>

														<button type='button' class='btn btn-success' speise_ID='".$row['speise_ID']."' speise_name='".$row['name']."' sonstiges='".$row['sonstiges']."' allergene='".$row['allergene_inhaltsstoffe']."' preis='".$row['preis']."' data-toggle='modal' data-target='#EditFood' method='POST' id='edit_food'  >
														<i class='fas fa-pencil-alt'> </i></button>
														</td>
												</tr>";
									}
							}
								else {
									echo "<tr><td class='align-middle'><strong>0 Ergebnisse</strong></td></tr>";
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
														<option value="all">Alle Nutzer</option>
											</select>
											</form>
									</div>
									</div>
								<!--Page Navigation END -->
								</div>

		<?php include 'footer.php'; ?>
	</body>
</html>
