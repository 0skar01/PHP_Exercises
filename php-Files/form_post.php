<?php
/*
genutzte Funktionen der PHP-Fkt-Bibl.:

intval(variabler typ)       -> wandelt einen Wert in einen Integer-Wert um
isset(variable|array[key])  -> prüft das Vorhandensein einer Variablen
key_exists(key, array)      -> prüft ob ein Schlüssel in einem Array vorhanden ist und gibt true|false zurück
preg_match(patter, str)     -> prüft anhand eines Regulären Ausdrucks den Aufbau einer Zeichenkette und gibt true|false zurück
rand()                      -> erzeugt einen zufälligen Int-Wert
session_start()             -> startet eine neue Sitzung und erzeugt auf dem Server und auf dem Client ein Session-Cookie
strlen(string_var)          -> gibt die Länge einer Zeichenkette als Int zurück
*/
session_start();
echo "<pre>Inhalt von POST:\n";
// da das form mit der Methode POST gesendet wird, werden die übermittelten Daten durch PHP in die globale Variable POST aufgenommen und können über diese verarbeitet werden
var_dump($_POST);
var_dump($_SESSION);
if(!isset($_SESSION['randomform'])) {
    $_SESSION['randomform'] = rand();
}
echo session_id();
$_SESSION['post'] = $_POST;
var_dump($_SESSION);
echo "</pre>";

// variablen
$error = 0;
$firstname = "";
$surname = "";
$age = null;
// prüfen ob POST überhaupt inhalte besitzt
if( isset($_POST['submit']) && ( isset($_POST['randomform']) && $_POST['randomform'] == $_SESSION['randomform'] ) ) {
// if( count($_POST) [ > 0 ] ) {         // Alternative zur zur Prüfung auf die Menge der Übermittelten Daten
    echo "POST besitzt Inhalte";
    /*
    zuerst muss die Existenz den Keys in einem Array geprüft werden, bevor der Wert des Keys angesprochen wird
    wird dies nicht in dieser Reihenfolge durchgeführt, dann führt der Zugriff auf einen nicht vorhanden Key zu einem Fehler

    */
    if( isset($_POST['firstname']) && strlen($_POST['firstname']) >= 2 && preg_match('/^[A-ZÖÄÜ][a-zöäüß]{1,}$/', $_POST['firstname']) ) {        
        $firstname = $_POST['firstname'];
    } else {
        if(isset($_POST['firstname']))$firstname = $_POST['firstname'];
        $error |= pow(2, 0);    // 2^0 = 1 = 0001
    }
    if( key_exists('surname',$_POST) && preg_match('/^[A-ZÖÄÜ][a-zöäüß]{1,}$/', $_POST['surname']) ) {
        $surname = $_POST['surname'];
    } else {
        if(isset($_POST['surname']))$surname = $_POST['surname'];
        $error |= pow(2, 1);    // 2^1 = 2 = 0010
    }
    if( key_exists('age',$_POST) && preg_match('/^\d{1,3}$/', $_POST['age']) ) {
        $age = intval($_POST['age']);
    } else {
        if(isset($_POST['age']))$age = $_POST['age'];
        $error |= pow(2, 2);    // 2^2 = 4 = 0100
    }
    // wenn keine Fehler aufgetreten sind, dann besitzt $error den Wert 0 -> false
    if(!$error) {
        $_SESSION['randomform'] = rand();
        echo "Alle Eingaben sind korrekt";
        // mache irgendetwas mit den Daten ... z. B. Daten in einer DB speichern
    } else {
        echo decbin($error);
        echo "0x" . dechex($error); // MS-Style        
    }
} elseif ( isset($_POST['randomform']) && $_POST['randomform'] != $_SESSION['randomform'] ) {
    echo 'Das Formular wurde schon einmal gesendet';
} else {
    echo "POST besitzt keine Inhalte";
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formularverarbeitung per POST</title>
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
    <h1>Daten per POST senden</h1>
    <p>Die Datenübertragung per POST sollte nach Möglichkeit nicht erfolgen, wenn dann nur für nicht sensible Daten. Die betrifft bspw. die zusätzlichen Parameter, die an URL innerhalb von dem href-Attribut eines Anker-Tags angefügt werden um auf bestimmte Seiten zu navigieren. Bei Formularen selbst sollte anstatt POST prinzipiell POST verwendet werden.</p>
    <?php
    if($error || !isset($_POST['submit'])) {        
        if($error)echo '<p class="error">Fehler 0x'. dechex($error) .'. Sie haben in dem Formular fehlerhafte Angaben vorgenommen. Bitte korrigieren Sie diese und senden Sie das Formular erneut.</p>';
        ?>
        <form action="#" method="POST">
            <input type="hidden" name="randomform" value="<?=$_SESSION['randomform']??''?>">
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
//    } elseif(!$error && isset($_POST['submit'])) {
    } else {
        echo '<p class="success">Vielen Dank für Ihre persönlichen Daten.</p>';
    }
    ?>
</body>
</html>