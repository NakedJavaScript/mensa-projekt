<?php
	include_once 'dependencies.php';
	include_once 'views/userList.php';
	include_once 'modals/userList.php';
?>

<!DOCTYPE HTML>
<html>
	<head>
		<?php
			echo $head_dependencies;
			$sql = "SELECT * FROM benutzer";
			$result = $conn->query($sql);
		?>
		<title>Benutzerliste</title>
	</head>

	<body>
		<?php include 'header.php';
			if (((!isset($_SESSION['adminrechte'])) || $_SESSION['adminrechte'] != 2)) { // Checks if the user has Admin rights
				include 'footer.php';
				die('Sie haben keinen Zugriff auf diese Seite. Bitte loggen Sie sich als Administrator ein.'); // If not the user wont be able to access the site
			}
		?>

		<div class="container col-sm-10">
			<h1>Benutzerliste</h1>
			<br>
			<p>Das ist die globale Benutzerliste auf die nur Sie als Administrator Zugriff haben. Hier können Sie sehen welche Nutzer existieren, diese sortieren, nach ihnen suchen, sie bearbeiten oder löschen. Zudem können Sie mithilfe des "Hinzufügen"-Buttons neue Nutzer anlegen.</p>
			<br>
			<button type='button' class='btn btn-success btn-lg' data-toggle="modal" data-target="#NewUser">Hinzufügen <i class='fa fa-plus'></i></button>

			<br/>
			<br/>

			<table class="tabelsorterTable table table-hover tablesorter">
				<thead>
					<tr>
						<th>Vorname <i class="fas fa-exchange-alt"></i></th>
						<th>Nachname <i class="fas fa-exchange-alt"></i></th>
						<th>Email <i class="fas fa-exchange-alt"></i></th>
						<th>Kontostand <i class="fas fa-exchange-alt"></i></th>
						<th>Admin? <i class="fas fa-exchange-alt"></i></th>
						<th class="filter-false" data-sorter="false">Löschen/Bearbeiten</th>
					</tr>
				</thead>
				<tbody>
					<?php
						if ($result->num_rows > 0) {
							// Returns the data in a table
							while ($row = $result->fetch_assoc()) {
								if ($row['admin_rechte'] == 2) { // Sets the admin rights for the user
									$adminRecht = "Ja";
									echo "<tr class='admin-highlight'>";
								} else {
									$adminRecht = "Nein";
									echo "<tr>";
								}
								echo "<td class='align-middle'>".$row['vorname']."</td>
								<td class='align-middle'>".$row['nachname']."</td>
								<td class='align-middle'>".$row['email']."</td>
								<td class='align-middle'>".$row['kontostand']."€</td>
								<td class='align-middle'>".$adminRecht."</td>";
								if ($row['benutzer_ID'] == $_SESSION['id']) { // If you're logged in you can't delete yourself
									$disabled = 'disabled';
								} else {
									$disabled = '';
								}
								echo "<td class='align-middle'><button type='button' method='POST' data-href='?delete?userID=".$row['benutzer_ID']."' data-toggle='modal' data-target='#confirm-delete' class='btn btn-danger'". $disabled .">
								<i class='fas fa-trash'> </i></button>

								<button type='button' method='POST'id='edit_user' benutzer_ID='".$row['benutzer_ID']."' vorname='".$row['vorname']."' nachname='".$row['nachname']."' email='".strstr($row['email'], '@', true)."' kontostand='".$row['kontostand']."' adminrechte='".$row['admin_rechte']."' data-href='' data-toggle='modal' data-target='#edit-user' class='btn btn-success'>
								<i class='fas fa-pencil-alt'> </i></button></td>
								</tr>";
							}
						} else {
							echo "Keine Ergebnisse";
						}
					?>
				<tbody>
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

		<?PHP // Opens the modal to delete a user
			confModal('Wollen Sie diesen Nutzer wirklich löschen?');
		?>
	</body>
	<?php include 'footer.php'; ?>
	<script>
		// Additional Javascript code for editing users
		$(document).on("click", '#edit_user', function (e) {
			var vorname = $(this).attr('vorname');
			var nachname = $(this).attr('nachname');
			var email = $(this).attr('email');
			var kontostand = $(this).attr('kontostand');
			var identity = $(this).attr('benutzer_ID');
			var adminrechte = $(this).attr('adminrechte');
			var sessID = <?php echo json_encode($_SESSION['id']) ?>; // This script part has to be in this file due to the PHP part in it
			// set what we got to our form
			$('#vorname').val(vorname);
			$('#nachname').val(nachname);
			$('#email').val(email);
			$('#kontostand').val(kontostand);
			$('#benutzer_ID').val(identity);
			$("input[name=adminrechte][value=" + adminrechte + "]").prop('checked', true); // Depending wether the user is admin or not the correct radiobutton will show up
			if (identity == sessID) { // If you want to edit yourself (as admin), you can't change your rights
				$("input[name=adminrechte], label[for=adminrechte], span[name=adminrechte]").hide(); // Hide the fields
			} else {
				$("input[name=adminrechte], label[for=adminrechte], span[name=adminrechte]").show(); // Else if your not editing yourself, show them
			}
		});
	</script>
</html>
