<?php


session_start();
require_once 'configure/db_connect.php';

if (!isset($_SESSION['lang_by_user'])) {
    if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
        $languages = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        $preferredLang = substr($languages, 0, 2);

        $_SESSION['lang'] = $preferredLang;
    } else {
        $_SESSION['lang'] = 'pl';
    }
}

if($_SESSION['lang'] == 'pl'){
    $db = $dbPl;
} else{
    $db = $dbEn;
}

$aboutQuery = $db->prepare('SELECT * FROM about WHERE id = 1');
$aboutQuery->execute();
$about = $aboutQuery->fetch(PDO::FETCH_ASSOC);

$aboutPhotoQuery = $db->prepare('SELECT * FROM photos WHERE id = :aboutImageId');
$aboutPhotoQuery->bindParam(':aboutImageId', $about['image_id']);
$aboutPhotoQuery->execute();
$aboutPhoto = $aboutPhotoQuery->fetch(PDO::FETCH_ASSOC);

$mottoQuery = $db->prepare('SELECT * FROM motto WHERE id = 1');
$mottoQuery->execute();
$motto = $mottoQuery->fetch(PDO::FETCH_ASSOC);

$mottoPhotoQuery = $db->prepare('SELECT * FROM photos WHERE id = :mottoImageId');
$mottoPhotoQuery->bindParam(':mottoImageId', $motto['image_id']);
$mottoPhotoQuery->execute();
$mottoPhoto = $mottoPhotoQuery->fetch(PDO::FETCH_ASSOC);

$breedQuery = $db->prepare('SELECT id, name, main_photo  FROM breeds');
$breedQuery->execute();
$breedList = $breedQuery->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <?php include 'configure/head.php'?>

    <title>
        <?php
        if ($_SESSION['lang'] == 'pl') {
            echo 'Z Krainy Narwi - hodowla psów rasowych';
        } else {
            echo 'From the Land of the Narew - purebred dog breeding';
        }
        ?>
    </title>
</head>

<body>
    <?php include 'components/navbar.php' ?>
    <!-- Slideshow -->
    <?php
    if (sizeof($breedList) > 0) {
        echo '<section id="slideshow">';
        foreach ($breedList as $breed) {
            echo <<<EOT
            <div class="slide">
                <img src="{$breed['main_photo']}"/>
                <div class="capture-text">
                    <a href="breed.php?id={$breed['id']}">{$breed['name']}</a>
                </div>
            </div>
            EOT;
        }
        echo '</section>';
    }

    ?>
    <!--Motto-->
    <section id="motto">
        <div class="motto-area">
            <div class="motto-text-area">
                <p class="motto-text">
                    <?= "{$motto['motto']}" ?>
                </p>
                <span class="author">
                    <?= "{$motto['motto_author']}" ?>
                </span>
            </div>
            <div class="motto-img-area">
                <img class="motto-img" src=<?= "{$mottoPhoto['link']}"?> />
            </div>
        </div>
    </section>
    <!--About-->
    <section id="about">
        <div class="about-section">
            <div class="about-section-image">
                <img src=<?= "{$aboutPhoto['link']}"?>>
            </div>
            <div class="about-section-text">
                <p>
                    <?= "{$about['about_intro']}" ?>
                </p>
                <a class="more-link" href="about.php">
                    <?php
                    if ($_SESSION['lang'] == 'pl') {
                        echo 'Czytaj więcej &gt;&gt;';
                    } else {
                        echo 'Read more &gt;&gt;';
                    }
                    ?>
                </a>
            </div>
        </div>
    </section>
    <?php include 'components/contact.php' ?>
    <?php include 'components/footer.php' ?>
</body>

</html>