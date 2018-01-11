<?php include_once 'dependencies.php'; ?>
<!DOCTYPE HTML>
<html>
	<head>
		<?php
			echo $head_dependencies;
			echo $head_dependencies;
			if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };//Schaut bei welcher Site wir gerade sind, falls keine eingegeben wurde, zeigt er die erste Seite. $page = aktuelle Seite.
			$start_from = ($page-1) * 10; //Rechnet aus bei welchen Eintrag wir nun sind, 10 entspricht den Limit pro Seite.
			$sql = "SELECT * FROM speise ORDER BY speise_ID ASC LIMIT $start_from ,10"; //nimmt das Ergebnis aus $start_from und nimmt dann die darauf folgenden 10 Ergebnisse.
			$result = $conn->query($sql);
		?>
		<title></title>
	</head>

	<body>
		<?php include 'header.php';
			if(((!isset($_SESSION['adminrechte'])) || $_SESSION['adminrechte'] != 2)) {
				include'footer.php';
				die('Du hast keinen Zugriff auf diese Seite. Bitte logge dich als ein Administrator ein.'); } //Verweigert leuten den Zugriff auf diese Seite?>
		<div class="container">

			<h1>Essensliste</h1>
			<br>
			<p>Das ist die globale Essensliste auf die nur Sie als Administrator Zugriff haben. Hier können Sie sehen welche Essen existieren, diese sortieren, nach ihnen suchen, sie bearbeiten oder löschen. Zudem können Sie mit dem Button weiter unten auch ein neues Essen erstellen.</p>
			<br>
			<button type='button' class='btn btn-success btn-lg' data-toggle="modal" data-target="#NewFood">
				Hinzufügen <i class='fas fa-plus'> </i>
			</button>

			<br>
			<br>

			<table class="table table-hover">
    <thead>
      <tr>
        <th>Name der Speise</th>
        <th>Allergene/Inhaltsstoffe</th>
        <th>Sonstiges</th>
        <th>Preis</th>
		<th>Löschen/Bearbeiten</th>
      </tr>
    </thead>
    <tbody>
				<?php
					if ($result->num_rows > 0) {
					// ausgabe der Daten aus jeder Zeile der Tabelle.
					while($row = $result->fetch_assoc()) {
							echo 	"<tr><td>".$row['name']."</td>";
							echo		"<td>".$row['allergene_inhaltsstoffe']."</td>";
							echo		"<td>".$row['sonstiges']."</td>";
							echo		"<td>".$row['preis']."€</td>";
							echo		"<td><button type='button' method='POST' data-href='essensliste.php?delete?speiseID=".$row['speise_ID']."' data-toggle='modal' data-target='#confirm-delete' class='btn btn-danger'>
										<i class='fas fa-trash'> </i></button>
										<button type='button' class='btn btn-success'>
										<i class='fas fa-pencil-alt'> </i></button>
										</td>
								</tr>";
					}
					} else {
						echo "<strong>0 Ergebnisse</strong>";
					}
				?>
			</table>
				<nav class="page_nav">
					<ul class='pagination justify-content-center'>
						<?php 
							$count = "SELECT COUNT(speise_ID) AS total FROM mensa.speise";
							$result = $conn->query($count);
							$row = $result->fetch_assoc();
							$total_pages = ceil($row["total"] / 10); // Berechnung der insgesamten Seiten mit Ergebnissen, 10 = anzahl der Ergebnisse pro Seite
								
								echo "<li class='page-item";//Previous Button
									if($page == 1) {
										echo " disabled";
									}
										echo "'><a class='page-link' href='essensliste.php?page=". ($page-1)."'><i class='fas fa-arrow-left'></i></a></li>";
											for ($i=1; $i<=$total_pages; $i++) {  // ausgabe aller seiten mithilfe von Links
												echo "<li class='page-item";
													if ($i==$page) { 
														echo " active'";
													}
													echo "'><a class='page-link' href='essensliste.php?page=".$i."'";
													
														echo ">".$i."</a></li>"; 
											}; 
												echo "<li class='page-item";//Next Button
													if($page == $total_pages) {
														echo " disabled";
													}
														echo "'><a class='page-link' href='essensliste.php?page=". ($page+1) ."'><i class='fas fa-arrow-right'></i></a></li>";
								$conn->close();
						?>
		</nav>	
		</div>
		
		<!--Confirm Delet Modal -->
		<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<strong>Willst du diesen Eintrag wirklich Löschen?</strong>
					</div>
            <div class="modal-body">
                Man kann die Löschung <strong>NICHT</strong> rückgängig machen.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
                <a class="btn btn-danger btn-ok">Löschen</a>
            </div>
        </div>
    </div>
</div>
		<!--Confirm Delet Modal END -->


		<!--New Food Modal-->
		<div class="modal fade" id="NewFood" tabindex="-1" role="dialog" aria-labelledby="New User" aria-hidden="true">
								<div class="modal-dialog">
								  <div class="modal-content">
									<!-- header -->
									<div class="modal-header">
									<h3 class="modal-title">Neues Essen hinzufügen</h3>
									  <button type="button" class="close" data-dismiss="modal">&times;</button>

									</div>
									<!-- body -->
									<div class="modal-body">
									  <form role="form" method="POST" action="essensliste.php?FoodAdded">
										<div class="form-group">
										  <label for="name">Name der Speise</label><input type="text" name="name" class="form-control"  placeholder="Schnitzel, Pommes, Gurke..." required/><br>
										  <label for="allergene">Allergene/Inhaltsstoffe:</label><input type="text" name="allergene" class="form-control"  placeholder="Gluten, Schwefeldioxid..." required/><br>
										  <label for="sonstiges" >Sonstiges:</label><input type="text" name="sonstiges" class="form-control" placeholder="Pommes + kleine Cola" /><br>
										  <label for="preis" >Preis:</label><input type="text" name="preis" class="form-control" placeholder="123€" aria-labelledby="preisHelp"  required/>
											<small id="preisHelp" class="form-text text-muted">Bitte verwende bei Kommazahlen ein punkt: '.'</small>
										</div>

									</div>
									<!-- footer -->
									<div class="modal-footer">
									  <input type="submit" name="Essen_hinzufügen" class="btn btn-primary btn-block" value="Essen hinzufügen">
									</div>
									</form>

								  </div>
								</div>
							  </div>
		<!--New Food Modal End-->

		<?php include 'footer.php'; ?>
		
		<script language="JavaScript" type="text/javascript">
		$('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});
</script>
	</body>
</html>
