<?php include_once 'dependencies.php';
?>
<!DOCTYPE HTML>
<html>
    <head>
        <?php
            echo $head_dependencies;
        ?>
        <title>Passwort Zurücksetzen</title>
    </head>

    <body>
        <?php
            include 'header.php';
            include 'views/resetPassword.php';

            if ($data->num_rows > 0) {
                echo "<div class='container flat-form'>
                    <div id='reset' class='form-action'>
                        <h1>Neues Passwort setzen</h1>
                        <small>Geben Sie hier bitte Ihr neues Passwort ein.</small>
                        <form role='form' method='POST' class='resetPasswordForm'>
                            <ul>
                                <li>
                                    <input type='password' name='neuesPasswort' class='form-control' required/>
                                </li>
                                <li>
                                    <input type='submit' name='submitNewPassword' class='btn btn-success'>
                                </li>
                            </ul>
                        </form>
                    </div>
                 </div>";
            } else {
                $Alert = dangerMessage("Der aufgerufene Link ist abgelaufen oder falsch!");

                echo $Alert . " <div class='container' id='error-img-wrapper'><img src='../images/taco-error.png'></div>
                <script>setTimeout(function () {
                    window.location.href= 'index.php';
                },3000);</script>";
            }
        ?>
    </body>
<?php include 'footer.php'; ?>
</html>
