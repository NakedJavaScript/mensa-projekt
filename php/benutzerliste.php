<?php session_start(); ?>
<!DOCTYPE HTML>
<html>
<?php include 'dependencies.php' ?>
	<head>
		<?php
			echo $head_dependencies;

			$sql = "SELECT * FROM benutzer";
			$result = $conn->query($sql);
		?>
		<title></title>
	</head>

	<body>
		<?php include 'header.php' ?>
		<div class="container">
		<?php echo $Output; ?>
			<h1>Benutzerliste</h1>
			<button type='button' class='btn btn-success btn-lg' data-toggle="modal" data-target="#NewUser">
				Hinzufügen <i class='fa fa-plus'> </i>
			</button>
				<br>
				<br>
				<br>
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
							echo 	"<tr><td>".$row['vorname']."</td>";
							echo		"<td>".$row['nachname']."</td>";
							echo		"<td>".$row['email']."</td>";
							echo		"<td>".$row['kontostand']."€</td>";
							echo		"<td><a href='benutzerliste.php?delete?userID=".$row['benutzer_ID']."'><button type='button' method='POST' name='delete_user' class='btn btn-danger'>
										<i class='fa fa-trash'> </i></button></a>
									<button type='button' class='btn btn-success'>
										<i class='fa fa-pencil'> </i></button></td>
								</tr>";
					}
					} else {
						echo "0 results";
					}
					$conn->close();
				?>
			</table>
		</div>

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
									  <form role="form" method="POST" action="benutzerliste.php?newUser">
										<div class="form-group">
										  <label for="vorname">Vorname</label><input type="text" name="vorname" class="form-control"  placeholder="Max" required/>
										  <label for="nachname">Nachname</label><input type="text" name="nachname" class="form-control"  placeholder="Mustermann" required/>
										  <label for="email">Email</label><input type="email" name="email" class="form-control"  placeholder="max.mustermann@musterdomäne.de" required/>
										  <label for="password" >Password</label><input type="password" name="passwort" class="form-control" placeholder="1Muster2Pass3Wort" required/>
										  <label for="kontostand" >Kontostand</label><input type="int" name="kontostand" class="form-control" placeholder="WAAAS?! Du hast doch wohl kaum eine Millionen?!" required/>
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
	</body>
	<?php include 'footer.php' ?>
</html>
