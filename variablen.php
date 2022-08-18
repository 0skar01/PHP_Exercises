<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Variablen, Konstanten und Super Globals in PHP</title>
</head>

<body>
    <pre>
        <?php

        // einfache variablen deklarieren
        $a;
        // Deklaration mit Initialisierung
        $b = 24;
        // Ausgabe von Variablen
        echo $b;        // Wertausgabe
        print_r($b);    // gibt einige Infos zur Variablen in lesbarer Form aus
        var_dump($b);   // gibt alle Informatioinen einer Variablen aus
        echo '<br>';

        // Konstanten
        define('MWST_VOLL', 0.19);
        echo MWST_VOLL;
        const MWST_ERMAESSIGT = 0.07;
        echo '<br>';

        // Super-Global (sind global vorhanden und werden durch PHP bereitgestellt) - sind i. d. R. Arrays
        var_dump($_SERVER);     // alle Serverinformationen (Achtung: Unterschiede zwischen Unix und Windows)
        echo '<br>';

        var_dump($_GET);        // alle an der URL per GET übermittelten Parameter und Werte
        echo '<br>';

        var_dump($_POST);       // alle an der URL per POST übermittelten Parameter und Werte
        echo '<br>';

        var_dump($_FILES);      // die über ein <input type-"file"> übermittelten Datein
        echo '<br>';

        var_dump($_COOKIE);     // zugriff auf die clientseitig gespeicherten Cookiedaten
        echo '<br>';

        var_dump($_SESSION);    // Zugriff auf das Serverseitige Sitzungscookie (existiert erst, wenn die Session mit session_start(); begonnen wurde)
        echo '<br>';

        var_dump($_REQUEST);    // enthält $_GET, $_POST, $_COOKIE
        echo '<br>';

        var_dump($_ENV);        // enthält die Umgebungsvariablen 
        echo '<br>';


        // Deklaration von Arrays - Indizierte Arrays; kleinster Index = 0
        $arr_1 = array();                           // nur Deklaration
        $arr_2 = array(12, 13, 'text', 23454.78);   // Deklaration mit Initialisierung; in PHP kann ein Array auch verschiedene Datentypen enthalten

        $arr_3 = [];
        $arr_4 = [12, 13, 'text', 23454.78];

        // Zugriff auf indizierte Arrays
        echo $arr_2[2];                             // = text

        // anfügen neuer Indexeinträge
        $arr_2[] = 'zusätzlicher Wert';             // fügt an das Ende einen weiteren Index mit dem Wert an
        $arr_2[7] = 'vorgegebener Index';           // fügt einen neuen vorgegebenen Index an das Array an; Index 5 und 6 bleiben unbelegt

        var_dump($arr_1);
        echo '<br>';
        var_dump($arr_2);
        echo '<br>';
        var_dump($arr_3);
        echo '<br>';
        var_dump($arr_4);
        echo '<br>';


        // Deklaration von Arrays - Assoziative Arrays
        $arr_ass_1 = array(
            'firstname' => "Thomas",
            'surname'   => "Floß"
        );

        var_dump($arr_ass_1);
        echo '<br>';

        // Anfügen neuer Einträge bei assoziativen Einträgen
        $arr_ass_1['sex'] = 'Herr';

        var_dump($arr_ass_1);
        echo '<br>';

        // Zugriff auf einen Schlüssel (Key)
        echo $arr_ass_1['firstname'];
        echo '<br>';

        // mehrdimentionale Arrays
        $persons = array(                                   // 1. Dimension
            array(                                          // 2. Dimension
                'firstname' => "Thomas",
                'surname'   => "Floß",
                'address'   => array(                       // 3. Dimension
                    'zip'   => "08200",
                    'city'  => "Aue-Bad Schlema",
                    'street' => "Kirchstraße 1"
                )
            ),
            array(
                'firstname' => "Max",
                'surname'   => "Mustermann",
                'address'   => array(
                    'zip'   => "91156",
                    'city'  => "Musterstadt",
                    'street' => "Bahnhofstraße 27"
                )
            )
        );

        $persons[] = array(
            'firstname' => "Maria",
            'surname'   => "Mustermann",
            'address'   => array(
                'zip'   => "91156",
                'city'  => "Musterstadt",
                'street' => "Bahnhofstraße 27"
            )
        );

        $persons[0]['mobil'] = "0172 5648521";

        var_dump($persons);
        echo '<br>';

        ?>
    </pre>
</body>

</html>