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
                echo "<form role='form' method='POST'>
                        <div class='form-group'>
                            <label for='neuesPasswort'>Neues Passwort</label><input type='password' name='neuesPasswort' class='form-control' required/> <br>
                            <input type='submit' name='submitNewPassword' class='btn btn-primary'>
                       </div>
                      </form>";

                if ( isset( $_POST['submitNewPassword'] ) ) {
                    $newPassword = $_POST['neuesPasswort'];
                    // Passwort wird gehashed
                    $hashedPassword = password_hash($newPassword . $pepper, PASSWORD_BCRYPT, $options);
                    // Passwort wird verändert, token wird wieder auf empty gesetzt
                    $conn->query("UPDATE benutzer SET passwort='$hashedPassword', token='' WHERE email='$email'");

                    header("Location: index.php");
                    exit();
                }
            } else {
                echo "Der aufgerufene Link ist abgelaufen oder falsch!";
            }

        } else {
            header("Location: index.php");
            exit();
        }

?>
</body>
<?php include 'footer.php'; ?>
</html>
