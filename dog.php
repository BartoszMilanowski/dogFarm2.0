<?php
session_start();

require_once 'configure/db_connect.php';

if ($_SESSION['lang'] == 'pl') {
    $db = $dbPl;
} else {
    $db = $dbEn;
}

if(!isset($_GET['id']) || empty($_GET['id']) || $_GET['id'] == 0){
    header('Location: index.php');
    exit();
}

$dogId = $_GET['id'];

$dogQuery = $db->prepare("SELECT * FROM dog WHERE id = :dogId");
$dogQuery->bindParam(':dogId', $dogId);
$dogQuery->execute();
$dogResult = $dogQuery->fetch(PDO::FETCH_ASSOC);

$galleryQuery = $db->prepare("SELECT p.link
                                FROM photo_gallery pg
                                INNER JOIN photos p ON pg.image_id = p.id
                                WHERE pg.gallery_type = 2 AND pg.gallery_id = :galleryId");
$galleryQuery->bindParam(':galleryId', $dogId);
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
            echo $dogResult['dog_name'] . ' - Z Krainy Narwi';
        } else {
            echo $dogResult['dog_name'] . ' - From the Land of the Narew';
        }
        ?>
    </title>
</head>

<body>
    <?php include 'components/navbar.php' ?>
    <section id="about-dog">
        <div class="about-dog">
            <div class="about-dog-img">
                <img src=<?= $dogResult['main_photo'] ?> />
            </div>
            <div class="about-dog-text">
                <span class="dog-name">
                    <?= $dogResult['dog_name'] ?>
                </span>
                <span class="by-judges-title">
                    <?= $_SESSION['lang'] == 'pl' ? "W oczach sedziów" : "In the eyes of the judges" ?>
                </span>
                <p class="by-judges">
                    <?= $dogResult['about'] ?>
                </p>
            </div>
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