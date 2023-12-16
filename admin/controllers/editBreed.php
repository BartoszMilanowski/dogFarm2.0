<?php
session_start();
require_once "../../configure/db_connect.php";

$breedName = $_POST['breedName'];
$breedId = $_POST['breedId'];

$basicInfoPl = $_POST['basicInfoPl'];
$dogCharacterPl = $_POST['dogCharacterPl'];
$appearancePl = $_POST['appearancePl'];
$sizePl = $_POST['sizePl'];
$coatPl = $_POST['coatPl'];
$ointmentPl = $_POST['ointmentPl'];
$headPl = $_POST['headPl'];
$neckPl = $_POST['neckPl'];
$eyesPl = $_POST['eyesPl'];
$earsPl = $_POST['earsPl'];
$torsoPl = $_POST['torsoPl'];
$forelimbsPl = $_POST['forelimbsPl'];
$hindLimbsPl = $_POST['hindLimbsPl'];
$tailPl = $_POST['tailPl'];
$temperamentPl = $_POST['temperamentPl'];

$basicInfoEn = $_POST['basicInfoEn'];
$dogCharacterEn = $_POST['dogCharacterEn'];
$appearanceEn = $_POST['appearanceEn'];
$sizeEn = $_POST['sizeEn'];
$coatEn = $_POST['coatEn'];
$ointmentEn = $_POST['ointmentEn'];
$headEn = $_POST['headEn'];
$neckEn = $_POST['neckEn'];
$eyesEn = $_POST['eyesEn'];
$earsEn = $_POST['earsEn'];
$torsoEn = $_POST['torsoEn'];
$forelimbsEn = $_POST['forelimbsEn'];
$hindLimbsEn = $_POST['hindLimbsEn'];
$tailEn = $_POST['tailEn'];
$temperamentEn = $_POST['temperamentEn'];

$showDogs = isset($_POST['showDogs']) ? 1 : 0;
$draft = isset($_POST['draft']) ? 1 : 0;
$photo = $_POST['currentPhotoId'];
$selectedPhotos = $_POST['selectedPhotos'];

$editQuery = "UPDATE breeds SET name = :name,
    draft = :draft,
    photo_id = :photo,
    show_dogs = :showDogs,
    basic_info = :basicInfo,
    dog_character = :dogCharacter,
    appearance = :appearance,
    size = :size,
    coat = :coat,
    ointment = :ointment,
    head = :head,
    neck = :neck,
    eyes = :eyes,
    ears = :ears,
    torso = :torso,
    forelimbs = :forelimbs,
    hind_limbs = :hindLimbs,
    tail = :tail,
    temperament = :temperament
    WHERE id = :breedId";

$addQuery = "INSERT INTO breeds
(name, draft, photo_id, show_dogs, basic_info, dog_character, appearance, size, coat, ointment, head, neck, eyes, ears, torso,
forelimbs, hind_limbs, tail, temperament)
VALUES (:name, :draft, :photo, :showDogs, :basicInfo, :dogCharacter, :appearance, :size, :coat, :ointment, :head, :neck, :eyes, :ears,
:torso, :forelimbs, :hindLimbs, :tail, :temperament)";

$photosInsertQuery = "INSERT INTO photo_gallery (gallery_type, gallery_id, image_id) VALUES (1, :galleryId, :galleryImageId)";
$photosDeleteQuery = "DELETE FROM photo_gallery WHERE gallery_type = 1 AND gallery_id = :galleryId";

if ($breedId != 0) {
    $stmtPl = $dbPl->prepare($editQuery);
    $stmtPl->bindParam(":breedId", $breedId, PDO::PARAM_INT);

    $stmtEn = $dbEn->prepare($editQuery);
    $stmtEn->bindParam(":breedId", $breedId, PDO::PARAM_INT);

} else {
    $stmtPl = $dbPl->prepare($addQuery);
    $stmtEn = $dbEn->prepare($addQuery);
}
$stmtPl->bindParam(":name", $breedName, PDO::PARAM_STR);
$stmtPl->bindParam(":draft", $draft, PDO::PARAM_INT);
$stmtPl->bindParam(":photo", $photo, PDO::PARAM_INT);
$stmtPl->bindParam(":showDogs", $showDogs, PDO::PARAM_INT);
$stmtPl->bindParam(":basicInfo", $basicInfoPl, PDO::PARAM_STR);
$stmtPl->bindParam(":dogCharacter", $dogCharacterPl, PDO::PARAM_STR);
$stmtPl->bindParam(":appearance", $appearancePl, PDO::PARAM_STR);
$stmtPl->bindParam(":size", $sizePl, PDO::PARAM_STR);
$stmtPl->bindParam(":coat", $coatPl, PDO::PARAM_STR);
$stmtPl->bindParam(":ointment", $ointmentPl, PDO::PARAM_STR);
$stmtPl->bindParam(":head", $headPl, PDO::PARAM_STR);
$stmtPl->bindParam(":neck", $neckPl, PDO::PARAM_STR);
$stmtPl->bindParam(":eyes", $eyesPl, PDO::PARAM_STR);
$stmtPl->bindParam(":ears", $earsPl, PDO::PARAM_STR);
$stmtPl->bindParam(":torso", $torsoPl, PDO::PARAM_STR);
$stmtPl->bindParam(":forelimbs", $forelimbsPl, PDO::PARAM_STR);
$stmtPl->bindParam(":hindLimbs", $hindLimbsPl, PDO::PARAM_STR);
$stmtPl->bindParam(":tail", $tailPl, PDO::PARAM_STR);
$stmtPl->bindParam(":temperament", $temperamentPl, PDO::PARAM_STR);
$stmtPl->execute();

