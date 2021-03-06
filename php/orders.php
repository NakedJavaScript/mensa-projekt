<?php include_once 'dependencies.php';?>

<!DOCTYPE HTML>
<html>
    <head>
        <?php
            echo $head_dependencies;
            $sql = "SELECT buchungsnummer, datum as tagesangebotsdatum, sp.name, sp.preis, sp.allergene_inhaltsstoffe, sp.sonstiges, buchungsdatum, schueler_ID
                FROM mensa.buchungen as b
                INNER JOIN mensa.tagesangebot as t ON b.tagesangebot_ID = t.tagesangebot_ID
                INNER JOIN mensa.speise sp ON t.speise_ID = sp.speise_ID";
            $result = $conn->query($sql);
        ?>
        <title>Bestellungen</title>
    </head>

    <body>
        <?php include 'header.php';
            if (((!isset($_SESSION['adminrechte'])) || $_SESSION['adminrechte'] != 2)) { // If an user isn't an admin, he can't see the site
                include'footer.php';
                die('Sie haben keinen Zugriff auf diese Seite. Bitte loggen Sie sich als ein Administrator ein.');
            }
        ?>
        <div class="container col-sm-10">
            <h1>Bestellungen</h1>
            <table class="tabelsorterTable table table-hover tablesorter">
                <thead>
                    <tr>
                        <th>Buchungsnummer <i class="fas fa-exchange-alt"></i></th>
                        <th>Tagesangebotsdatum <i class="fas fa-exchange-alt"></i></th>
                        <th>Vorname <i class="fas fa-exchange-alt"></i></th>
                        <th>Nachname <i class="fas fa-exchange-alt"></i></th>
                        <th>Speise <i class="fas fa-exchange-alt"></i></th>
                        <th>Preis <i class="fas fa-exchange-alt"></i></th>
                        <th class="filter-false" data-sorter="false">Essen abgeholt</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if ($result->num_rows > 0) {
                            // Echos the table rows with the data
                            while ($row = $result->fetch_assoc()) {
                                $sql = "SELECT vorname, nachname FROM mensa.benutzer WHERE benutzer_ID =". $row['schueler_ID']; // fetch the user of the order
                                $user = $conn->query($sql)->fetch_assoc();
                                $dateFormat = strtotime($row['tagesangebotsdatum']); // format the date to day-month-year
                                echo "<tr><td class='align-middle'><strong> ". $row['buchungsnummer'] . "</strong></td>";
                                echo "<td class='align-middle'>".date('d.m.Y', $dateFormat)."</td>";
                                echo "<td class='align-middle'>".$user['vorname']."</td>";
                                echo "<td class='align-middle'>".$user['nachname']."</td>";
                                echo "<td class='align-middle'>".$row['name']."</td>";
                                echo "<td class='align-middle'>".$row['preis']."€</td>";
                                echo "<td class='align-middle'><input class='form-check-input position-relative' type='checkbox'></td>"; // a checkbox only as a reminder for the staff
                                echo "</tr>";
                            }
                        } else {
                            echo "<td class='align-middle'>Es gibt noch keine Bestellungen</td>";
                        }
                        $conn->close();
                    ?>
                </tbody>
            </table>
            <!-- jQuery Tablesorter Pager -->
            <div id="pager" class="pager">
                <form>
                    <i class="fas fa-angle-double-left first"/></i>
                    <i class="fas fa-angle-left prev"/></i>
                    <span class="pagedisplay" data-pager-output-filtered="{startRow:input} &ndash; {endRow} / {filteredRows} of {totalRows} total rows"></span>
                    <i class="fas fa-angle-right next"/></i>
                    <i class="fas fa-angle-double-right last"/></i>
                    <select class="pagesize">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                        <option value="all">Alle Bestellungen</option>
                    </select>
                </form>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </body>
</html>
