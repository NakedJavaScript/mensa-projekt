<?php include_once 'dependencies.php';
	  include_once 'functions/essensliste_func.php';
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

									<!-- Page Navigation-->
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
								<!--Page Navigation END -->
								</div>

		<?PHP
			confModal('Wollen Sie diese Speise wirklich löschen?');
		?>



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
									  <form role="form" method="POST" action="#FoodAdded">
										<div class="form-group">
										  <label for="name">Name der Speise</label><input type="text" name="name" class="form-control"  placeholder="Schnitzel, Pommes, Gurke..." required/><br>
											<fieldset>
											<p>Allergene/Inhaltsstoffe:</p>
														<div class="form-check">
															<input class="form-check-input ka" name="allergene[]" type="checkbox" id="ka" value="- Keine Allergene -">
															<label class="form-check-label" for="ka">Keine Allergene</label>

														</div>

											<div class="form-check">
												<input class="form-check-input cb" name="allergene[]" type="checkbox" id="gg" value="GG">
												<label class="form-check-label" for="gg">Glutenhaltiges Getreide</label>

											</div>

													<div class="form-check">
															<input class="form-check-input cb" name="allergene[]" type="checkbox" id="kre" value="Kre">
															<label class="form-check-label" for="kre">Krebstiere</label>
													</div>

											<div class="form-check">
													<input class="form-check-input cb" name="allergene[]" type="checkbox" id="ei" value="Ei">
													<label class="form-check-label" for="ei">Eier und daraus hergestellte Erzeugnisse</label>
											</div>

													<div class="form-check">
															<input class="form-check-input cb" name="allergene[]" type="checkbox" id="f" value="F">
															<label class="form-check-label" for="f">Fisch und daraus hergestellte Erzeugnisse</label>
													</div>

										<div class="form-check">
												<input class="form-check-input cb" name="allergene[]" type="checkbox" id="erd" value="Erd">
												<label class="form-check-label" for="erd">Erdnüsse</label>
										</div>

													<div class="form-check">
															<input class="form-check-input cb" name="allergene[]" type="checkbox" id="soj" value="Soj">
															<label class="form-check-label" for="soj">Soja und daraus hergestellte Erzeugnisse</label>
													</div>

									<div class="form-check">
											<input class="form-check-input cb" name="allergene[]" type="checkbox" id="mil" value="Mil">
											<label class="form-check-label" for="mil">Milch und daraus hergestellte Erzeugnisse(Laktose)</label>
									</div>

													<div class="form-check">
															<input class="form-check-input cb" name="allergene[]" type="checkbox" id="nus" value="Nus">
															<label class="form-check-label" for="nus">Schalenfrüchte(Nüsse)</label>
													</div>

									<div class="form-check">
											<input class="form-check-input cb" name="allergene[]" type="checkbox" id="sel" value="Sel">
											<label class="form-check-label" for="sel">Sellerie und daraus hergestellte Schalenfrüchte</label>
									</div>

													<div class="form-check">
															<input class="form-check-input cb" name="allergene[]" type="checkbox" id="sen" value="Sen">
															<label class="form-check-label" for="sen">Senf und daraus hergestellte Erzeugnisse</label>
													</div>

									<div class="form-check">
											<input class="form-check-input cb" name="allergene[]" type="checkbox" id="ses" value="Ses">
											<label class="form-check-label" for="ses">Sesamsamen und daraus hergestellte Erzeugnisse</label>
									</div>

													<div class="form-check">
															<input class="form-check-input cb" name="allergene[]" type="checkbox" id="sch" value="Sch">
															<label class="form-check-label" for="sch">Schwefeldioxid und Sulfite</label>
													</div>

									<div class="form-check">
											<input class="form-check-input cb" name="allergene[]" type="checkbox" id="lup" value="Lup">
											<label class="form-check-label" for="lup">Lupinen und daraus hergestellte Erzeugnisse</label>
									</div>

													<div class="form-check">
															<input class="form-check-input cb" name="allergene[]" type="checkbox" id="wei" value="Wei">
															<label class="form-check-label" for="wei">Weichtiere und daraus hergestellte Erzeugnisse</label>
													</div>
						</fieldset><br>
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

											<!--Edit Food Modal-->
											<div class="modal fade" id="EditFood" tabindex="-1" role="dialog" aria-labelledby="New User" aria-hidden="true">
																	<div class="modal-dialog">
																		<div class="modal-content">
																		<!-- header -->
																		<div class="modal-header">
																		<h3 class="modal-title">Speise Bearbeiten</h3>
																			<button type="button" class="close" id="close_modal" data-dismiss="modal">&times;</button>

																		</div>
																		<!-- body -->
																		<div class="modal-body">
																			<form role="form" method="POST" action="#FoodEdited">
																			<div class="form-group">
																				<input type="hidden" name="speise_ID" id="speise_ID" class="form-control"  placeholder="123" readonly/><br>
																				<label for="name">Name der Speise</label><input type="text" name="name" class="form-control" id="name" placeholder="Schnitzel, Pommes, Gurke..." required/><br>
																				<fieldset>
																				<p>Allergene/Inhaltsstoffe:</p>
																							<div class="form-check">
																								<input class="form-check-input ka" name="allergene[]" type="checkbox" id="ka" value="- Keine Allergene -">
																								<label class="form-check-label" for="ka">Keine Allergene</label>

																							</div>

																				<div class="form-check">
																					<input class="form-check-input cb" name="allergene[]" type="checkbox" id="gg" value="GG">
																					<label class="form-check-label" for="gg">Glutenhaltiges Getreide</label>

																				</div>

																						<div class="form-check">
																								<input class="form-check-input cb" name="allergene[]" type="checkbox" id="kre" value="Kre">
																								<label class="form-check-label" for="kre">Krebstiere</label>
																						</div>

																				<div class="form-check">
																						<input class="form-check-input cb" name="allergene[]" type="checkbox" id="ei" value="Ei">
																						<label class="form-check-label" for="ei">Eier und daraus hergestellte Erzeugnisse</label>
																				</div>

																						<div class="form-check">
																								<input class="form-check-input cb" name="allergene[]" type="checkbox" id="f" value="F">
																								<label class="form-check-label" for="f">Fisch und daraus hergestellte Erzeugnisse</label>
																						</div>

																			<div class="form-check">
																					<input class="form-check-input cb" name="allergene[]" type="checkbox" id="erd" value="Erd">
																					<label class="form-check-label" for="erd">Erdnüsse</label>
																			</div>

																						<div class="form-check">
																								<input class="form-check-input cb" name="allergene[]" type="checkbox" id="soj" value="Soj">
																								<label class="form-check-label" for="soj">Soja und daraus hergestellte Erzeugnisse</label>
																						</div>

																		<div class="form-check">
																				<input class="form-check-input cb" name="allergene[]" type="checkbox" id="mil" value="Mil">
																				<label class="form-check-label" for="mil">Milch und daraus hergestellte Erzeugnisse(Laktose)</label>
																		</div>

																						<div class="form-check">
																								<input class="form-check-input cb" name="allergene[]" type="checkbox" id="nus" value="Nus">
																								<label class="form-check-label" for="nus">Schalenfrüchte(Nüsse)</label>
																						</div>

																		<div class="form-check">
																				<input class="form-check-input cb" name="allergene[]" type="checkbox" id="sel" value="Sel">
																				<label class="form-check-label" for="sel">Sellerie und daraus hergestellte Schalenfrüchte</label>
																		</div>

																						<div class="form-check">
																								<input class="form-check-input cb" name="allergene[]" type="checkbox" id="sen" value="Sen">
																								<label class="form-check-label" for="sen">Senf und daraus hergestellte Erzeugnisse</label>
																						</div>

																		<div class="form-check">
																				<input class="form-check-input cb" name="allergene[]" type="checkbox" id="ses" value="Ses">
																				<label class="form-check-label" for="ses">Sesamsamen und daraus hergestellte Erzeugnisse</label>
																		</div>

																						<div class="form-check">
																								<input class="form-check-input cb" name="allergene[]" type="checkbox" id="sch" value="Sch">
																								<label class="form-check-label" for="sch">Schwefeldioxid und Sulfite</label>
																						</div>

																		<div class="form-check">
																				<input class="form-check-input cb" name="allergene[]" type="checkbox" id="lup" value="Lup">
																				<label class="form-check-label" for="lup">Lupinen und daraus hergestellte Erzeugnisse</label>
																		</div>

																						<div class="form-check">
																								<input class="form-check-input cb" name="allergene[]" type="checkbox" id="wei" value="Wei">
																								<label class="form-check-label" for="wei">Weichtiere und daraus hergestellte Erzeugnisse</label>
																						</div>
															</fieldset><br>
																				<label for="sonstiges" >Sonstiges:</label><input type="text" name="sonstiges" id="sonstiges" class="form-control" placeholder="Pommes + kleine Cola" /><br>
																				<label for="preis" >Preis:</label><input type="text" name="preis" id="preis" class="form-control" placeholder="123€" aria-labelledby="preisHelp"  required/>
																				<small id="preisHelp" class="form-text text-muted">Bitte verwende bei Kommazahlen ein punkt: '.'</small>
																			</div>

																		</div>
																		<!-- footer -->
																		<div class="modal-footer">
																			<input type="submit" name="Essen_bearbeiten" class="btn btn-primary btn-block" value="Änderungen Speichern">
																		</div>
																		</form>

																		</div>
																	</div>
																	</div>
											<!--Edit Food Modal End-->

		<?php include 'footer.php'; ?>
	</body>
</html>
