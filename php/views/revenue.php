<?php


    function getSum($startDate, $endDate) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mensa";
        $sum = 0.0;
        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql = "SELECT sum(preis) as price
                FROM mensa.buchungen
                WHERE buchungsdatum >= '$startDate' AND  buchungsdatum <= '$endDate'";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            if ($row['price']) {
                $sum = $row['price'];
            }
        }
        return $sum;
    }

    function getRevenue($timespan) {
        switch ($timespan) {
            case "days":
                $values ="";
                for ($i = 6; $i != -1; $i--) {
                    $endDate = new DateTime;
                    $startDate = new DateTime;
                    $startDate = $startDate->modify('-'. $i .' day');
                    $startDate = $startDate->format('Y-m-d H:i:s');
                    $endDate = $endDate->modify('-'. $i-1 .' day');
                    $endDate = $endDate->format('Y-m-d H:i:s');
                    if ($i > 0) {
                        $lineEnd = ",";
                    } else {
                        $lineEnd = "";
                    }
                    $values = $values . getSum($endDate, $startDate) . $lineEnd;
                }
                break;
            case "weeks":
                $values ="";
                for ($i = 3; $i != -1; $i--) {
                    $endDate = new DateTime;
                    $startDate = new DateTime;
                    $startDate = $startDate->modify('-'. $i .' week');
                    $startDate = $startDate->format('Y-m-d H:i:s');
                    $endDate = $endDate->modify('-'. $i-1 .' week');
                    $endDate = $endDate->format('Y-m-d H:i:s');
                    if ($i > 0) {
                        $lineEnd = ",";
                    } else {
                        $lineEnd = "";
                    }
                    $values = $values . getSum($endDate, $startDate)  . $lineEnd;

                }
                break;
            case "months":
                $values ="";
                for ($i = 11; $i != -1; $i--) {
                    $endDate = new DateTime;
                    $startDate = new DateTime;
                    $startDate = $startDate->modify('-'. $i .' month');
                    $startDate = $startDate->format('Y-m-d H:i:s');
                    $endDate = $endDate->modify('-'. $i-1 .' month');
                    $endDate = $endDate->format('Y-m-d H:i:s');
                    if ($i > 0) {
                        $lineEnd = ",";
                    } else {
                        $lineEnd = "";
                    }
                    $values = $values . getSum($endDate, $startDate)  . $lineEnd;
                }
                break;
        }
        return $values;
    }
?>
