<?php

session_start();
require_once "../configure/db_connect.php";

if (!isset($_GET['id'])) {
    header('Location:breedList.php');
}
;

$id = $_GET['id'];

if ($id != 0) {
    $query = 'SELECT * FROM breeds WHERE id = :id';

    $breedQueryPl = $dbPl->prepare($query);
    $breedQueryPl->bindParam(':id', $id, PDO::PARAM_INT);
    $breedQueryPl->execute();
    $breedPl = $breedQueryPl->fetch(PDO::FETCH_ASSOC);

    $breedQueryEn = $dbEn->prepare($query);
    $breedQueryEn->bindParam(':id', $id, PDO::PARAM_INT);
    $breedQueryEn->execute();
    $breedEn = $breedQueryEn->fetch(PDO::FETCH_ASSOC);


    $photoQuery = $dbPl->prepare('SELECT * FROM photos WHERE id = :imageId');
    $photoQuery->bindValue(':imageId', $breedPl['photo_id']);
    $photoQuery->execute();
    $currentPhoto = $photoQuery->fetch(PDO::FETCH_ASSOC);
}

$allPhotosQuery = $dbPl->prepare('SELECT * FROM photos ORDER BY id DESC');
$allPhotosQuery->execute();
$allPhotos = $allPhotosQuery->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="pl">

<head>
    <?php include "configure/head.php" ?>

    <title>
        Edytuj
        <?= $breedPl['name'] ?>
    </title>
</head>

<body class="pb-5">
    <div class="container">
        <?php include "components/nav.php"; ?>

        <h1 class="py-3">Edytuj
            <?= $breedPl['name'] ?>
        </h1>
        <form action="#" method="post">
            <div class="form-group">
                <label for="breedName" class="form-label">Nazwa rasy</label>
                <input class="form-control" type="text" id="breedName" name="breedName"
                    value="<?= $breedPl['name'] ?>" />
                <input type="hidden" id="breedId" name="breedId" value="<?= $breedPl['id'] ?>" />
            </div>
            <div class="form-group">
                <label for="basicInfo" class="form-label">Podstawowe dane</label>
                <br /><small>PL</small>
                <textarea class="form-control" id="basicInfo"
                    name="basicInfoPl"><?= $breedPl['basic_info'] ?></textarea>
                <small>EN</small>
                <textarea class="form-control" id="basicInfo"
                    name="basicInfoEn"><?= $breedEn['basic_info'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="dogCharakter" class="form-label">Charakter</label>
                <br /><small>PL</small>
                <textarea class="form-control" id="dogCharakter"
                    name="dogCharakterPl"><?= $breedPl['dog_character'] ?></textarea>
                <small>EN</small>
                <textarea class="form-control" id="dogCharakter"
                    name="dogCharakterEn"><?= $breedEn['dog_character'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="apparence" class="form-label">Wygląd</label>
                <br /><small>PL</small>
                <textarea class="form-control" id="apparence"
                    name="apparencePl"><?= $breedPl['appearance'] ?></textarea>
                <small>EN</small>
                <textarea class="form-control" id="apparence"
                    name="apparenceEn"><?= $breedEn['appearance'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="size" class="form-label">Wielkość</label>
                <br /><small>PL</small>
                <textarea class="form-control" id="size" name="sizePl"><?= $breedPl['size'] ?></textarea>
                <small>EN</small>
                <textarea class="form-control" id="size" name="sizeEn"><?= $breedEn['size'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="coat" class="form-label">Szata</label>
                <br /><small>PL</small>
                <textarea class="form-control" id="coat" name="coatPl"><?= $breedPl['coat'] ?></textarea>
                <small>EN</small>
                <textarea class="form-control" id="coat" name="coatEn"><?= $breedEn['coat'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="ointment" class="form-label">Maść</label>
                <br /><small>PL</small>
                <textarea class="form-control" id="ointment" name="ointmentPl"><?= $breedPl['ointment'] ?></textarea>
                <small>EN</small>
                <textarea class="form-control" id="ointment" name="ointmentEn"><?= $breedEn['ointment'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="head" class="form-label">Głowa</label>
                <br /><small>PL</small>
                <textarea class="form-control" id="head" name="headPl"><?= $breedPl['head'] ?></textarea>
                <small>EN</small>
                <textarea class="form-control" id="head" name="headEn"><?= $breedEn['head'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="neck" class="form-label">Szyja</label>
                <br /><small>PL</small>
                <textarea class="form-control" id="neck" name="neckPl"><?= $breedPl['neck'] ?></textarea>
                <small>EN</small>
                <textarea class="form-control" id="neck" name="neckEn"><?= $breedEn['neck'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="eyes" class="form-label">Oczy</label>
                <br /><small>PL</small>
                <textarea class="form-control" id="eyes" name="eyesPl"><?= $breedPl['eyes'] ?></textarea>
                <small>EN</small>
                <textarea class="form-control" id="eyes" name="eyesEn"><?= $breedEn['eyes'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="ears" class="form-label">Uszy</label>
                <br /><small>PL</small>
                <textarea class="form-control" id="ears" name="earsPl"><?= $breedPl['ears'] ?></textarea>
                <small>EN</small>
                <textarea class="form-control" id="ears" name="earsEn"><?= $breedEn['ears'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="torso" class="form-label">Tułów</label>
                <br /><small>PL</small>
                <textarea class="form-control" id="torso" name="torsoPl"><?= $breedPl['torso'] ?></textarea>
                <small>EN</small>
                <textarea class="form-control" id="torso" name="torsoEn"><?= $breedEn['torso'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="forelimbs" class="form-label">Kończyny przednie</label>
                <br /><small>PL</small>
                <textarea class="form-control" id="forelimbs" name="forelimbsPl"><?= $breedPl['forelimbs'] ?></textarea>
                <small>EN</small>
                <textarea class="form-control" id="forelimbs" name="forelimbsEn"><?= $breedEn['forelimbs'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="hindLimbs" class="form-label">Kończyny tylne</label>
                <br /><small>PL</small>
                <textarea class="form-control" id="hindLimbs"
                    name="hindLimbsPl"><?= $breedPl['hind_limbs'] ?></textarea>
                <small>EN</small>
                <textarea class="form-control" id="hindLimbs"
                    name="hindLimbsEn"><?= $breedEn['hind_limbs'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="tail" class="form-label">Ogon</label>
                <br /><small>PL</small>
                <textarea class="form-control" id="tail" name="tailPl"><?= $breedPl['tail'] ?></textarea>
                <small>EN</small>
                <textarea class="form-control" id="tail" name="tailEn"><?= $breedEn['tail'] ?></textarea>
            </div>
            <div class="form-group mb-3">
                <label for="temperament" class="form-label">Temperament</label>
                <br /><small>PL</small>
                <textarea class="form-control" id="temperament"
                    name="temperamentPl"><?= $breedPl['temperament'] ?></textarea>
                <small>EN</small>
                <textarea class="form-control" id="temperament"
                    name="temperamentEn"><?= $breedEn['temperament'] ?></textarea>
            </div>

            <?php
            if($id != 0){
                echo<<<EOT
                <img id="currentPhoto" class="currentPhoto" src='../{$currentPhoto["link"]}' /><br />
                <input type="hidden" name="currentPhotoId" value="{$currentPhoto['id']}">
                EOT;
            }
            
            ?>
            <button class="btn btn-primary my-3 showList" data-target="list1">Zmień zdjęcie</button>
        </form>
    </div>

</body>

</html>