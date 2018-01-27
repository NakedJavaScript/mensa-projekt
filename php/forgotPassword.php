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

                        echo "Sie haben von uns eine E-Mail erhalten.";
                    } else {
                        echo "Bitte überprüfen Sie Ihre Eingabe!";
                    }
                }
            ?>

            <div class="container">
                <form action="forgotPassword.php" method="post">
                    <input type="text" name="email" placeholder="Ihre E-Mail"><br>
                    <input type="submit" name="forgotPass" value="Passwort zurücksetzen">
                </form>
            </div>
    </body>
    <?php include 'footer.php'; ?>
</html>
