<?php 
	include 'dependencies.php'
    # Ist die $_POST Variable submit nicht leer ??? 
    # dann wurden Logindaten eingegeben, die müssen wir überprüfen ! 
    if (!empty($_POST["submit"])) 
        { 
        # Die Werte die im Loginformular eingegeben wurden "escapen", 
        # damit keine Hackangriffe über den Login erfolgen können ! 
        # Mysql_real... ist auf jedenfall dem Befehle addslashes() 
        # vorzuziehen !!! Ohne sind mysql injections möglich !!!! 
        $_email = mysql_real_escape_string($_POST["email"]); 
        $_passwort = mysql_real_escape_string($_POST["passwort"]); 

        # Befehl für die MySQL Datenbank 
        # Wichtig ist, die Variablen von $_username und $_passwort 
        # zu umklammern. Da wir mit Anführungszeichen den SQL String 
        # angeben, nehmen wir dafür die einfachen Anführungszeichen 
        # die man neben der Enter Taste auf der # findet ! 
        $_sql = "SELECT * FROM benutzer WHERE 
                    email='$_username' AND 
                    passwort='$_passwort'"; 

        # Prüfen, ob der User in der Datenbank existiert ! 
        $_res = mysql_query($_sql, $conn); 
        $_anzahl = @mysql_num_rows($_res); 

        # Die Anzahl der gefundenen Einträge überprüfen. Maximal 
        # wird 1 Eintrag rausgefiltert (LIMIT 1). Wenn 0 Einträge 
        # gefunden wurden, dann gibt es keinen Usereintrag, der 
        # gültig ist. Keinen wo der Username und das Passwort stimmt 
        # und user_geloescht auch gleich 0 ist ! 
        if ($_anzahl > 0) 
            { 
            echo "Der Login war erfolgreich.<br>"; 

            # In der Session merken, dass der User eingeloggt ist ! 
            $_SESSION["login"] = 1; 

            # Den Eintrag vom User in der Session speichern ! 
            $_SESSION["user"] = mysql_fetch_array($_res, MYSQL_ASSOC);  
            } 
        else 
            { 
            echo "Die Logindaten sind nicht korrekt.<br>"; 
            } 
        } 
?>