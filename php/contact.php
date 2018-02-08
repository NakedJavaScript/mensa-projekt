<!DOCTYPE HTML>
<html>
  <?php include_once 'dependencies.php';
        include 'views/contactSend.php';
  ?>
  <head>
    <title>Kontaktformular</title>
        <?php
            echo $headDependencies;
        ?>
    </head>

    <body>
        <?php include 'header.php'; ?>
        <div class="container">
            <div>
                <h1>Kontaktformular <i class="fas fa-envelope"></i></h1>
                <br>
                <p>Für Fragen, Vorschläge oder Beschwerden nutzen Sie bitte das untenstehende Kontaktformular. Wir kümmern uns so schnell wie möglich um die Bearbeitung Ihrer Anfrage. Bei dringenden Angelegenheiten können Sie auch direkt unsere Angestellten ansprechen.</p>
                <br>
            </div>
            <div class="contact-box px-4 py-4 rounded">
                <form class="" role="form" action="" method="post">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="name" class="form-control" name="name" id="name" placeholder="Nachname Vorname" required>
                        <br>
                        <label for="email">Email Adresse:</label>
                        <input type="email" class="form-control" name="email" id="email" aria-describedby="emailInfo" placeholder="name@domain.de" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$" required />
                        <small id="emailInfo" class="form-text text-muted">Wir werden Ihre Email Adresse NIEMALS veröffentlichen oder teilen</small>
                    </div>
                    <div class="form-group">
                        <label for="subject">Betreff:</label>
                        <input type="text" class="form-control" name="subject" id="subject" placeholder="Betreffzeile" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Nachricht:</label>
                        <textarea class="form-control" name="message" id="message" rows="3" placeholder="Geben Sie hier Ihre Nachricht ein." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success" name="contactFormSubmit">Nachricht senden</button>
                </form>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </body>
</html>
