<?php

session_start();
require_once "../configure/db_connect.php";

$aboutQueryPl = $dbPl->prepare('SELECT * FROM about WHERE id = 1');
$aboutQueryPl->execute();
$aboutPl = $aboutQueryPl->fetch(PDO::FETCH_ASSOC);

$aboutQueryEn = $dbEn->prepare('SELECT * FROM about WHERE id = 1');
$aboutQueryEn->execute();
$aboutEn = $aboutQueryEn->fetch(PDO::FETCH_ASSOC);

$allPhotosQuery = $dbPl->prepare('SELECT * FROM photos');
$allPhotosQuery->execute();
$allPhotos = $allPhotosQuery->fetchAll(PDO::FETCH_ASSOC);

$currentGalleryQuery = $dbPl->prepare('SELECT * FROM photo_gallery WHERE gallery_type = 3 AND gallery_id = 1');
$currentGalleryQuery->execute();
$currentGallery = $currentGalleryQuery->fetchAll(PDO::FETCH_ASSOC);



$currentPhoto = "../" . $aboutPl['about_image'];
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <?php include "configure/head.php" ?>

    <title>
        Edytuj "o nas"
    </title>
</head>

<body class="pb-5">
    <div class="container">
        <?php include "components/nav.php" ?>

        <h1 class="py-3">O nas</h1>

        <form action="controllers/editAbout.php" method="post">
            <div class="form-group">
                <label for="aboutIntro" class="form-label">O nas - wstęp</label>
                <textarea class="form-control" id="aboutIntro"
                    style="min-height: 200px"><?= "{$aboutPl['about_intro']}" ?></textarea>
            </div>
            <div class="form-group">
                <label for="aboutMain" class="form-label">O nas - tekst główny</label>
                <textarea class="form-control" id="aboutMain"
                    style="min-height: 200px"><?= "{$aboutPl['about_main']}" ?></textarea>
            </div>
            <div class="form-group">
                <label for="aboutIntroEn" class="form-label">O nas - wstęp [wersja angielska]</label>
                <textarea class="form-control" id="aboutIntroEn"
                    style="min-height: 200px"><?= "{$aboutEn['about_intro']}" ?></textarea>
            </div>
            <div class="form-group">
                <label for="aboutMainEn" class="form-label">O nas - tekst główny [wersja angielska]</label>
                <textarea class="form-control" id="aboutMainEn"
                    style="min-height: 200px"><?= "{$aboutEn['about_main']}" ?></textarea>
            </div>
            <div class="form-group">
                <input class="btn btn-primary" type="submit" value="Zapisz"/>
            </div>
        </form>
<!-- 

        <div class="form-group">
            <label for="currentPhoto" class="form-label">Zdjęcie główne</label><br />
            <img id="currentPhoto" class="currentPhoto" src="<?= "$currentPhoto" ?>" /><br />
            <label for="newPhoto" class="btn btn-primary my-3">Wybierz plik</label>
            <input type="file" id="newPhoto" name="newPhoto" style="display: none" />
            <input type="hidden" name="currentPhotoLink" value="<?= $currentPhoto ?>"> -->





            <!--<button class="btn btn-primary my-3 changePhoto">Zmień zdjęcie</button>

                <div class="showPhotos hidden"> -->
            <?php
            /*foreach ($allPhotos as $photo) {

                echo <<<EOT
                <label class="form-label">
                <input type="radio" name="selectedPhoto" value="{$photo['link']}"/>
                <img class="currentPhoto" src="../{$photo['link']}" />
                </label>
                EOT;

            }*/
            ?>
            <!-- </div> -->
        </div>
        <div class="form-group">
            <!-- <label for="gallery" class="form-label">Galeria</label><br />

                <div class="gallery"> -->
            <?php
            /*foreach ($allPhotos as $photo) {

                foreach($currentGallery as $galleryItem){
                    if($galleryItem['photo_link'] === $photo['link']){
                        $isChecked = true;
                        break;
                    } else {
                        $isChecked = false;
                    }
                }

                echo '<label class="form-label">';
                echo '<input type="checkbox" value="' . $photo['link'] . '"';
                echo $isChecked ? 'checked' : '';
                echo '/>';
                echo '<img class="currentPhoto" src="../' . $photo['link'] . '" />';
                echo '</label>';

            }*/
            ?>
            <!-- </div> -->
        </div>
    </div>

</body>

</html>