<?PHP
	if(isset($_POST['submit'])){
		$email = trim($_POST['email']);
		$passwort = trim($_POST['passwort']);

		$sql = "select * from benutzer where email = '".$email."'";
		$rs = $conn->query($sql);

		$hashed_shit = password_hash ( $passwort, PASSWORD_DEFAULT );


		if($rs -> num_rows  == 1){
			$row = $rs->fetch_assoc();
			if(password_verify($passwort,$row['passwort'])){
				echo "Password verified";
			}
			else{
				echo $hashed_shit . " + " . $row['passwort'];
			}
		}
		else{
			echo "No User found";
		}
	}
?>

<div class="pageContentWrapper">
	<nav class="navbar navbar-expand-lg navbar-light bg-custom">
		<a class="navbar-brand" href="index.php"><img src='../images/logo.png' width="120px"/></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href="benutzerliste.php">Benutzerliste</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="essensliste.php">Essensliste</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="profil.php">Profil</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="umsatz.php">Umsatz</a>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<button type='button' class="btn btn-success" data-toggle="modal" data-target="#popUpWindow">Login</button>

				<div class="modal fade" id="popUpWindow">
					<div class="modal-dialog">
						<div class="modal-content">
							<!-- header -->
							<div class="modal-header">
								<h3 class="modal-title">Login Form</h3>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<!-- body -->
							<div class="modal-body">
								<form role="form" method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']?>">
									<div class="form-group">
										<label for="email">Email</label><input type="email" name="email" class="form-control"  placeholder="Email"/>
										<label for="password" >Password</label><input type="password" name="passwort" class="form-control" placeholder="Passwort" />
									</div>
									<!-- footer -->
									<div class="modal-footer">
										<input type="submit" name="submit" class="btn btn-primary btn-block" value="Einloggen">
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</ul>
		</div>
	</nav>
