<?php

session_start();

$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$databasePl = 'ZKrainyNarwi';
$databaseEn = 'ZKrainyNarwi_en';

try {
    
    $dbPl = new PDO("mysql:host=$dbHost;dbname=$databasePl", $dbUser, $dbPass);
    $dbPl->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $dbEn = new PDO("mysql:host=$dbHost;dbname=$databaseEn", $dbUser, $dbPass);
    $dbEn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "" . $e->getMessage();
}

