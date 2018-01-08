<?php
session_start();
session_destroy();
header("refresh:3;index.php");
include 'dependencies.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
    <?php echo $head_dependencies; ?>
    <title>Mensa Logout </title>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="modalbox success col-sm-8 col-md-6 col-lg-5 center animate">
          <div class="icon">
            <i class="fas fa-check-circle fa-5x" style="color: #28a745"></i>
          </div>
          <div class="text-box">
            <h1>Logout Erfolgreich!</h1>
            <p>Sie haben sich erfolgreich ausgeloggt.</p>
          </div>
          <a href="index.php">
            <button type="button" class="redo btn">Zurück zur Startseite</button>
          </a>
          <span class="change">Klicken Sie entweder auf den Button um zurück zur Startseite zu gelangen oder warten Sie einen moment bevor Sie automatisch zurückgeleitet werden.</span>
        </div>
      </div>

  </body>
  </html>
