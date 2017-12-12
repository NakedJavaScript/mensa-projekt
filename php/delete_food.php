<?php

$id = $_GET['id'];
include 'dependencies.php';


// sql to delete a record
$delete = "DELETE FROM speise WHERE speise_ID = $id"; 

if ($conn->query($delete) === TRUE) {
					echo"Speise wurde erfolgreich entfernt";
					header("Refresh:3;url=essensliste.php");
				} else {
					echo"Error: " . $sql . "<br>" . $conn->error;
					}
?>