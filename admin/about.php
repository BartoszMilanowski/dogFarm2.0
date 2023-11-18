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

$allPhotosQuery = $dbPl->prepare('SELECT * FROM photos');
$allPhotosQuery->execute();
$allPhotos = $allPhotosQuery->fetchAll(PDO::FETCH_ASSOC);

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
        <?php
        include "components/nav.php";

        if (isset($_SESSION['result'])) {
            echo $_SESSION['result'];
            unset($_SESSION['result']);
        }
        ?>

        <h1 class="py-3">O nas</h1>

        <form action="controllers/editAbout.php" method="post">
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
            <span>Id: <?= $currentPhoto['id'] ?></span><br/>
            <span>Opis: <?= $currentPhoto['about'] ?></span><br/>
            <span>Alt: <?= $currentPhoto['alt'] ?></span><br/>
            <img id="currentPhoto" class="currentPhoto" src='<?= "../" . $currentPhoto['link'] ?>' /><br />
            <input type="hidden" name="currentPhotoId" value="<?= $currentPhoto['id'] ?>">
            <button class="btn btn-primary my-3 changePhoto">Zmień zdjęcie</button>

            <div class="showPhotos hidden">
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
                <input class="btn btn-primary" type="submit" value="Zapisz" />
            </div>
        </form>
    </div>
</body>

</html>