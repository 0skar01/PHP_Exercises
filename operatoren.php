<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operatoren</title>
</head>

<body>
    <?php
    // Standardoperatoren
    $a = 5;
    $b = 3;
    $c = "14";
    // Addition
    echo ($a + $b) . "<br>";    // . verknüpft Zeichenkette
    echo ($a + $c) . "<br>";
    // Subtraktion
    echo ($a - $b) . "<br>";
    // Multiplikation
    echo ($a * $b) . "<br>";
    // Division
    echo ($a / $b) . "<br>";
    // Modulo
    echo ($a % $b) . "<br>";
    // Potenzierung
    echo ($a ** $b) . "<br>";   // 5^3
    echo pow($a, $b) . "<br>";  // Alternative Potenzierung mit PHP-Funktion

    // Binäre Operatoren
    echo decbin($a) . "<br>";   // decbin() wandelt eine Dezimalzahl in eine Binärzahl ( String) um
    echo decbin($b) . "<br>";

    // UND
    echo ($a & $b) . "<br>";
    echo decbin($a & $b) . "<br>";
    // ODER
    echo ($a | $b) . "<br>";
    echo decbin($a | $b) . "<br>";
    // XODER
    echo ($a ^ $b) . "<br>";
    echo decbin($a ^ $b) . "<br>";

    // NOT (NICHT)
    echo ($a) . "<br>";
    echo decbin(~$a) . "<br>";

    // Bitweises Schieben
    echo "Rechtsschieben<br>";
    echo decbin($a) . "<br>";     
    echo decbin($a >> 3) . "<br>";      // Rechtschieben um 3 Stellen
    
    echo "Linksschieben<br>";
    echo decbin($a) . "<br>";     
    echo decbin($a << 3) . "<br>";      // Linkschieben um 3 Stellen

    // Verglichsoperatoren
    echo "Verglichoperatoren<br>";
    $d = true;                  // true sind auch alle Zahlen (int, float) unglich 0
    $e = false;                 // false ist auch 0
    $f = 1;

    echo "gleich: " . $d == $f . "<br>";       // gleich - es werden nur die Werte überprüft
    echo "identisch: " . $d === $f . "<br>";      // identisch - es werden nur die Werte und der Datentypüberprüft

    echo "ungleich: " . $d != $f . "<br>";       // ungleich - es werden nur die Werte überprüft
    echo "ungleich: " . $d <> $f . "<br>";       // ungleich - es werden nur die Werte überprüft
    echo "unidentisch: " . $d !== $f . "<br>";      // identisch - es werden nur die Werte und der Datentypüberprüft

    echo "kleiner als: " . ($a < $b) . "<br>";
    echo "größer als: " . ($a > $b) . "<br>";
    echo "kleiner oder gleich: " . ($a <= $b) . "<br>";
    echo "größer oder gleich: " . ($a >= $b) . "<br>";

    echo "Spaceship (Raumschiff): " . ($a <=> $b) . "<br>"; // wenn a großer b = 1, wenn a gleich b = 0, wenn a kleiner b = -1
    echo "Spaceship (Raumschiff): " . ($b <=> $a) . "<br>"; 
    echo "Spaceship (Raumschiff): " . ($a <=> $a) . "<br>";

    // Operator zur Fehlerunterdrückung - bitte mit Vorsicht nutzen
    $arr = array();
    echo "Ohne: " . $arr[3] . "<br>";
    echo "mit: " . @$arr[3] . "<br>";

    // Logische Operatoren
    echo (bool)(true && false) . "<br>";        // logisches UND
    echo (bool)(true || false) . "<br>";        // logisches ODER
    echo (bool)(true ^ false) . "<br>";         // logisches XODER
    echo (bool)(!false) . "<br>";               // logisches NICHT
    ?>
</body>

</html>