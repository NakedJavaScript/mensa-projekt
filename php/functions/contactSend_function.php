<?php
    if (isset($_POST['contactFormSubmit'])) {
        $_POST = sanitize_form($_POST);
        if ($_POST) {
            function sendMail($to, $from, $fromName, $subject, $body) {
                // PHP Mailer configuration for the contact form
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

            // Set the data you'll want to send in the mail
            $name = $_POST['Name'];
            $email = $_POST['Email'];
            $subject = $_POST['Betreff'] . " <Von " . $email . " >";
            $body = $_POST['Nachricht'];
            $to = 'foodmengroup@gmail.com';

            if (sendMail($to, $email, $name, $subject, $body)) {
                $Alert = successMessage('Vielen dank für Ihre E-Mail!');
                header('refresh: 1.5 ; url = kontakt.php');
            } else {
                $Alert = dangerMessage('Es tut uns leid aber irgendetwas ist schief gelaufen! Bitte versuchen Sie es erneut.');
                header('refresh: 1.5 ; url = kontakt.php');
                die();
            }
        } else {
            $Alert = dangerMessage('Fehler: Invalide Eingabe.');
            header('refresh: 1.5 ; url = kontakt.php');
        }
    }
?>
