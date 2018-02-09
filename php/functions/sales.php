<?php


    function getSum($startDate, $endDate) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mensa";

        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql = "SELECT sum(preis) as bla
                FROM mensa.buchungen
                WHERE buchungsdatum >= '$startDate' AND  buchungsdatum <= '$endDate'";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            echo $row['bla'];
            $sum = $row['bla'];
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
                    $values = $values . getSum($startDate,$endDate) . $lineEnd;
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
                    $values = $values . getSum($startDate,$endDate) . $lineEnd;

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
                    $values = $values . getSum($startDate,$endDate) . $lineEnd;
                }
                break;
        }
        return $values;
    }
?>
