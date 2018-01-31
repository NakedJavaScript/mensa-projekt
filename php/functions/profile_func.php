<?PHP

//Code zum löschen eines Nutzers
if (isset($_GET['stornieren?buchungsnummer'])) {
  $buchungsnummer = $_GET['stornieren?buchungsnummer'];
  $delete = "DELETE FROM mensa.buchungen WHERE buchungsnummer = $buchungsnummer";
  if ($conn->query($delete) === TRUE) {
    $Alert = successMessage('Sie haben ihre Bestellung erfolgreich storniert!');
  }
  else {
    $Alert = dangerMessage("<strong>Error:</strong> " . $delete . "<br>" . $conn->error ."");
  }
}
?>
