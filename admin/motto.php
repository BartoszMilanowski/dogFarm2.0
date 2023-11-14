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


$currentPhoto = "../" . $aboutPl['motto_image'];
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <?php include "configure/head.php" ?>

    <title>
        Edytuj "motto"
    </title>
</head>

<body class="pb-5">
    <div class="container">
        <?php include "components/nav.php" ?>

        <h1 class="py-3">O nas</h1>
        <form>
            <div class="form-group">
                <label for="aboutMotto" class="form-label">Motto (strona główna)</label>
                <textarea class="form-control" id="aboutMotto"
                    style="min-height: 200px"><?= "{$aboutPl['motto']}" ?></textarea>
            </div>
            <div class="form-group">
                <label for="aboutMottoEn" class="form-label">Motto (strona główna) [wersja angielska]</label>
                <textarea class="form-control" id="aboutMottoEn"
                    style="min-height: 200px"><?= "{$aboutEn['motto']}" ?></textarea>
            </div>
            <div class="form-group">
                <label for="mottoAuthor" class="form-label">Autor motto</label>
                <input type="text" class="form-control" id="mottoAuthor" value="<?= "{$aboutPl['motto_author']}" ?>" />
            </div>
            <div class="form-group">
                <label for="currentPhoto" class="form-label">Zdjęcie główne</label><br />
                <img id="currentPhoto" class="currentPhoto" src="<?= "$currentPhoto" ?>" /><br />
                <input type="hidden" name="currentPhotoLink" value="<?= $currentPhoto ?>">
                <button class="btn btn-primary my-3 changePhoto">Zmień zdjęcie</button>

                <div class="showPhotos hidden">
                    <?php
                    foreach ($allPhotos as $photo) {

                        echo '<label class="form-label">';
                        echo '<input type="radio" name="selectedPhoto" value="' . $photo['link'] . '"/>';
                        echo '<img class="currentPhoto" src="../' . $photo['link'] . '" />';
                        echo '</label>';

                    }
                    ?>
                </div>
            </div>
        </form>
    </div>
</body>

</html>