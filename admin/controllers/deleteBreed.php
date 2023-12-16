<?php

require_once "../../configure/db_connect.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $removeQuery = 'DELETE FROM breeds WHERE id = :id';
    
    $stmtPl = $dbPl->prepare($removeQuery);
    $stmtPl->bindParam(':id', $id, PDO::PARAM_INT);
    $stmtPl->execute();

    $stmtEn = $dbEn->prepare($removeQuery);
    $stmtEn->bindParam(':id', $id, PDO::PARAM_INT);
    $stmtEn->execute();

    header('Location: ../breedList.php');
}