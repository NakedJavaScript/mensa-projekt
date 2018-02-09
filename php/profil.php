<?php
	include 'dependencies.php';
	include_once 'functions/profile_func.php';
	include_once 'modals/profile.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Dein Profil</title>
		<?php
			echo $head_dependencies;

			$sql = "SELECT buchungsnummer, datum as tagesangebotsdatum, sp.name, sp.preis, sp.allergene_inhaltsstoffe, sp.sonstiges, buchungsdatum
			FROM mensa.buchungen as b
			INNER JOIN mensa.tagesangebot as t ON b.tagesangebot_ID = t.tagesangebot_ID
			INNER JOIN mensa.speise sp ON t.speise_ID = sp.speise_ID
			WHERE schueler_ID =" . $_SESSION['id'];
			$result = $conn->query($sql);
		?>
	</head>
	<body>
		<?php
			include 'header.php';
			if(!isset($_SESSION['email'])) {
				include'footer.php';
				die('Du musst eingeloggt sein um dein Profil zu sehen.');
			} // If you're not logged in you won't see this site
		?>
		<div class="container pt-3">
			<div class="row">
				<div class="nav flex-column nav-pills nav-tabs-sticky col-sm-2" id="v-pills-tab" role="tablist" aria-orientation="vertical">
					<a class="nav-link active" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="true">Profil</a>
					<a class="nav-link" id="v-pills-order-tab" data-toggle="pill" href="#v-pills-order" role="tab" aria-controls="v-pills-order" aria-selected="false">Bestellungen</a>
				</div>
				<div class="tab-content col-sm-10" id="v-pills-tabContent">
					<div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
						<h1>Dein Profil</h1>
						<br>
						<p>Das ist dein Profil. Hier kannst du deine Daten einsehen und falls nötig bearbeiten. Über den Reiter links kannst du außerdem auf deine Bestellungen zugreifen und sehen was du bisher gekauft hast.</p>
						<br>
						<table class="table table-bordered">
							<tbody>
								<tr>
									<th scope="row">ID</th>
									<td class='align-middle'><?PHP echo  $_SESSION['id'] ?></td>
								</tr>
								<tr>
									<th scope="row">Name</th>
									<td class='align-middle'><?PHP echo  $_SESSION['vorname'] . " " .  $_SESSION['nachname']?></td>
								</tr>
								<tr>
									<th scope="row">E-Mail</th>
									<td class='align-middle'><?PHP echo $_SESSION['email']?></td>
								</tr>
								<tr>
									<th scope="row">Kontostand</th>
									<td class='align-middle'><?PHP echo $_SESSION['kontostand'] . "€"?></td>
								</tr>
							</tbody>
						</table>
						<button type='button' method='POST' benutzer_ID='".$_SESSION['id']."' data-href='' data-toggle='modal' data-target='#edit-profile' class='btn btn-success'>Bearbeiten <i class='fas fa-pencil-alt'></i></button>
					</div>
					<div class="tab-pane fade" id="v-pills-order" role="tabpanel" aria-labelledby="v-pills-order-tab">
						<h1>Deine Bestellungen</h1>
						<br>
						<p>Das sind deine Bestellungen. Hier kannst du deine Bestellungen ansehen und stornieren.
							 <strong>Bitte bedenke dass man seine Bestellungen nur bis zum Tag BEVOR das Tagesangebot gültig ist stornieren kann</strong></p>
						<br>
						<table class="table table-bordered">
							<thead>
								<th>Buchungsnummer</th>
								<th>Tagesangebot am:</th>
								<th>Speise:</th>
								<th>Allergene:</th>
								<th>Sonstiges:</th>
								<th>Preis:</th>
								<th>Buchungsdatum</th>
								<th class="filter-false" data-sorter="false">Stornieren</th>
							</thead>
							<tbody>
							<?php
								if ($result->num_rows > 0) {
								// creates the table to show the data
								while($row = $result->fetch_assoc()) {
									$dateFormat = strtotime($row['tagesangebotsdatum']); // formats the date to Day-Month-Year
									$buchungsdateFormat = strtotime($row['buchungsdatum']);
									echo  "<tr><td class='align-middle'><strong> ". $row['buchungsnummer'] . "</strong></td>";
									echo 	"<td class='align-middle'>".date('d.m.Y', $dateFormat)."</td>";
									echo	"<td class='align-middle'>".$row['name']."€</td>";
									echo	"<td class='align-middle'>".$row['allergene_inhaltsstoffe']."</td>";
									echo	"<td class='align-middle'>".$row['sonstiges']."</td>";
									echo	"<td class='align-middle'>".$row['preis']."€</td>";
									echo	"<td class='align-middle'>".date('d.m.Y', $buchungsdateFormat)."</td>";
                                    if ($row['tagesangebotsdatum'] > date('Y-m-d')) { // If the ordered meal is One day old then this button gets disabled
    									echo "<td class='align-middle'>
                                                <button type='button' method='POST'data-href='?stornieren?buchungsnummer=".$row['buchungsnummer']."' data-toggle='modal' data-target='#confirm-delete' name='stornieren' class='btn btn-danger'>
                                                    <i class='fas fa-trash'> </i>
                                                </button>
                                             </td>";
                                    } else { // Otherwise the user can cancle his order
    									echo "<td class='align-middle'>
                                                <button type='button' method='POST' class='btn btn-danger disabled'>
                                                    <i class='fas fa-trash'> </i>
                                                </button>
                                             </td>";
                                    }
                                    echo "</tr>";
									}
								} else {
									echo "<td>Sie haben noch keine Buchungen getätigt</td>";
								}
								$conn->close();
							?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<?php
			confModal("Wollen Sie diese Bestellung wirklich stornieren?");
			include 'footer.php';
		?>
		<script>
			$('.nav-tabs-sticky').stickyTabs();
		</script>
	</body>
</html>
