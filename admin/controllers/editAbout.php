<?php
session_start();
require_once "../../configure/db_connect.php";

if (
    isset($_POST["aboutIntro"]) && isset($_POST["aboutMain"])
    && isset($_POST["aboutIntroEn"]) && isset($_POST["aboutMainEn"]) &&
    isset($_POST["currentPhotoId"])
) {

    $aboutIntroPl = $_POST["aboutIntro"];
    $aboutMainPl = $_POST["aboutMain"];
    $aboutIntroEn = $_POST["aboutIntroEn"];
    $aboutMainEn = $_POST["aboutMainEn"];
    $photo = $_POST['currentPhotoId'];
    $selectedPhotos = $_POST['selectedPhotos'];

    $query = "UPDATE about SET about_intro = :aboutIntro, about_main = :aboutMain, image_id = :imageId WHERE id = 1";
    $photosInsertQuery = "INSERT INTO photo_gallery (gallery_type, gallery_id, image_id) VALUES (3, 1, :galleryImageId)";
    $photosDeleteQuery = "DELETE FROM photo_gallery WHERE gallery_type = 3 AND gallery_id = 1";

    $stmtPl = $dbPl->prepare($query);
    $stmtPl->bindParam(":aboutIntro", $aboutIntroPl, PDO::PARAM_STR);
    $stmtPl->bindParam(":aboutMain", $aboutMainPl, PDO::PARAM_STR);
    $stmtPl->bindParam(":imageId", $photo, PDO::PARAM_INT);
    $stmtPl->execute();
    $stmtPlDelete = $dbPl->prepare($photosDeleteQuery);
    $stmtPlDelete->execute();

    foreach ($selectedPhotos as $photo) {
        $stmtPlInsert = $dbPl->prepare($photosInsertQuery);
        $stmtPlInsert->bindParam(":galleryImageId", $photo, PDO::PARAM_INT);
        $stmtPlInsert->execute();
    }

    $stmtEn = $dbEn->prepare($query);
    $stmtEn->bindParam(":aboutIntro", $aboutIntroEn, PDO::PARAM_STR);
    $stmtEn->bindParam(":aboutMain", $aboutMainEn, PDO::PARAM_STR);
    $stmtEn->bindParam(":imageId", $photo, PDO::PARAM_INT);
    $stmtEn->execute();
    $stmtEnDelete = $dbEn->prepare($photosDeleteQuery);
    $stmtEnDelete->execute();

    foreach ($selectedPhotos as $photo) {
        $stmtEnInsert = $dbEn->prepare($photosInsertQuery);
        $stmtEnInsert->bindParam(":galleryImageId", $photo, PDO::PARAM_INT);
        $stmtEnInsert->execute();
    }

    $_SESSION['result'] = "Dane zaktualizowane";
    header('Location: ../about.php');

}