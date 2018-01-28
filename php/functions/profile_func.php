<?php
    function endsWith($haystack, $needle) {
        return $needle === '' || substr_compare($haystack, $needle, -strlen($needle)) === 0;
    }
    if (isset($_POST['edit_profile'])) {
        $required = array('vorname','nachname','email','new_password');
        $is_empty = TRUE;
        foreach($required as $field) {
          if (!empty($_POST[$field])) {
              $is_empty = false;
              break;
          }
        }
        if (!$is_empty) {
            $pepper = 'mensa_pfeffer';
            $update = "UPDATE mensa.benutzer SET";

            if(!empty($_POST['vorname'])) {
                $update = $update . " vorname ='".$_POST['vorname']."' ,";
            }
            if(!empty($_POST['nachname'])) {
                $update = $update . " nachname ='".$_POST['nachname']."' ,";
            }
            if(!empty($_POST['email'])) {
                if (endsWith($_POST['email'], '@its.de')) {
                    $update = $update . " email = '".$_POST['email']."' ,";
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
                    $Alert = dangerMessage("Fehler: Passwort eingaben stimmen nicht überein.");
                }
            }
            if (endsWith($update,',')) {
                $update = substr($update, 0, -1);
                $update = $update . " WHERE benutzer_ID = ".$_SESSION['id'];
                $result = $conn->query($update);
                if($result === true) {
                    $query = "SELECT * from mensa.benutzer WHERE benutzer_ID = ".$_SESSION['id'];
                    $user = $conn->query($update);
                    $_SESSION['email'] = $user['email'];
        			$_SESSION['vorname'] = $user['vorname'];
        			$_SESSION['nachname'] = $user['nachname'];
                    $Alert = successMessage("Änderungen erfolgreich gespeichert.");
                } else {
                    $Alert = dangerMessage("<strong>Error:</strong> " . $update . "<br>" . $conn->errno . " " . $conn->error);
                }
            }
        } else {
            $Alert = dangerMessage("Fehler: Keine Änderungen erkannt.");
        }
    }
?>
