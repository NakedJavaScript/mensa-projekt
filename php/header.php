<?PHP
if(isset($_POST['submit'])){
	$email = trim($_POST['email']);
	$passwort = trim($_POST['passwort']);
  $pepper = 'mensa_pfeffer';

	$sql = "select * from benutzer where email = '$email'";
	$rs = $conn->query($sql);

	if($rs -> num_rows  == 1){

		$row = $rs->fetch_assoc();
		if(password_verify($passwort . $pepper,$row['passwort'])){
			$_SESSION['email'] = $email;
			$_SESSION['vorname'] = $row['vorname'];
			$_SESSION['nachname'] = $row['nachname'];
			$_SESSION['kontostand'] = $row['kontostand'];
			$_SESSION['id'] = $row['benutzer_ID'];
			$Output= "<div class='alert alert-success alert-dismissable'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Login erfolgreich</div>";
		}
		else{
					$Output ="<div class='alert alert-danger alert-dismissable fade in'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Wrong password</div>";
		}
	}
	else{
		$Output ="<div class='alert alert-danger alert-dismissable fade in'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>No User found</div>";
	}
}

?>


<nav class="navbar navbar-expand-lg navbar-light bg-custom">
  <a class="navbar-brand" href="index.php"><img src='../images/logo.png' width="120px"/></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="benutzerliste.php">Benutzerliste <span class="sr-only">(current)</span></a>
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
		 <?php if (isset($_SESSION['email'])) {
			echo  "<div class='btn-group'>
 		 		<button type='button' class='btn btn-primary'>" . $_SESSION['vorname'] . "</button>
 				<button type='button' class='btn btn-primary dropdown-toggle dropdown-toggle-split' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
	 			<span class='sr-only'>" . $_SESSION['email'] . "</span>
 				</button>
 					<div class='dropdown-menu'>
	 					<a class='dropdown-item' href='profil.php?profile'>Profil</a>
	 					<a class='dropdown-item' href='profil.php?orders'>Bestellungen</a>
	 					<div class='dropdown-divider'></div>
	 					<a class='dropdown-item' href='logout.php'>Logout</a>
 					</div>
						</div>";
			}
			 else {
					echo "<button type='button' class='btn btn-success' data-toggle='modal' data-target='#popUpWindow'>Login</button>";
				}
				?>
	</ul>
</nav>

<div class="container">
<?PHP echo $Output; //Wird verwendet um Nachrichten auszugeben("Nutzer erfolgreich angelegt", "falsches passwort" usw.)?>
</div>


<!-- Login Modal Begin -->
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
			<label for="email">Email</label><input type="email" name="email" class="form-control"  placeholder="Email"/><br>
			<label for="password" >Password</label><input type="password" name="passwort" class="form-control" placeholder="Passwort" />
		</div>

	</div>
	<!-- footer -->
	<div class="modal-footer">
		<input type="submit" name="submit" class="btn btn-primary btn-block" value="Einloggen">
	</div>
	</form>

	</div>
</div>
</div>
<!-- Login Modal End -->

 <div class="pageContentWrapper"> <!-- Wird verwendet damit content zwischen footer und Header bleibt und damit footer wirklich am Ende der Seite steht. -->
