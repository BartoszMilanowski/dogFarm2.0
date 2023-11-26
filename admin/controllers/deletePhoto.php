<?php

require_once "../../configure/db_connect.php";


if(isset($_GET["id"])){
    $id = $_GET["id"];

    //Get picture data

    $photoQuery = $dbPl->prepare('SELECT * from photos WHERE id=:id');
    $photoQuery->bindParam(':id', $id, PDO::PARAM_INT);
    $photoQuery->execute();
    $photo = $photoQuery->fetch(PDO::FETCH_ASSOC);

    // print_r($photo);

    //Remove picture from dir

    unlink('../../' . $photo['link']);

    //Remove picture from galleries

    $removeFromGalleryQuery = 'DELETE FROM photo_gallery WHERE image_id = :id';

    $removeFromGalleryStmtPl = $dbPl->prepare($removeFromGalleryQuery);
    $removeFromGalleryStmtPl->bindParam(':id', $id, PDO::PARAM_INT);
    $removeFromGalleryStmtPl->execute();

    $removeFromGalleryStmtEn = $dbEn->prepare($removeFromGalleryQuery);
    $removeFromGalleryStmtEn->bindParam(':id', $id, PDO::PARAM_INT);
    $removeFromGalleryStmtEn->execute();
    
    //Remove picture from list

    $removePhotoQuery = 'DELETE FROM photos WHERE id=:id';

    $removePhotoStmtPl=$dbPl->prepare($removePhotoQuery);
    $removePhotoStmtPl->bindParam(':id', $id, PDO::PARAM_INT);
    $removePhotoStmtPl->execute();


    $removePhotoStmtEn=$dbEn->prepare($removePhotoQuery);
    $removePhotoStmtEn->bindParam(':id', $id, PDO::PARAM_INT);
    $removePhotoStmtEn->execute();

    header('Location: ../photos.php');
}

?>