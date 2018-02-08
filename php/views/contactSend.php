<?php
    if (isset($_POST['contactFormSubmit'])) {
        function sendMail($to, $from, $fromName, $subject, $body) {
            // PHP Mailer Konfiguration für das Kontaktformular
            $contactMail = new PHPMailer();
            $contactMail->Host = "smtp.gmail.com";
            $contactMail->isSMTP();
            $contactMail->SMTPAuth = true;
            $contactMail->SMTPSecure = "ssl";
            $contactMail->Port = 465;
            $contactMail->Username = "foodmengroup@gmail.com";
            $contactMail->Password = "!tsSchuleF00Dmengrp";
            $contactMail ->setFrom($from, $fromName);
            $contactMail ->addAddress($to);
            $contactMail ->Subject = $subject;
            $contactMail ->Body = $body;
            $contactMail ->isHTML(true);

            return $contactMail->send();

        }

        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'] . " <Von " . $email . " >";
        $body = $_POST['message'];
        $to = 'foodmengroup@gmail.com';

        if (sendMail($to, $email, $name, $subject, $body)) {
            $alert = successMessage('Vielen dank für Ihre E-Mail!');
            header('refresh: 1.5 ; url = contact.php');
        } else {
            $alert = dangerMessage('Es tut uns leid aber irgendetwas ist schief gelaufen! Bitte versuchen Sie es erneut.');
            header('refresh: 1.5 ; url = contact.php');
        }
    }
?>
