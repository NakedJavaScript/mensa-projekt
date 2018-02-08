<?php
    if(isset($_SESSION['email'])) { // If you're logged in you won't be able to see this page
        include 'footer.php';
        die('Sieht so aus als wären Sie eingeloggt, da können Sie ihr Passwort doch nicht vergessen haben!');
    }

    if (isset($_POST["forgotPass"])) { // If the user fills out the form and types in a valid email
        $email = $conn->real_escape_string($_POST["email"]);
        $data = $conn->query("SELECT benutzer_ID FROM benutzer WHERE email='$email'");

        if ($data->num_rows > 0) { // Set a new random password for the user
            $pepper = 'mensa_pfeffer';
            $options = array("cost"=>12);
            $str = "0123456789qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM";
            $str = str_shuffle($str); // Shuffle a new random password
            $str = substr($str, 0,10); // Pick only 10
            $url = "http://localhost/mensa-projekt/php/resetPassword.php?token=$str&email=$email"; // Set the url for the user
            $mail->Subject = "Passwort zuruecksetzen";
            $mail->Body = "Um Ihr Passwort zurueckzusetzen, besuchen Sie bitte diese <a href='$url'>Seite</a>";
            $mail->addAddress($email);
            $mail->setFrom('foodmengroup@gmail.com', 'Foodmengroup');
            $mail->send(); // Send him the mail with the link

            // Hash the new random password
            $hashedPassword = password_hash($str . $pepper, PASSWORD_BCRYPT, $options);
            // Update the users password in the database
            $conn->query("UPDATE benutzer SET passwort='$hashedPassword', token='$str' WHERE email='$email'");
            $Alert = successMessage('Sie haben eine E-Mail von uns erhalten.');
            header('refresh: 1.5 ; url = forgotPassword.php');
        } else {
            $Alert = dangerMessage("Diese E-Mail existiert nicht!");
            header('refresh: 1.5 ; url = forgotPassword.php');
        }
    }
?>
