<?php
    // Code to reset the password
    if(isset($_GET["email"]) && isset($_GET["token"])) { // Checks if the mail and the tokens in the reset url link are correct and available in the Database
        $email = $conn->real_escape_string($_GET["email"]);
        $token = $conn->real_escape_string($_GET["token"]);
        $data = $conn->query("SELECT benutzer_ID FROM mensa.benutzer WHERE email='$email' AND token='$token'");
        $pepper = 'mensa_pfeffer';
        $options = array("cost"=>12);

        if ( isset( $_POST['submitNewPassword'] ) ) { // Sets a new Password for the user
            $newPassword = $_POST['neuesPasswort'];
            $hashedPassword = password_hash($newPassword . $pepper, PASSWORD_BCRYPT, $options);
            $conn->query("UPDATE benutzer SET passwort='$hashedPassword', token='' WHERE email='$email'");

            $Alert = successMessage("Dein Passwort wurde erfolgreich geändert!");

            header('refresh: 1.5 ; url = index.php');
        }
    } else {
        header('refresh: 1.5 ; url = index.php');
        exit();
    }

?>
