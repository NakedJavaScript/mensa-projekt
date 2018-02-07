<!DOCTYPE HTML>
<html>
<?php include 'dependencies.php' ?>
	<head>
		<title>Erfolgreiche Weiterleitung</title>
		<?php
			echo $headDependencies;
		?>
	</head>

	<body>
		<?php include 'header.php' ?>

    <div class="container">
      <div class="row">
        <div class="modalbox success col-sm-8 col-md-6 col-lg-5 center animate">
          <div class="icon">
            <i class="fas fa-check-circle fa-5x" style="color: #28a745"></i>
          </div>
          <div class="text-box">
            <h1>Erfolgreich!</h1>
            <p>Wir haben Ihre E-Mail erfolgreich erhalten
            <br>und melden uns so schnell wie möglich bei Ihnen.</p>
          </div>
          <a href="index.php">
            <button type="button" class="redo btn">Zurück zur Startseite</button>
          </a>
          <span class="change">Klicken Sie entweder auf den Button um zurück zur Startseite zu gelangen oder warten Sie einen moment bevor Sie automatisch zurückgeleitet werden.</span>
        </div>
      </div>

    <script type="text/javascript">
      window.setTimeout(function () {
        window.location = "index.php";
      },5000);
    </script>
		<?php include 'footer.php' ?>
	</body>
</html>
