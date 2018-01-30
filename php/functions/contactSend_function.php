<?php

    if (isset($_POST['submit'])) {
        require '../phpmailer/PHPMailerAutoload.php';

        function sendMail($to, $from, $fromName, $body, $subject) {
            $mail = new PHPMailer();
            $mail ->setFrom($from, $fromName);
            $mail ->addAddress($to);
            $mail ->subject = $subject;
            $mail ->Body = $body;
            $mail ->isHTML(true);

            return $mail->send();

        }

        $name = $_POST['Name'];
        $email = $_POST['Email'];
        $subject = $_POST['Betreff'];
        $body = $_POST['Nachricht'];

        if (sendMail($to = 'foodmengroup@gmail.com', $email, $name, $subject, $body)) {
            $Alert = successMessage('Vielen dank für Ihre E-Mail!');
        } else {
            $Alert = successMessage('Es tut uns leid aber irgendetwas ist schief gelaufen! Bitte versuchen Sie es erneut.');
        }

    }

?>
