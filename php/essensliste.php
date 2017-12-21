<?php include_once 'dependencies.php'; ?>
<!DOCTYPE HTML>
<html>
	<head>
		<?php
			echo $head_dependencies;

			$sql = "SELECT * FROM speise";
			$result = $conn->query($sql);
		?>
		<title></title>
	</head>

	<body>
		<?php include 'header.php'; ?>
		<div class="container">

			<h1>Essensliste</h1>
			<button type='button' class='btn btn-success btn-lg' data-toggle="modal" data-target="#NewFood">
				Hinzufügen <i class='fa fa-plus'> </i>
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
							echo		"<td><a href='essensliste.php?delete?speiseID=".$row['speise_ID']."'><button type='button' method='POST' name='delete_food' class='btn btn-danger'>
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
									  <form role="form" method="POST" action="essensliste.php?FoodAdded"> <!-- Mit NewFood.php als action funktioniert es, aber mit dem da oben nicht...-->
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

		<?php include 'footer.php' ?>
	</body>
</html>
