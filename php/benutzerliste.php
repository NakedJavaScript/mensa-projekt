<?php include_once 'dependencies.php';
	  include_once 'functions/benutzerliste_func.php';
 ?>
<!DOCTYPE HTML>
<html>
	<head>
		<?php
			echo $head_dependencies;
			if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };//Schaut bei welcher Site wir gerade sind, falls keine eingegeben wurde, zeigt er die erste Seite.
			$start_from = ($page-1) * 10; //Rechnet aus bei welchen Eintrag wir nun sind
			$sql = "SELECT * FROM benutzer ORDER BY benutzer_ID ASC LIMIT $start_from ,10";
			$result = $conn->query($sql);
		?>
		<title>Benutzerliste</title>
	</head>

	<body>
		<?php include 'header.php';
			if(((!isset($_SESSION['adminrechte'])) || $_SESSION['adminrechte'] != 2)) {
				include'footer.php';

				die('Sie haben keinen Zugriff auf diese Seite. Bitte loggen Sie sich als Administrator ein.');  } //Verweigert nicht Admins den Zugriff auf diese Seite
		?>
		<div class="container">

			<h1>Benutzerliste</h1>

			<br>
			<p>Das ist die globale Benutzerliste auf die nur Sie als Administrator Zugriff haben. Hier können Sie sehen welche Nutzer existieren, diese sortieren, nach ihnen suchen, sie bearbeiten oder löschen. Zudem können Sie mithilfe des "Hinzufügen"-Buttons neue Nutzer anlegen.</p>
			<br>
			<button type='button' class='btn btn-success btn-lg' data-toggle="modal" data-target="#NewUser">

				Hinzufügen <i class='fa fa-plus'> </i>
			</button>
			<div class="input-group add-on" style="float:right; width:400px;">
      <input class="form-control search-box" placeholder="Suche" name="srch-term" id="srch-term" type="text">
      <div class="input-group-btn">
        <button class="btn btn-default search-btn" id="search-btn" type="submit"><i class="fas fa-search"></i></button>
      </div>
	  </div>
				<br/>
				<br/>


			<table class="table table-hover">

		    <thead>
		      <tr>
		        <th>Vorname</th>
		        <th>Nachname</th>
		        <th>Email</th>
		        <th>Kontostand</th>
						<th>Löschen/Bearbeiten</th>
		      </tr>
		    </thead>
				    <tbody>
								<?php
									if ($result->num_rows > 0) {
									// ausgabe der Daten aus jeder Zeile der Tabelle.
									while($row = $result->fetch_assoc()) {
											 echo	"<tr><td>".$row['vorname']."</td>
														<td>".$row['nachname']."</td>
														<td>".$row['email']."</td>
														<td>".$row['kontostand']."€</td>
														<td><button type='button' method='POST' data-href='#?delete?userID=".$row['benutzer_ID']."' data-toggle='modal' data-target='#confirm-delete' class='btn btn-danger'>
														<i class='fas fa-trash'> </i></button>

													<button type='button' method='POST'id='edit_user' benutzer_ID='".$row['benutzer_ID']."' vorname='".$row['vorname']."' nachname='".$row['nachname']."' email='".$row['email']."' kontostand='".$row['kontostand']."' adminrechte='".$row['admin_rechte']."' data-href='' data-toggle='modal' data-target='#edit-user' class='btn btn-success'>
														<i class='fas fa-pencil-alt'> </i></button></td>
												</tr>";
									}
									} else {
										echo "0 results";
									}

								?>
								<tbody>
			</table>

			<nav class="page_nav">
					<ul class='pagination justify-content-center'>
						<?php
							$count = "SELECT COUNT(benutzer_ID) AS total FROM mensa.benutzer";
							$result = $conn->query($count);
							$row = $result->fetch_assoc();
							$total_pages = ceil($row["total"] / 10); // Berechnung der insgesamten Seiten mit Ergebnissen

								echo "<li class='page-item";//Previous Button
									if($page == 1) {
										echo " disabled";
									}
										echo "'><a class='page-link' href='benutzerliste.php?page=". ($page-1)."'><i class='fas fa-arrow-left'></i></a></li>";
											for ($i=1; $i<=$total_pages; $i++) {  // ausgabe aller seiten mithilfe von Links
												echo "<li class='page-item";
													if ($i==$page) {
														echo " active'";
													}
													echo "'><a class='page-link' href='benutzerliste.php?page=".$i."'";

														echo ">".$i."</a></li>";
											};
												echo "<li class='page-item";//Next Button
													if($page == $total_pages) {
														echo " disabled";
													}
														echo "'><a class='page-link' href='benutzerliste.php?page=". ($page+1) ."'><i class='fas fa-arrow-right'></i></a></li>";
								$conn->close();
						?>
		</nav>
		</div>

		<?PHP
			confModal('Wollen Sie diesen Nutzer wirklich löschen?');
		?>

		<!--New User Modal-->
		<div class="modal fade" id="NewUser" tabindex="-1" role="dialog" aria-labelledby="New User" aria-hidden="true">
								<div class="modal-dialog">
								  <div class="modal-content">
									<!-- header -->
									<div class="modal-header">
									<h3 class="modal-title">Neuer Nutzer</h3>
									  <button type="button" class="close" data-dismiss="modal">&times;</button>

									</div>
									<!-- body -->
									<div class="modal-body">
									  <form role="form" method="POST" action="">
										<div class="form-group">
										  <label for="vorname">Vorname</label><input type="text" name="vorname" class="form-control"  placeholder="Max" required/> <br>
										  <label for="nachname">Nachname</label><input type="text" name="nachname" class="form-control"  placeholder="Mustermann" required/><br>
										  <label for="email">Email</label><input type="email" name="email" class="form-control"  placeholder="max.mustermann@musterdomäne.de" required/><br>
										  <label for="password" >Passwort</label><input type="password" name="passwort" class="form-control" placeholder="Passwort" required/><br>
										  <label for="kontostand" >Kontostand</label><input type="text" name="kontostand" class="form-control" placeholder="Tragen Sie den gewünschten Betrag ein" required/><br>
											<label for="adminrechte" >Adminrechte</label><br>
														<input type="radio" name="adminrechte" class="radio-inline" value="3" checked>Nein &nbsp
														<input type="radio" name="adminrechte" class="radio-inline" value="2">Ja
										</div>

									</div>
									<!-- footer -->
									<div class="modal-footer">
									  <input type="submit" name="neuer_nutzer" class="btn btn-primary btn-block" value="Neuen Nutzer anlegen">
									</div>
									</form>

								  </div>
								</div>
							  </div>
		<!--New User Modal End-->

							<!--Edit User Modal-->
							<div class="modal fade" id="edit-user" tabindex="-1" role="dialog" aria-labelledby="New User" aria-hidden="true">
													<div class="modal-dialog">
														<div class="modal-content">
														<!-- header -->
														<div class="modal-header">
														<h3 class="modal-title">Nutzer bearbeiten</h3>
															<button type="button" class="close" data-dismiss="modal">&times;</button>

														</div>
														<!-- body -->
														<div class="modal-body">
															<form role="form" method="POST" action="">
															<div class="form-group" id="editform">
																<input type="hidden" name="benutzer_ID" class="form-control" id="benutzer_ID"  placeholder="123" readonly/> <br> <!--Dieses Feld ist für den Nutzer unsichtbar. -->
																<label for="vorname">Vorname</label><input type="text" name="vorname" class="form-control" id="vorname"  placeholder="Max" required/> <br>
																<label for="nachname">Nachname</label><input type="text" name="nachname" class="form-control" id="nachname"  placeholder="Mustermann" required/><br>
																<label for="email">Email</label><input type="email" name="email" class="form-control" id="email"  placeholder="max.mustermann@musterdomäne.de" required/><br>
																<label for="passwort" >Passwort</label><input type="password" name="passwort" class="form-control" placeholder="Passwort" /><br>
																<label for="kontostand" >Kontostand</label><input type="text" name="kontostand" class="form-control" id="kontostand" placeholder="Tragen Sie den gewünschten Betrag ein" required/><br>
																<label for="adminrechte" >Adminrechte</label><br>
																			<input type="radio" name="adminrechte" class="radio-inline" value="3"><span name="adminrechte">Nein &nbsp</span>
																			<input type="radio" name="adminrechte" class="radio-inline" value="2"><span name="adminrechte">Ja</span>
															</div>

														</div>
														<!-- footer -->
														<div class="modal-footer">
															<input type="submit" name="bearbeiten_nutzer" class="btn btn-primary btn-block" value="Änderungen Speichern">
														</div>
														</form>

														</div>
													</div>
													</div>
							<!--Edit User Modal End-->

	</body>
	<?php include 'footer.php'; ?>
	<script>
	//zum Bearbeiten der Nutzer
	$(document).on("click",'#edit_user' , function (e) {
  var vorname= $(this).attr('vorname');
	var nachname=$(this).attr('nachname');
	var email=$(this).attr('email');
	var kontostand=$(this).attr('kontostand');
	var identity=$(this).attr('benutzer_ID');
	var adminrechte=$(this).attr('adminrechte');
	var sessID = <?php echo json_encode($_SESSION['id']) ?>; //muss aufgrund diesen PHP parts hier stehen und kann nicht ins script.js
//set what we got to our form
  $('#vorname').val(vorname);
	$('#nachname').val(nachname);
	$('#email').val(email);
	$('#kontostand').val(kontostand);
	$('#benutzer_ID').val(identity);
	$("input[name=adminrechte][value=" + adminrechte + "]").prop('checked', true); //je nachdem ob der Nutzer adminrechte oder nicht wird der richtige radiobutton gewählt
	if(identity == sessID) { //falls man sich selbst bearbeitet, kann man seine Zugriffsrechte nicht bearbeiten
		$("input[name=adminrechte], label[for=adminrechte], span[name=adminrechte]").hide(); //felder werden gehidet
		//$("label[for=adminrechte]").hide();
	} else {
		$("input[name=adminrechte], label[for=adminrechte], span[name=adminrechte]").show(); //sonst werden sie gezeigt
	}
});
</script>
</html>