$stmtEn->bindParam(":name", $breedName, PDO::PARAM_STR);
$stmtEn->bindParam(":draft", $draft, PDO::PARAM_INT);
$stmtEn->bindParam(":photo", $photo, PDO::PARAM_INT);
$stmtEn->bindParam(":showDogs", $showDogs, PDO::PARAM_INT);
$stmtEn->bindParam(":basicInfo", $basicInfoEn, PDO::PARAM_STR);
$stmtEn->bindParam(":dogCharacter", $dogCharacterEn, PDO::PARAM_STR);
$stmtEn->bindParam(":appearance", $appearanceEn, PDO::PARAM_STR);
$stmtEn->bindParam(":size", $sizeEn, PDO::PARAM_STR);
$stmtEn->bindParam(":coat", $coatEn, PDO::PARAM_STR);
$stmtEn->bindParam(":ointment", $ointmentEn, PDO::PARAM_STR);
$stmtEn->bindParam(":head", $headEn, PDO::PARAM_STR);
$stmtEn->bindParam(":neck", $neckEn, PDO::PARAM_STR);
$stmtEn->bindParam(":eyes", $eyesEn, PDO::PARAM_STR);
$stmtEn->bindParam(":ears", $earsEn, PDO::PARAM_STR);
$stmtEn->bindParam(":torso", $torsoEn, PDO::PARAM_STR);
$stmtEn->bindParam(":forelimbs", $forelimbsEn, PDO::PARAM_STR);
$stmtEn->bindParam(":hindLimbs", $hindLimbsEn, PDO::PARAM_STR);
$stmtEn->bindParam(":tail", $tailEn, PDO::PARAM_STR);
$stmtEn->bindParam(":temperament", $temperamentEn, PDO::PARAM_STR);
$stmtEn->execute();

if ($breedId != 0) {

    $stmtPlDelete = $dbPl->prepare($photosDeleteQuery);
    $stmtPlDelete->bindParam(":galleryId", $breedId, PDO::PARAM_INT);
    $stmtPlDelete->execute();

    foreach ($selectedPhotos as $selectedPhoto) {
        $stmtPlInsert = $dbPl->prepare($photosInsertQuery);
        $stmtPlInsert->bindParam(":galleryId", $breedId, PDO::PARAM_INT);
        $stmtPlInsert->bindParam(":galleryImageId", $selectedPhoto, PDO::PARAM_INT);
        $stmtPlInsert->execute();
    }

    $stmtEnDelete = $dbEn->prepare($photosDeleteQuery);
    $stmtEnDelete->bindParam(":galleryId", $breedId, PDO::PARAM_INT);
    $stmtEnDelete->execute();

    foreach ($selectedPhotos as $selectedPhoto) {
        $stmtEnInsert = $dbEn->prepare($photosInsertQuery);
        $stmtEnInsert->bindParam(":galleryId", $breedId, PDO::PARAM_INT);
        $stmtEnInsert->bindParam(":galleryImageId", $selectedPhoto, PDO::PARAM_INT);
        $stmtEnInsert->execute();
    }

    $_SESSION['result'] = "Dane zaktualizowane";
    header('Location: ../breed.php?id=' . $breedId);

} else {

    $breedId = $dbPl->lastInsertId();

    foreach ($selectedPhotos as $selectedPhoto) {
        $stmtPlInsert = $dbPl->prepare($photosInsertQuery);
        $stmtPlInsert->bindParam(":galleryId", $breedId, PDO::PARAM_INT);
        $stmtPlInsert->bindParam(":galleryImageId", $selectedPhoto, PDO::PARAM_INT);
        $stmtPlInsert->execute();
    }

    foreach ($selectedPhotos as $selectedPhoto) {
        $stmtEnInsert = $dbEn->prepare($photosInsertQuery);
        $stmtEnInsert->bindParam(":galleryId", $breedId, PDO::PARAM_INT);
        $stmtEnInsert->bindParam(":galleryImageId", $selectedPhoto, PDO::PARAM_INT);
        $stmtEnInsert->execute();
    }


    $_SESSION['result'] = $breedName . " dodano do listy ras";
    header('Location: ../breed.php?id=' . $breedId);

}

