<?php
    include_once 'misc.php';

    function endsWith($haystack, $needle) { // Checks if a string ends with a string
        return $needle === '' || substr_compare($haystack, $needle, -strlen($needle)) === 0;
    }
    if (isset($_POST['edit_profile'])) {
        $_POST = sanitize_form($_POST);
        if ($_POST) {
            $required = array('vorname','nachname','email','new_password');
            $is_empty = TRUE;
            foreach($required as $field) {
              if (!empty($_POST[$field])) {
                  $is_empty = false;
                  break;
              }
            }
            if (!$is_empty) { // Updates the user
                $pepper = 'mensa_pfeffer';
                $update = "UPDATE mensa.benutzer SET";
                $email_invalid = false;
                $password_invalid = false;

                if(!empty($_POST['vorname'])) {
                    $update = $update . " vorname ='".$_POST['vorname']."' ,";
                }
                if(!empty($_POST['nachname'])) {
                    $update = $update . " nachname ='".$_POST['nachname']."' ,";
                }
                if(!empty($_POST['email'])) {
                    if (strpos($_POST['email'], '@') == false) {
                        $update = $update . " email = '".$_POST['email']."@its-stuttgart.de' ,";
                    }  else {
                        $email_invalid = true;
                    }
                }
                if(!empty($_POST['new_password'])) {
                    if(!empty($_POST['confirm_password']) && $_POST['new_password'] == $_POST['confirm_password']) {
                        $passwort = $_POST['new_password'];
                        //passwort wird gehasht
                        $options = array("cost"=>12);
                        $hashPassword = password_hash($passwort . $pepper,PASSWORD_BCRYPT,$options);
                        $update = $update . " passwort = '$hashPassword' ,";
                    } else {
                        $password_invalid = true;
                    }
                }
                if (endsWith($update,',')) {
                    $update = substr($update, 0, -1);
                    $update = $update . " WHERE benutzer_ID = ".$_SESSION['id'];
                    $result = $conn->query($update);
                    if($result === true) {
                        $query = "SELECT * from mensa.benutzer WHERE benutzer_ID = ".$_SESSION['id'];
                        $user = $conn->query($query)->fetch_assoc();
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['vorname'] = $user['vorname'];
                        $_SESSION['nachname'] = $user['nachname'];
                        $Alert = successMessage("Profil erfolgreich bearbeitet.");
                        header('refresh: 1.5 ; url = profil.php');
                    } else {
                        $Alert = dangerMessage("<strong>Error:</strong> " . $update . "<br>" . $conn->errno . " " . $conn->error);
                        header('refresh: 1.5 ; url = profil.php');
                    }
                } else {
                    if($email_invalid) {
                        $Alert = dangerMessage("Im Feld 'email' dürfen keine Domänen angegeben werden, bitte entfernen Sie das <strong>'@'</strong> zeichen und die <strong>Domäne</strong>");
                        header('refresh: 1.5 ; url = profil.php');
                    } else {
                        $Alert = dangerMessage("Fehler: Die von Ihnen eingegebenen Passwörter stimmen nicht überein.");
                        header('refresh: 1.5 ; url = profil.php');
                    }
                }
            } else {
                $Alert = dangerMessage("Fehler: Keine Änderungen erkannt.");
                header('refresh: 1.5 ; url = profil.php');
            }
        } else {
            $Alert = dangerMessage("Fehler: Invalide Eingabe.");
            header('refresh: 1.5 ; url = profil.php');
        }
    }

    // Code to delete orders
    if (isset($_GET['stornieren?buchungsnummer'])) {
        $ordernumber = $_GET['stornieren?buchungsnummer'];
        $delete = "DELETE FROM mensa.buchungen WHERE buchungsnummer = $ordernumber";
        $getPrice = $conn->query("SELECT sp.preis FROM mensa.buchungen as bu INNER JOIN mensa.tagesangebot as t ON t.tagesangebot_ID = bu.tagesangebot_ID INNER JOIN mensa.speise as sp ON sp.speise_ID = t.speise_ID WHERE buchungsnummer = '$ordernumber' LIMIT 1");
        $getPrice = $getPrice->fetch_object();
        if ($conn->query($delete) === TRUE) { // if everything is correct and the user can delete his order, we calculate his new balance and show it to him
            $price = $getPrice->preis;
            $newBalance = $_SESSION['kontostand'] + $price;
            $_SESSION['kontostand'] = $newBalance;
            $conn->query("UPDATE mensa.benutzer SET kontostand = $newBalance  WHERE  benutzer_ID = ".$_SESSION['id']); // the new balance will be set
            $Alert = successMessage("Sie haben ihre Bestellung erfolgreich storniert! <br/> <strong>Ihr neuer Kontostand: $newBalance €</strong>");
            header('refresh: 1.5 ; url = profil.php#v-pills-order');
        }
        else {
            $Alert = dangerMessage("Es ist etwas schief gelaufen, bitte versuchen Sie es erneut!");
            header('refresh: 1.5 ; url = profil.php#v-pills-order');
        }
    }
?>
