<?php include_once 'dependencies.php';
	  include_once 'views/userList.php';
 ?>
<!DOCTYPE HTML>
<html>
	<head>
		<?php
			echo $headDependencies;
			$sql = "SELECT * FROM benutzer";
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

			<table class="tabelsorterTable table table-hover tablesorter">

		    <thead>
		      <tr>
		        <th>Vorname</th>
		        <th>Nachname</th>
		        <th>Email</th>
		        <th>Kontostand</th>
				<th>Admin?</th>
				<th class="filter-false" data-sorter="false">Löschen/Bearbeiten</th>
		      </tr>
		    </thead>
				    <tbody>
								<?php
									if ($result->num_rows > 0) {
									// ausgabe der Daten aus jeder Zeile der Tabelle.
									while($row = $result->fetch_assoc()) {
										if ($row['admin_rechte'] == 2) {
											$adminRecht = "Ja";
											echo "<tr class='admin-highlight'>";
										} else {
											$adminRecht = "Nein";
											echo "<tr>";
										}
											 echo	"<td class='align-middle'>".$row['vorname']."</td>
														<td class='align-middle'>".$row['nachname']."</td>
														<td class='align-middle'>".$row['email']."</td>
														<td class='align-middle'>".$row['kontostand']."€</td>
														<td class='align-middle'>".$adminRecht."</td>";
														if ($row['benutzer_ID'] == $_SESSION['id']) {
															$disabled = 'disabled';
														} else {
															$disabled = '';
														}
											 echo "<td class='align-middle'><button type='button' method='POST' data-href='?delete?userID=".$row['benutzer_ID']."' data-toggle='modal' data-target='#confirm-delete' class='btn btn-danger'". $disabled .">
														<i class='fas fa-trash'> </i></button>
													  <button type='button' method='POST' id='editUser' userID='".$row['benutzer_ID']."' firstName='".$row['vorname']."' lastName='".$row['nachname']."' email='".strstr($row['email'], '@', true)."' balance='".$row['kontostand']."' adminRights='".$row['admin_rechte']."' data-href='' data-toggle='modal' data-target='#edit-user' class='btn btn-success'>
														<i class='fas fa-pencil-alt'> </i></button></td>
												</tr>";
									}
									} else {
										echo "0 results";
									}

								?>
								<tbody>
			</table>

			<!-- pager -->
<div id="pager" class="pager">
  <form>
    <i class="fas fa-angle-double-left first"/></i>
    <i class="fas fa-angle-left prev"/></i>
    <!-- the "pagedisplay" can be any element, including an input -->
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
										  <label for="firstName">Vorname</label><input type="text" name="firstName" class="form-control"  placeholder="Max" required/> <br>
										  <label for="lastName">Nachname</label><input type="text" name="lastName" class="form-control"  placeholder="Mustermann" required/><br/>
											<label for="email">Email</label>
											<div class="input-group mb-3">
   											<input type="text" class="form-control" name="email" placeholder="max.mustermann" aria-label="Recipient's username" aria-describedby="emailDomain" required>
   												<div class="input-group-append">
     												<span class="input-group-text" id="emailDomain">@its-stuttgart.de</span>
   												</div>
 											</div>
										  <label for="passwort" >Passwort</label><input type="password" name="password" class="form-control" value="" placeholder="Passwort" required/><br>
										  <label for="balance" >Kontostand</label>
											<div class="input-group mb-3">
   											<input type="text" class="form-control" name="balance" placeholder="123" aria-label="Tragen sie den gewünschten Betrag ein." aria-labelledby="kontostandHelp" aria-describedby="unit" required>
   												<div class="input-group-append">
     												<span class="input-group-text" id="unit">€</span>
   												</div>
 											</div>
											<small id="kontostandHelp" class="form-text text-muted">Bitte verwenden Sie anstelle eines Kommas einen Punkt: '.'</small><br>
											<label for="adminRights" >Adminrechte</label><br>
											<div class="form-check form-check-inline">
														<input type="radio" name="adminRights" id="keineAdminrechte" class="form-check-input" value="3" checked><label class="form-check-label" for="keineAdminrechte">Nein</label>
											</div>
											<div class="form-check form-check-inline">
														<input type="radio" name="adminRights" id="adminRights" class="form-check-input" value="2"><label class="form-check-label" for="adminRights">Ja</label>
											</div>
										</div>

									</div>
									<!-- footer -->
									<div class="modal-footer">
									  <input type="submit" name="newUser" class="btn btn-primary btn-block" value="Neuen Nutzer anlegen">
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
															<div class="form-group" id="editForm">
																<input type="hidden" name="userID" class="form-control" id="userID"  placeholder="123" readonly/> <br> <!--Dieses Feld ist für den Nutzer unsichtbar. -->
																<label for="firstName">Vorname</label><input type="text" name="firstName" class="form-control" id="firstName"  placeholder="Max" required/> <br>
																<label for="lastName">Nachname</label><input type="text" name="lastName" class="form-control" id="lastName"  placeholder="Mustermann" required/><br>
																<label for="email">Email</label>
																<div class="input-group mb-3">
					   											<input type="text" class="form-control" name="email" placeholder="max.mustermann" id="email" aria-label="Recipient's username" aria-describedby="emailDomain" required>
					   												<div class="input-group-append">
					     												<span class="input-group-text" id="emailDomain">@its-stuttgart.de</span>
					   												</div>
					 											</div>
																<label for="passwort" >Passwort</label><input type="password" name="passwort" class="form-control" placeholder="Passwort" /><br>
																<label for="balance" >Kontostand</label>
																<div class="input-group mb-3">
					   											<input type="text" class="form-control" name="balance"id="balance" placeholder="123" aria-label="Tragen sie den gewünschten Betrag ein." aria-labelledby="kontostandHelp" aria-describedby="unit" required>
					   												<div class="input-group-append">
					     												<span class="input-group-text" id="unit">€</span>
					   												</div>
					 											</div>
																<label for="adminRights" >Adminrechte</label><br>
																<div class="form-check form-check-inline">
																			<input type="radio" name="adminRights" id="keineAdminrechte" class="form-check-input" value="3" checked><label class="form-check-label" for="adminRights">Nein</label>
																</div>
																<div class="form-check form-check-inline">
																			<input type="radio" name="adminRights" id="adminRights" class="form-check-input" value="2"><label class="form-check-label" for="adminRights">Ja</label>
																</div>
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
	$(document).on("click",'#editUser' , function (e) {
  var firstName= $(this).attr('firstName');
	var lastName=$(this).attr('lastName');
	var email=$(this).attr('email');
	var balance=$(this).attr('balance');
	var identity=$(this).attr('userID');
	var adminRights=$(this).attr('adminRights');
	var sessID = <?php echo json_encode($_SESSION['id']) ?>; //muss aufgrund diesen PHP parts hier stehen und kann nicht ins script.js
//set what we got to our form
  $('#firstName').val(firstName);
	$('#lastName').val(lastName);
	$('#email').val(email);
	$('#balance').val(balance);
	$('#userID').val(identity);
	$("input[name=adminRights][value=" + adminRights + "]").prop('checked', true); //je nachdem ob der Nutzer adminRights oder nicht wird der richtige radiobutton gewählt
	if(identity == sessID) { //falls man sich selbst bearbeitet, kann man seine Zugriffsrechte nicht bearbeiten
		$("input[name=adminRights], label[for=adminRights], span[name=adminRights]").hide(); //felder werden gehidet
	} else {
		$("input[name=adminRights], label[for=adminRights], span[name=adminRights]").show(); //sonst werden sie gezeigt
	}
});
</script>
</html>
