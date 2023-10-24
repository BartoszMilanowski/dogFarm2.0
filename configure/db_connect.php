<?php

session_start();

$db_host = "localhost";
$db_user = "root";
$db_pass = "";

if($_SESSION['lang'] == 'pl'){
    $database = "ZKrainyNarwi";

} else{
    $database = "ZKrainyNarwi_en";
}

try {
    $db = new PDO("mysql:host=$db_host;dbname=$database", $db_user, $db_pass);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "" . $e->getMessage();
}