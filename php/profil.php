<?php include 'dependencies.php' ?>
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
							Bearbeiten <i class='fa fa-pencil'> </i>
						</button>
					</div>
				  <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
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
