<?php


    function getSum($startDate, $endDate) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mensa";

        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql = "SELECT tagesangebot_ID
                FROM mensa.buchungen
                WHERE buchungsdatum >= '$startDate' AND  buchungsdatum <= '$endDate'";
        $result = $conn->query($sql);
        $sum = 0.0;
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $daymealID = $row['tagesangebot_ID'];
                $sql = "SELECT speise_ID
                        FROM mensa.tagesangebot
                        WHERE tagesangebot_ID = '$daymealID'
                        LIMIT 1";
                $chicken = $conn->query($sql);
                while($row = $chicken->fetch_assoc()) {
                    $mealID = $row['speise_ID'];
                    $shit = "SELECT preis FROM mensa.speise WHERE speise_ID = '$mealID'";
                    $price = $conn->query($shit)->fetch_assoc();
                    $sum = $sum + $price['preis'];
                }
            }
        }
        return $sum;
    }

    function getRevenue($timespan) {
        switch ($timespan) {
            case "days":
                $values ="";
                for ($i = 0; $i <= 7; $i++) {
                    $endDate = new DateTime;
                    $startDate = $endDate->modify('-'. 7-$i.' day');
                    $startDate = $startDate->format('Y-m-d H:i:s');
                    $endDate = new DateTime;
                    $endDate = $endDate->format('Y-m-d H:i:s');
                    if ($i < 7) {
                        $lineEnd = ",";
                    } else {
                        $lineEnd = "";
                    }
                    $values = $values . getSum($startDate,$endDate)['sum'] . $lineEnd;
                }
                break;
            case "weeks":
                $values ="";
                for ($i = 0; $i <= 4; $i++) {
                    $endDate = new DateTime;
                    $startDate = $endDate->modify('-'. 4-$i.' week');
                    $startDate = $startDate->format('Y-m-d H:i:s');
                    $endDate = new DateTime;
                    $endDate = $endDate->format('Y-m-d H:i:s');
                    if ($i < 4) {
                        $lineEnd = ",";
                    } else {
                        $lineEnd = "";
                    }
                    $values = $values . getSum($startDate,$endDate)['sum'] . $lineEnd;

                }
                break;
            case "months":
                $values ="";
                for ($i = 0; $i <= 12; $i++) {
                    $endDate = new DateTime;
                    $startDate = $endDate->modify('-'. 12-$i.' month');
                    $startDate = $startDate->format('Y-m-d H:i:s');
                    $endDate = new DateTime;
                    $endDate = $endDate->format('Y-m-d H:i:s');
                    if ($i < 12) {
                        $lineEnd = ",";
                    } else {
                        $lineEnd = "";
                    }
                    $values = $values . getSum($startDate,$endDate)['sum'] . $lineEnd;
                }
                break;
        }
        return $values;
    }
?>
