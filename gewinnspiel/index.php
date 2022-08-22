<?php
session_start();
include_once("errorMs.inc.php");

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Übung Kapitel 8</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <h1>Umfrage am Gewinnspiel</h1>
    <p>Wir freuen uns, dass Sie an unserer kleinen Umfrage zu unserer Webseite teilnehmen! Unter allen Teilnehmern verlosen wir drei Präsentkörbe.</p>
    <?php
    if(isset($_SESSION['umfrage']) && isset($_SESSION['umfrage']['error']) && $_SESSION['umfrage']['error'] != 0){
        $error = $_SESSION['umfrage']['error'];
        echo '<fieldset>Fehler: <br>'.
            ($error & 0b1 ? $errors['1'].'<br>':'').
            ($error & 0b10 ? $errors['2'].'<br>':'').
            ($error & 0b100 ? $errors['3'].'<br>':'').
            ($error & 0b1000 ? $errors['4'].'<br>':'').
            ($error & 0b10000 ? $errors['4'].'<br>':'').
            ($error & 0b100000 ? $errors['4'].'<br>':'').
            ($error & 0b1000000 ? $errors['5'].'<br>':'').
            ($error & 0b10000000 ? $errors['6'].'<br>':'').
        '</fieldset>';

    }elseif(isset($_SESSION['umfrage']) && isset($_SESSION['umfrage']['error']) && $_SESSION['umfrage']['error'] == 0){
        echo '<div> Umfrage wurde erfolgreich gesendet </div>';
        $_SESSION = '';
    }
    ?>
    <form action="umfrage.php" method="post">
        <fieldset>
            <label for="name">
                <span>Vorname und Nachname</span>
                <input type="text" name="name" id="name" value="<?= isset($_SESSION['umfrage']) ? ($error & 0b1 ? '':$_SESSION['umfrage']['name']) : ''?>">
            </label>
            <label for="street">
                <span>Straße</span>
                <input type="text" name="street" id="street" value="<?=isset($_SESSION['umfrage']) ? ($error & 0b10 ? '':$_SESSION['umfrage']['street']) : ''?>">
            </label>
            <label for="zipcity">
                <span>PLZ und Ort</span>
                <input type="text" name="zipcity" id="zipcity" value="<?=isset($_SESSION['umfrage']) ? ($error & 0b100 ? '':$_SESSION['umfrage']['zipcity']) : ''?>">
            </label>
        </fieldset>
        <fieldset>
            <p>Wie gefällt Ihnen unser Internetangebot?</p>
            <label for="internet_1">
                <input type="radio" name="internet" id="internet_1" value="1" <?=isset($_SESSION['umfrage']) ? ($_SESSION['umfrage']['internet'] == 1 ? 'checked':''):''?>>
                <span>sehr gut</span>
            </label>
            <label for="internet_2">
                <input type="radio" name="internet" id="internet_2" value="2" <?=isset($_SESSION['umfrage']) ? ($_SESSION['umfrage']['internet'] == 2 ? 'checked':''):''?>>
                <span>gut</span>
            </label>
            <label for="internet_3">
                <input type="radio" name="internet" id="internet_3" value="3" <?=isset($_SESSION['umfrage']) ? ($_SESSION['umfrage']['internet'] == 3 ? 'checked':''):''?>>
                <span>nicht so gut</span>
            </label>
            <label for="internet_4">
                <input type="radio" name="internet" id="internet_4" value="4" <?=isset($_SESSION['umfrage']) ? ($_SESSION['umfrage']['internet'] == 4 ? 'checked':''):''?>>
                <span>gar nicht</span>
            </label>
        </fieldset>
        <fieldset>
            <p>Wie beurteilen Sie den Informationsgehalt unserer Webseite?</p>
            <label for="info_1">
                <input type="radio" name="info" id="info_1" value="1" <?=isset($_SESSION['umfrage']) ? ($_SESSION['umfrage']['info'] == 1 ? 'checked':''):''?>>
                <span>sehr gut</span>
            </label>
            <label for="info_2">
                <input type="radio" name="info" id="info_2" value="2" <?=isset($_SESSION['umfrage']) ? ($_SESSION['umfrage']['info'] == 2 ? 'checked':''):''?>>
                <span>gut</span>
            </label>
            <label for="info_3">
                <input type="radio" name="info" id="info_3" value="3" <?=isset($_SESSION['umfrage']) ? ($_SESSION['umfrage']['info'] == 3 ? 'checked':''):''?>>
                <span>nicht so gut</span>
            </label>
        </fieldset>
        <fieldset>
            <p>Wie kommen Sie mit dem Bestellsystem zurecht?</p>
            <label for="order_1">
                <input type="radio" name="order" id="order_1" value="1" <?=isset($_SESSION['umfrage']) ? ($_SESSION['umfrage']['order'] == 1 ? 'checked':''):''?>>
                <span>sehr gut</span>
            </label>
            <label for="order_2">
                <input type="radio" name="order" id="order_2" value="2" <?=isset($_SESSION['umfrage']) ? ($_SESSION['umfrage']['order'] == 2 ? 'checked':''):''?>>
                <span>gut</span>
            </label>
            <label for="order_3">
                <input type="radio" name="order" id="order_3" value="3" <?=isset($_SESSION['umfrage']) ? ($_SESSION['umfrage']['order'] == 3 ? 'checked':''):''?>>
                <span>nicht so besonders gut</span>
            </label>
            <label for="order_4">
                <input type="radio" name="order" id="order_4" value="4" <?=isset($_SESSION['umfrage']) ? ($_SESSION['umfrage']['order'] == 4 ? 'checked':''):''?>>
                <span>gar nicht</span>
            </label>
        </fieldset>
        <fieldset>
            <label for="other">
                <span>Möchten Sie uns noch etwas mitteilen?</span>
                <textarea name="other" id="other" ><?=isset($_SESSION['umfrage']) ? ($error & 0b1000000 ? '': $_SESSION['umfrage']['other']) : ''?></textarea>
            </label>
        </fieldset>
        <fieldset>
            <label for="lawcheck">
                <input type="checkbox" name="lawcheck" id="lawcheck" value="1" required>
                <span>Mit der Teilnahme am Gewinnspiel akzeptiere ich die Teilnahmebedingungen</span>
            </label>
            <button type="submit" name="submit">Jetzt am Gewinnspiel teilnehmen!</button>
        </fieldset>
    </form>    
</body>
</html>