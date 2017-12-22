<?php include 'dependencies.php'; ?>
<!DOCTYPE HTML>
<html>
	<head>
		<title></title>
		<?php
			echo $head_dependencies;

			$sql = "SELECT * FROM speise";
			$result = $conn->query($sql);
		?>
	</head>
	<body>
		<?php include 'header.php';
			if(!isset($_SESSION['email'])) {
			die('Du musst eingeloggt sein um dein Profil zu sehen.'); }//Nutzer die nicht eingeloggt sind können nicht auf diese Seite zugreifen.?>
		<div class="container">
		<div class="row">
				<div class="nav flex-column nav-pills col-sm-2" id="v-pills-tab" role="tablist" aria-orientation="vertical">
				  <a class="nav-link active" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="true">Profil</a>
				  <a class="nav-link" id="v-pills-order-tab" data-toggle="pill" href="#v-pills-order" role="tab" aria-controls="v-pills-order" aria-selected="false">Bestellungen</a>
				</div>
				<div class="tab-content col-sm-10" id="v-pills-tabContent">
					<div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
						<h1>Dein Profil</h1>
						<table class="table table-bordered">
						  <tbody>
							<tr>
							  <th scope="row">ID</th>
							  <td><?PHP echo  $_SESSION['id'] ?></td>
							</tr>
							<tr>
							  <th scope="row">Name</th>
							  <td><?PHP echo  $_SESSION['vorname'] . " " .  $_SESSION['nachname']?></td>
							</tr>
							<tr>
							  <th scope="row">E-Mail</th>
							  <td><?PHP echo $_SESSION['email']?></td>
							</tr>
							<tr>
							  <th scope="row">Kontostand</th>
							  <td><?PHP echo $_SESSION['kontostand'] . "€"?></td>
							</tr>
						  </tbody>
						</table>
						<button type='button' class='btn btn-success'>
							Bearbeiten <i class='fa fa-pencil'> </i>
						</button>
					</div>
				  <div class="tab-pane fade" id="v-pills-order" role="tabpanel" aria-labelledby="v-pills-order-tab">
						<ul class="list-group">
							<?php
								if ($result->num_rows > 0) {
								// output data of each row
								while($row = $result->fetch_assoc()) {
									echo 	"<li class='list-group-item justify-content-between'> "
												. $row["name"] . " " . $row["preis"] .
												"<button type='button' class='btn btn-success' style='float:right; text-align:center;''>
													<i class='fa fa-pencil'> </i>
												</button>
												<button type='button' class='btn btn-danger' style='float:right; text-align:center;''>
													<i class='fa fa-trash'> </i>
												</button>
											</li>";
								}
								} else {
									echo "0 results";
								}
								$conn->close();
							?>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<?php include 'footer.php' ?>
	</body>
</html>
