<?php
if(isset($_POST['submit'])){
    $to = "nikolai.nowolodski@googlemail.com"; // this is your Email address
    $from = $_POST['email']; // this is the sender's Email address
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $subject = "Form submission";
    $subject2 = "Copy of your form submission";
    $message = $first_name . " " . $last_name . " wrote the following:" . "\n\n" . $_POST['message'];
    $message2 = "Here is a copy of your message " . $first_name . "\n\n" . $_POST['message'];

    $headers = "From:" . $from;
    $headers2 = "From:" . $to;
    mail($to,$subject,$message,$headers);
    mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender
    echo "Mail Sent. Thank you " . $first_name . ", we will contact you shortly.";
    // You can also use header('Location: thank_you.php'); to redirect to another page.
    }
?>

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
    <?php include 'header.php' ?>

    <form method="post" action="send-mail.php">
    <p><label>Name:<br><input type="text" name="Name"></label></p>
    <p><label>E-Mail:<br><input type="text" name="Mail"></label></p>
    <p><label>Betreff:<br><input type="text" name="Betreff"></label></p>
    <p><label>Nachricht:<br>
    <textarea name="Nachricht" cols="50" rows="8"></textarea></label></p>
    <input type="submit" value="OK">
    </form>
    <!-- <div class="container">
      <form action="" method="post">
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="name" class="form-control" id="name" placeholder="Vor- und Nachname">
          <label for="email">Email Adresse:</label>
          <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="E-Mail">
          <small id="emailHelp" class="form-text text-muted">Wir werden Ihre Email NICHT veröffentlichen oder teilen</small>
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
    </div> -->
    <?php include 'footer.php' ?>
  </body>
</html>
