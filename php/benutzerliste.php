<!DOCTYPE HTML>
<html>
	<?php include 'dependencies.php' ?>
	<head>
		<?php
			echo $head_dependencies;

			$sql = "SELECT * FROM benutzer";
			$result = $conn->query($sql);
		?>
		<title>Mensa - Benutzerliste</title>
	</head>

	<body>
		<?php include 'header.php' ?>
		<div class="container">
			<?php echo $Output; ?>
			<h1>Benutzerliste</h1>
			<br>
			<p>Das ist die globale Benutzerliste auf die nur Sie als Administrator Zugriff haben. Hier können Sie sehen welche Nutzer existieren, diese sortieren, nach ihnen suchen, sie bearbeiten oder löschen. Zudem können Sie mit dem Button weiter unten auch einen neuen Nutzer erstellen.</p>
			<br>
			<button type='button' class='btn btn-success btn-lg' data-toggle="modal" data-target="#NewUser">
				Hinzufügen <i class='fas fa-plus'> </i>
			</button>
			<table class="table table-hover user-table">
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
								echo "<tr><td>".$row['vorname']."</td>";
								echo "<td>".$row['nachname']."</td>";
								echo "<td>".$row['email']."</td>";
								echo "<td>".$row['kontostand']."€</td>";
								echo "<td><button type='button' class='btn btn-success'>
								<i class='fas fa-pencil-alt'> </i></button>
								<a href='benutzerliste.php?delete?userID=".$row['benutzer_ID']."'><button type='button' method='POST' name='delete_user' class='btn btn-danger'>
								<i class='fas fa-trash'> </i></button></a>
								</td>
								</tr>";
							}
						} else {
							echo "0 results";
						}
						$conn->close();
					?>
				</tbody>
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
