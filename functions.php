<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funktionen</title>
</head>
<body>
    <h1>Funktionen</h1>
    <h2>Prozeduren (Function ohne Rückgabewert)</h2>
    <?php
        function power_1(){                     // keine Parameterübergabe erforderlich
            echo pow(2, 3) . "<br>";
        }
        function power_2(int|float $basis, int $potenz):void {      // beide Parameter müssen übergeben werden
            echo pow($basis, $potenz) . "<br>";
        }
        function power_3(int|float $basis, int $potenz = 2):void {  // parameter $potenz ist optional; wird er nich übergeben, wird 2 als Defaultwert verwendet
            echo pow($basis, $potenz) . "<br>";
        }
        // Aufruf von Prozeduren
        power_1();
        power_2(3, 2);
        power_3(4, 4);
        power_3(4);
    ?>
    <h2>Funktionen (Funktion mit Rückgabewert)</h2>
    <h3>Call-by-Value</h3>
    <?php
        function power_4(){
            return pow(2, 3);                   // return gibt einen Wert oder ein Array bzw. ein Objekt zurück
        }
        function power_5(int|float $basis, int $potenz):int|float {
            return pow($basis, $potenz);
        }
        function power_6(int|float $basis, int $potenz = 2):int|float {
            return pow($basis, $potenz);
        }
        echo power_4();
        $value_1 = 3;
        $value_2 = 4;
        $erg_5 = power_5($value_1, $value_2);
        $erg_6 = power_6($value_1, $value_2);
        $erg_7 = power_6($value_1);
        echo "<br>$erg_5, $erg_6, $erg_7<br>";
    ?>
    <h3>Call-by-Referenz</h3>
    <?php
        $value_3 = 15;
        function power_7(&$v):void {        // durch das & wird nicht der Wert sondern die Speicheradresse der Funktion von value_3 übergeben
            $v = pow($v, 2);
        }
        power_7($value_3);
        echo $value_3;
    ?>
    <h3>Variadische Funktionen</h3>
    <?php
        function variadisch(int|array ...$args) {
            foreach($args as $arg) {
                if(is_array($arg)){
                    variadisch(...$arg);        // rekrusiver aufruf der Funktioin durch sich selbst
                }else{
                    echo "$arg, ";
                }
            }
        }
        variadisch(1, 456, 2, [156, [12, 22], 234], 34, 12334);
    ?>
    <h3>Anonyme Funktionen</h3>
    <?php
        $quadrat = function(int $basis):int {
            return pow($basis, 2);
        };
        echo $quadrat(4);
    ?>
    <h3>Pfeilfunktionen</h3>
    <?php
        $q = fn(int $basis) => pow($basis, 2);
        echo $q(3);
    ?>
</body>
</html>