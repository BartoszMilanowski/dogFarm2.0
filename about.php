<?php
session_start();

require_once 'configure/db_connect.php';

if ($_SESSION['lang'] == 'pl') {
    $db = $dbPl;
} else {
    $db = $dbEn;
}

$aboutQuery = $db->prepare('SELECT * FROM about WHERE id = 1');
$aboutQuery->execute();
$about = $aboutQuery->fetch(PDO::FETCH_ASSOC);

$mainPhotoQuery = $db->prepare('SELECT * FROM photos WHERE id = :imageId');
$mainPhotoQuery->bindParam('imageId', $about['image_id']);
$mainPhotoQuery->execute();
$mainPhoto = $mainPhotoQuery->fetch(PDO::FETCH_ASSOC);

$galleryQuery = $db->prepare("SELECT p.link
                                FROM photo_gallery pg
                                INNER JOIN photos p ON pg.image_id = p.id
                                WHERE pg.gallery_type = 3 AND pg.gallery_id = 1");
$galleryQuery->execute();
$gallery = $galleryQuery->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <?php include 'configure/head.php' ?>

    <title>
        <?php
        if ($_SESSION['lang'] == 'pl') {
            echo 'O nas - Z Krainy Narwi';
        } else {
            echo 'About us - From the Land of the Narew';
        }
        ?>
    </title>
</head>

<body>
    <?php include 'components/navbar.php' ?>
    <!--About-->
    <section id="about-page">
        <div class="about-page-first">
            <div class="about-page-image">
                <img src=<?= "{$mainPhoto['link']}" ?> alt=<?= "{$mainPhoto['alt']}" ?>>
            </div>
            <div class="about-page-text-first">
                <p>
                    <?= "{$about['about_intro']}" ?>
                </p>
            </div>
        </div>
        <div class="about-page-content">
            <?= "{$about['about_main']}" ?>
        </div>
    </section>

    <!--Gallery-->
    <?php

    if (sizeof($gallery) > 0) {
        echo <<<EOT
            <section id="about-gallery">
                <div class="gallery">
        EOT;
        foreach ($gallery as $item) {
            echo <<<EOT
                <div class="gallery-item">
                    <img src="{$item['link']}" />
                </div>
            EOT;
        }
        echo <<<EOT
                </div>
            </section>
        EOT;
    }
    ?>

    <?php include 'components/contact.php' ?>
    <?php include 'components/footer.php' ?>
</body>

</html>