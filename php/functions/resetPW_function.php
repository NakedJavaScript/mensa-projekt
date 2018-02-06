<?php
include_once 'misc.php';

if(isset($_GET["email"]) && isset($_GET["token"])) {
    $_GET = sanitize_form($_GET);
    if ($_GET) {
    $email = $conn->real_escape_string($_GET["email"]);
    $token = $conn->real_escape_string($_GET["token"]);
    $data = $conn->query("SELECT benutzer_ID FROM mensa.benutzer WHERE email='$email' AND token='$token'");


        $pepper = 'mensa_pfeffer';
        $options = array("cost"=>12);

        if ( isset( $_POST['submitNewPassword'] ) ) {
            $newPassword = $_POST['neuesPasswort'];
            // Passwort wird gehashed
            $hashedPassword = password_hash($newPassword . $pepper, PASSWORD_BCRYPT, $options);
            // Passwort wird verändert, token wird wieder auf empty gesetzt
            $conn->query("UPDATE benutzer SET passwort='$hashedPassword', token='' WHERE email='$email'");

            $Alert = successMessage("Dein Passwort wurde erfolgreich geändert!");

            echo $Alert . "
            <script>setTimeout(function () {
                window.location.href= 'index.php';
            },3000);</script>";
        }
    } else {
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}

?>
