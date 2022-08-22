<?php
echo "<pre>Inhalt von GET:\n";
// da das form mit der Methode GET gesendet wird, werden die übermittelten Daten durch PHP in die globale Variable GET aufgenommen und können über diese verarbeitet werden
var_dump($_GET);
echo "</pre>";

// variablen
$error = 0;
$firstname = "";
$surname = "";
$age = null;
// prüfen ob get überhaupt inhalte besitzt
if( isset($_GET['submit']) ) {
// if( count($_GET) [ > 0 ] ) {         // Alternative zur zur Prüfung auf die Menge der Übermittelten Daten
    echo "GET besitzt Inhalte";
    /*
    zuerst muss die Existenz den Keys in einem Array geprüft werden, bevor der Wert des Keys angesprochen wird
    wird dies nicht in dieser Reihenfolge durchgeführt, dann führt der Zugriff auf einen nicht vorhanden Key zu einem Fehler

    genutzte Funktionen der PHP-Fkt-Bibl.:

    isset(variable|array[key])  -> prüft das Vorhandensein einer Variablen
    strlen(string_var)          -> gibt die Länge einer Zeichenkette als Int zurück
    preg_match(patter, str)     -> prüft anhand eines Regulären Ausdrucks den Aufbau einer Zeichenkette und gibt true|false zurück
    key_exists(key, array)      -> prüft ob ein Schlüssel in einem Array vorhanden ist und gibt true|false zurück
    intval(variabler typ)       -> wandelt einen Wert in einen Integer-Wert um
    */
    if( isset($_GET['firstname']) && strlen($_GET['firstname']) >= 2 && preg_match('/^[A-ZÖÄÜ][a-zöäüß]{1,}$/', $_GET['firstname']) ) {        
        $firstname = $_GET['firstname'];
    } else {
        if(isset($_GET['firstname']))$firstname = $_GET['firstname'];
        $error |= pow(2, 0);    // 2^0 = 1 = 0001
    }
    if( key_exists('surname',$_GET) && preg_match('/^[A-ZÖÄÜ][a-zöäüß]{1,}$/', $_GET['surname']) ) {
        $surname = $_GET['surname'];
    } else {
        if(isset($_GET['surname']))$surname = $_GET['surname'];
        $error |= pow(2, 1);    // 2^1 = 2 = 0010
    }
    if( key_exists('age',$_GET) && preg_match('/^\d{1,3}$/', $_GET['age']) ) {
        $age = intval($_GET['age']);
    } else {
        if(isset($_GET['age']))$age = $_GET['age'];
        $error |= pow(2, 2);    // 2^2 = 4 = 0100
    }
    // wenn keine Fehler aufgetreten sind, dann besitzt $error den Wert 0 -> false
    if(!$error) {
        echo "Alle Eingaben sind korrekt";
        // mache irgendetwas mit den Daten ... z. B. Daten in einer DB speichern
    } else {
        echo decbin($error);
        echo "0x" . dechex($error); // MS-Style
    }

} else {
    echo "GET besitzt keine Inhalte";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formularverarbeitung per GET</title>
    <style>
        * {
            font-size:14pt;
        }
        label {
            clear: both;
            display: block;
            float: left;
            padding-bottom: .5rem;
            width: 100%;
        }
        label > span {
            display: inline-block;
            width: 7rem;
        }
        label.error > input {
            border-color: #f00;
        }
        p.error, label.error > span {
            color: #f00;
        }
        p.success {
            color: #0f0;
        }
    </style>
</head>
<body>
    <h1>Daten per GET senden</h1>
    <p>Die Datenübertragung per GET sollte nach Möglichkeit nicht erfolgen, wenn dann nur für nicht sensible Daten. Die betrifft bspw. die zusätzlichen Parameter, die an URL innerhalb von dem href-Attribut eines Anker-Tags angefügt werden um auf bestimmte Seiten zu navigieren. Bei Formularen selbst sollte anstatt GET prinzipiell POST verwendet werden.</p>
    <?php
    if($error || !isset($_GET['submit'])) {        
        if($error)echo '<p class="error">Fehler 0x'. dechex($error) .'. Sie haben in dem Formular fehlerhafte Angaben vorgenommen. Bitte korrigieren Sie diese und senden Sie das Formular erneut.</p>';
        ?>
        <form action="#" method="GET">
            <fieldset>
                <legend>Ihre Eingaben</legend>
                <label for="firstname"<?php echo $error & 0b1 ?'class="error"':'';?>><span>Ihr Vorname</span><input type="text" name="firstname" id="firstname" value="<?=$firstname?>"></label>
                <label for="surname"<?php echo $error & 0b10 ?'class="error"':'';?>><span>Ihr Nachname</span><input type="text" name="surname" id="surname" value="<?=$surname?>"></label>
                <label for="age"<?php echo $error & 0b100 ?'class="error"':'';?>><span>Ihr Alter</span><input type="number" name="age" id="age" min="0" max="140" step="1" value="<?=$age?>"></label>
            </fieldset>
            <fieldset>
                <button type="reset">Eingaben löschen</button>
                <button type="submit" name="submit">Jetzt senden</button>
            </fieldset>
        </form>
        <?php
    } elseif(!$error && isset($_GET['submit'])) {
        echo '<p class="success">Vielen Dank für Ihre persönlichen Daten.</p>';
    }
    ?>
</body>
</html>