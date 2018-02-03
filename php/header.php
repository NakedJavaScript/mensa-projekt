<?PHP include_once 'functions/login.php'; ?>

<nav class="navbar navbar-expand-lg navbar-light bg-custom" id="cd-top-link">
  <a class="navbar-brand" href="index.php"><img src='../images/logo.png' width="120px"/></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
			<?PHP
					if (isset($_SESSION['adminrechte'])) {
					if($_SESSION['adminrechte'] == 2) { //nur Admin sieht diese Seiten
			      echo "<li class='nav-item'>
			        <a class='nav-link' href='benutzerliste.php'>Benutzerliste <span class='sr-only'>(current)</span></a>
			      </li>
			      <li class='nav-item'>
			        <a class='nav-link' href='essensliste.php'>Essensliste</a>
			      </li>
			      <li class='nav-item'>
			        <a class='nav-link' href='umsatz.php'>Umsatz</a>
			      </li>";
					 }
					else if($_SESSION['adminrechte'] == 3) { //normale user sehen das.
						echo "<li class='nav-item'>
							<a class='nav-link' href='profil.php'>Profil</a>
						</li>";
					}
					else {
					}
				}
			?>
    </ul>
   <ul class="nav navbar-nav navbar-right">
		 <?php if (isset($_SESSION['email'])) {
			echo  "<div class='btn-group'>
 		 		<a role='button' href='profil.php' class='btn btn-primary'>" . $_SESSION['vorname'] . "</a>
 				<button type='button' class='btn btn-primary dropdown-toggle dropdown-toggle-split' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
	 			<span class='sr-only'>" . $_SESSION['email'] . "</span>
 				</button>
 					<div class='dropdown-menu'>
	 					<a class='dropdown-item' href='profil.php#v-pills-profile'>Profil</a>
	 					<a class='dropdown-item' href='profil.php#v-pills-order'>Bestellungen</a>
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

<div class="container alert-container">
<?PHP echo $Alert; //Wird verwendet um Nachrichten auszugeben("Nutzer erfolgreich angelegt", "falsches passwort" usw.)?>
</div>


<!-- Login Modal Begin -->
<div class="modal fade" id="popUpWindow">
<div class="modal-dialog">
	<div class="modal-content">
	<!-- header -->
	<div class="modal-header">
	<h3 class="modal-title">Login</h3>
		<button type="button" class="close" data-dismiss="modal">&times;</button>

	</div>
	<!-- body -->
	<div class="modal-body">
		<form role="form" method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']?>">
		<div class="form-group">
			<label for="email">Email</label><input type="email" name="email" class="form-control"  placeholder="Email" required/><br>
			<label for="password" >Passwort</label><input type="password" name="passwort" class="form-control" placeholder="Passwort" required/>
		</div>

	</div>
	<!-- footer -->
	<div class="modal-footer login-footer ">
		<input type="submit" name="submit" class="btn btn-primary btn-block" value="Einloggen">
        <a href="forgotPassword.php">Passwort vergessen?</a>
	</div>
	</form>

	</div>
</div>
</div>
<!-- Login Modal End -->

 <div class="pageContentWrapper"> <!-- Wird verwendet damit content zwischen footer und Header bleibt und damit footer wirklich am Ende der Seite steht. -->
