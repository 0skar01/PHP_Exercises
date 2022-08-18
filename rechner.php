<?php
/*
Funktioinen aus der PHP-Bibl.:

floatval(wert)                  -> wandelt eine wert in eine
str_replace()                   -> Buch S. 168
*/
session_start();    // für die speicherung der rechenoperationen erforderlich
// erforderliche variablen
var_dump($_POST);
$z1 = 0;
$z2 = 0;
$co = 0;
$result = 0;
$error = 0;
$load = false;
$operations = array(
    array(
        'symbol'    => '+',
        'label'     => 'Addition',
        'template'  => '%s + %s = %s'
    ),
    array(
        'symbol'    => '-',
        'label'     => 'Subtraktion',
        'template'  => '%s - %s = %s'
    ),
    array(
        'symbol'    => '*',
        'label'     => 'Multiplikation',
        'template'  => '%s * %s = %s'
    ),
    array(
        'symbol'    => '/',
        'label'     => 'Division',
        'template'  => '%s / %s = %s'
    ),
    array(
        'symbol'    => '^',
        'label'     => 'Potenzierung',
        'template'  => '%s<sup>%s</sup> = %s'
    ),
    array(
        'symbol'    => 'mod',
        'label'     => 'Modulo',
        'template'  => '%s mod %s = %s'
    ),
);
$errors = array(
    "Zahl 1 entspricht nicht dem korrekten Zahlenformat",
    "Zahl 2 entspricht nicht dem korrekten Zahlenformat",
    "Division durch 0 ist nicht möglich",
    "Es wurde kein Rechenoperator ausgewählt"
);
// wurde das form gesendet?
if (isset($_POST['submit'])) {
    // prüfung der validierung der daten
    if (isset($_POST['z1']) && preg_match('/^[\da-fA-F]+h|[0-1]+b|(\d+(,\d+)?|\d{1,3}(\.\d{3})*)(,\d+)?$/', $_POST['z1'])) {
        // komma durch punkt ersetzen und in float validieren
        $z1 = getNumber($_POST['z1']);
    } else {
        error_handling($error, 0b1);
        $z1 = $_POST['z1'];
    }
    if (isset($_POST['z2']) && preg_match('/^[\da-fA-F]+h|[0-1]+b|(\d+(,\d+)?|\d{1,3}(\.\d{3})*)(,\d+)?$/', $_POST['z2'])) {
        $z2 = getNumber($_POST['z2']);
    } else {
        error_handling($error, 0b10);
        $z2 = $_POST['z2'];
    }
    if (isset($_POST['co']) && !$error) {
        $result = match (intval($_POST['co'])) {
            1   => $z1 + $z2,
            2   => $z1 - $z2,
            3   => $z1 * $z2,
            4   => $z2 != 0 ? $z1 / $z2 : error_handling($error, 0b100),
            5   => $z1 ** $z2,
            6   => $z2 != 0 ? $z1 % $z2 : error_handling($error, 0b100),
            default => error_handling($error, 0b1000)
        };
        if (!is_null($result)) {
            $co = intval($_POST['co']);
        }
    }elseif(isset($_POST['co']) && intval($_POST['co']) == 0){
        error_handling($error, 0b1000);
    }
    if(!$error){
        saveData($_POST['z1'], $_POST['z2'], $co, $result);
    }
} elseif(array_key_exists('delete', $_GET) && array_key_exists('calculations', $_SESSION)){
    if($_GET['delete'] == 'all' && array_key_exists('calculations', $_SESSION)){
        unset($_SESSION['calculations']);
    }elseif(is_numeric($_GET['delete']) && array_key_exists(intval($_GET['delete']), $_SESSION['calculations'])){
        array_splice($_SESSION['calculations'], intval($_GET['delete']), 1);
    }
} elseif(array_key_exists('load', $_GET) && array_key_exists('calculations', $_SESSION) && is_numeric($_GET['load']) && array_key_exists(intval($_GET['load']), $_SESSION['calculations'])){
    $load = true;
    $z1 = $_SESSION['calculations'][intval($_GET['load'])]['z1'];
    $z1 = $_SESSION['calculations'][intval($_GET['load'])]['z2'];
    $z1 = $_SESSION['calculations'][intval($_GET['load'])]['co'];
}
function error_handling(&$err, $errno)
{
    $err |= $errno;     // $error = $error | 0b1
    return null;
}
function getNumber(string $nr):float|int{   
    if(str_ends_with($nr, 'h')){                                    // prüfung auf hex-eingabe
        $nr = substr($nr, 0, -1);                                   // lösche letzte zeichen
        $nr = hexdec($nr);                                          // wandle string in dec um
    }elseif(str_ends_with($nr, 'b')){                               // prüfung auf bin-eingabe
        $nr = substr($nr, 0, -1);                                   // lösche letzte zeichen 
        $nr = bindec($nr);                                          // wandle string in dec um
    }elseif(str_contains($nr, ',')){                                // prüfe auf komma (dezimalzahl)
        $nr = floatval(str_replace(',', '.', $nr));
    }else{                                                          // sonst dec-eingabe
        $nr = intval($nr);
    }
    return $nr;
}
function getNumberType(string $nr):string{
    $type = '%d';
    if(str_ends_with($nr, 'h')){                                    // prüfung auf hex-eingabe
        $type = '%x<sub>hex</sub>';
    }elseif(str_ends_with($nr, 'b')){                               // prüfung auf bin-eingabe
        $type = '%b<sub>hex</sub>';
    }elseif(str_contains($nr, ',')){                                // prüfe auf komma (dezimalzahl)
        $type = '%.' . (strlen($nr) - (strrpos($nr, ',') + 1)) . 'f';
    }
    return $type;
}
function saveData(string|float|int $z1, string|float|int $z2, string $co, float $result):void {
    // prüfe ob innerhalb der SESSION das Array für die Kalkulationen noch nicht existiert
    if(!array_key_exists('calculations', $_SESSION)){
        $_SESSION['calculations'] = array();            // lege es an
    }
    // speichere die daten ab
    $_SESSION['calculations'][] = array(
        'z1'    => $z1,
        'z2'    => $z2,
        'co'    => $co,
        'result'=> $result
    );
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechner</title>
</head>

<body>
    <h1>Taschenrechner</h1>
    <div>
        <form action="<?=$_SERVER['SCRIPT_NAME']?>" method="post">
            <label for="z1"><span>Zahl 1</span><input type="text" name="z1" id="z1" value="<?= $error & 0b1 || $load ? $z1 : '' ?>"></label>
            <label for="co"><span>Rechenoperation</span><select name="co" id="co">
                    <option value="0">-- bitte wählen --</option>
                    <?php
                    foreach ($operations as $k => $v) {
                        echo '<option value="' . ($k + 1) . '"' . ($k==$co-1?' selected':'') . '>' . $v["label"] . '</option>';
                    }
                    ?>
                </select></label>
            <label for="z2"><span>Zahl 2</span><input type="text" name="z2" id="z2" value="<?= $error & 0b10 || $load ? $z2 : '' ?>"></label>
            <button type="submit" name="submit">=</button>
        </form>
        <div id="result">
            <!-- hier soll das Ergebnis oder ein Fehler der aktuellen Kalkulation ausgegeben werden -->
            <?php
            if (isset($_POST['submit']) && !is_null($result) && !$error) {
                echo "<p>" . number_format($result, intval(ini_get('precision')), ',', '.') . "</p>";
                echo "<p>" . decbin(intval($result)) . "<sub>b</sub></p>";
                echo "<p>" . dechex(intval($result)) . "<sub>h</sub></p>";
            } elseif ($error) {
                echo '<p>Fehler: ' . decbin($error) . "</p>";
                for($i=0; $i < count($errors); $i++){
                    // if(($error >> $i) % 2)       // alternative mit Rechtsschieben und Modulokalkulation
                    if(pow(2, $i) & $error){
                        echo "<p>" . $errors[$i] . "!</p>";
                    }
                }
            }
            ?>
        </div>
    </div>
    <div id="previousResults">
        <!-- hier sollen alle bisherigen Ergebnisse angezeigt werden
        Template:
        <div>
            <span>Zahl 1 Rechenoperator Zahl 2 = Ergebnis</span>
            <span>
                <a href="">Löschen</a>          -> das ergebnis soll aus dem Speicher gelöscht werden
                <a href="">Laden</a>            -> die Rechenoperation soll in das Formular geladen werden
            </span>
        </div>
-->
        <?php
        // durchlaufe sessioin letzter eintrag soll oben stehen
        if(array_key_exists('calculations', $_SESSION)){
            foreach(array_reverse($_SESSION['calculations'], true) as $k => $v){
                // bestimme für zahl 1 den zahlentypen (dec, float, hex, bin)
            $z1type = getNumberType(($v['z1']));
            // wandle zahl 1 in float oder dec um
            $z1 = getNumber($v['z1']);
            // bestimme für zahl 2 den zahlentypen (dec, float, hex, bin)
            $z2type = getNumberType(($v['z2']));
            // wandle zahl 2 in float oder dec um
            $z2 = getNumber($v['z2']);
            // korrigiere das template aus array operations - ersetze %s durch %d (dec) | %f (float) | %b (bin) | %x (hex);
            $format = sprintf($operations[$v['co']-1]['template'], $z1type, $z2type, getNumberType($v['result']));
            // erzeuge ausgabe
            echo '<div>
                <span>' . sprintf($format, $z1, $z2, $v['result']) . '</span>
                <span>
                    <a href="' . $_SERVER['SCRIPT_NAME'] . '?delete='.$k.'">Löschen</a>
                    <a href="' . $_SERVER['SCRIPT_NAME'] . '?load='.$k.'">Laden</a>
                    </span>
                    </div>';
                }
                echo '<a href="' . $_SERVER['SCRIPT_NAME'] . '?delete=all">Lösche Speicher</a>';
        }
        ?>
    </div>
</body>

</html>