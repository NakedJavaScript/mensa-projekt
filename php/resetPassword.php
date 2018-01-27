<?php include_once 'dependencies.php';
?>
<!DOCTYPE HTML>
<html>
    <head>
        <?php
            echo $head_dependencies;
        ?>
        <title>Passwort Reset</title>
    </head>

    <body>
        <?php include 'header.php';

        if(isset($_GET["email"]) && isset($_GET["token"])) {
            $email = $conn->real_escape_string($_GET["email"]);
            $token = $conn->real_escape_string($_GET["token"]);
            $data = $conn->query("SELECT benutzer_ID FROM mensa.benutzer WHERE email='$email' AND token='$token'");

            if ($data->num_rows > 0) {
                $pepper = 'mensa_pfeffer';
                $options = array("cost"=>12);
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

                if ( isset( $_POST['submitNewPassword'] ) ) {
                    $newPassword = $_POST['neuesPasswort'];
                    // Passwort wird gehashed
                    $hashedPassword = password_hash($newPassword . $pepper, PASSWORD_BCRYPT, $options);
                    // Passwort wird verändert, token wird wieder auf empty gesetzt
                    $conn->query("UPDATE benutzer SET passwort='$hashedPassword', token='' WHERE email='$email'");

                    $Alert = 'Dein Passwort wurde erfolgreich geändert!';

                    echo "<div class='alert alert-success alert-dismissable fade show' style='width:500px;'>
                                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>".$Alert."</div>

                  <script>setTimeout(function () {
                     window.location.href= 'index.php';

                 },3000);</script>";
                }
            } else {
                $Alert = "Der aufgerufene Link ist abgelaufen oder falsch!";
                echo "<div class='alert alert-danger alert-dismissable fade show''>
              <a href='essensliste.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>".$Alert."</div>

              <script>setTimeout(function () {
                 window.location.href= 'index.php';

             },2000);</script>";
            }

        } else {
            header("Location: index.php");
            exit();
        }

?>
</body>
<?php include 'footer.php'; ?>
</html>
