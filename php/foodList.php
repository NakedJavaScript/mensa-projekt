
<?php
	include_once 'dependencies.php';
	include_once 'views/foodList.php';

?>

<!DOCTYPE HTML>
<html>
	<head>
		<?php
			echo $headDependencies;
			$sql = "SELECT * FROM speise";
			$result = $conn->query($sql);
		?>
		<title>Essensliste</title>
	</head>

	<body>
		<?php include 'header.php';
			if(((!isset($_SESSION['adminRights'])) || $_SESSION['adminRights'] != 2)) { // Checks if the user has Admin rights
				include'footer.php';
				die('Sie haben keinen Zugriff auf diese Seite. Bitte loggen Sie sich als ein Administrator ein.'); // If not the user wont be able to access the site
			}
		?>

		<div class="container">
			<h1>Essensliste</h1>
			<br>
			<p>Das ist die globale Essensliste auf die nur Sie als Administrator Zugriff haben. Hier können Sie sehen welche Essen existieren, diese sortieren, nach ihnen suchen, sie bearbeiten oder löschen. Zudem können Sie mit dem Button weiter unten ein neues Essen erstellen.</p>
			<br>
			<button type='button' class='btn btn-success btn-lg' data-toggle="modal" data-target="#NewFood">Hinzufügen <i class='fas fa-plus'></i></button>

			<br/>
			<br/>

			<table class="tabelsorterTable table table-hover tablesorter">

    		<thead>
		      <tr>
        		<th>Name der Speise</th>
        		<th>Allergene/Inhaltsstoffe</th>
        		<th>Sonstiges</th>
        		<th>Preis</th>
				<th  class="filter-false" data-sorter="false">Löschen/Bearbeiten</th>
  			</tr>
		</thead>
		    <tbody>
						<?php
							if ($result->num_rows > 0) {
							// Returns the data in a table
									while($row = $result->fetch_assoc()) {
											echo 	"<tr><td class='align-middle'>".$row['name']."</td>";
											echo		"<td class='align-middle'>".$row['allergene_inhaltsstoffe']."</td>";
											echo		"<td class='align-middle'>".$row['sonstiges']."</td>";
											echo		"<td class='align-middle'>".$row['preis']."€</td>";
											echo		"<td class='align-middle'><button type='button' method='POST' data-href='?delete?speiseID=".$row['speise_ID']."' data-toggle='modal' data-target='#confirm-delete' class='btn btn-danger'>
														<i class='fas fa-trash'> </i></button>

														<button type='button' class='btn btn-success' foodID='".$row['speise_ID']."' foodName='".$row['name']."' others='".$row['sonstiges']."' allergenic='".$row['allergene_inhaltsstoffe']."' price='".$row['preis']."' data-toggle='modal' data-target='#EditFood' method='POST' id='edit_food'  >
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
						<option value="all">Alle Nutzer</option>
					</select>
				</form>
			</div>
		</div>

		<?PHP // Opens the modal to delete a meal
			confModal('Wollen Sie diese Speise wirklich löschen?');
		?>

		<!--New Food Modal-->
		<div class="modal fade" id="NewFood" tabindex="-1" role="dialog" aria-labelledby="New User" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title">Neues Essen hinzufügen</h3>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
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
									</div>
									<!-- body -->
									<div class="modal-body">
									  <form role="form" method="POST" action="#FoodAdded">
										<div class="form-group">
										  <label for="name">Name der Speise</label><input type="text" name="name" class="form-control"  placeholder="Schnitzel, Pommes, Gurke..." required/><br>
											<fieldset>
											<p>Allergene/Inhaltsstoffe:</p>
														<div class="form-check">
															<input class="form-check-input ka" name="allergenic[]" type="checkbox" id="ka" value="- Keine Allergene -">
															<label class="form-check-label" for="ka">Keine Allergene</label>

														</div>

											<div class="form-check">
												<input class="form-check-input cb" name="allergenic[]" type="checkbox" id="gg" value="GG">
												<label class="form-check-label" for="gg">Glutenhaltiges Getreide</label>

											</div>

													<div class="form-check">
															<input class="form-check-input cb" name="allergenic[]" type="checkbox" id="kre" value="Kre">
															<label class="form-check-label" for="kre">Krebstiere</label>
													</div>

											<div class="form-check">
													<input class="form-check-input cb" name="allergenic[]" type="checkbox" id="ei" value="Ei">
													<label class="form-check-label" for="ei">Eier und daraus hergestellte Erzeugnisse</label>
											</div>

													<div class="form-check">
															<input class="form-check-input cb" name="allergenic[]" type="checkbox" id="f" value="F">
															<label class="form-check-label" for="f">Fisch und daraus hergestellte Erzeugnisse</label>
													</div>

										<div class="form-check">
												<input class="form-check-input cb" name="allergenic[]" type="checkbox" id="erd" value="Erd">
												<label class="form-check-label" for="erd">Erdnüsse</label>
										</div>

										<div class="form-check">
												<input class="form-check-input cb" name="allergenic[]" type="checkbox" id="soj" value="Soj">
												<label class="form-check-label" for="soj">Soja und daraus hergestellte Erzeugnisse</label>
										</div>

									<div class="form-check">
											<input class="form-check-input cb" name="allergenic[]" type="checkbox" id="mil" value="Mil">
											<label class="form-check-label" for="mil">Milch und daraus hergestellte Erzeugnisse(Laktose)</label>
										</div>
									<div class="form-check">
											<input class="form-check-input cb" name="allergenic[]" type="checkbox" id="nus" value="Nus">
											<label class="form-check-label" for="nus">Schalenfrüchte(Nüsse)</label>
									</div>

									<div class="form-check">
											<input class="form-check-input cb" name="allergenic[]" type="checkbox" id="sel" value="Sel">
											<label class="form-check-label" for="sel">Sellerie und daraus hergestellte Schalenfrüchte</label>
									</div>

									<div class="form-check">
											<input class="form-check-input cb" name="allergenic[]" type="checkbox" id="sen" value="Sen">
											<label class="form-check-label" for="sen">Senf und daraus hergestellte Erzeugnisse</label>
									</div>

									<div class="form-check">
											<input class="form-check-input cb" name="allergenic[]" type="checkbox" id="ses" value="Ses">
											<label class="form-check-label" for="ses">Sesamsamen und daraus hergestellte Erzeugnisse</label>
										</div>

									<div class="form-check">
											<input class="form-check-input cb" name="allergenic[]" type="checkbox" id="sch" value="Sch">
											<label class="form-check-label" for="sch">Schwefeldioxid und Sulfite</label>
									</div>

									<div class="form-check">
											<input class="form-check-input cb" name="allergenic[]" type="checkbox" id="lup" value="Lup">
											<label class="form-check-label" for="lup">Lupinen und daraus hergestellte Erzeugnisse</label>
									</div>

									<div class="form-check">
										<input class="form-check-input cb" name="allergenic[]" type="checkbox" id="wei" value="Wei">
										<label class="form-check-label" for="wei">Weichtiere und daraus hergestellte Erzeugnisse</label>
									</div>
								</fieldset><br>
								<label for="others" >Sonstiges:</label><input type="text" name="others" class="form-control" placeholder="Pommes + kleine Cola" /><br>
								<label for="price" >Preis:</label>
								<div class="input-group mb-3">
									<input type="text" class="form-control" name="price" placeholder="123" aria-label="Tragen Sie den gewünschten Betrag ein." aria-labelledby="priceHelp" aria-describedby="unit" required>
									<div class="input-group-append">
										<span class="input-group-text" id="unit">€</span>
									</div>
								</div>
								<small id="priceHelp" class="form-text text-muted">Bitte verwenden Sie anstelle eines Kommas einen Punkt: '.'</small>
							</div>
							<div class="modal-footer">
								<input type="submit" name="Essen_hinzufügen" class="btn btn-primary btn-block" value="Essen hinzufügen">
							</div>
						</form>
					</div>

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
																				<input type="hidden" name="foodID" id="foodID" class="form-control"  placeholder="123" readonly/><br>
																				<label for="name">Name der Speise</label><input type="text" name="name" class="form-control" id="name" placeholder="Schnitzel, Pommes, Gurke..." required/><br>
																				<fieldset>
																				<p>Allergene/Inhaltsstoffe:</p>
																							<div class="form-check">
																								<input class="form-check-input ka" name="allergenic[]" type="checkbox" id="ka" value="- Keine Allergene -">
																								<label class="form-check-label" for="ka">Keine Allergene</label>

																							</div>

																				<div class="form-check">
																					<input class="form-check-input cb" name="allergenic[]" type="checkbox" id="gg" value="GG">
																					<label class="form-check-label" for="gg">Glutenhaltiges Getreide</label>

																				</div>

																						<div class="form-check">
																								<input class="form-check-input cb" name="allergenic[]" type="checkbox" id="kre" value="Kre">
																								<label class="form-check-label" for="kre">Krebstiere</label>
																						</div>

																				<div class="form-check">
																						<input class="form-check-input cb" name="allergenic[]" type="checkbox" id="ei" value="Ei">
																						<label class="form-check-label" for="ei">Eier und daraus hergestellte Erzeugnisse</label>
																				</div>

																						<div class="form-check">
																								<input class="form-check-input cb" name="allergenic[]" type="checkbox" id="f" value="F">
																								<label class="form-check-label" for="f">Fisch und daraus hergestellte Erzeugnisse</label>
																						</div>

																			<div class="form-check">
																					<input class="form-check-input cb" name="allergenic[]" type="checkbox" id="erd" value="Erd">
																					<label class="form-check-label" for="erd">Erdnüsse</label>
																			</div>

																						<div class="form-check">
																								<input class="form-check-input cb" name="allergenic[]" type="checkbox" id="soj" value="Soj">
																								<label class="form-check-label" for="soj">Soja und daraus hergestellte Erzeugnisse</label>
																						</div>

																		<div class="form-check">
																				<input class="form-check-input cb" name="allergenic[]" type="checkbox" id="mil" value="Mil">
																				<label class="form-check-label" for="mil">Milch und daraus hergestellte Erzeugnisse(Laktose)</label>
																		</div>

																						<div class="form-check">
																								<input class="form-check-input cb" name="allergenic[]" type="checkbox" id="nus" value="Nus">
																								<label class="form-check-label" for="nus">Schalenfrüchte(Nüsse)</label>
																						</div>

																		<div class="form-check">
																				<input class="form-check-input cb" name="allergenic[]" type="checkbox" id="sel" value="Sel">
																				<label class="form-check-label" for="sel">Sellerie und daraus hergestellte Schalenfrüchte</label>
																		</div>

																						<div class="form-check">
																								<input class="form-check-input cb" name="allergenic[]" type="checkbox" id="sen" value="Sen">
																								<label class="form-check-label" for="sen">Senf und daraus hergestellte Erzeugnisse</label>
																						</div>

																		<div class="form-check">
																				<input class="form-check-input cb" name="allergenic[]" type="checkbox" id="ses" value="Ses">
																				<label class="form-check-label" for="ses">Sesamsamen und daraus hergestellte Erzeugnisse</label>
																		</div>

																						<div class="form-check">
																								<input class="form-check-input cb" name="allergenic[]" type="checkbox" id="sch" value="Sch">
																								<label class="form-check-label" for="sch">Schwefeldioxid und Sulfite</label>
																						</div>

																		<div class="form-check">
																				<input class="form-check-input cb" name="allergenic[]" type="checkbox" id="lup" value="Lup">
																				<label class="form-check-label" for="lup">Lupinen und daraus hergestellte Erzeugnisse</label>
																		</div>

																						<div class="form-check">
																								<input class="form-check-input cb" name="allergenic[]" type="checkbox" id="wei" value="Wei">
																								<label class="form-check-label" for="wei">Weichtiere und daraus hergestellte Erzeugnisse</label>
																						</div>
															</fieldset><br>
																				<label for="others" >Sonstiges:</label><input type="text" name="others" id="others" class="form-control" placeholder="Pommes + kleine Cola" /><br>
																				<label for="price" >Preis:</label>
																				<div class="input-group mb-3">
																					<input type="text" class="form-control" name="price" id="price" placeholder="123" aria-label="Tragen Sie den gewünschten Betrag ein." aria-labelledby="priceHelp" aria-describedby="unit" required>
																						<div class="input-group-append">
																							<span class="input-group-text" id="unit">€</span>
																						</div>
																				</div>
																				<small id="priceHelp" class="form-text text-muted">Bitte verwende bei Kommazahlen ein punkt: '.'</small>
																			</div>

																		</div>
																		<!-- footer -->
																		<div class="modal-footer">
																			<input type="submit" name="editFood" class="btn btn-primary btn-block" value="Änderungen Speichern">
																		</div>
																		</form>

																		</div>
																	</div>
																	</div>
											<!--Edit Food Modal End-->								
				</div>
		<?php include 'footer.php'; ?>
	</body>
</html>
