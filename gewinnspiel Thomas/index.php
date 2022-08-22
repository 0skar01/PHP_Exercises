<?php
session_start();
require_once('errormsg.inc.php');
const DEBUG=true;
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
    $error=0;
    if(array_key_exists('errordata', $_SESSION) && array_key_exists('error', $_SESSION['errordata'])) {
        $error=$_SESSION['errordata']['error'];
        echo '<div class="error"><h4>Fehler</h4><p>Sie haben bei dem Senden der Umfrage fehlerhafte Angaben vorgenommen. Bitte korrigieren Sie diese und senden Sie die Umfrage erneut. Vielen Dank und viel Glück!</p><ul>';
        for($i=0;$i<strlen(decbin($error));$i++){
            if(pow(2,$i)&$error){
                echo '<li>' . $errormsg['raffle'][$i]. '</li>';
            }
        }
        echo '</ul></div>';
    }elseif(array_key_exists('success', $_SESSION)&&$_SESSION['success']){
        unset($_SESSION['success']);
        echo '<div class="success"><h4>Erfolg!</h4><p>Sie haben Sie haben erfolgreich Ihre Daten zur Teilnahme am Gewinnspiel eingesandt. Wir wünschen Ihnen viel Glück bei der Ziehung der Lose!</p></div>';
    }
    ?>
    <form action="umfrage.php" method="post">
        <fieldset>
            <label for="name"<?=$error&0b10?' class="error"':''?>>
                <span>Vorname und Nachname</span>   
                <input type="text" name="name" id="name"<?=$error&&$error^0b10?' value=" ' . $_SESSION['errordata']['name'].'"':''?>>
            </label>
            <label for="street"<?=$error&0b100?' class="error"':''?>>
                <span>Straße</span>
                <input type="text" name="street" id="street"<?=$error&&$error^0b100?' value="'.$_SESSION['errordata']['street'].'"':''?>>
            </label>
            <label for="zipcity"<?=$error&0b1000?' class="error"':''?>>
                <span>PLZ und Ort</span>
                <input type="text" name="zipcity" id="zipcity"<?=$error&&$error^0b1000?' value="'.$_SESSION['errordata']['zipcity'].'"':''?>>
            </label>
        </fieldset>
        <fieldset>
            <p>Wie gefällt Ihnen unser Internetangebot?</p>
            <label for="internet_1"<?=$error&0b10000?' class="error"':''?>>
                <input type="radio" name="internet" id="internet_1" value="1"<?=$error&&$error^0b10000&&$_SESSION['errordata']['internet']==1?' checked':''?>>
                <span>sehr gut</span>
            </label>
            <label for="internet_2"<?=$error&0b10000?' class="error"':''?>>
                <input type="radio" name="internet" id="internet_2" value="2"<?=$error&&$error^0b10000&&$_SESSION['errordata']['internet']==2?' checked':''?>>
                <span>gut</span>
            </label>
            <label for="internet_3"<?=$error&0b10000?' class="error"':''?>>
                <input type="radio" name="internet" id="internet_3" value="3"<?=$error&&$error^0b10000&&$_SESSION['errordata']['internet']==3?' checked':''?>>
                <span>nicht so gut</span>
            </label>
            <label for="internet_4"<?=$error&0b10000?' class="error"':''?>>
                <input type="radio" name="internet" id="internet_4" value="4"<?=$error&&$error^0b10000&&$_SESSION['errordata']['internet']==4?' checked':''?>>
                <span>gar nicht</span>
            </label>
        </fieldset>
        <fieldset>
            <p>Wie beurteilen Sie den Informationsgehalt unserer Webseite?</p>
            <label for="info_1"<?=$error&0b100000?' class="error"':''?>>
                <input type="radio" name="info" id="info_1" value="1"<?=$error&&$error^0b100000&&$_SESSION['errordata']['info']==1?' checked':''?>>
                <span>sehr gut</span>
            </label>
            <label for="info_2"<?=$error&0b100000?' class="error"':''?>>
                <input type="radio" name="info" id="info_2" value="2"<?=$error&&$error^0b100000&&$_SESSION['errordata']['info']==2?' checked':''?>>
                <span>gut</span>
            </label>
            <label for="info_3"<?=$error&0b100000?' class="error"':''?>>
                <input type="radio" name="info" id="info_3" value="3"<?=$error&&$error^0b100000&&$_SESSION['errordata']['info']==3?' checked':''?>>
                <span>nicht so gut</span>
            </label>
        </fieldset>
        <fieldset>
            <p>Wie kommen Sie mit dem Bestellsystem zurecht?</p>
            <label for="order_1"<?=$error&0b1000000?' class="error"':''?>>
                <input type="radio" name="order" id="order_1" value="1"<?=$error&&$error^0b1000000&&$_SESSION['errordata']['order']==1?' checked':''?>>
                <span>sehr gut</span>
            </label>
            <label for="order_2"<?=$error&0b1000000?' class="error"':''?>>
                <input type="radio" name="order" id="order_2" value="2"<?=$error&&$error^0b1000000&&$_SESSION['errordata']['order']==2?' checked':''?>>
                <span>gut</span>
            </label>
            <label for="order_3"<?=$error&0b1000000?' class="error"':''?>>
                <input type="radio" name="order" id="order_3" value="3"<?=$error&&$error^0b1000000&&$_SESSION['errordata']['order']==3?' checked':''?>>
                <span>nicht so besonders gut</span>
            </label>
            <label for="order_4"<?=$error&0b1000000?' class="error"':''?>>
                <input type="radio" name="order" id="order_4" value="4"<?=$error&&$error^0b1000000&&$_SESSION['errordata']['order']==4?' checked':''?>>
                <span>gar nicht</span>
            </label>
        </fieldset>
        <fieldset>
            <label for="other">
                <span>Möchten Sie uns noch etwas mitteilen?</span>
                <textarea name="other" id="other"><?=$error&&$error?$_SESSION['errordata']['other']:''?></textarea>
            </label>
        </fieldset>
        <fieldset>
            <label for="lawcheck"<?=$error&0b1?' class="error"':''?>>
                <input type="checkbox" name="lawcheck" id="lawcheck" value="1" required>
                <span>Mit der Teilnahme am Gewinnspiel akzeptiere ich die Teilnahmebedingungen</span>
            </label>
            <button type="submit" name="submit">Jetzt am Gewinnspiel teilnehmen!</button>
        </fieldset>
    </form>
    <?php
    if(DEBUG){
        echo '<div class="debug"><div>Infokonsole</div><pre>';
        echo '<h2>SESSION</h2>';
        var_dump($_SESSION);
        echo '<h2>POST</h2>';
        var_dump($_POST);
        echo '<h2>GET</h2>';
        var_dump($_GET);
        echo '<h2>SERVER</h2>';
        var_dump($_SERVER);
        echo '</pre></div>';
    }
    ?>
</body>
</html>