<?php

session_start();
require_once "../configure/db_connect.php";

$mottoQueryPl = $dbPl->prepare('SELECT * FROM motto WHERE id = 1');
$mottoQueryPl->execute();
$mottoPl = $mottoQueryPl->fetch(PDO::FETCH_ASSOC);

$mottoQueryEn = $dbEn->prepare('SELECT * FROM motto WHERE id = 1');
$mottoQueryEn->execute();
$mottoEn = $mottoQueryEn->fetch(PDO::FETCH_ASSOC);

$photoQuery = $dbPl->prepare('SELECT * FROM photos WHERE id = :imageId');
$photoQuery->bindValue(':imageId', $mottoPl['image_id']);
$photoQuery->execute();
$currentPhoto = $photoQuery->fetch(PDO::FETCH_ASSOC);

$allPhotosQuery = $dbPl->prepare('SELECT * FROM photos ORDER BY id DESC');
$allPhotosQuery->execute();
$allPhotos = $allPhotosQuery->fetchAll(PDO::FETCH_ASSOC);

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

        <form action="controllers/editMotto.php" method="post" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="mottoPl" class="form-label">Motto (strona główna)</label>
                <textarea class="form-control" id="mottoPl" name="mottoPl"
                    style="min-height: 200px"><?= "{$mottoPl['motto']}" ?></textarea>
            </div>
            <div class="form-group">
                <label for="mottoEn" class="form-label">Motto (strona główna) [wersja angielska]</label>
                <textarea class="form-control" id="mottoEn" name="mottoEn"
                    style="min-height: 200px"><?= "{$mottoEn['motto']}" ?></textarea>
            </div>
            <div class="form-group">
                <label for="mottoAuthor" class="form-label">Autor motto</label>
                <input type="text" class="form-control" id="mottoAuthor" name="mottoAuthor"
                    value="<?= "{$mottoPl['motto_author']}" ?>" />
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
                    echo '<input type="hidden" name="selectedAbout" value"' . $photo['about'] . '"/>';
                    echo '<input type="hidden" name="selectedAlt" value"' . $photo['alt'] . '"/>';
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