<?php
session_start();
var_dump($_SESSION);
var_dump($_POST);
$error = 0;
$name = null;
$street = null;
$zipcity = null;
$internet = null;
$info = null;
$order = null;
$other = null;


if(isset($_POST['submit'])){
    if(isset($_POST['name']) && $_POST['name'] != ''){
        $name = $_POST['name'];
    }else{
        $error |= 0b1;
        $name = $_POST['name'];
    }
    if(isset($_POST['street']) && $_POST['street'] != ''){
        $street = $_POST['street'];
    }else{
        $error |= 0b10;
        $street = $_POST['street'];
    }
    if(isset($_POST['zipcity']) && $_POST['zipcity'] != ''){
        $zipcity = $_POST['zipcity'];
    }else{
        $error |= 0b100;
        $zipcity = $_POST['zipcity'];
    }
    if(isset($_POST['internet']) && $_POST['internet'] != ''){
        $internet = $_POST['internet'];
    }else{
        $error |= 0b1000;
    }
    if(isset($_POST['info']) && $_POST['info'] != ''){
        $info = $_POST['info'];
    }else{
        $error |= 0b10000;
    }
    if(isset($_POST['order']) && $_POST['order'] != ''){
        $order = $_POST['order'];
    }else{
        $error |= 0b100000;
    }
    if(isset($_POST['other']) && $_POST['other'] != ''){
        $other = $_POST['other'];
    }else{
        $error |= 0b1000000;
        $other = $_POST['other'];
    }
    if(!isset($_POST['lawcheck']) || $_POST['lawcheck'] == '0'){
        $error |= 0b10000000;
    }
    $_SESSION['umfrage'] = array(
        'name' => $name,
        'street' => $street,
        'zipcity' => $zipcity,
        'internet' => $internet,
        'info'  => $info,
        'order' => $order,
        'other' => $other,
        'error' => $error
    );
    if(!$error){
        $record = fopen("record.csv", "a");
        fwrite($record,utf8_decode("$name,$street,$zipcity,$internet,$info,$order,$other\n\r"));
        fclose($record);
        header('Location: index.php');
    }elseif($error){
        // header sendet einen Ausgabe an den Client -> das kann eine Datei, ein Fehler, oder auch eine Url-Umleitung sein
        header('Location: index.php');
    }
}
?>
