<!DOCTYPE HTML>
<html>
  <?php include 'dependencies.php' ?>
  <head>
    <title>Kontaktformular</title>
    <?php
      echo $head_dependencies;
    ?>
  </head>

  <body>

    <!-- Quick link to login to fake-mailbox: https://inboxbear.com/q/864xjrw/2ffswdg -->

    <?php include 'header.php' ?>

    <div class="container">
		<form action="http://formspree.io/foodmen-group@inboxbear.com" method="post">
		  <div class="form-group">
			<label for="name">Dein Name:</label>
			<input type="name" class="form-control" name="_next" id="name" placeholder="Horst? Max? Eva? Wie heißt du denn nun?!">
			<label for="email">Deine Email Adresse:</label>
			<input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="deinname@deinedomain.de">
			<small id="emailHelp" class="form-text text-muted">Wir werden deine Email NIEMALS veröffentlichen oder teilen</small>
		  </div>
		  <div class="form-group">
			<label for="betreff">Betreff:</label>
			<input type="text" class="form-control" id="betreff" placeholder="Was willsch?">
		  </div>
		  <div class="form-group">
			<label for="nachricht">Nachricht:</label>
			<textarea class="form-control" id="nachricht" rows="3" placeholder="Erzähle uns mehr von deinem Bedürfniss"></textarea>
		  </div>
		  <button type="submit" name="senden" class="btn btn-primary">Nachricht senden</button>
		</form>
		</div>

    <?php include 'footer.php' ?>
  </body>
</html>
