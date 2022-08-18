<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontrollstrukturen</title>
</head>

<body>
    <h1>Kontrollstrukturen</h1>
    <h2>Verzweigungen</h2>
    <?php
    $a = 3;
    $b = 5;
    // einfachverzweigung
    if ($a < $b) {
        echo "a ist kleiner als b<br>";
    }
    if ($a < $b) echo "a ist kleiner als b<br>"; // bei nur einer Anweisung ist das {}-Paar optional

    // zweifachverweigung
    if ($a < $b) echo "a ist kleiner als b<br>";
    else echo "b ist kleiner als a<br>";
    // ternäre Schreibweise -> bedingung ? true : false ;
    echo $a < $b ? "a ist kleiner als b<br>" : "b ist kleiner als a<br>";

    // mehrfachverzweigung
    if ($a < $b) {
        echo "a ist kleiner als b<br>";
    } elseif ($a > $b) {
        echo "b ist kleiner als a<br>";
    } else if ($a == $b) {
        echo "a ist gleich b<br>";
    } else {
        echo "a kann mit b nicht verglichen werden<br>";
    }

    $note = 8;
    switch ($note) {
        case 1:
            echo "Sehr gut<br>";
            break;
        case 2:
            echo "Gut<br>";
            break;
        case 3:
            echo "Befriedigend<br>";
            break;
        case 4:
            echo "Ausreichend<br>";
            break;
        case 5:
            echo "Mangelhaft<br>";
            break;
        case 6:
            echo "ungenügend<br>";
            break;
        case 7:                         // wenn in einem case der break nicht angebegeben wird, dann wird der nächste case auch ausgeführt
        case 8:
            echo "Die Noten 7 und 8 sind noch nicht verfügbar!<br>";
            break;
        default:
            echo "Die Note $note ist uns unbekannt<br>";
    }

    echo $result = match($note){
        1 => "Sehr gut",
        2 => "Gut",
        3 => "Befriedigend",
        4 => "Ausreichend",
        5 => "Mangelhaft",
        6 => "ungenügend",
        7, 8 => "Die Noten 7 und 8 sind noch nicht verfügbar!",
        default => "Die Note $note ist uns unbekannt"
    };
    ?>
    <h2>Schleifen</h2>
    <h3>Kopfgesteuerte Schleifen</h3>
    <h4>Zählschleifen</h4>
    <?php
    for ($i = 0; $i < 10; $i++) {
        echo pow(2, $i) . ", ";
    }
    echo "<br>";
    ?>
    <h4>Bedingte Schleifen</h4>
    <?php
    $solange = false;
    $i = 0;
    while ($solange == false) {
        if (++$i >= 10) {
            $solange = true;
        }
        echo $i . ", ";
    }
    echo "<br>";

    // foreach bietet sich für das durchlaufen von assoziativen Arrays an
    $person = array(
        'firstname' => "Thomas",
        'surname'   => "Floß"
    );
    foreach($person as $value){     // $value erhält bei jedem Durchlauf den Wert des Indexes
        echo $value . ", ";
    }
    echo "<br>";
    foreach($person as $key => $value){     // $key erhält den Schlüüssel des jeweiligen Durchlaufs
        echo $key . ": " . $value . ", ";
    }
    echo "<br>";
    ?>
    <h3>Fußgesteuerte Schleifen</h3>
    <?php
    do {
        echo --$i . ", ";
    } while ($i >= 0);
    echo "<br>";
    ?>
    <h4>Bedingte Schleifen</h4>

</body>

</html>