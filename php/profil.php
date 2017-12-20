<!DOCTYPE HTML>
<html>
<?php include 'dependencies.php' ?>
	<head>
		<title></title>
		<?php
			echo $head_dependencies;

			$sql = "SELECT * FROM speise";
			$result = $conn->query($sql);
		?>
	</head>
	<body>
		<?php include 'header.php' ?>
		<div class="container">
		<div class="row">
				<div class="nav flex-column nav-pills col-sm-2" id="v-pills-tab" role="tablist" aria-orientation="vertical">
				  <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Profil</a>
				  <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Bestellungen</a>
				</div>
				<div class="tab-content col-sm-10" id="v-pills-tabContent">
					<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
						<h1>Dein Profil</h1>
						<br>
						<p>Das ist dein Profil. Hier kannst du deine Daten einsehen und falls nötig bearbeiten. Über den Reiter links kannst du außerdem auf deine Bestellungen zugreifen und sehen was du bisher gekauft hast.</p>
						<br>
						<table class="table table-bordered">
						  <tbody>
							<tr>
							  <th scope="row">Name</th>
							  <td>Nigglai NewWolölolodski</td>
							</tr>
							<tr>
							  <th scope="row">E-Mail</th>
							  <td>coolshit@jo.com</td>
							</tr>
							<tr>
							  <th scope="row">Kontostand</th>
							  <td>9001.00 €</td>
							</tr>
						  </tbody>
						</table>
						<button type='button' class='btn btn-success'>
							Bearbeiten <i class='fas fa-pencil-alt'> </i>
						</button>
					</div>
				  <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
						<h1>Deine Bestellungen</h1>
						<br>
						<table class="table table-bordered">
						<tbody>
							<tr>
							<?php
								$count = 1;
								if ($result->num_rows > 0) {
								// ausgabe der Daten aus jeder Zeile der Tabelle.
								while($row = $result->fetch_assoc()) {
										echo "<th scope='row'>Bestellung " . $count++ . "</th>";
										echo 	"<td>".$row['name']."</td>";
										echo		"<td>".$row['preis']."€</td>";
										echo		"<td><button type='button' class='btn btn-success'>
													<i class='fas fa-pencil-alt'> </i></button>
													<button type='button' method='POST' name='delete_food' class='btn btn-danger'>
																<i class='fas fa-trash'> </i></button>
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
				</div>
			</div>
		</div>
		<?php include 'footer.php' ?>
	</body>
</html>
