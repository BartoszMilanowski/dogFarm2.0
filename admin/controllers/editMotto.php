<?php
session_start();
require_once "../../configure/db_connect.php";

if(isset($_POST["mottoPl"]) && isset($_POST["mottoEn"])
&& isset($_POST["mottoAuthor"]) && isset($_POST["currentPhotoId"])){


    $mottoPl = $_POST["mottoPl"];
    $mottoEn = $_POST["mottoEn"];
    $mottoAuthor = $_POST["mottoAuthor"];
    $photo = $_POST['currentPhotoId'];

    $query = "UPDATE motto SET motto = :motto, motto_author = :mottoAuthor, image_id = :imageId WHERE id = 1";

    $stmtPl = $dbPl->prepare($query);
    $stmtPl->bindParam(":motto", $mottoPl, PDO::PARAM_STR);
    $stmtPl->bindParam(":mottoAuthor", $mottoAuthor, PDO::PARAM_STR);
    $stmtPl->bindParam(":imageId", $photo, PDO::PARAM_INT);
    $stmtPl->execute();


    $stmtEn = $dbEn->prepare($query);
    $stmtEn->bindParam(":motto", $mottoEn, PDO::PARAM_STR);
    $stmtEn->bindParam(":mottoAuthor", $mottoAuthor, PDO::PARAM_STR);
    $stmtEn->bindParam(":imageId", $photo, PDO::PARAM_INT);
    $stmtEn->execute();


    $_SESSION['result'] = "Dane zaktualizowane";

    header('Location: ../motto.php');

}
