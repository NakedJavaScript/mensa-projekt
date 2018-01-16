<?php include_once 'dependencies.php'; ?>
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
			if(((!isset($_SESSION['adminrechte'])) || $_SESSION['adminrechte'] != 2)) { //Verweigert Unbefugten den Zugriff auf diese Seite
				include'footer.php';
				die('Du hast keinen Zugriff auf diese Seite. Bitte logge dich als ein Administrator ein.');
			}
			?>
			<div class="container">

					<h1>Essensliste</h1>
					<br>
					<p>Das ist die globale Essensliste auf die nur Sie als Administrator Zugriff haben. Hier können Sie sehen welche Essen existieren, diese sortieren, nach ihnen suchen, sie bearbeiten oder löschen. Zudem können Sie mit dem Button weiter unten auch ein neues Essen erstellen.</p>
					<br>
						<button type='button' class='btn btn-success btn-lg' data-toggle="modal" data-target="#NewFood">
								Hinzufügen <i class='fas fa-plus'> </i>
						</button>
							<div class="input-group add-on" style="float:right; width:400px;">
									<input class="form-control search-box" placeholder="Suche" name="srch-term" id="srch-term" type="text">
							<div class="input-group-btn">
								<button class="btn btn-default" type="submit"><i class="fas fa-search"></i></button>
							</div>
						</div>
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
														echo		"<td><a href='essensliste.php?delete?speiseID=".$row['speise_ID']."'><button type='button' method='POST' name='delete_food' class='btn btn-danger'>
																	<i class='fas fa-trash'> </i></button></a>
																	<button type='button' class='btn btn-success'>
																	<i class='fas fa-pencil-alt'> </i></button>
																	</td>
															</tr>";
											}
										}
											else {
													echo "0 results";
											}
													$conn->close();
									?>
						</table>
		</div>


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
											<fieldset>
											<p>Allergene/Inhaltsstoffe:</p>
														<div class="form-check">
															<input class="form-check-input" name="allergene[]" type="checkbox" id="ka" value="- Keine Allergene -">
															<label class="form-check-label" for="ka">Keine Allergene</label>

														</div>

											<div class="form-check">
												<input class="form-check-input" name="allergene[]" type="checkbox" id="gg" value="GG">
												<label class="form-check-label" for="gg">Glutenhaltiges Getreide</label>

											</div>

													<div class="form-check">
															<input class="form-check-input" name="allergene[]" type="checkbox" id="kre" value="Kre">
															<label class="form-check-label" for="kre">Krebstiere</label>
													</div>

											<div class="form-check">
													<input class="form-check-input" name="allergene[]" type="checkbox" id="ei" value="Ei">
													<label class="form-check-label" for="ei">Eier und daraus hergestellte Erzeugnisse</label>
											</div>

													<div class="form-check">
															<input class="form-check-input" name="allergene[]" type="checkbox" id="f" value="F">
															<label class="form-check-label" for="f">Fisch und daraus hergestellte Erzeugnisse</label>
													</div>

										<div class="form-check">
												<input class="form-check-input" name="allergene[]" type="checkbox" id="erd" value="Erd">
												<label class="form-check-label" for="erd">Erdnüsse</label>
										</div>

													<div class="form-check">
															<input class="form-check-input" name="allergene[]" type="checkbox" id="soj" value="Soj">
															<label class="form-check-label" for="soj">Soja und daraus hergestellte Erzeugnisse</label>
													</div>

									<div class="form-check">
											<input class="form-check-input" name="allergene[]" type="checkbox" id="mil" value="Mil">
											<label class="form-check-label" for="mil">Milch und daraus hergestellte Erzeugnisse(Laktose)</label>
									</div>

													<div class="form-check">
															<input class="form-check-input" name="allergene[]" type="checkbox" id="nus" value="Nus">
															<label class="form-check-label" for="nus">Schalenfrüchte(Nüsse)</label>
													</div>

									<div class="form-check">
											<input class="form-check-input" name="allergene[]" type="checkbox" id="sel" value="Sel">
											<label class="form-check-label" for="sel">Sellerie und daraus hergestellte Schalenfrüchte</label>
									</div>

													<div class="form-check">
															<input class="form-check-input" name="allergene[]" type="checkbox" id="sen" value="Sen">
															<label class="form-check-label" for="sen">Senf und daraus hergestellte Erzeugnisse</label>
													</div>

									<div class="form-check">
											<input class="form-check-input" name="allergene[]" type="checkbox" id="ses" value="Ses">
											<label class="form-check-label" for="ses">Sesamsamen und daraus hergestellte Erzeugnisse</label>
									</div>

													<div class="form-check">
															<input class="form-check-input" name="allergene[]" type="checkbox" id="sch" value="Sch">
															<label class="form-check-label" for="sch">Schwefeldioxid und Sulfite</label>
													</div>

									<div class="form-check">
											<input class="form-check-input" name="allergene[]" type="checkbox" id="lup" value="Lup">
											<label class="form-check-label" for="lup">Lupinen und daraus hergestellte Erzeugnisse</label>
									</div>

													<div class="form-check">
															<input class="form-check-input" name="allergene[]" type="checkbox" id="wei" value="Wei">
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

		<?php include 'footer.php'; ?>
		<!--Script disables and unchecks all other checkboxes if 'Keine Allergene' is checked -->
		<script>
		$("#ka").change(function() {
			$(":checkbox").not(this).prop("checked", false);//sets the state of 'checked' to false at every other checkbox
		  $(":checkbox").not(this).prop("disabled", this.checked);//disables all checkboxes, but the checked one
		});
		</script>
	</body>
</html>
