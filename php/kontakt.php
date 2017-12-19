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
      <div>
        <h1>Kontaktformular <i class="fas fa-envelope" style="color:#007bff"></i></h1>
        <br>
        <p>Für Fragen, Vorschläge oder Beschwerden nutzen Sie bitte das untenstehende Kontaktformular. Wir kümmern uns so schnell wie möglich um die Bearbeitung Ihrer Anfrage. Bei dringenden Angelegenheiten können Sie auch direkt unsere Angestellten ansprechen.</p>
        <br>
      </div>
      <div class="contact-box">
        <form class="" role="form" action="http://formspree.io/foodmen-group@inboxbear.com" method="post">
          <input type="hidden" name="_next" value="mensa-projekt/php/success.php" />
          <div class="form-group">
            <label for="name">Name:</label>
            <input type="name" class="form-control" name="Name" id="name" placeholder="Nachname Vorname" required>
            <br>
            <label for="email">Email Adresse:</label>
            <input type="email" class="form-control" name="Email" id="email" aria-describedby="emailHelp" placeholder="name@domain.de" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required />
            <small id="emailHelp" class="form-text text-muted">Wir werden Ihre Email Adresse NIEMALS veröffentlichen oder teilen</small>
          </div>
          <div class="form-group">
            <label for="betreff">Betreff:</label>
            <input type="text" class="form-control" name="Betreff" id="betreff" placeholder="Betreffzeile" required>
          </div>
          <div class="form-group">
            <label for="nachricht">Nachricht:</label>
            <textarea class="form-control" name="Nachricht" id="nachricht" rows="3" placeholder="Geben Sie hier Ihre Nachricht ein." required></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Nachricht senden</button>
        </form>
      </div>
    </div>

    <?php include 'footer.php' ?>
  </body>
</html>
