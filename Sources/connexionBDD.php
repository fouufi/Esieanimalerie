<?php

//connexion à la base de données:
$BDD = array();
$BDD['host'] = "localhost";
$BDD['user'] = "test";
$BDD['pass'] = "~w_xm>rzA#@2uJc";
$BDD['db'] = "MORVAN";

$mysqli = mysqli_connect($BDD['host'], $BDD['user'], $BDD['pass'], $BDD['db']);

if(!$mysqli)
{
    echo "Connexion non établie avec la BDD";
    exit;
}

   
?>
