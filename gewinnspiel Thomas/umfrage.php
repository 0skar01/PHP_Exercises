<?php
session_start();
$delemiter=";";
$error=0;
$name="";
$street="";
$zipcity="";
$internet=0;
$info=0;
$order=0;
$other="";
if(array_key_exists('submit',$_POST)&&array_key_exists('lawcheck',$_POST)){
    // check inputs
    if(!(array_key_exists('name',$_POST)&&!empty($_POST['name'])))$error|=0b10;
    if(!(array_key_exists('street',$_POST)&&!empty($_POST['street'])))$error|=0b100;
    if(!(array_key_exists('zipcity', $_POST)&&!empty($_POST['zipcity'])))$error|=0b1000;
    if(!(array_key_exists('internet',$_POST)&&!empty($_POST['internet'])))$error|=0b10000;
    if(!(array_key_exists('info',$_POST)&&!empty($_POST['info'])))$error|=0b100000;
    if(!(array_key_exists('order',$_POST)&&!empty($_POST['order'])))$error|=0b1000000;
    // Übernahme der Daten, die keinen Fehler enthalten
    if(!($error&0b10))$name=$_POST['name'];
    if(!($error&0b100))$street=$_POST['street'];
    if(!($error&0b1000))$zipcity=$_POST['zipcity'];
    if(!($error&0b10000))$internet=intval($_POST['internet']);
    if(!($error&0b100000))$info=intval($_POST['info']);
    if(!($error&0b1000000))$order=intval($_POST['order']);
    $other=$_POST['other'];
    // wenn Fehler vorhanden, dann speichere die Daten in der Session
    if($error) {
        // prüfe ob array in Session existiert
        if(!array_key_exists('errordata',$_SESSION))$_SESSION['errordata']=array();
        // speichere Daten
        $_SESSION['errordata']['error']=$error;
        $_SESSION['errordata']['name']=$name;
        $_SESSION['errordata']['street']=$street;
        $_SESSION['errordata']['zipcity']=$zipcity;
        $_SESSION['errordata']['internet']=$internet;
        $_SESSION['errordata']['info']=$info;
        $_SESSION['errordata']['order']=$order;
        $_SESSION['errordata']['other']=$other;
        if(array_key_exists('success',$_SESSION))unset($_SESSION['success']);
    }
    // wenn keine Fehler vorhanden sind
    else{
        // lösche Fehlerhafte Daten aus Session, wenn vorhanden
        if(array_key_exists('errordata',$_SESSION))unset($_SESSION['errordata']);
        // öffne Datei und setze Zeiger an das Ende
        $fh=fopen('umfrage_daten.csv',"a+");
        // Schreibe Daten in die Datei und füge Zeilenumbruch an das Ende an
        if(!fwrite($fh,sprintf("%s%s%s%s%s%s%d%s%d%s%d%s%s\n",$name,$delemiter,$street,$delemiter,$zipcity,$delemiter,$internet,$delemiter,$info,$delemiter,$order,$delemiter,$other))){
            $error|=0b10000000;            
        }else{
            $_SESSION['success']=true;
        };
        // Schließe Datei
        fclose($fh);
    }
}
// wenn Form ohne zustimmung zu den Bedingungen versendet wurde
elseif(array_key_exists('submit',$_POST)&&!array_key_exists('lawcheck',$_POST)){
    $error|=0b1;
}
// header sendet einen Ausgabe an den Client -> das kann eine Datei, ein Fehler, oder auch eine Url-Umleitung sein
header('Location: index.php');
// beende Script
exit();
?>