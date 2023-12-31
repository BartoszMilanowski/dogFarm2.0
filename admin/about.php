<?php

session_start();
require_once "../configure/db_connect.php";

$aboutQueryPl = $dbPl->prepare('SELECT * FROM about WHERE id = 1');
$aboutQueryPl->execute();
$aboutPl = $aboutQueryPl->fetch(PDO::FETCH_ASSOC);

$aboutQueryEn = $dbEn->prepare('SELECT * FROM about WHERE id = 1');
$aboutQueryEn->execute();
$aboutEn = $aboutQueryEn->fetch(PDO::FETCH_ASSOC);

$photoQuery = $dbPl->prepare('SELECT * FROM photos WHERE id = :imageId');
$photoQuery->bindValue(':imageId', $aboutPl['image_id']);
$photoQuery->execute();
$currentPhoto = $photoQuery->fetch(PDO::FETCH_ASSOC);

$allPhotosQuery = $dbPl->prepare('SELECT * FROM photos ORDER BY id DESC');
$allPhotosQuery->execute();
$allPhotos = $allPhotosQuery->fetchAll(PDO::FETCH_ASSOC);

$currentGalleryQuery = $dbPl->prepare('SELECT * FROM photo_gallery WHERE gallery_type = 3 AND gallery_id = 1');
$currentGalleryQuery->execute();
$currentGallery = $currentGalleryQuery->fetchAll(PDO::FETCH_ASSOC);

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
        <?php include "components/nav.php"; ?>

        <h1 class="py-3">O nas</h1>
        <?php

        if (isset($_SESSION['result'])) {

            $resultClass = isset($_SESSION['error']) ? 'error-class' : 'success-class';
            if (isset($_SESSION['error'])) {
                unset($_SESSION['error']);
            }

            echo "<p class='$resultClass'>{$_SESSION['result']}</p>";
            unset($_SESSION['result']);
        }
        ?>

        <form action="controllers/editAbout.php" method="post" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="aboutIntro" class="form-label">O nas - wstęp</label>
                <textarea class="form-control" id="aboutIntro" name="aboutIntro"
                    style="min-height: 200px"><?= "{$aboutPl['about_intro']}" ?></textarea>
            </div>
            <div class="form-group">
                <label for="aboutMain" class="form-label">O nas - tekst główny</label>
                <textarea class="form-control" id="aboutMain" name="aboutMain"
                    style="min-height: 200px"><?= "{$aboutPl['about_main']}" ?></textarea>
            </div>
            <div class="form-group">
                <label for="aboutIntroEn" class="form-label">O nas - wstęp [wersja angielska]</label>
                <textarea class="form-control" id="aboutIntroEn" name="aboutIntroEn"
                    style="min-height: 200px"><?= "{$aboutEn['about_intro']}" ?></textarea>
            </div>
            <div class="form-group">
                <label for="aboutMainEn" class="form-label">O nas - tekst główny [wersja angielska]</label>
                <textarea class="form-control" id="aboutMainEn" name="aboutMainEn"
                    style="min-height: 200px"><?= "{$aboutEn['about_main']}" ?></textarea>
            </div>
            <label for="currentPhoto" class="form-label">Zdjęcie główne</label><br />
            <span id="currentId">Id:
                <?= $currentPhoto['id'] ?>
            </span><br />
            <img id="currentPhoto" class="currentPhoto" src='<?= "../" . $currentPhoto['link'] ?>' /><br />
            <input type="hidden" name="currentPhotoId" value="<?= $currentPhoto['id'] ?>">

            <button class="btn btn-primary my-3 showList" data-target="list1">Zmień zdjęcie</button>

            <div class="photosList hidden" id="list1">
                <?php
                foreach ($allPhotos as $photo) {

                    echo '<label class="form-label">';
                    echo '<input type="radio" name="selectedPhotoId" value="' . $photo['id'] . '"/>';
                    echo '<img class="currentPhoto selectedPhotoLink" name="selectedPhotoLink" src="../' . $photo['link'] . '" />';
                    echo '</label>';

                }
                ?>
            </div>
            <div class="form-group">
                <label for="gallery" class="form-label">Galeria</label><br />


                <button class="btn btn-primary my-3 showList" data-target="list2">Pokaż</button>

                <div class="photosList hidden" id="list2">
                    <?php
                    foreach ($allPhotos as $photo) {

                        foreach ($currentGallery as $galleryItem) {
                            if ($galleryItem['image_id'] === $photo['id']) {
                                $isChecked = true;
                                break;
                            } else {
                                $isChecked = false;
                            }
                        }

                        echo '<label class="form-label">';
                        echo '<input type="checkbox" name="selectedPhotos[]" value="' . $photo['id'] . '"';
                        echo $isChecked ? 'checked' : '';
                        echo '/>';
                        echo '<img class="currentPhoto" src="../' . $photo['link'] . '" />';
                        echo '</label>';
                    }
                    ?>
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="Zapisz" />
                </div>
        </form>
    </div>
</body>

</html>