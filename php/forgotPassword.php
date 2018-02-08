<?php include_once 'dependencies.php'; ?>
<!DOCTYPE HTML>
<html>
    <head>
        <?php
            echo $head_dependencies;
        ?>
        <title>Passwort vergessen?</title>
    </head>

    <body>
        <?php
            include 'header.php';
<<<<<<< HEAD
            include 'functions\forgotPW_function.php';
=======
>>>>>>> master
        ?>

        <div class="container flat-form">
            <div id="reset" class="form-action">
                <h1>Passwort zurücksetzen</h1>
                <small>Um Ihr Passwort zurückzusetzen geben Sie bitte Ihre E-Mail Adresse im untenstehenden Feld ein. Sofern Ihre Adresse in unserem System registriert ist, erhalten Sie eine E-Mail mit einem Link um ein neues Passwort zu setzen.</small>
<<<<<<< HEAD
                <form action="forgotPassword.php" method="post" class="forgotPasswordForm">
=======
                <form action="" method="post" class="mt-3">
>>>>>>> master
                    <ul>
                        <li>
                            <input type="email" name="email" placeholder="Ihre E-Mail" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$" required>
                        </li>
                        <li>
                            <input type="submit" class="btn btn-success" name="forgotPass" value="Passwort zurücksetzen">
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </body>
    <?php include 'footer.php'; ?>
</html>
