<?php
    function getRevenue($timespan) {
        $endDate = new DateTime; // Datetime NOW
        echo $timespan;
        switch ($timespan) {
            case "days":
                $startDate = $endDate->modify('-1 week');
                $startDate = $startDate->format('Y-m-d H:i:s');
                $endDate = new DateTime;
                $endDate = $endDate->format('Y-m-d H:i:s');
                $sql = "SELECT * FROM mensa.buchungen WHERE (buchungsdatum BETWEEN $startDate AND $endDate)";
                //$timespan =
                echo $sql;
                break;
            case "weeks":
                $startDate = $endDate->modify('-1 month');
                $startDate = $startDate->format('Y-m-d H:i:s');
                $endDate = new DateTime;
                $endDate = $endDate->format('Y-m-d H:i:s');
                $sql = "SELECT * FROM mensa.buchungen WHERE (buchungsdatum BETWEEN $startDate AND $endDate)";
                //$timespan =
                echo $sql;
                break;
            case "months":
                $startDate = $endDate->modify('-1 year');
                $startDate = $startDate->format('Y-m-d H:i:s');
                $endDate = new DateTime;
                $endDate = $endDate->format('Y-m-d H:i:s');
                $sql = "SELECT * FROM mensa.buchungen WHERE (buchungsdatum BETWEEN $startDate AND $endDate)";
                //$timespan =
                echo $sql;
                break;
        }
    }
?>
