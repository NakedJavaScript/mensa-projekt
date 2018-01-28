<?php
if (isset($_POST['bearbeiten_nutzer'])) {
            if (!is_numeric($_POST['kontostand'])) { //prüft ob im Textfeld nur Zahlen eingegeben wurden.
                $Alert = dangerMessage("Im Feld <strong>'Kontostand'</strong> sind nur numerische Zeichen erlaubt.");
            }
                    else if ($_POST['kontostand'] < 0) {//prüft ob es keine negative Zahl ist
                            $Alert= dangerMessage("Im Feld <strong>'Kontostand'</strong> sind keine Negativen Zahlen erlaubt.");
                    }
                                else {
                                    $nutzerID = $_POST['benutzer_ID'];
                                    $vorname = $_POST['vorname'];
                                    $nachname = $_POST['nachname'];
                                    $email = $_POST['email'];
                                    $kontostand = $_POST['kontostand'];
                                    $adminrechte = $_POST['adminrechte'];
                                    $pepper = 'mensa_pfeffer';

                                    if(isset($_POST['passwort'])) { //falls der Admin ein neues Passwort setzt wird die variable $passwort gesetzt
                                    $passwort = $_POST['passwort'];
                                    //passwort wird gehasht
                                    $options = array("cost"=>12);
                                    $hashPassword = password_hash($passwort . $pepper,PASSWORD_BCRYPT,$options);
                                }
                                    //aktuelle email des zu bearbeitenden Users wird ausgewählt.
                                    $mysqlItem = $conn->query("SELECT email FROM mensa.benutzer WHERE benutzer_ID = $nutzerID");
                                    $mysqlItem = $mysqlItem->fetch_assoc();

                                                    if($email != $mysqlItem['email']) { //falls die email adresse geändert wurde wird geprüft ob die Eingetragene bereits vorhanden ist.
                                                                $check = $conn->query("SELECT * FROM benutzer WHERE email = '$email'"); //sql befehl zum prüfen ob es den User bereits gibt

                                                                    if($check->num_rows < 1 ) {   //Wenn keine Zeilen zurückgegeben werden, dann wird das Produkt eingefügt.
                                                                        $update = "UPDATE mensa.benutzer SET vorname= '$vorname'
                                                                                                                                                , nachname = '$nachname'
                                                                                                                                                , email = '$email'
                                                                                                                                                , kontostand = '$kontostand'
                                                                                                                                                , admin_rechte = $adminrechte";
                                                                                                if(isset($_POST['passwort'])) {
                                                                                                    $update = $update . " , passwort = 'abc'";
                                                                                                }

                                                                                            $update = $update . " WHERE benutzer_ID = $nutzerID";

                                                                            $result = $conn->query($update);
                                                                                if($result === true) {
                                                                                    $Alert = successMessage($vorname . " " . $nachname . ' wurde erfolgreich bearbeitet');
                                                                                }
                                                                                    else {
                                                                                        $Alert = dangerMessage("<strong>Error:</strong> " . $update . "<br>" . $conn->errno . " " . $conn->error);
                                                                                    }
                                                                    }
                                                                        else { //Ausgabe wenn es diesen Nutzer bereits gibt
                                                                            $Alert = dangerMessage("Es gibt bereits einen Nutzer mit dieser Email.");
                                                                        }
                                                }

                                                else { //Wenn email adresse gleich bleibt wird update sofort durchgeführt.
                                                    $update = "UPDATE mensa.benutzer SET vorname= '$vorname'
                                                                                                                            , nachname = '$nachname'
                                                                                                                            , email = '$email'
                                                                                                                            , kontostand = '$kontostand'
                                                                                                                            , admin_rechte = $adminrechte";
                                                                                                    if(isset($_POST['passwort'])) {
                                                                                                        $update = $update . " , passwort = '$hashPassword'";
                                                                                                    } else {}

                                                                                        $update = $update . " WHERE benutzer_ID = $nutzerID";

                                                        $result = $conn->query($update);
                                                            if($result === true) {
                                                                $Alert = successMessage($vorname . " " . $nachname . ' wurde erfolgreich bearbeitet');
                                                            }
                                                                else {
                                                                    $Alert = dangerMessage("<strong>Error:</strong> " . $update . "<br>" . $conn->errno . " " . $conn->error);
                                                                }
                                                }

                        }//ende von else
}//ende von if isset
?>