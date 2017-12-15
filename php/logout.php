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
    <h1> Sie haben sich erfolgreich ausgeloggt!</h1>
    <h3>Falls sie nicht automatisch weitergeleitet werden klicken sie <a href="index.php">hier</a></h3>
    <div>
  </body>
  </html>
