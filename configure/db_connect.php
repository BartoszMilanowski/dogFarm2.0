<?php

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$database = "ZKrainyNarwi";

try {
    $db = new PDO("mysql:host=$db_host;dbname=$database", $db_user, $db_pass);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "" . $e->getMessage();
}