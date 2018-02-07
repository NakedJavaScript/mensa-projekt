<?php include_once 'dependencies.php';
	  include_once 'functions/userlist_func.php';
	  include_once 'modals/userlist_modals.php';
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
											 echo	"<tr><td class='align-middle'>".$row['vorname']."</td>
														<td class='align-middle'>".$row['nachname']."</td>
														<td class='align-middle'>".$row['email']."</td>
														<td class='align-middle'>".$row['kontostand']."€</td>
														<td class='align-middle'><button type='button' method='POST' data-href='?delete?userID=".$row['benutzer_ID']."' data-toggle='modal' data-target='#confirm-delete' class='btn btn-danger'>
														<i class='fas fa-trash'> </i></button>

													<button type='button' method='POST'id='edit_user' benutzer_ID='".$row['benutzer_ID']."' vorname='".$row['vorname']."' nachname='".$row['nachname']."' email='".$row['email']."' kontostand='".$row['kontostand']."' adminrechte='".$row['admin_rechte']."' data-href='' data-toggle='modal' data-target='#edit-user' class='btn btn-success'>
														<i class='fas fa-pencil-alt'> </i></button></td>
												</tr>";
									}
									} else {
										echo "<tr><td class='align-middle'><strong>0 Ergebnisse</strong></td></tr>";
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
										echo "'><a class='page-link' href='userlist.php?page=". ($page-1)."'><i class='fas fa-arrow-left'></i></a></li>";
											for ($i=1; $i<=$total_pages; $i++) {  // ausgabe aller seiten mithilfe von Links
												echo "<li class='page-item";
													if ($i==$page) {
														echo " active'";
													}
													echo "'><a class='page-link' href='userlist.php?page=".$i."'";

														echo ">".$i."</a></li>";
											};
												echo "<li class='page-item";//Next Button
													if($page == $total_pages) {
														echo " disabled";
													}
														echo "'><a class='page-link' href='userlist.php?page=". ($page+1) ."'><i class='fas fa-arrow-right'></i></a></li>";
								$conn->close();
						?>
		</nav>
		</div>

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
