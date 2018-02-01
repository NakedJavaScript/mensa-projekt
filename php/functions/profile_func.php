<?PHP

//Code zum löschen eines Nutzers
if (isset($_GET['stornieren?buchungsnummer'])) {
  $buchungsnummer = $_GET['stornieren?buchungsnummer'];
  $delete = "DELETE FROM mensa.buchungen WHERE buchungsnummer = $buchungsnummer";
  $getPreis = $conn->query("SELECT sp.preis FROM mensa.buchungen as bu INNER JOIN mensa.tagesangebot as t ON t.tagesangebot_ID = bu.tagesangebot_ID INNER JOIN mensa.speise as sp ON sp.speise_ID = t.speise_ID WHERE buchungsnummer = '$buchungsnummer' LIMIT 1");
  $getPreis = $getPreis->fetch_object();
  if ($conn->query($delete) === TRUE) {
    $preis = $getPreis->preis;
    $newKontostand = $_SESSION['kontostand'] + $preis;
    $_SESSION['kontostand'] = $newKontostand;
    $conn->query("UPDATE mensa.benutzer SET kontostand = $newKontostand  WHERE  benutzer_ID = ".$_SESSION['id']); //neuer Kontostand wird in der Datenbank gesetzt
    $Alert = successMessage("Sie haben ihre Bestellung erfolgreich storniert! <br/> <strong>Ihr neuer Kontostand: $newKontostand €</strong>");
  }
  else {
    $Alert = dangerMessage("<strong>Error:</strong> " . $delete . "<br>" . $conn->error ."");
  }
}
?>
