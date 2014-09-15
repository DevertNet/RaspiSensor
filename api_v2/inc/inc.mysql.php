<?php

$benutzer = "root";
$passwort = "root";
$datenbank = "rpi";
//$db_link = mysql_connect ("127.0.0.1:8889", $benutzer, $passwort);
//mysql_select_db($datenbank, $db_link);

$mysqli = new mysqli ("127.0.0.1", $benutzer, $passwort, $datenbank);



/*
$benutzer = 'brand_new';
$passwort = 'fA84$_aD=a64==p_!aZ';
$datenbank = 'brand_new_challenge';
$db_link = mysql_connect ("db1", $benutzer, $passwort);
mysql_select_db($datenbank, $db_link);

*/




?>