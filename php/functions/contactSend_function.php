<?php
    if (isset($_POST['contactFormSubmit'])) {
        function sendMail($to, $from, $fromName, $subject, $body) {
            // PHP Mailer Konfiguration für das Kontaktformular
            $ContactMail = new PHPMailer();
            $ContactMail->Host = "smtp.gmail.com";
            $ContactMail->isSMTP();
            $ContactMail->SMTPAuth = true;
            $ContactMail->SMTPSecure = "ssl";
            $ContactMail->Port = 465;
            $ContactMail->Username = "foodmengroup@gmail.com";
            $ContactMail->Password = "!tsSchuleF00Dmengrp";
            $ContactMail ->setFrom($from, $fromName);
            $ContactMail ->addAddress($to);
            $ContactMail ->Subject = $subject;
            $ContactMail ->Body = $body;
            $ContactMail ->isHTML(true);

            return $ContactMail->send();
        }

        $name = $_POST['Name'];
        $email = $_POST['Email'];
        $subject = $_POST['Betreff'] . " <Von " . $email . " >";
        $body = $_POST['Nachricht'];
        $to = 'foodmengroup@gmail.com';

        if (sendMail($to, $email, $name, $subject, $body)) {
            $Alert = successMessage('Vielen dank für Ihre E-Mail!');
            header('refresh: 1.5 ; url = kontakt.php');
            die();
        } else {
            $Alert = dangerMessage('Es tut uns leid aber irgendetwas ist schief gelaufen! Bitte versuchen Sie es erneut.');
            header('refresh: 1.5 ; url = kontakt.php');
            die();
        }
    }
?>
