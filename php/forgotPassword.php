<?php include_once 'dependencies.php';
?>
<!DOCTYPE HTML>
<html>
    <head>
        <?php
            echo $head_dependencies;
        ?>
        <title>Passwort vergessen?</title>
    </head>

    <body>
            <?php include 'header.php';
                if(isset($_SESSION['email'])) {
                    include'footer.php';
                    die('Sieht so aus als wären Sie eingeloggt, da können Sie ihr Passwort doch nicht vergessen haben!');
                } //Verweigert nicht Admins den Zugriff auf diese Seite

                if (isset($_POST["forgotPass"])) {
                    $email = $conn->real_escape_string($_POST["email"]);
                    $data = $conn->query("SELECT benutzer_ID FROM benutzer WHERE email='$email'");

                    if ($data->num_rows > 0) {
                        $pepper = 'mensa_pfeffer';
                        $options = array("cost"=>12);
                        $str = "0123456789qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM";
                        $str = str_shuffle($str);
                        $str = substr($str, 0,10);
                        $url = "http://localhost/mensa-projekt/php/resetPassword.php?token=$str&email=$email";
                        $mail->Subject = "Passwort zuruecksetzen";
                        $mail->Body = "Um Ihr Passwort zurueckzusetzen, besuchen Sie bitte diese <a href='$url'>Seite</a>";
                        $mail->addAddress($email);
                        $mail->setFrom('foodmengroup@gmail.com', 'Foodmengroup');
                        $mail->send();

                        // Passwort wird gehashed
                        $hashedPassword = password_hash($str . $pepper, PASSWORD_BCRYPT, $options);
                        // Passwort wird verändert
                        $conn->query("UPDATE benutzer SET passwort='$hashedPassword', token='$str' WHERE email='$email'");

                        $Alert = 'Sie haben eine E-Mail von uns erhalten.';

                        echo "<div class='alert alert-success alert-dismissable fade show' style='width:500px;'>
                    					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>".$Alert."</div>";
                    } else {
                        $Alert = "Diese E-Mail existiert nicht!";
                        echo "<div class='alert alert-danger alert-dismissable fade show' style='width:500px;'>
                      <a href='essensliste.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>".$Alert."</div>";
                    }
                }
            ?>

            <div class="container flat-form">
                <div id="reset" class="form-action">
                    <h1>Passwort zurücksetzen</h1>
                    <small>Um Ihr Passwort zurückzusetzen geben Sie bitte Ihre E-Mail Adresse im untenstehenden Feld ein. Sofern Ihre Adresse in unserem System registriert ist, erhalten Sie eine E-Mail mit einem Link um ein neues Passwort zu setzen.</small>
                    <form action="forgotPassword.php" method="post" class="forgotPasswordForm">
                        <ul>
                            <li>
                                <input type="email" name="email" placeholder="Ihre E-Mail" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$" required>
                            </li>
                            <li>
                                <input type="submit" class="btn btn-success" name="forgotPass" value="Passwort zurücksetzen">
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
    </body>
    <?php include 'footer.php'; ?>
</html>
