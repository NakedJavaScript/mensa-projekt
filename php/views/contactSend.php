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

        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'] . " <Von " . $email . " >";
        $body = $_POST['message'];
        $to = 'foodmengroup@gmail.com';

        if (sendMail($to, $email, $name, $subject, $body)) {
            $alert = successMessage('Vielen dank für Ihre E-Mail!');
            header('refresh: 1.5 ; url = kontakt.php');
            die();
        } else {
            $alert = dangerMessage('Es tut uns leid aber irgendetwas ist schief gelaufen! Bitte versuchen Sie es erneut.');
            header('refresh: 1.5 ; url = kontakt.php');
            die();
        }
    }
?>
